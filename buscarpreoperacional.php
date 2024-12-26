<?php
require("login_autentica.php"); //coneccion bade de datos
$DB1 = new DB_mssql;
$DB1->conectar();
$DB = new DB_mssql;
$DB->conectar();

//Obtenemos los datos de los input

$fecha =$_POST["fecha"];
$iduser=$_POST["user"];
$campo=$_POST["campo"];
$cond="";

	 $slq="SELECT $campo FROM `pre-operacional` where preidusuario='$iduser' and prefechaingreso like '$fecha%'";	
	$DB->Execute($slq); 
	$cajam=$DB->recogedato(0);
	if($cajam==null and $cajam==''){
		$cajam=null;
	}

	header('Content-Type: application/json');
	//Devolvemos el array pasado a JSON como objeto
	echo json_encode($cajam, JSON_FORCE_OBJECT);
?>