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


    $estado=$_POST['estado'];
    $idMani=$_POST['idMani'];
    $valor=$_POST['valor'];
    $Observacion=$_POST['Observacion'];
    
if ($estado=="calificacion") {
    echo$sql="UPDATE `manifiestos_viajes` SET `mani_cal`='$valor' WHERE idmani='$idMani'  ";
    $DB1->Execute($sql);
}elseif ($estado=="observacion") {
    echo$sql="UPDATE `manifiestos_viajes` SET `mani_comentario`='$Observacion' WHERE idmani='$idMani'  ";
    $DB1->Execute($sql);
}

