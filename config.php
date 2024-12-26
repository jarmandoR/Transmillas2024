<?php
include('connection/variables.php');


$con = mysqli_connect($host, $user, $pass) or die("No se ha podido conectar al Servidor");
mysqli_query($con,"SET SESSION collation_connection ='utf8_unicode_ci'");
$db = mysqli_select_db($con, $bd) or die("Upps! Error en conectar a la Base de Datos");

?>
