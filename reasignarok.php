<?php
require("definirvar.php");
require("connection/conectarse.php");
require("connection/funciones.php");
require("connection/funciones_clases.php");
require("connection/sql_transact.php");
require("connection/llenatablas.php");
@$id_usuario=$_REQUEST["id_usuario"];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();


$sql1="UPDATE `servicios` SET ser_idusuarioguia='$param2',`ser_idusuarioregistro`='$id_usuario',`ser_fechaguia`='$fechatiempo' WHERE `idservicios`=$id_param2";

$DB->Execute($sql1);

 
	$DB->cerrarconsulta();
	
header ("Location: asignar_planillas.php?bandera=1");


?>