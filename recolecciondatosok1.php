<?php
require("login_autentica.php"); 
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];


$DB = new DB_mssql;
$DB->conectar();

@$id_usuario=$_REQUEST["id_usuario"];


@$precio=$_REQUEST["precio"];
@$pordeclarado=$_REQUEST["pordeclarado"];
@$porprestamo=$_REQUEST["porprestamo"];

$DB1 = new DB_mssql;
$DB1->conectar();
if($param11!=$param4){
 $sql3="SELECT inner_sedes FROM `ciudades` where idciudades in ($param11,$param4)";
 $DB1->Execute($sql3);
 $ver=0;
while($rw3 = mysqli_fetch_row($DB1->Consulta_ID)) {
	$sedes[$ver]=$rw3[0];
	$ver++;
	}
if($sedes[0]==$sedes[1]){   $estado=8; } else { $estado=6; }
	if($param28=='2'){ $param78=2; } else { $param78=0; }
} else {
	
	$estado=8; 
}	
if($nivel_acceso==3){  $estado=4;  $param15="Recogida Operador"; }	
 
$param10=$param10."&".$param101."&".$param21."&".$param22."&".$param24."&"; 
$param5=$param5."&".$param51."&".$param19."&".$param20."&".$param23."&";  
	

$param5 = str_replace('&0&','&&', $param5);
$param10 = str_replace('&0&','&&', $param10);

if($id_param==0 and $id_param1==0){

	$sql1="INSERT INTO `clientes`(`cli_iddocumento`,  `cli_email`, `cli_clasificacion`, `cli_retorno`,`cli_tipo`, `cli_fecharegistro`) 
	VALUES ('$param1','$param3','$param78',$param25,2,'$fechatiempo')";
	$idexec=$DB1->Executeid($sql1);

	$sql="INSERT INTO `clientesdir`(`cli_nombre`, `cli_telefono`,`cli_idciudad`, `cli_direccion`,  `cli_idclientes`, `cli_principal`) 
	VALUES ('$param6','$param2','$param4','$param5','$idexec','1')";
	$idcli=$DB1->Executeid($sql);

}else {
$idcli=$_REQUEST['id_param2'];	
 	 $sql1="UPDATE `clientes` SET  `cli_iddocumento`='$param1',`cli_email`='$param3', `cli_clasificacion`='$param78',
	`cli_tipo`='2', `cli_fecharegistro`='$fechatiempo',`cli_retorno`=$param25  WHERE `idclientes`='$id_param'";
	$DB->Execute($sql1);

	 $sql="UPDATE `clientesdir` SET  `cli_nombre`='$param6', `cli_telefono`='$param2',`cli_idciudad`='$param4', `cli_direccion`='$param5',
	  `cli_idclientes`='$id_param', `cli_principal`='1' where `idclientesdir`='".$_REQUEST['id_param2']."'";
	$DB->Execute($sql);
	
		$idexec=$id_param;

}

	 $sql2="INSERT INTO `clientesservicios` (`cli_nombre`, `cli_telefono`,`cli_idciudad`, `cli_direccion`,  `cli_idclientes`, `cli_principal`) 
	VALUES ('$param6','$param2','$param4','$param5','$idexec','1')";
	$idcli2=$DB->Executeid($sql2);

if($param8!=''){

	 $sql3="SELECT idclientes From clientes inner join clientesdir on cli_idclientes=idclientes where cli_telefono='$param8'";
	$DB->Execute($sql3);
	$valorinser=$DB->recogedato(0);
	if($valorinser<=0){

		 $sql1="INSERT INTO `clientes`(`cli_tipo`, `cli_iddocumento`,  `cli_email`,`cli_fecharegistro`) 
		VALUES (0,'$param7','','$fechatiempo')";
		$idexec=$DB->Executeid($sql1);

		  $sql5="INSERT INTO `clientesdir`(`cli_nombre`, `cli_telefono`,`cli_idciudad`, `cli_direccion`,  `cli_idclientes`, `cli_principal`) 
		VALUES ('$param9','$param8','$param11','$param10','$idexec','0')";
		$DB->Execute($sql5);


	}else {
		
		 $sql1="UPDATE `clientes` SET  `cli_tipo`='0', `cli_fecharegistro`='$fechatiempo', `cli_iddocumento`='$param7'  WHERE `idclientes`='$valorinser'";
		$DB->Execute($sql1);

		 $sql="UPDATE `clientesdir` SET  `cli_nombre`='$param9', `cli_telefono`='$param8',`cli_idciudad`='$param11', 
		 `cli_direccion`='$param10',   `cli_principal`='0' where `idclientesdir`='".$_REQUEST['id_param0']."' ";
		$DB->Execute($sql);
		
	}
}

 	$sql="SELECT `idconfac`, `idconsecutivo`, `idresolucion`, `prefijo` FROM `conf_fac` inner join ciudades on idciudad=inner_sedes WHERE idciudades='$param4'";	
	$DB1->Execute($sql);
	$rw1=mysqli_fetch_array($DB1->Consulta_ID);	
	$planilla="$rw1[3]$rw1[1]";
	$idconsecutivo=$rw1[1]+1;
   $sql2="UPDATE `conf_fac` c inner join ciudades cc on c.idciudad=cc.inner_sedes SET c.`idconsecutivo`=$idconsecutivo   WHERE cc.idciudades='$param4'";	
	
	$DB->Execute($sql2);
 
 $param17=str_replace(".","", $param17);
 
   $sql1="INSERT INTO `servicios` (`ser_iddocumento`,`ser_telefonocontacto`, `ser_destinatario`, `ser_direccioncontacto`,`ser_ciudadentrega`, `ser_tipopaquete`, `ser_paquetedescripcion`, `ser_fechaentrega`,`ser_prioridad`, 
  `ser_guiare`, `ser_valorabono`, `ser_valorseguro`,  `ser_fecharegistro`,`ser_peso`,ser_volumen,ser_idverificado,ser_idresponsable,ser_valor,`ser_estado`,ser_visto,ser_consecutivo,ser_llego,ser_pendientecobrar,ser_fechafinal,ser_clasificacion,ser_idverificadopeso,ser_piezas,ser_descripcion,ser_verificado,ser_tipopaq) 
 VALUES  ('$param7','$param8','$param9','$param10','$param11','$param12','$param13','$param14','$param15','$param16','$param17','$param18','$fechatiempo','$param26','$param27',$id_usuario,$id_usuario,$precio,$estado,0,'$planilla','SI','$param112','$fechatiempo','$param28',1,'$param30','$param31','$param32','$param33')";
 $idser=$DB->Executeid($sql1);


 $sql2="INSERT INTO `rel_sercli`(`idsercli`, `ser_idclientes`, `ser_idservicio`, `ser_fechaingreso`) VALUES ('',$idcli2,$idser,'$fechatiempo')";
  $DB1->Execute($sql2);
  
   $sql3="INSERT INTO `guias`(`gui_idservicio`,`gui_idusuario`,`gui_usucreado`, `gui_fechacreacion`,gui_tiposervicio) 
		VALUES ('$idser,'$id_usuario','$id_nombre','$fechatiempo',$param29) ";
	$DB->Executeid($sql3); 
  
  	$param18=str_replace(".","", $param18);
	//$param16=str_replace(".","", $param16);
	
	$sql31="DELETE FROM `rel_sercre` WHERE  idservicio=$idser";
	$DB1->Execute($sql31);	

	$sql32="INSERT INTO rel_sercre (`idservicio`, `rel_nom_credito`) VALUES ($idser,'$param113')";
	$DB1->Execute($sql32);

  	 $sql2="INSERT INTO `cuentaspromotor`(`cue_idservicio`,`cue_idoperador`,`cue_abono`, `cue_porprestamo`, `cue_prestamo`,
	 `cue_vrdeclarado`,`cue_pordeclarado`,  `cue_valorflete`,  `cue_tipopago`,  `cue_fecha`,`cue_valpagar`,cue_estado, `cue_idciudadori`, `cue_idciudaddes`, `cue_tipoevento`, `cue_numeroguia`, `cue_fecharecogida`, `cue_pendientecobrar`,gui_tiposervicio) 
	VALUES ('$idser','$id_usuario','$param17','$porprestamo','0','$param18','$pordeclarado','$precio','$param15','$fechatiempo','$param26','4','$param4','$param11','$param28','$planilla','$fechatiempo','$param112','$param34')";
	$DB->Execute($sql2);

	$DB->cerrarconsulta();
	$DB1->cerrarconsulta();


?>