<?php 
require("login_autentica.php");
require("layout2.php");
$p1=$_REQUEST["p1"]; $p2=$_REQUEST["p2"]; $p3=$_REQUEST["p3"];
if($p1!="" and $p1!="0"){$cond1=" AND idsecretarias='$p1'"; } else { $cond1=""; }
if($p2!="" and $p2!="0"){$cond2=" AND idieducativas='$p2'"; } else { $cond2=""; }
if($p3!=""){$cond3=" AND (fne_identificacion LIKE '%$p3%' OR fne_nombre LIKE '%$p3%')"; } else { $cond3=""; }
$FB->titulo_azul1("Formadores Nativos Extranjeros",9,0,4);  
if($rcrear==1) { $FB->nuevo("FNE", $condecion, ""); } 
$sql="SELECT COUNT(*) FROM fne INNER JOIN ieducativas ON ieducativas_idieducativas=idieducativas INNER JOIN secretarias a ON secretarias_idsecretarias=idsecretarias INNER JOIN ciudades ON a.usu_idsede=idciudades $cond1 $cond2 $cond3 ";
$DB->Execute($sql); 
$valor=$DB->recogedato(0);
if(isset($_REQUEST["pagina"])){ $pagina=$_REQUEST["pagina"]; } else { $pagina=0; } 
if(isset($_REQUEST["ordby"])){ $ordby=$_REQUEST["ordby"]; } else { $ordby="ied_nombre"; } 
if($_REQUEST["asc"]!=""){ $asc=$_REQUEST["asc"]; } else {$asc="ASC"; } 	$asc2=""; if($asc=="ASC"){ $asc2="DESC";}
$condlimit=$FB->llena_sigant($pagina, $ordby, $asc, $valor);

$FB->titulo_azul5("Instituci&oacute;n Educativa",1,100,0,"ied_nombre",$asc2); $FB->titulo_azul5("Documento",1,0,0,"fne_identificacion",$asc2); $FB->titulo_azul5("Nacionalidad",1,0,0,"fne_nacionalidad",$asc2); $FB->titulo_azul5("Nombre",1,0,0,"fne_nombre",$asc2); $FB->titulo_azul5("Email",1,0,0,"fne_mail",$asc2); $FB->titulo_azul5("Tel&eacute;fono",1,0,0,"fne_telefono",$asc2); $FB->titulo_azul5("Empez&oacute;",1,0,0,"fne_empezo",$asc2); $FB->titulo_azul5("Profesi&oacute;n",1,0,0,"fne_profesion",$asc2); 
$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
$sql="SELECT idfne, ied_nombre, fne_identificacion, fne_nacionalidad, fne_nombre, fne_mail, fne_telefono, fne_empezo, fne_profesion FROM fne INNER JOIN ieducativas ON ieducativas_idieducativas=idieducativas INNER JOIN secretarias a ON secretarias_idsecretarias=idsecretarias INNER JOIN ciudades ON a.usu_idsede=idciudades $cond1 $cond2 $cond3 ORDER BY $ordby $asc $condlimit  ";$va=0; $param_edicion=1;
$LT->llenatabla($sql,9, "FNE",$condecion,"","","","","","", $param_edicion, $DB, $DB1);
require("footer.php"); ?>