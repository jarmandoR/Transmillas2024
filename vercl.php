<?php
$mail=$_POST["param1"];
require("connection/conectarse.php");
require("connection/funciones.php");
$DB = new DB_mssql;
$DB->conectar();

 $seles="SELECT usu_identificacion FROM usuarios WHERE usu_mail='$mail'  ";  
$DB->Execute($seles);
$id_param=$DB->recogedato(0);


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