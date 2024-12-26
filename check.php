<?php
require("connection/conectarse.php");
require("connection/arrays.php");
require("connection/funciones.php");
require("connection/funciones_clases.php");
require("connection/PasswordHash.php");
date_default_timezone_set("America/Bogota");
$DBss = new DB_mssql;
$DBss->conectar();
echo md5("79938317");
/*
//$email=mysqli_real_escape_string($_POST['user'],$DBss->Conexion_ID);
$query = "SELECT idusuarios, roles_idroles, usu_mail, usu_pass, usu_nombre FROM usuarios WHERE usu_mail='$email' LIMIT 0,1";
	$DBss->Execute($query); 
	if($DBss->numregistros()==1){
		$row = mysqli_fetch_array($DBss->Consulta_ID); 
		$storedPassword = $row['usu_pass'];
		$salt = "mercy2344fsdfd";
		$postedPassword=mysqli_real_escape_string(md5($_POST['pass']),$DBss->Conexion_ID);
		$saltedPostedPassword = $salt . $postedPassword;
		$hasher = new PasswordHash(8,false);
		$saltedPostedPassword = $hasher->HashPassword($saltedPostedPassword);

		$check = $hasher->CheckPassword($saltedPostedPassword, $storedPassword);
		//header ("Location: seleccionar_destino.php");
//		if($check){
			session_name("projecst2344fsdfd");
			session_start(); 
			$id_ses=session_id();		
			session_cache_limiter('nocache,private');
			$_SESSION['usuario_rol']=$row["roles_idroles"];
			$_SESSION['usuario_login']=$_POST['user'];
			$_SESSION['token'] = md5(rand().$_SESSION['usuario_login']);
			$_SESSION['usuario_nombre']=$row["usu_nombre"];
			$_SESSION['usuario_id']=$row["idusuarios"];
			$_SESSION['usuario_cliente']=$row["clientes_idclientes"];
			$act="UPDATE usuarios SET usu_token='".$_SESSION['token']."' WHERE usu_mail='".$_SESSION['usuario_login']."'";
			$DBss->Execute($act);
			$DBss->cerrarconsulta();
			header ("Location: seleccionar_destino.php");
//		}
//		else{ 
//			header ("Location: index.php?error_login=2");
//		}
	}
}	
else 
{
	session_name("projecst2344fsdfd");
	session_start();
	if(!empty($_SESSION['usuario_login']) && !empty($_SESSION['token'])) {
		$DBss = new DB_mssql;
		$DBss->conectar();
		$_SESSION['usuario_login']=mysqli_real_escape_string($_SESSION['usuario_login'],$DBss->Conexion_ID);
		$_SESSION['token']=mysqli_real_escape_string($_SESSION['token'],$DBss->Conexion_ID);
		$query="SELECT idusuarios FROM usuarios WHERE usu_mail='".$_SESSION['usuario_login']."' AND usu_token='".$_SESSION['token']."'";
		$DBss->execute($query);
		if($DBss->numregistros()==1){
			$_SESSION['token']= md5(rand().$_SESSION['usuario_login']);
			$act="UPDATE usuarios SET usu_token='".$_SESSION['token']."' WHERE usu_mail='".$_SESSION['usuario_login']."'";
			$DBss->Execute($act);
			$DBss->cerrarconsulta();
		} else {
			$DBss->cerrarconsulta();
			session_destroy();
			header("Location:index.php?error_login=8");
			exit;
		}
	}
	else {		
		session_destroy();
		header("Location:index.php?error_login=8");
		exit;
	}
}
*/
?>