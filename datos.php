<?php
require("login_autentica.php"); //coneccion bade de datos
$DB1 = new DB_mssql;
$DB1->conectar();
$DB = new DB_mssql;
$DB->conectar();

//Obtenemos los datos de los input

$iddocumento = $_POST["documento"];


  $sql="SELECT `idpaciente`, `tipodocumento_idtipodocumento`, `pac_iddocumento`, `pac_nombre`,  `pac_fechanacimiento`, `pac_sexo`, `pac_procedentede`, `pac_barrio`,`pac_profesion`, `pac_telefonocasa` FROM pacientes where pac_iddocumento='$iddocumento'";		
	$DB1->Execute($sql);
	$datos=mysqli_fetch_array($DB1->Consulta_ID,MYSQLI_ASSOC);

//Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
header('Content-Type: application/json');
//Guardamos los datos en un array
/*  $datos = array(
'estado' => 'ok',
'nombre' => $nombre, 
'apellido' => $iddocumento, 
'edad' => $edad
);  */

//Devolvemos el array pasado a JSON como objeto
echo json_encode($datos, JSON_FORCE_OBJECT);

?>