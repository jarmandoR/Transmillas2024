<?php 
	include("../../connection/variables.php"); 
	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";

	$obj= new crud();

	echo $obj->eliminar($_POST['id'],$_POST['tabla']);

 ?>