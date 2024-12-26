<?php 

require("login_autentica.php"); 
include("declara.php");



// $conde1.=" and deu_fecha >='$param5' and deu_fecha <= '$param4' "; 
// $conde="";
// $conde="deu_fecha";
// $conde2="and usu_idsede=$id_ciudad"; 
$idUser=$_GET['idUser'];

// if($param6!='0' and $param6!=''){
// 	$conde3="and deu_tipo='$param6'"; 
// }else{
// 	$conde3="";
// }

$sql="SELECT `iddeudapromotor`, `deu_fecha`, usu_nombre,`deu_tipo` , `deu_valor`, `due_descripcion`, `deu_idautoriza`, `deu_idpromotor` FROM `duedapromotor`  inner join usuarios on deu_idpromotor=idusuarios WHERE iddeudapromotor>0 and deu_idpromotor='$idUser'  ";
$DB1->Execute($sql); $va=0;
$prestamo=0;
$descuadre=0;
$pago=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{

    if ($rw1[3]=="Prestamos") {
        $prestamo =$prestamo+$rw1[4];
    }elseif ($rw1[3]=="Descuadre") {
        $descuadre =$descuadre+$rw1[4];
    }elseif ($rw1[3]=="Pagos") {
        $pago =$pago+$rw1[4];
    }



}

$prestamo;
$descuadre;
$pago;
$prestamoTotal= $prestamo+$descuadre;
echo$TotalDebe = $prestamoTotal-$pago;