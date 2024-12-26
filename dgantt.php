<?php
require("login_autentica.php");
include("layout.php");
require("cabezote4.php");
include("menu3.php");
$espla=0; $filtop=""; $param3="Eventos en la Institución Educativa";
if(isset($_REQUEST["param3"])){ 
	$param3=$_REQUEST["param3"]; 
	if($param3=="Eventos en la Institución Educativa"){ $espla=0; } 
	else if($param3=="Otros eventos"){ $espla=2; } 
	else if($param3==""){ $espla=0; } 
	else if($param3=="Plan de acción") { $filtop=" ";  $espla=1;}
	else if($param3=="Plan de acción - Institucional") { $filtop=" AND eve_planaccion LIKE '%Plan I%' ";  $espla=1;}
	else if($param3=="Plan de acción - Área") {  $filtop=" AND eve_planaccion LIKE '%Plan de%' ";  $espla=1; } 
}   
else { $espla=0; } 
if(isset($_REQUEST["param5"])){ $param5=$_REQUEST["param5"]; } else { $param5=""; } 
if(isset($_REQUEST["param6"])){ $param6=$_REQUEST["param6"]; } else { $param6=""; }
$FB->abre_form("form1","","post");
$FB->volver1("", "Diagrama de gantt", 9, "", "Diagrama de gantt");
$FB->llena_texto("Plan de Acci&oacute;n / Otros eventos:", 3, 18, $DB, $espla1, "llena_cale(0);", $param3, 1,0);
$FB->llena_texto("Inician desde:", 5, 10, $DB, "", "llena_cale(0)", $param5, 3,0);
$FB->llena_texto("Finalizan hasta:", 6, 10, $DB, "", "llena_cale(0)", $param6, 4,0);
$FB->cierra_tabla(); 
$FB->cierra_form(); $cond_tip=" "; $calen=3; 
include("gantt.php"); ?>