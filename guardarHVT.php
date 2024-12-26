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


    $funcion=$_POST['funcion'];
    $pregunta=$_POST['pregunta'];
    $respuesta=$_POST['respuesta'];
    // $Observacion=$_POST['Observacion'];
    
if ($funcion=="preres") {
    $sql="INSERT INTO `preguntas_transmillas`(`pregunta`, `respuesta`,pre_tipodato) VALUES ('$pregunta','$respuesta',1)  ";
    $DB1->Execute($sql);
}elseif ($funcion=="informacion") {
    $sql="INSERT INTO `preguntas_transmillas`(`pregunta`, `respuesta`,pre_tipodato) VALUES ('$pregunta','$respuesta',2)  ";
    $DB1->Execute($sql);
}elseif ($funcion=="renovar") {
    $valor=$_POST["valor"];
    $idDoc=$_POST["idDoc"];
    $sql="UPDATE `documentosTransmillas` SET `doct_renovado`='$valor' WHERE doctid='$idDoc'";
    $DB1->Execute($sql);
}elseif ($funcion=="estadocierre") {
    $valor=$_POST["valor"];
    $id=$_POST["id"];
    $sql="UPDATE `cuentassede` SET cue_estado='$valor' WHERE idcuentassede='$id'";
    $DB1->Execute($sql);
}