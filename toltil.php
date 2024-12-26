<!DOCTYPE html>
<html lang="es">
<head>

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="js/jquery.min.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>

<?php

require("connection/conectarse.php");
require("connection/funciones.php");
$DB = new DB_mssql;
$DB->conectar();

/* $mail=$_POST["param1"];
require("connection/conectarse.php");
require("connection/funciones.php");
require("connection/funciones_clases.php");
require("connection/sql_transact.php");
require("connection/llenatablas.php");
$DB = new DB_mssql;
$DB->conectar();
$LT = new llenatablas;
 */
/* 	$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0  )", "", "$id_sedes", 2, 1);
	$FB->llena_texto("Fecha de Envio:", 8, 10, $DB, "", "", "$fechaactual", 2, 0);
	$FB->llena_texto("Tipo Reclamo:", 9, 82, $DB, $tiporeclamo, "", "", 2, 1);
	$FB->llena_texto("Nombre:", 4, 1, $DB, "", "", "", 1, 0);
	$FB->llena_texto("telefono:", 5, 1, $DB, "", "", "", 1, 0);
	$FB->llena_texto("E-mail:", 6, 1, $DB, "", "", "", 1, 0);
	$FB->llena_texto("Descripcion de Reclamo:", 7,9, $DB, "", "", "", 2, 0);
	$FB->llena_texto("Numero De Guia Completo",2, 1, $DB, "", "", "",2,1);
	$FB->llena_texto("param3", 1, 13, $DB, "", "ser_consecutivo", 0, 5, 0);
	echo "<td><button type='button' class='btn btn-primary btn-lg' onclick='buscarguia(29);'  >Validar Guia </button></td></tr>";		
	$FB->llena_texto("Foto Guia", 8, 6, $DB, "", "", "",1,0);
	$FB->llena_texto("", 2, 4, $DB, "llega_sub2", "", "",1,0); */





if($id_param!="")
{

	$bandera=10;
	$id_param2=substr(md5(microtime(true)),0,8);
	 $nombre="Su clave de acceso a Transmillas es: ".$id_param2;
	 $upd="UPDATE usuarios SET usu_pass='".md5($id_param2)."' WHERE usu_identificacion='$id_param'";
	$DB->Execute($upd);
	
	$mensaje1="$nombre \n";
	$headers .= "From: Transmillas \r\n"; 
	$headers .= "Reply-To: transmillas@gmail.com"; 
	$headers .= 'From: transmillas@gmail.com' . "\r\n" .
	'Reply-To: $nombre' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	if(mail($mail, "Transmillas - Recuperar su clave de acceso", $mensaje1, $headers)){
		$bandera=10;
	}
	else {$bandera=11; } 
}
else { $bandera=11;} 
header ("Location: index.php?error_login=$bandera");
?> 

</body>
</html>
