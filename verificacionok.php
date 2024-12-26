<?php
require("login_autentica.php"); 
$id_nombre=$_SESSION['usuario_nombre'];
@$id_usuario=$_REQUEST["id_usuario"];
@$dir=$_REQUEST["dir"];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();

$DB1 = new DB_mssql;
$DB1->conectar();
//$param5=$param5."&".$param51."&".$param19."&".$param20."&".$param23; 
$fechar=$_REQUEST["param105"];
$fechar2=$_REQUEST["param106"];
// $_REQUEST["param99"];
 $cond="";
/* echo $fechar."----".$fechar2;
exit; */
if($_REQUEST["param99"]==1 or $fechar!=$fechar2){
	$hora=date("H:m:s");
	$descllamada=$_REQUEST["param100"].'<br>'.$_REQUEST["descllamada"].'<br>';
	$fechar=date("$fechar $hora");
	$sql2="UPDATE `servicios` SET  ser_fecharegistro='$fechar',`ser_esatdollamando`='Colgado',`ser_descllamada`='$descllamada' WHERE `idservicios`='".$_REQUEST['id_param0']."'";			
	$DB->Execute($sql2);

	$sql3="SELECT `llam_numero` FROM `llamadasvalidadas` WHERE llam_fecha='$fechaactual' and llam_idusuario='$id_usuario'";
	$DB->Execute($sql3);
	$numellamada=$DB->recogedato(0);
	if($numellamada>=1){

		$sql4a="UPDATE `llamadasvalidadas` SET  llam_numero=$numellamada+1 WHERE llam_fecha='$fechaactual' and llam_idusuario='$id_usuario'";			
		$DB->Execute($sql4a);

	}else{

		$sql4a="INSERT INTO `llamadasvalidadas`( `llam_idusuario`, `llam_fecha`, `llam_numero`) VALUES ($id_usuario,'$fechaactual',1)";			
		$DB->Execute($sql4a);

	}
	
}else {
	if($dir=="adm_validardatos.php"){
				$cond.=",`ser_estado`='2'";
	}
	$cond.=",`ser_fechaconfirmacion`='$fechatiempo',`ser_iduserverific`='$id_usuario'";
}

if($param27=='1000'){
	$param107=str_replace(".","", $param107);
	$cond.=",`ser_valor`='$param107',`ser_piezas`='$param30'";
}

$param5=$param5."&".$param51."&".$param19."&".$param20."&".$param23."&";  
$param5 = str_replace('&0&','&&', $param5);

 
 	 $sql1="UPDATE `clientes` SET  `cli_iddocumento`='$param1',`cli_email`='$param3', `cli_clasificacion`='2',
	`cli_tipo`='2', `cli_fecharegistro`='$fechatiempo',`cli_retorno`=$param25  WHERE `idclientes`='$id_param'";
	$DB->Execute($sql1);


	 $sql="UPDATE `clientesdir` SET  `cli_nombre`='$param6', `cli_telefono`='$param2',`cli_idciudad`='$param4', 
	 `cli_direccion`='$param5',  `cli_principal`='1' where `cli_idclientes`='$id_param'";
	$DB->Execute($sql);
 
 
 	 $sql11="UPDATE `clientesservicios` SET  `cli_nombre`='$param6', `cli_telefono`='$param2',`cli_idciudad`='$param4', 
	 `cli_direccion`='$param5',  `cli_idclientes`='$id_param', `cli_principal`='1' where `idclientesdir`='".$_REQUEST['id_param2']."'";
	$DB->Execute($sql11);

//$param10=$param10."&".$param101."&".$param21."&".$param22."&".$param24; 
$param10=$param10."&".$param101."&".$param21."&".$param22."&".$param24."&"; 
$param10 = str_replace('&0&','&&', $param10);	
if($dir=="adm_validardatos.php"){
	//$cond.=",`ser_estado`='2'";
	
	$sql3="UPDATE `guias` SET `gui_usuvalida`='$id_nombre',`gui_fechavalidacion`='$fechatiempo' WHERE `gui_idservicio`='".$_REQUEST['id_param0']."'";
	$DB->Executeid($sql3); 
	$ideservis=$_REQUEST['id_param0'];

	$sql32="UPDATE rel_sercre (`idservicio`, `rel_nom_credito`) VALUES ($ideservis,'$param113')";
	$DB1->Execute($sql32);
	
}else {

/* 	if(){

	}else{
		
	} */
	
 $sql3="UPDATE `guias` SET `gui_useredita`='$id_nombre',`gui_fechaedita`='$fechatiempo',gui_tiposervicio='$param27' WHERE `gui_idservicio`='".$_REQUEST['id_param0']."'";
	$DB->Executeid($sql3); 	
	
		$param177=str_replace(".","", $param17);
		$param166=str_replace(".","", $param16);
		$param188=str_replace(".","", $param18);
		
		$sql="SELECT `pre_porcentaje` FROM `prestamo` WHERE `pre_inicio`<'$param166' and `pre_final`>='$param166'";
		$DB->Execute($sql);
		$porprestamo=$DB->recogedato(0);
		$dosporcentaje=explode(" ",$porprestamo); 

		if(@$dosporcentaje[1]=='%'){
			$porprestamo=($param166*@$dosporcentaje[0])/100;
		}
		$pordeclarado=(intval($param188)*1)/100;
	
	
	  $sql22="UPDATE `cuentaspromotor` SET  `cue_abono`='$param177', `cue_porprestamo`='$porprestamo', `cue_prestamo`='$param166',
	 `cue_vrdeclarado`='$param188',`cue_pordeclarado`='$pordeclarado' where cue_idservicio='".$_REQUEST['id_param0']."'";
$DB1->Execute($sql22);	
	
	
}
$param17=str_replace(".","", $param17);
if($param28==1){
	$param28=2;
}
 $sql1="UPDATE `servicios` SET `ser_iddocumento`='$param7',`ser_telefonocontacto`='$param8',`ser_destinatario`='$param9',`ser_direccioncontacto`='$param10',`ser_ciudadentrega`='$param11',`ser_tipopaquete`='$param12',`ser_paquetedescripcion`='$param13',`ser_fechaentrega`='$param14',`ser_valorprestamo`='$param16',`ser_valorabono`='$param17',`ser_valorseguro`='$param18', ser_clasificacion='$param28' $cond WHERE `idservicios`='".$_REQUEST['id_param0']."'";
$DB->Execute($sql1);



if($param8!=$param2){ 
	 $sql3="SELECT idclientes From clientes inner join clientesdir on cli_idclientes=idclientes where cli_telefono='$param8'";
	$DB->Execute($sql3);
	$valorinser=$DB->recogedato(0);
	if($valorinser<=0){


		 $sql1="INSERT INTO `clientes`(`idclientes`,  `cli_tipo`, `cli_iddocumento`,  `cli_email`,`cli_fecharegistro`) 
		VALUES ('',0,'$param7','','$fechatiempo')";
		$idexec=$DB1->Executeid($sql1);

		  $sql5="INSERT INTO `clientesdir`(`idclientesdir`, `cli_nombre`, `cli_telefono`,`cli_idciudad`, `cli_direccion`,  `cli_idclientes`, `cli_principal`) 
		VALUES ('','$param9','$param8','$param11','$param10','$idexec','0')";
		$DB1->Execute($sql5);


	}else {
		
		 $sql1="UPDATE `clientes` SET  `cli_tipo`='0', `cli_fecharegistro`='$fechatiempo', `cli_iddocumento`='$param7'   WHERE `idclientes`='$valorinser'";
		$DB->Execute($sql1);

		 $sql="UPDATE `clientesdir` SET  `cli_nombre`='$param9', `cli_telefono`='$param8',`cli_idciudad`='$param11', 
		 `cli_direccion`='$param10',   `cli_principal`='0' where `cli_idclientes`='$valorinser' ";
		$DB->Execute($sql);
		
	}
}
	$DB->cerrarconsulta();
	$DB1->cerrarconsulta();


header ("Location:$dir?bandera=1");


?>