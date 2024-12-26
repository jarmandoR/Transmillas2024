<?php
require("login_autentica.php");
// include("cabezote.php");
include("cabezote1.php");
 include("cabezote3.php");
// include("cabezote4.php");
 //include("layout.php");

$fechaactual = date("Y-m-d");
$id_usuario = $_SESSION['usuario_id'];
$DB_m = new DB_mssql;
$DB_m->conectar();
$DB_m1 = new DB_mssql;
$DB_m1->conectar();
$DB_m2 = new DB_mssql;
$DB_m2->conectar();
?>

<?php
include("reordenarCompa.php");
?>