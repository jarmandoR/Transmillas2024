<?php
require("login_autentica.php"); //coneccion bade de datos
$DB1 = new DB_mssql;
$DB1->conectar();
$DB = new DB_mssql;
$DB->conectar();

//Obtenemos los datos de los input

$fecha = $_POST["fecha"];
 $sedes=$_POST["sede"];
$cond="";

	 $slq="SELECT cue_caja FROM `cuentassede` where cus_idsede='$sedes' and cus_fecha like '$fecha%' order by idcuentassede desc limit 1";	
	$DB->Execute($slq); 
	$cajam=$DB->recogedato(0);
	if($cajam==null and $cajam==''){
		$cajam=null;
	}

	header('Content-Type: application/json');
	//Devolvemos el array pasado a JSON como objeto
	echo json_encode($cajam, JSON_FORCE_OBJECT);
?>