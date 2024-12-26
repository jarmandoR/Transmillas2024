<?php 
require("login_autentica.php"); 
include("layout.php");
$FB->titulo_azul1("Roles",9,0, 5);  
if($rcrear==1) { $FB->nuevo("Rol", $condecion, "configuracion.php?idmen=138"); }
if($ord==1){ $ord="rol_nombre"; }
$FB->titulo_azul6("Rol",1,0,1,"rol_nombre",$asc2); 
$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
 $sql="SELECT idroles, rol_nombre FROM roles ORDER BY $ord $asc ";
$LT->llenatabla($sql,2, "Rol",$condecion,"","","","","","", $param_edicion, $DB, $DB1);
include("footer.php"); ?>