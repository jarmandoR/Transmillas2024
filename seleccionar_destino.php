<?php
require("login_autentica.php"); 


$nivel_acceso=$_SESSION['usuario_rol'];
if(isset($_REQUEST["rol_nombre"])){ $_SESSION['rol_nombre']=$_REQUEST['rol_nombre']; 
	$SQL="SELECT idroles, idusuarios FROM usuarios INNER JOIN roles ON roles_idroles=idroles WHERE rol_nombre='".$_SESSION['rol_nombre']."' 
	AND usu_mail='".$_SESSION['usuario_login']."'"; 
	$DBss = new DB_mssql;
	$DBss->conectar();
	$DBss->Execute($SQL);
	$row = mysqli_fetch_array($DBss->Consulta_ID); 
	$_SESSION['usuario_rol']=$row[0];
	$_SESSION['usuario_id']=$row[1];
	$_SESSION['inicio']='1';
}
$rol_nombre=$_SESSION['rol_nombre']; 


if (isset($_SESSION['rol_nombre']))
{
	if($rol_nombre=="Administrador"){ 
		header ("Location: inicio.php?idmen=163");
	
		exit;
 	}
	else {
		
		header ("Location: inicio.php?idmen=163");
	
		exit;
	}
}
else 
{
	header ("Location: salir.php");
	exit;
} 
?>