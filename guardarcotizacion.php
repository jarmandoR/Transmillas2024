<?php 
require("login_autentica.php"); 
$id_ciudad= $_SESSION['usu_idsede'];
$id_usuario= $_SESSION['usuario_id'];
@$tipoguia=$_REQUEST["tipoguia"];
@$registros=$_REQUEST["registros"];
$id_nombre=$_SESSION['usuario_nombre'];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();


    $id=$_POST['id'];
    $funcion=$_POST['funcion'];
    $estado=$_POST['estado'];
    // $Observacion=$_POST['Observacion'];
    
if ($funcion=="realizada") {
    $sql="UPDATE `cotozaciones` SET `cot_estado`='$estado' WHERE cot_id='$id'  ";
    $DB1->Execute($sql);
}elseif ($funcion=="funcion") {

}