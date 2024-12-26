<?php 
require("login_autentica.php"); 
include("declara.php");
$miRol=$nivel_acceso;
$misede=$_SESSION['usu_idsede'];
$idUserA=$_SESSION['usuario_id'];



$sql6="SELECT usu_nombre, usu_mail FROM usuarios WHERE idusuarios='$idUserA' ";
                    $DB->Execute($sql6); 
                    $rw5=mysqli_fetch_row($DB->Consulta_ID);
 $nomuser=$rw5[0];

$sql1 = "SELECT count(*) FROM `noticia` WHERE not_idusuario='$id_usuario' and  not_visto='no' AND not_deChat='' ";
 $DB1->Execute($sql1); 
 $cantMensajes=$DB1->recogedato(0);

if ( $cantMensajes> "0"){

	echo $cantMensajes;
}else{
	echo '0';
}