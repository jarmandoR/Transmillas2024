<?php
require("login_autentica.php"); 
$id_ciudad= $_SESSION['usu_idsede'];
$id_usuario= $_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
@$tabla=$_REQUEST["tabla"];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();

switch ($tabla) {

	case "Ciudades":
		$ciudad=$_REQUEST["ciudaddes"];

		$sql2="SELECT ciu_nombre FROM `ciudades` where  ciu_nombre='$ciudad'";	
	   $DB1->Execute($sql2);
	   $rw1=mysqli_fetch_row($DB1->Consulta_ID);
	   $bdciudad=$rw1[1];
	   if($bdciudad!=''){
		   $datos=array("resultado"  => "1","msg"  => "La ciudad ya existe. Verifique" );
	   }else {
		   $datos=array("resultado"  => "2","msg"  => "OK" );
	   }

	   //Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
		header('Content-Type: application/json');
		//Devolvemos el array pasado a JSON como objeto
		echo json_encode($datos, JSON_FORCE_OBJECT);
	break;
	case "Sedes":
	break;

	default:
			return false;
	break;
	
	
}



?>