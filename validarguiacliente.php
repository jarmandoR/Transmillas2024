<?php
require("connection/conectarse.php"); //coneccion bade de datos
$DB1 = new DB_mssql;
$DB1->conectar();
$DB = new DB_mssql;
$DB->conectar();

//Obtenemos los datos de los input
$cond="";
$vlores = $_POST["vlores"];
$tipo=$_POST["tipo"];



  $sql="SELECT `idservicios` FROM `servicios` WHERE ser_guiare='$vlores' $cond; ";		
	$DB1->Execute($sql);
	$datos=mysqli_fetch_array($DB1->Consulta_ID,MYSQLI_ASSOC);
/* 	echo "jose--".$datos;
exit;  */
//Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
header('Content-Type: application/json');
//Devolvemos el array pasado a JSON como objeto
echo json_encode($datos, JSON_FORCE_OBJECT);

?>