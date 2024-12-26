<?php 
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=fne.xls");
header("Pragma: no-cache");
header("Expires: 0"); 
require("login_autentica.php");
require("cabezote3.php");
$p1=$_REQUEST["p1"]; $p2=$_REQUEST["p2"]; $p3=$_REQUEST["p3"];
echo "<table width='100%' border=1><tr>";
$p1=$_REQUEST["p1"]; $p2=$_REQUEST["p2"]; $p3=$_REQUEST["p3"];
if($p1!="" and $p1!="0"){$cond1=" AND idsecretarias='$p1'"; } else { $cond1=""; }
if($p2!="" and $p2!="0"){$cond2=" AND idieducativas='$p2'"; } else { $cond2=""; }
if($p3!=""){$cond3=" AND (fne_identificacion LIKE '%$p3%' OR fne_nombre LIKE '%$p3%')"; } else { $cond3=""; }
$FB->titulo_azul2a("Instituci&oacute;n Educativa"); $FB->titulo_azul2a("Documento"); $FB->titulo_azul2a("Nacionalidad"); $FB->titulo_azul2a("Nombre"); 
$FB->titulo_azul2a("Email"); $FB->titulo_azul2a("Tel&eacute;fono"); $FB->titulo_azul2a("Empez&oacute;"); $FB->titulo_azul2a("Profesi&oacute;n"); 
$sql="SELECT idfne, ied_nombre, fne_identificacion, fne_nacionalidad, fne_nombre, fne_mail, fne_telefono, fne_empezo, fne_profesion FROM fne INNER JOIN ieducativas ON ieducativas_idieducativas=idieducativas INNER JOIN secretarias a ON secretarias_idsecretarias=idsecretarias INNER JOIN ciudades ON a.usu_idsede=idciudades $cond1 $cond2 $cond3 ORDER BY ied_nombre, fne_nombre  ";
$LT->llenatabla($sql,9, "FNE",$condecion,"","","","","","", 0, $DB, $DB1);
require("footer.php"); ?>