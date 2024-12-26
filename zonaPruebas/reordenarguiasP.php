<?php
require("login_autentica.php");
include("layout.php");
$fechaactual = date("Y-m-d");
$id_usuario = $_SESSION['usuario_id'];
include("reordenarP.php");
?>
