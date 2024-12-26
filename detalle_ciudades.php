<?php 
require("login_autentica.php");
require("layout2.php");
$p1=$_REQUEST["p1"];
$FB->titulo_azul1("Ciudades",9,0, 4);  
if($rcrear==1) { $FB->nuevo("Ciudad", $condecion, "configuracion.php?idmen=65"); } 
$FB->titulo_azul1("Departamento",1,0,0); $FB->titulo_azul1("Ciudad",1,0,0); $FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
if($p1!="" and $p1!="0"){$cond2=" AND iddepartamentos='$p1'"; } else { $cond2=""; }
$sql="SELECT idciudades, dep_nombre, ciu_nombre FROM ciudades INNER JOIN departamentos ON departamentos_iddepartamentos=iddepartamentos  $cond2 ORDER BY dep_nombre, ciu_nombre";
$LT->llenatabla($sql,3, "Ciudad",$condecion,"4,5,6","","","","","", $param_edicion, $DB, $DB1);
require("footer.php"); ?>