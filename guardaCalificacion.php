<?php
require("connection/conectarse.php");
require("connection/funciones.php");
require("connection/arrays.php");
require("connection/funciones_clases.php");
require("connection/sql_transact.php");
require("connection/llenatablas.php");
include("cabezote1.php"); 
include("cabezote4.php"); 

$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$FB = new funciones_varias;
$QL = new sql_transact;
$LT = new llenatablas;

$calificacion=$_GET['valor1'];
$opinion=$_GET['valor2'];
$fecha= date('Y-m-d');

$sql1="INSERT INTO `pagina`(`calif_fecha`,`calif_calificacion`,`calif_opinion`) 
		VALUES ('$fecha','$calificacion','$opinion')";
		$vinculo=$DB->Executeid($sql1);

      