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

      if (!isset($data[$key])) {
        $data[$key] = Array();
      }

      $data[$key][] = $v;
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
    $c .= "  <owl:Class rdf:about=\"&biflow;" . $x["name"] ."\">\n";
    if (isset($x["label"])) {
      $c .= "    <rdfs:label xml:lang=\"en\">" . implode("\n", $x["label"]) . "</rdfs:label>\n";
    } else {
      $c .= "    <rdfs:label xml:lang=\"en\">" . $x["name"] . "</rdfs:label>\n";
    }

    if (isset($x["comment"])) {
      $c .= "    <rdfs:comment xml:lang=\"en\">" . implode("\n", $x["comment"]) . "</rdfs:comment>\n";
    }

    $c .= "    <rdfs:isDefinedBy rdf:resource=\"&biflow;\" />\n";

    if (isset($x["equivalentClass"])) {
      foreach($x['equivalentClass'] as $eq) {
        $c .= "    <owl:equivalentClass rdf:resource=\"" . $eq . "\" />\n";
      }
    }

    if (isset($x["subclassOf"])) {
      foreach($x['subclassOf'] as $sub) {
        $c .="    <rdfs:subClassOf rdf:resource=\"" . $sub . "\" />\n";
      }
    }

    $c .= "  </owl:Class>\n\n";
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

      $properties[$x["name"]]["domain"][] = "&biflow;" . $class["name"];
    }
  }

  foreach($properties as $x) {
    $c .= "  <owl:ObjectProperty rdf:about=\"&biflow;" . $x['name'] . "\">\n";

    if (isset($x["label"])) {
      $c .= "    <rdfs:label xml:lang=\"en\">" . implode("\n", $x["label"]) . "</rdfs:label>\n";
    } else {
      $c .= "    <rdfs:label xml:lang=\"en\">" . $x["name"] . "</rdfs:label>\n";
    }

    if (isset($x["comment"])) {
      $c .= "    <rdfs:comment xml:lang=\"en\">" . implode("\n", $x["comment"]) . "</rdfs:comment>\n";
    }

    $c .= "    <rdfs:isDefinedBy rdf:resource=\"&biflow;\" />\n";

    if (isset($x["domain"])) {
      foreach($x['domain'] as $sub) {
        $c .="    <rdfs:domain rdf:resource=\"" . $sub . "\" />\n";
      }
    }

    if (isset($x["range"])) {
      foreach($x['range'] as $sub) {
        $c .="    <rdfs:range rdf:resource=\"" . $sub . "\" />\n";
      }
    }

    if (isset($x["subPropertyOf"])) {
      foreach($x['subPropertyOf'] as $sub) {
        $c .="    <rdfs:subPropertyOf rdf:resource=\"&biflow;" . $sub . "\" />\n";
      }
    }

    $c .= "  </owl:ObjectProperty>\n\n";
  }

  return $c;
}

?>
