<?php 
require("login_autentica.php"); 
include("layout.php");
$FB->titulo_azul1("Tipos de documentos",9,0, 4);  
if($rcrear==1) { $FB->nuevo("Tipo de documento", $condecion, "configuracion.php?idmen=66"); }
if($ord==1){ $ord="tid_nombre"; }
$FB->titulo_azul6("Tipo de documento",1,0,1,"tid_nombre",$asc2); $FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
$sql="SELECT idtipodocumentos, tid_nombre FROM tipodocumentos  ORDER BY $ord $asc ";
$LT->llenatabla($sql,2, "Tipo de documento",$condecion,"","","","","","", $param_edicion, $DB, $DB1);
include("footer.php"); ?>