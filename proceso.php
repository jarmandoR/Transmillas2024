<?php
require("login_autentica.php"); //coneccion bade de datos
$DB1 = new DB_mssql;
$DB1->conectar();
$DB = new DB_mssql;
$DB->conectar();
$id_nombre=$_SESSION['usuario_nombre'];

$sql="SELECT `ser_piezas`,idservicios,ser_consecutivo,ser_estado,ser_desvaliguia,ser_ciudadentrega,ser_idverificadopeso FROM `servicios` WHERE ser_estado=7 and ser_fechaguia>='2020-01-01' ";		
$DB->Execute($sql);
while($rw1=mysqli_fetch_row($DB->Consulta_ID))
{
    for($a=1;$a<=$rw1[0];$a++){
            $sql="INSERT INTO `piezasguia`(`numeroguia`, `numeropieza`) values ('$rw1[2]',$a)";
            $DB1->Execute($sql);
    }

}

?>