# Biflow_Catalogue

FRBR and TEI model

My notes: working in progress of Biflow catalogue model, which will be described in detail once it is refined.

<?xml version="1.0" encoding="utf-8" ?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
         xmlns:ns0="http://purl.org/vocab/frbr/core#"
         xmlns:foaf="http://xmlns.com/foaf/0.1/"
         xmlns:ns1="http://I_have_no_idea_yet#"
         xmlns:dc11="http://purl.org/dc/elements/1.1/">

  <rdf:Description rdf:about="http://sandbox.cceh.uni-koeln.de/works/1">
    <ns0:creator>
      <foaf:Person rdf:about="http://sandbox.cceh.uni-koeln.de/people/14">
        <rdf:type rdf:resource="http://purl.org/vocab/frbr/core#ResponsibleEntity"/>
        <foaf:name>Angela da Foligno</foaf:name>
        <ns0:creatorOf rdf:resource="http://sandbox.cceh.uni-koeln.de/works/1"/>
      </foaf:Person>
    </ns0:creator>

    <ns1:code>AngFolLIB</ns1:code>
    <ns1:content>Scrivere qualcosa qui</ns1:content>
    <ns1:otherTranslations>Lista delle altre tradizioni...</ns1:otherTranslations>
    <ns1:genre>Letteratura religiosa</ns1:genre>
    <ns1:genre>Autobiografia spirituale</ns1:genre>
    <ns1:genre>Agiografia</ns1:genre>
    <ns0:realization rdf:resource="http://sandbox.cceh.uni-koeln.de/expressions/1"/>
    <ns0:realization rdf:resource="http://sandbox.cceh.uni-koeln.de/expressions/2"/>
    <rdf:type rdf:resource="http://purl.org/vocab/frbr/core#Work"/>
  </rdf:Description>

  <foaf:Person rdf:about="http://sandbox.cceh.uni-koeln.de/people/15">
    <rdf:type rdf:resource="http://purl.org/vocab/frbr/core#ResponsibleEntity"/>
    <foaf:name>Bertoldus de Scyedam</foaf:name>
    <ns1:copyistOf rdf:resource="http://sandbox.cceh.uni-koeln.de/manuscripts/1"/>
  </foaf:Person>

  <foaf:Person rdf:about="http://sandbox.cceh.uni-koeln.de/people/16">
    <rdf:type rdf:resource="http://purl.org/vocab/frbr/core#ResponsibleEntity"/>
    <foaf:name>Anonimo</foaf:name>
    <ns1:translatorOf rdf:resource="http://sandbox.cceh.uni-koeln.de/expressions/2"/>
  </foaf:Person>

  <ns0:Expression rdf:about="http://sandbox.cceh.uni-koeln.de/expressions/1">
    <dc11:title>Liber</dc11:title>
    <ns0:creator rdf:resource="http://sandbox.cceh.uni-koeln.deundefined"/>
    <ns1:explicit>In opprobium...</ns1:explicit>
    <ns1:implicit>undefined</ns1:implicit>
    <ns1:editorialHistory>undefined</ns1:editorialHistory>
    <ns1:manuscriptTradition>Manuscript tqualcosa</ns1:manuscriptTradition>
    <ns0:realizationOf rdf:resource="http://sandbox.cceh.uni-koeln.de/works/1"/>
    <ns1:language>Latino</ns1:language>
    <ns1:textualTypology>Prosa</ns1:textualTypology>
    <ns1:derivedBy rdf:resource="http://sandbox.cceh.uni-koeln.de/expressions/2"/>
    <ns0:manifestation rdf:resource="http://sandbox.cceh.uni-koeln.de/manuscripts/1"/>
    <ns0:manifestation>
      <ns0:Manifestation rdf:about="http://sandbox.cceh.uni-koeln.de/manuscripts/2">
        <ns1:cartaNumber>203</ns1:cartaNumber>
        <ns1:catalogueNumber>Madrid BNE 9020</ns1:catalogueNumber>
        <ns1:width>216</ns1:width>
        <ns1:height>148</ns1:height>
        <ns1:note>redaction maior, disposta in ordine tematico</ns1:note>
        <ns1:localisation>cc 154-199r</ns1:localisation>
        <ns0:embodiment rdf:resource="http://sandbox.cceh.uni-koeln.de/expressions/1"/>
        <ns1:checkStatus>Non esaminato direttamente</ns1:checkStatus>
      </ns0:Manifestation>
    </ns0:manifestation>

  </ns0:Expression>

  <ns0:Expression rdf:about="http://sandbox.cceh.uni-koeln.de/expressions/2">
    <dc11:title>Qui comincia</dc11:title>
    <ns0:creator rdf:resource="http://sandbox.cceh.uni-koeln.deundefined"/>
    <ns1:explicit>In bprobio...</ns1:explicit>
    <ns1:implicit>undefined</ns1:implicit>
    <ns1:editorialHistory>undefined</ns1:editorialHistory>
    <ns1:manuscriptTradition>Dal testo e' noto...</ns1:manuscriptTradition>
    <ns0:realizationOf rdf:resource="http://sandbox.cceh.uni-koeln.de/works/1"/>
    <ns1:language>Volgare fiorentino</ns1:language>
    <ns1:textualTypology>Prosa</ns1:textualTypology>
    <ns1:translator rdf:resource="http://sandbox.cceh.uni-koeln.de/people/16"/>
    <ns1:derivedFrom rdf:resource="http://sandbox.cceh.uni-koeln.de/expressions/1"/>
    <ns0:manifestation>
      <ns0:Manifestation rdf:about="http://sandbox.cceh.uni-koeln.de/manuscripts/3">
        <ns1:cartaNumber>cc I+89+I'</ns1:cartaNumber>
        <ns1:catalogueNumber>Magliab XXXXVIII.122</ns1:catalogueNumber>
        <ns1:width>260</ns1:width>
        <ns1:height>184</ns1:height>
        <ns1:note></ns1:note>
        <ns1:localisation>cc 1r-89v</ns1:localisation>
        <ns0:embodiment rdf:resource="http://sandbox.cceh.uni-koeln.de/expressions/2"/>
        <ns1:checkStatus>Esaminato direttamente</ns1:checkStatus>
      </ns0:Manifestation>
    </ns0:manifestation>

  </ns0:Expression>

  <ns0:Manifestation rdf:about="http://sandbox.cceh.uni-koeln.de/manuscripts/1">
    <ns1:cartaNumber>118</ns1:cartaNumber>
    <ns1:catalogueNumber>Liege BGS 6.G.4</ns1:catalogueNumber>
    <ns1:width>203</ns1:width>
    <ns1:height>143</ns1:height>
    <ns1:note>(Thier Calufetti 1985)</ns1:note>
    <ns1:localisation>cc 1r-118v</ns1:localisation>
    <ns0:embodiment rdf:resource="http://sandbox.cceh.uni-koeln.de/expressions/1"/>
    <ns1:copyist rdf:resource="http://sandbox.cceh.uni-koeln.de/people/15"/>
    <ns1:checkStatus>Non esaminato direttamente</ns1:checkStatus>
  </ns0:Manifestation>

</rdf:RDF>
