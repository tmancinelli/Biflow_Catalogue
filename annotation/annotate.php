<?php

$files = scandir('../api/src/Entity');

$data = Array();
foreach ($files as $file) {
  if ($file[0] == '.') continue;

  require_once('../api/src/Entity/' . $file);
  $className = explode(".", $file)[0];
  $data[] = getClassData('App\Entity\\' . $className);
}

$content = generateRDF($data);

$file = file_get_contents("template.rdf");
$rdf = str_replace("{biflow.classes_and_properties}", $content, $file);
echo $rdf;

function getGenericData($comment) {
  $data = Array();

  $lines = explode("\n", $comment);
  foreach($lines as $line) {
    $a = strpos($line, "@ontology-");
    if ($a !== false) {
      $v = trim(substr($line, $a + strlen("@ontology-")));
      $key = explode(" ", $v)[0];

      $v = trim(substr($line, $a + strlen("@ontology-") + strlen($key)));
      $data[$key] = $v;
    }
  }

  return $data;
}

function getClassData($class) {
  $reflector = new ReflectionClass($class);

  $data = getGenericData($reflector->getDocComment());
  $data["name"] = $reflector->getShortName();

  $data["properties"] = Array();

  foreach($reflector->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
    $data["properties"][] = getPropertyData($property);
  }

  return $data;
}

function getPropertyData($property) {
  $data = getGenericData($property->getDocComment());
  $data["name"] = $property->getName();
  return $data;
}

function generateRDF($data) {
  $c = "";
  foreach($data as $x) {
    $c .= "  <rdf:Description rdf:about=\"&biflow;" . $x["name"] ."\">\n";
    if (isset($x["label"])) {
      $c .= "    <rdfs:label>" . $x["label"] . "</rdfs:label>\n";
    } else {
      $c .= "    <rdfs:label>" . $x["name"] . "</rdfs:label>\n";
    }

    if (isset($x["comment"])) {
      $c .= "    <rdfs:comment>" . $x["comment"] . "</rdfs:comment>\n";
    }

    $c .= "    <rdfs:isDefinedBy rdf:resource=\"&biflow;\" />\n";
    $c .= "    <rdf:type rdf:resource=\"&rdfs;Class\" />\n";
    $c .= "    <rdf:type rdf:resource=\"&owl;Class\" />\n";

    if (isset($x["equivalentClasses"])) {
      foreach(explode(" ", $x['equivalentClasses']) as $eq) {
        $c .= "    <owl:equivalentClass>\n";
        $c .= "      <owl:Class rdf:about=\"" . $eq . "\" />\n";
        $c .= "    </owl:equivalentClass>\n";
      }
    }

    if (isset($x["subclassOf"])) {
      foreach(explode(" ", $x['subclassOf']) as $sub) {
        $c .="    <rdfs:subClassOf rdf:resource=\"&biflow;#{sub}\" />\n";
      }
    }

    $c .= "  </rdf:Description>\n\n";
  }

  $properties = Array();

  foreach($data as $class) {
    foreach($class["properties"] as $x) {
      if (!isset($properties[$x["name"]])) {
        $properties[$x["name"]] = $x;
      }

      if (!isset($properties[$x["name"]]["domain"])) {
        $properties[$x["name"]]["domain"] = Array();
      }

      $properties[$x["name"]]["domain"][] = $class["name"];
    }
  }

  foreach($properties as $x) {
    $c .= "  <rdf:Description rdf:about=\"&biflow;" . $x['name'] . "\">\n";

    if (isset($x["label"])) {
      $c .= "    <rdfs:label>" . $x["label"] . "</rdfs:label>\n";
    } else {
      $c .= "    <rdfs:label>" . $x["name"] . "</rdfs:label>\n";
    }

    if (isset($x["comment"])) {
      $c .= "    <rdfs:comment>" . $x["comment"] . "</rdfs:comment>\n";
    }

    $c .= "    <rdfs:isDefinedBy rdf:resource=\"&biflow;\" />\n";
    $c .= "    <rdf:type rdf:resource=\"&rdfs;Property\" />\n";
    $c .= "    <rdf:type rdf:resource=\"&owl;InverseFunctionalProperty\" />\n";
    $c .= "    <rdf:type rdf:resource=\"&owl;ObjectProperty\" />\n";

    if (isset($x["domain"])) {
      foreach($x['domain'] as $sub) {
        $c .="    <rdfs:domain rdf:resource=\"&biflow;" . $sub . "\" />\n";
      }
    }

    if (isset($x["range"])) {
      foreach(explode(" ", $x['range']) as $sub) {
        $c .="    <rdfs:range rdf:resource=\"&biflow;" . $sub . "\" />\n";
      }
    }

    $c .= "  </rdf:Description>\n\n";
  }

  return $c;
}

?>
