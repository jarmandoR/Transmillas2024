<?php
require("login_autentica.php"); 
$id_nombre=$_SESSION['usuario_nombre'];


@$id_usuario=$_REQUEST["id_usuario"];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];
$checked = $data['checked'];

if ($checked==true) {
    $checked=1;
}else {
    $checked=0;
}


echo$insertar=" update contactofacturacion set `con_principal`='$checked' where idcontactofacturacion='$id' ";
$DB1->Execute($insertar);	