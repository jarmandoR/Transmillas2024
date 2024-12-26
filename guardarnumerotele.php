<?php

require("connection/conectarse.php");
require("connection/funciones.php");
require("connection/arrays.php");
require("connection/funciones_clases.php");
require("connection/sql_transact.php");
include('definirvar.php');

$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$FB = new funciones_varias;
$QL = new sql_transact;

$telefono=$_REQUEST["telefono"];
if($telefono!=''){
	echo$sql2="INSERT INTO `telefonospagina`(`tel_enviado`, `tel_estado`,`tel_fechaingreso`) VALUES ('$telefono','Sin validar','$fechatiempo')";
	$DB->Execute($sql2);
	$estado='ok';
}else{
	$estado='mal';
}

// header("Status: 301 Moved Permanently");
header("Location:https://transmillas.com");
exit;
 ?>
