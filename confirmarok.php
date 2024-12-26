<?php
require("login_autentica.php"); 
include("declara.php");

$id_usuario=$_SESSION['usuario_id'];
$nivel_acceso=$_SESSION['usuario_rol'];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$id_nombre=$_SESSION['usuario_nombre'];

$param6=str_replace(".","", $param6);
if($id_param2=='confirmar'){
    $tipo_gastos=$_REQUEST["tipo_gastos"];
	if($tipo_gastos!='Gastos'){
		$param10=0;
	}
	$sql2="UPDATE `cajamenor` SET `caj_usucom`='$id_nombre',`caj_cantcom`='$param6',`caj_feccom`='$fechatiempo',caj_idgastos=$param10  WHERE idcajamenor='$id_param'";	
	$DB->Execute($sql2);
	$dir="cajamenor.php";

}else if($id_param2=='Verificar Remesa') {

	$sql2="UPDATE `gastos` SET `gas_descrecogio`='$param2', `gas_nomvalida`='$id_nombre', `gas_fechavalida`='$fechatiempo'   WHERE idgastos='$id_param'";	
	$DB->Execute($sql2);

	$dir="verificarpeso.php";

	
}
else if($id_param2=='Confirmargastos') {
	$param8=str_replace(".","", $param8);
	$tipo_gastos=$_REQUEST["tipo_gastos"];
	if($tipo_gastos!='Gastos'){
		$param10=0;
	}
	 $sql2="UPDATE `asignaciondinero` SET  `asi_usercom`='$id_usuario', `asi_valorcom`='$param8',asi_fechaconf='$fechatiempo',asi_idgastos=$param10  WHERE `idasignaciondinero`='$id_param' ";
	$DB->Execute($sql2);

	$dir="gastosoperador.php";

	
}elseif($id_param2=='Confirmartransferencia'){

	$sql2="UPDATE `pagoscuentas` SET `pag_userverifica`='$id_nombre',`pag_fechaverifica`='$fechatiempo',pag_valorconfirmado='$param8',pag_numerotrans='$param6'  WHERE idpagoscuentas='$id_param'";	
	$DB->Execute($sql2);

	if($_FILES["param7"]!=''){
		$QL->addDocumento1($_FILES["param7"], 1, "pagoscuentas", $id_param, "pagoscuentas", $DB);
	}

	$dir="confirmacionpagos.php";


}elseif($id_param2=='ConfirmarSeguimientoRemesa'){

    $param1=str_replace(".", "", $param1);
    
    $sql2="UPDATE seguimiento_remesas 
        SET seg_fechafinal = CURRENT_TIMESTAMP(),
            seg_valorconfirmado = '{$param1}',
            seg_userconfirma = {$id_usuario}
        WHERE idseguimientoremesas = '{$id_param}'";	
    $DB->Execute($sql2);

//	if($_FILES["param7"]!=''){
//		$QL->addDocumento1($_FILES["param7"], 1, "pagoscuentas", $id_param, "pagoscuentas", $DB);
//	}

    $dir="remesasprogramadas.php";


}elseif($id_param2=='CambiarEstadoRemesaPagada'){

     $sql2="UPDATE viajesremesas 
        SET gas_estado = 'Pagado'
        WHERE idgastos = '{$id_param}'";	
    $DB->Execute($sql2);

    $dir="remesasprogramadas.php";


}
elseif($id_param2=='Confirmarcambios'){

	$sql2="UPDATE `modificaciones` SET `mod_userverificado`='$id_nombre',`mod_fechaverificado`='$fechatiempo',mod_descripciones='$param6'  WHERE idmodificaciones='$id_param'";	
	$DB->Execute($sql2);

	$dir="confirmacioncambios.php";
}
else{
/* 
	$sqlse = "INSERT INTO `seguimientoruta`( `seg_fecha`, `seg_idservicio`, `seg_direccion`, `seg_tipo`, `seg_estado`,`seg_idusuario`,`seg_guia`) select '$fechatiempo','$id_param',CONCAT('Empresa TR: ',gas_empresa,' - # BUS: ' ,gas_bus,'-Tel Conductor: ',gas_telconductor),'Remesa Entrega','Asignada','$id_usuario','Remesa# $id_param' from gastos where idgastos=$id_param";
	$DB1->Execute($sqlse); */

	$sql2="UPDATE `gastos` SET `gas_usucom`='$id_nombre',`gas_cantcom`='$param6',`gas_feccom`='$param7'  WHERE idgastos='$id_param'";	
	$DB->Execute($sql2);
	
	$dir="gastos.php";

	
}



	$DB->cerrarconsulta();
//pop_dis3($id_p,\"Recoger Paquete\")

header ("Location: $dir?bandera=$bandera&tabla=$tabla");
?>

