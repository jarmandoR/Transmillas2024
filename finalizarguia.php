<?php
require("login_autentica.php"); //coneccion bade de datos
$DB1 = new DB_mssql;
$DB1->conectar();
$DB = new DB_mssql;
$DB->conectar();
$id_nombre=$_SESSION['usuario_nombre'];
$id_usuario= $_SESSION['usuario_id'];
//Obtenemos los datos de los input
$cond="";
$guia = $_POST["valores"];

 $sql="SELECT cue_estado,cue_idservicio FROM `cuentaspromotor` WHERE cue_numeroguia='$guia'";		

$DB1->Execute($sql);
$rw1=mysqli_fetch_row($DB1->Consulta_ID);
$estado=$rw1[0];
$idser=$rw1[1];
if($estado==10){


$sql="UPDATE cuentaspromotor SET cue_validar=1, cue_usuvalido='$id_nombre',cue_fechafinalizo='$fechatiempo' WHERE cue_idservicio='$idser' ";
$DB1->Execute($sql);

$datos=array("resultado"  => "1");

}else{
	$datos=array("resultado"  => "2");
	return;
}
	//Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
	header('Content-Type: application/json');
	//Devolvemos el array pasado a JSON como objeto
	echo json_encode($datos, JSON_FORCE_OBJECT);
?>