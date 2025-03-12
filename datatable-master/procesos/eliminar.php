<?php 
	include("../../connection/variables.php"); 
	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	$obj= new crud();

	echo $obj->eliminar($_POST['id'],$_POST['tabla']);

 ?>