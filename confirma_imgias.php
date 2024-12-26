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


$fechaHoraActual = date('Y-m-d H:i:s');






$tipo=$_POST['tipo'];
$idser=$_POST['idser'];


        // // if ($tipo=="Basico") {
        //     $sql1="SELECT  count(*) from nomina where nom_id_usu='$idusuario' and nom_fecha_inicio='$fechaini'  ";		
        //     $DB1->Execute($sql1);
        //     $rw1=mysqli_fetch_row($DB1->Consulta_ID);
        
            if ($tipo=="Recogida") {
                echo$sql="UPDATE `servicios` SET `ser_confimgrec`='si' WHERE idservicios ='$idser '  ";
                $DB1->Execute($sql);
               
            }else if($tipo=="Entrega"){
                echo$sql="UPDATE `servicios` SET `ser_confimgentre`='si' WHERE idservicios ='$idser '  ";
                $DB1->Execute($sql);
            }