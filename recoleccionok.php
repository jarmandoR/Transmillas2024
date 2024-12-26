<?php
require("login_autentica.php"); 
$id_nombre=$_SESSION['usuario_nombre'];
//@$id_usuario=$_REQUEST["id_usuario"];
$id_usuario=$_SESSION['usuario_id'];
$id_sedes=$_SESSION['usu_idsede'];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$bandera=1;

@$id_ciudad=$_REQUEST["id_ciudad"];

$param5=$param5."&".$param51."&".$param19."&".$param20."&".$param23."&";  
$param5 = str_replace('&0&','&&', $param5);


if($param15=="Compra"){
	$idclides=$_REQUEST['id_param3'];	
if($idclides!=''){
	 $sql21="select cli_valorprestado from clientes where idclientes=$idclides";
	$DB->Execute($sql21);

	$valoractual=$DB->recogedato(0);
	$valorprestado=$param16;
	$valorprestado = str_replace('.','', $valorprestado);

	$nuevovalor=$valoractual+$valorprestado;
	  $sql11="UPDATE `clientes` SET  `cli_valorprestado`='$nuevovalor'  WHERE `idclientes`='$id_param3'";
		$DB->Execute($sql11);
	}
}

if($id_param==0 and $id_param1==0){  // inserta el cliente remitente 0 Lugar de compra. si no esta creado y no lo actualiza.

	  $sql1="INSERT INTO `clientes`( `cli_iddocumento`,  `cli_email`, `cli_clasificacion`, `cli_retorno`,`cli_tipo`, `cli_fecharegistro`) 
	VALUES ('$param1','$param3','1',$param25,2,'$fechatiempo')";
	$idexec=$DB1->Executeid($sql1);

	 $sql="INSERT INTO `clientesdir`( `cli_nombre`, `cli_telefono`,`cli_idciudad`, `cli_direccion`,  `cli_idclientes`, `cli_principal`) 
	VALUES ('$param6','$param2','$param4','$param5','$idexec','1')";
	$idcli=$DB1->Executeid($sql);
	
	
}else {

	 $sql1="UPDATE `clientes` SET  `cli_iddocumento`='$param1',`cli_email`='$param3', `cli_clasificacion`='2',
	`cli_tipo`='2', `cli_fecharegistro`='$fechatiempo',`cli_retorno`=$param25  WHERE `idclientes`='$id_param'";
	$DB->Execute($sql1);

	 $sql="UPDATE `clientesdir` SET  `cli_nombre`='$param6', `cli_telefono`='$param2',`cli_idciudad`='$param4', 
	 `cli_direccion`='$param5',  `cli_idclientes`='$id_param', `cli_principal`=1 where `idclientesdir`='".$_REQUEST['id_param2']."'";
	$DB->Execute($sql);
	$idcli=$_REQUEST['id_param2'];	

	$idexec=$id_param;
}

$param10=$param10."&".$param101."&".$param21."&".$param22."&".$param24."&"; 
$param10 = str_replace('&0&','&&', $param10);

if($param8!=''){ // verifica que el telefono del destinatario no este vacio

	$sql3="SELECT idclientes From clientes inner join clientesdir on cli_idclientes=idclientes where cli_telefono='$param8'";
   $DB->Execute($sql3);
   $valorinser=$DB->recogedato(0);
   if($valorinser<=0){ 

		$sql1="INSERT INTO `clientes`(`cli_tipo`, `cli_iddocumento`,  `cli_email`,`cli_fecharegistro`) 
	   VALUES (0,'$param7','$param31','$fechatiempo')";
	   $idexec=$DB1->Executeid($sql1);

		$sql5="INSERT INTO `clientesdir`(`cli_nombre`, `cli_telefono`,`cli_idciudad`, `cli_direccion`,  `cli_idclientes`, `cli_principal`) 
	   VALUES ('$param9','$param8','$param11','$param10','$idexec',0)";
	   $DB1->Execute($sql5);


   }else {
	   
	$sql1="UPDATE `clientes` SET  `cli_tipo`='0', `cli_fecharegistro`='$fechatiempo', `cli_iddocumento`='$param7'  WHERE `idclientes`='$valorinser'";
	   $DB->Execute($sql1);

	$sql="UPDATE `clientesdir` SET  `cli_nombre`='$param9', `cli_telefono`='$param8',`cli_idciudad`='$param11', 
		`cli_direccion`='$param10',   `cli_principal`=0  where `cli_idclientes`='$valorinser'";
	   $DB->Execute($sql);
	   
   }
}



	$sql2="INSERT INTO `clientesservicios` (`cli_nombre`, `cli_telefono`,`cli_idciudad`, `cli_direccion`,  `cli_idclientes`, `cli_principal`) 
	VALUES ('$param6','$param2','$param4','$param5','$idexec',1)";
	$idcli2=$DB->Executeid($sql2);

$param17=str_replace(".","", $param17);
//$param10=$param10."&".$param101."&".$param21."&".$param22."&".$param24; 


if($param28==1){
	$param28=2;
}



if($param27=='1000'){
	$valorflete=str_replace(".","", $param100);
	$sql1="INSERT INTO `servicios`(`ser_iddocumento`,`ser_telefonocontacto`, `ser_destinatario`, `ser_direccioncontacto`,`ser_ciudadentrega`, `ser_tipopaquete`, `ser_paquetedescripcion`, `ser_fechaentrega`,`ser_prioridad`,  `ser_valorprestamo`, `ser_valorabono`, `ser_valorseguro`,  `ser_fecharegistro`,ser_clasificacion,ser_valor,ser_piezas) 
	VALUES
	('$param7','$param8','$param9','$param10','$param11','$param12','$param13','$param14','$param15','$param16','$param17','$param18','$fechatiempo','$param28','$valorflete','$param30')";
	$idser=$DB->Executeid($sql1);

}else{

	$sql1="INSERT INTO `servicios`(`ser_iddocumento`,`ser_telefonocontacto`, `ser_destinatario`, `ser_direccioncontacto`,`ser_ciudadentrega`, `ser_tipopaquete`, `ser_paquetedescripcion`, `ser_fechaentrega`,`ser_prioridad`,  `ser_valorprestamo`, `ser_valorabono`, `ser_valorseguro`,  `ser_fecharegistro`,ser_clasificacion) 
	VALUES
	('$param7','$param8','$param9','$param10','$param11','$param12','$param13','$param14','$param15','$param16','$param17','$param18','$fechatiempo','$param28')";
	$idser=$DB->Executeid($sql1);
} 
 

   $sql2="INSERT INTO `rel_sercli`(`ser_idclientes`, `ser_idservicio`, `ser_fechaingreso`) VALUES ($idcli2,$idser,'$fechatiempo')";
	$DB1->Execute($sql2);

	$sql5="SELECT `cre_nombre` FROM `creditos` WHERE `idcreditos`=$param113";
	$DB1->Execute($sql5);
	$nombrecredito=$DB1->recogedato(0);
	
	  $sql32="INSERT INTO rel_sercre (`idservicio`, `rel_nom_credito`) VALUES ($idser,'$nombrecredito')";
	$DB1->Execute($sql32);

     $sql3="INSERT INTO `guias`(`gui_idservicio`, `gui_idusuario`,`gui_usucreado`, `gui_fechacreacion`,gui_tiposervicio)  VALUES ($idser,'$id_usuario','$id_nombre','$fechatiempo',$param27) ";
	$DB->Executeid($sql3);

	if($param17>0){
		$sql33="INSERT INTO `abonosguias`(`abo_fecha`, `abo_valor`, `abo_idservicio`, `abo_iduser`, `abo_idsede`, `abo_estado`)  VALUES ('$fechatiempo','$param17','$idser','$id_usuario','$id_sedes','abono')";
		$DB->Executeid($sql33);
	}

	 $sql31="select idcuentaspromotor from cuentaspromotor where cue_idservicio=$idser";
	$DB->Execute($sql31);
	$cuepromotor=$DB->recogedato(0);
if($cuepromotor>0 and $param28==2){
	$sqlc="UPDATE `cuentaspromotor` SET  `cue_tipoevento`='2' where  cue_idservicio=$idser ";
	$DB->Execute($sqlc);
	}

	$DB->cerrarconsulta();
	$DB1->cerrarconsulta();

header ("Location: inicio1.php?bandera=$bandera");
