<?php
require("login_autentica.php");
$DB = new DB_mssql;
$DB->conectar();
$searchTerm = $_GET['term'];
$query="SELECT usu_nombre FROM usuarios WHERE usu_nombre LIKE '%".$searchTerm."%' ORDER BY usu_nombre ASC";
$DB->Execute($query); 
while ($rw=mysqli_fetch_row($DB->Consulta_ID))
{
	$data[] = $rw[0];
}
echo json_encode($data);
?>