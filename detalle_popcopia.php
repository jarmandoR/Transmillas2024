<?php
require("login_autentica.php");
include("cabezote3.php");
include("cabezote1.php"); 
if(isset($_REQUEST["id_param"])) {$id_param=$_REQUEST["id_param"]; } else { $id_param=""; } 
if(isset($_REQUEST["tabla"])) {$tabla=$_REQUEST["tabla"]; } else { $tabla=""; } 
if(isset($_REQUEST["dir"])) {$dir=$_REQUEST["dir"]; } else { $dir=""; } 
$fechatiempo=date("Y-m-d H:i:s");
$id_sedes=$_SESSION['usu_idsede'];
?>	

<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title"><?php echo $tabla; ?></h4></div>
<?php 
if($tabla=="Verificar Datos") {

$estadofactura='verificacion';
$nombre=explode(" ",$id_nombre);
$descllamada=$nombre[0]." ".$nombre[1].'<br>';
$descllamada.="$fechatiempo";
$dir=$_REQUEST["dir"];


  $sql="SELECT `idclientes`, `cli_iddocumento`, `cli_telefono`, `cli_email`, `cli_idciudad`, `cli_direccion`, `cli_nombre`, `ser_iddocumento`,`ser_telefonocontacto`, `ser_destinatario`, `ser_direccioncontacto`,`ser_ciudadentrega`,
 `ser_tipopaquete`, `ser_paquetedescripcion`, `ser_fechaentrega`,`ser_prioridad`,  `ser_valorprestamo`, `ser_valorabono`, `ser_valorseguro`, `idservicios`,cli_retorno,idclientesdir,ser_descllamada,date(ser_fecharegistro),ser_clasificacion,ser_tipopaq FROM 
 servicios inner join rel_sercli  on idservicios=ser_idservicio  inner join clientesservicios on idclientesdir=ser_idclientes inner join clientes on idclientes=cli_idclientes  where idservicios=$id_param ";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	

//$descllamada.=@$rw[22];
$fecharegistro=@$rw[23];
  $sql2="UPDATE `servicios` SET  `ser_esatdollamando`='Ocupado',`ser_descllamada`='$descllamada' WHERE `idservicios`='$id_param' ";			
	$DB->Execute($sql2);

$actuliza="no";
$param15=$rw[15];

if($param15=="Envio Oficina"){
	
   include("oficina.php");

}else if($param15=="Compra"){
	$boton='no';
	include("recoleccion_compra.php");

} else {
include("recoleccion_datos.php");	
}

if($dir=="adm_validardatos.php"){
$FB->llena_texto("LLAMAR DESPUES:",99, 5, $DB, "", "", "", 1, 0);
$FB->llena_texto("MOTIVO:",100,1, $DB, "", "","" ,4, 0);	
$FB->llena_texto("Reasignar Fecha:", 105, 10, $DB, "", "", "$fecharegistro", 4, 0);

}else {
	$FB->llena_texto("param99", 1, 13, $DB, "", "", "", 5, 0);
	$FB->llena_texto("param100", 1, 13, $DB, "", "", "", 5, 0);
	$FB->llena_texto("param105", 1, 13, $DB, "", "", "$fecharegistro", 4, 0);

}

$FB->llena_texto("param106", 1, 13, $DB, "", "", "$fecharegistro", 4, 0);
$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
$FB->llena_texto("dir", 1, 13, $DB, "", "", $dir, 5, 0);
$FB->llena_texto("descllamada", 1, 13, $DB, "", "", $descllamada, 5, 0);
//$FB->llena_texto("id_param0", 1, 13, $DB, "", "", $id_usuario, 5, 0);
 
}elseif($tabla=="acuerdo") {

	$idservicio=$_REQUEST["dir"];
	$FB->llena_texto("Descripcion de LLamada:",1,9, $DB, "", "","" ,1, 1);	
	$FB->llena_texto("Valor a Pagar:",2, 1, $DB, "", "", "$rw[4]", 1, 0);
	$FB->llena_texto("Formato de pago Firmado", 3, 6, $DB, "", "", "",1,0);
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("param10", 1, 13, $DB, "", "", $idservicio, 5, 0);


}elseif($tabla=="Pagoacuerdo") {

	$idservicio=$_REQUEST["dir"];
	$FB->llena_texto("# Cuenta:",1, 1, $DB, "", "", "$rw[1]", 1, 0);
	$FB->llena_texto("Tipo Cuenta:",1,82, $DB, $tipocuenta, "", "$rw[2]", 1, 0);
	$FB->llena_texto("Banco:",3, 1, $DB, "", "", "$rw[3]", 1, 0);
	$FB->llena_texto("Valor a Pagar:",4, 1, $DB, "", "", "$rw[4]", 1, 0);
	$FB->llena_texto("Formato de pago ", 5, 6, $DB, "", "", "",1,0);
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("param10", 1, 13, $DB, "", "", $idservicio, 5, 0);


}elseif($tabla=="LlamarReclamos") {

	$idservicio=$_REQUEST["dir"];
	$FB->llena_texto("Descripcion de LLamada:",2,9, $DB, "", "","" ,1, 1);		
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("param10", 1, 13, $DB, "", "", $idservicio, 5, 0);


}elseif($tabla=="Llamar Remesas") {

	$estadofactura='2';
	$nombre=explode(" ",$id_nombre);
	$descllamada=$nombre[0]." ".$nombre[1].'<br>';
	$descllamada.="$fechatiempo";
	$dir=$_REQUEST["ide"];
	
	
	  $sql="SELECT `idgastos`,  `gas_descripcion`, `gas_peso`, `gas_piezas`,  `gas_cantcom`, `gas_empresa`, `gas_bus`, `gas_telconductor`, `gas_iduserremesa`, `gas_nomremesa` from gastos  where idgastos=$id_param ";
	$DB->Execute($sql);
	$rw=mysqli_fetch_array($DB->Consulta_ID);	

	  $sql2="UPDATE `gastos` SET  `gas_estadollamada`='2',`gas_userllamo`='$descllamada',gas_fechallamo='$fechatiempo' WHERE `idgastos`='$id_param' ";			
		$DB->Execute($sql2);
	
		echo "<p  align='left'>TELEFONO: $rw[7]<br></p>";
	$FB->llena_texto("Descripcion:",1, 1, $DB, "", "", "$rw[1]", 1, 0);
	$FB->llena_texto("Peso:",2, 1, $DB, "", "", "$rw[2]", 1, 0);
	$FB->llena_texto("Piezas:",3, 1, $DB, "", "", "$rw[3]", 1, 0);
	$FB->llena_texto("Valor a Pagar:",4, 1, $DB, "", "", "$rw[4]", 1, 0);
	$FB->llena_texto("Empresa:",5, 1, $DB, "", "", "$rw[5]", 1, 0);
	$FB->llena_texto("Bus:",6, 1, $DB, "", "", "$rw[6]", 1, 0);
	$FB->llena_texto("Telefono:",1, 1, $DB, "", "", "$rw[7]", 1, 0);
	$FB->llena_texto("Pasar a Asignar:",7, 5, $DB, "", "", "", 1, 0);
	$FB->llena_texto("MOTIVO:",8,1, $DB, "", "","" ,4, 0);	
	$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
	 
	
}else if($tabla=="Seguimiento Datos") {

$estadofactura='verificacion';

 $sql="SELECT `idclientes`, `cli_iddocumento`, `cli_telefono`, `cli_email`, `cli_idciudad`, `cli_direccion`, `cli_nombre`, `cli_clasificacion`,`ser_telefonocontacto`, `ser_destinatario`, `ser_direccioncontacto`,`ser_ciudadentrega`, `ser_tipopaquete`, `ser_paquetedescripcion`, `ser_fechaentrega`,`ser_prioridad`,  `ser_valorprestamo`, `ser_valorabono`, `ser_valorseguro`, `idservicios`,cli_retorno,idclientesdir FROM 
serviciosdia  where idservicios=$id_param ";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	
$actuliza="no";
$param15=$rw[15];
if($param15=="Envio Oficina"){
	
   include("oficina.php");

}else if($param15=="Compra"){
	
	include("recoleccion_compra.php");

} else {
include("recoleccion_datos.php");	
}	

$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
//$FB->llena_texto("id_param0", 1, 13, $DB, "", "", $id_usuario, 5, 0);

}
else if($tabla=="Reaccionar"){ 
$rw[4]=0;

$idciudad=$_REQUEST["idciudad"];
$FB->llena_texto("Tipo de Operador:",1,82, $DB, $vehiculo, "cambio_ajax2(this.value, 9, \"llega_sub1\", \"param2\", 1, $idciudad)",@$rw[1], 17, 1);
$FB->llena_texto("OPerador:", 2, 444, $DB, "llega_sub1", "", "",4,0);

$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("condicion", 1, 13, $DB, "", "", "2", 5, 0);

}
else if($tabla=="Reaccionarsaldos"){ 
	$rw[4]=0;
	
	$idciudad=$_REQUEST["idciudad"];
	$FB->llena_texto("Tipo de Operador:",1,82, $DB, $vehiculo, "cambio_ajax2(this.value, 9, \"llega_sub1\", \"param2\", 1, $idciudad)",@$rw[1], 17, 1);
	$FB->llena_texto("OPerador:", 2, 444, $DB, "llega_sub1", "", "",4,0);
	
	$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("condicion", 1, 13, $DB, "", "", "4", 5, 0);
	
	}
else if($tabla=="Reaccionardos"){ 
$rw[4]=0;

$idciudad=$_REQUEST["idciudad"];
$FB->llena_texto("Tipo de Operador:",1,82, $DB, $vehiculo, "cambio_ajax2(this.value, 9, \"llega_sub1\", \"param2\", 1, $idciudad)",@$rw[1], 17, 1);
$FB->llena_texto("OPerador:", 2, 444, $DB, "llega_sub1", "", "",4,0);

$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("condicion", 1, 13, $DB, "", "", "3", 5, 0);
}
else if($tabla=="Reasignar"){ 
	
$idciudad=$_REQUEST["idciudad"];
$FB->llena_texto("Tipo de Operador:",1,82, $DB, $vehiculo, "cambio_ajax2(this.value, 8, \"llega_sub1\", \"param2\", 1, $idciudad)",@$rw[1], 17, 1);
$FB->llena_texto("OPerador:", 2, 444, $DB, "llega_sub1", "", "",4,1);

$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);


}else if($tabla=="remesas"){ 

$FB->titulo_azul1("Fecha",1,0,5); 
$FB->titulo_azul1("Usuario",1,0,0); 
$FB->titulo_azul1("Sede Origen",1,0,0); 
$FB->titulo_azul1("Sede Destino",1,0,0); 	
$FB->titulo_azul1("Empresa TR",1,0,0); 
$FB->titulo_azul1("# BUS",1,0,0); 



$sql="SELECT `idgastos`, `gas_fecharegistro`, `usu_nombre`, `gas_idciudadori`, `sed_nombre`, `gas_empresa`, `gas_bus`, `gas_telconductor`,`gas_pagar`,`gas_iduserremesa`, `gas_nomremesa`,`gas_descripcion`,`gas_peso`,`gas_piezas`,`gas_valor`,gas_usucom,gas_cantcom,gas_feccom ,gas_idciudaddes,gas_iduserrecoge,gas_recogio,gas_entrego,gas_fecrecogida FROM `gastos` inner join usuarios on gas_idusuario=idusuarios inner join sedes on idsedes=gas_idciudaddes WHERE idgastos=$id_param ";
$DB1->Execute($sql); $va=0;
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

			$rw1[16]=number_format($rw1[16],0,".",".");
			$sql2="SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes='$rw1[3]'";
			$DB->Execute($sql2);
			$rw=mysqli_fetch_row($DB->Consulta_ID);

		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			echo "<td>".$rw1[1]."</td>
			<td>".$rw1[2]."</td>
			<td>".$rw[1]."</td>
			<td>".$rw1[4]."</td>
			<td>".$rw1[5]."</td>
			<td>".$rw1[6]."</td>";
			echo "</tr>";
			$FB->titulo_azul1("Tel Conductor",1,0,5); 
$FB->titulo_azul1("Pagar en?",1,0,0); 
$FB->titulo_azul1("Operario Remesa",1,0,0); 
$FB->titulo_azul1("Descripcion",1,0,0); 
$FB->titulo_azul1("Peso",1,0,0); 
$FB->titulo_azul1("Piezas",1,0,0); 
echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	
			echo "<td>".$rw1[7]."</td>
			<td>".$rw1[8]."</td>
			<td>".$rw1[10]."</td>
			<td>".$rw1[11]."</td>
			<td>".$rw1[12]."</td>
			<td>".$rw1[13]."</td>";
			echo "</tr>";
	
		
		
			$FB->titulo_azul1("Pagar",1,0,5); 
$FB->titulo_azul1("Confirmo",1,0,0); 
$FB->titulo_azul1("Valor Aprobado",1,0,0); 
$FB->titulo_azul1("Fecha Confirmacion",1,0,0);
$FB->titulo_azul1("Fecha Recogida",1,0,0);  
$FB->titulo_azul1("Operario Recoge",1,0,0); 
echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

echo "
<td>".$rw1[14]."</td>
<td>".$rw1[15]."</td>
<td>".$rw1[16]."</td>
<td>".$rw1[17]."</td>
";
			$sql5="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$rw1[19]' ";
			$DB->Execute($sql5);
			$nombreuser=$DB->recogedato(1);
			echo "<td>".$rw1[22]."</td>";
			echo "<td>".$nombreuser."</td>";

		echo "</tr>";
	}

}
else if($tabla=="asignar remesa"){ 
	
	$idciudad=$_REQUEST["idciudad"];
	/* $urls=$_SERVER['PHP_SELF'];
	$obtenerurl=explode('?',$urls,1); */

	$FB->llena_texto("Tipo de Operador:",1,82, $DB, $vehiculo, "cambio_ajax2(this.value, 8, \"llega_sub1\", \"param2\", 1, $idciudad)",@$rw[1], 17, 1);
	$FB->llena_texto("OPerador:", 2, 444, $DB, "llega_sub1", "", "",4,1);
	
	$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("condicion", 1, 13, $DB, "", "", "3", 5, 0);
	$FB->llena_texto("url", 1, 13, $DB, "", "", "$url", 5, 0);

	
	}
	else if($tabla=="asignar dinero"){ 
	
		$FB->titulo_azul1("Fecha",1,0,5); 
$FB->titulo_azul1("Operador",1,0,0); 
$FB->titulo_azul1("Tipo",1,0,0); 
$FB->titulo_azul1("Valor ",1,0,0); 
$FB->titulo_azul1("Descripcion ",1,0,0); 
$FB->titulo_azul1("Asigno ",1,0,0); 

$sql="SELECT `idasignaciondinero`,`asi_fecha`, usu_nombre, `asi_tipo`, `asi_valor`,  `asi_descripcion`, `asi_idautoriza`, `asi_idpromotor` FROM `asignaciondinero` inner join usuarios on asi_idpromotor=idusuarios WHERE idasignaciondinero>0  and idasignaciondinero=$id_param  ";
$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	
	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		";
		$slqs="SELECT usu_nombre FROM usuarios WHERE idusuarios='$rw1[6]' ";
		$DB->Execute($slqs); 
		$asigno=$DB->recogedato(0);
		echo "<td>".$asigno."</td>
		";
	echo "</tr>";

	}
}else if($tabla=="detalleprestamos"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("VALOR",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
	  $sql="SELECT ser_guiare,ser_valorprestamo FROM `servicios` inner join cuentaspromotor on idservicios=cue_idservicio WHERE cue_fecharecogida  like '$fechaab%' and  ser_estado!=100   and cue_idciudadori=$id_param and ser_valorprestamo>0 order by cue_fecharecogida";

		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				";
				$rw1[1]=str_replace(".","", $rw1[1]);
				$sumatotal=$rw1[1]+$sumatotal;
			echo "</tr>";
		}
		$sumatotal=number_format($sumatotal,0,".",".");
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }else if($tabla=="detalleexcedente"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("%PRESTAMO",1,0,0); 
	$FB->titulo_azul1("PRESTAMO",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		$sql="SELECT cue_numeroguia,cue_porprestamo,cue_prestamo FROM `cuentaspromotor`  inner join ciudades on idciudades=cue_idciudaddes WHERE `cue_fecha` like '$fechaab%'  and cue_estado=10  and cue_tipoevento=1 and  cue_prestamo>0 and inner_sedes=$id_param  order by `cue_fecha` ";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				";
				$rw1[1]=str_replace(".","", $rw1[1]);
				$rw1[2]=str_replace(".","", $rw1[2]);

				$sumatotal=$rw1[1]+$rw1[2]+$sumatotal;
			echo "</tr>";
		}
		$sumatotal=number_format($sumatotal,0,".",".");
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }else if($tabla=="detallecontado"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("%PRESTAMO",1,0,0); 
	$FB->titulo_azul1("PRESTAMO",1,0,0); 
	$FB->titulo_azul1("FLETE",1,0,0); 
	$FB->titulo_azul1("%SEGURO",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		$sql="SELECT cue_numeroguia,cue_porprestamo,cue_prestamo,cue_valorflete,cue_pordeclarado FROM `cuentaspromotor`  inner join ciudades on idciudades=cue_idciudadori WHERE `cue_fecharecogida` like '$fechaab%'  and cue_estado<=14  and cue_tipoevento=1 and  cue_pendientecobrar=0 and inner_sedes=$id_param  order by `cue_fecha` ";
	//	$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>
				<td>".$rw1[4]."</td>
				";
				$rw1[1]=str_replace(".","", $rw1[1]);
				$rw1[2]=str_replace(".","", $rw1[2]);
				$rw1[3]=str_replace(".","", $rw1[3]);
				$rw1[4]=str_replace(".","", $rw1[4]);

				$sumatotal=$rw1[3]+$rw1[4]+$sumatotal;
			echo "</tr>";
		}
		$sumatotal=number_format($sumatotal,0,".",".");
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="detallepxc"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("%PRESTAMO",1,0,0); 
	$FB->titulo_azul1("PRESTAMO",1,0,0); 
	$FB->titulo_azul1("FLETE",1,0,0); 
	$FB->titulo_azul1("%SEGURO",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		//$sql="SELECT cue_numeroguia,cue_porprestamo,cue_prestamo,cue_valorflete,cue_pordeclarado FROM `cuentaspromotor`  inner join ciudades on idciudades=cue_idciudadori WHERE `cue_fechapcobrar` like '$fechaab%'  and cue_estado<=14  and cue_tipoevento=1 and  cue_pendientecobrar=2 and inner_sedes=$id_param  order by `cue_fecha` ";
		$sql="SELECT cue_numeroguia,cue_porprestamo,cue_prestamo,cue_valorflete,cue_pordeclarado FROM `cuentaspromotor`  inner join usuarios on idusuarios=cue_idoperpendiente WHERE `cue_fechapcobrar` like '$fechaab%'  and cue_estado<=14  and cue_tipoevento=1 and cue_pendientecobrar=2 and usu_idsede=$id_param  order by `cue_fecha` ";

	//	$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>
				<td>".$rw1[4]."</td>
				";
				$rw1[1]=str_replace(".","", $rw1[1]);
				$rw1[2]=str_replace(".","", $rw1[2]);
				$rw1[3]=str_replace(".","", $rw1[3]);
				$rw1[4]=str_replace(".","", $rw1[4]);

				$sumatotal=$rw1[1]+$rw1[2]+$rw1[3]+$rw1[4]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$sumatotal=number_format($sumatotal,0,".",".");
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="detallealcobro"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("%PRESTAMO",1,0,0); 
	$FB->titulo_azul1("PRESTAMO",1,0,0); 
	$FB->titulo_azul1("FLETE",1,0,0); 
	$FB->titulo_azul1("%SEGURO",1,0,0); 
	$FB->titulo_azul1("- ABONO",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		$sql="SELECT cue_numeroguia,cue_porprestamo,cue_prestamo,cue_valorflete,cue_pordeclarado,cue_abono FROM `cuentaspromotor`  inner join ciudades on idciudades=cue_idciudaddes WHERE `cue_fecha` like '$fechaab%' and  cue_estado>=8  and cue_estado<=14  and cue_tipoevento=3 and inner_sedes=$id_param  order by `cue_fecha` ";
	//	$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>
				<td>".$rw1[4]."</td>
				<td>".$rw1[5]."</td>
				";
				$rw1[1]=str_replace(".","", $rw1[1]);
				$rw1[2]=str_replace(".","", $rw1[2]);
				$rw1[3]=str_replace(".","", $rw1[3]);
				$rw1[4]=str_replace(".","", $rw1[4]);
				$rw1[5]=str_replace(".","", $rw1[5]);

				$sumatotal=$rw1[1]+$rw1[2]+$rw1[3]+$rw1[4]-$rw1[5]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="detallpagasalcobro"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("%PRESTAMO",1,0,0); 
	$FB->titulo_azul1("PRESTAMO",1,0,0); 
	$FB->titulo_azul1("FLETE",1,0,0); 
	$FB->titulo_azul1("%SEGURO",1,0,0); 
	$FB->titulo_azul1("- ABONO",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		$sql="SELECT cue_numeroguia,cue_porprestamo,cue_prestamo,cue_valorflete,cue_pordeclarado,cue_abono FROM `cuentaspromotor`  inner join ciudades on idciudades=cue_idciudaddes WHERE `cue_fecha` like '$fechaab%'  and cue_estado=10  and cue_tipoevento=3 and inner_sedes=$id_param  order by `cue_fecha` ";
	//	$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>
				<td>".$rw1[4]."</td>
				<td>".$rw1[5]."</td>
				";
				$rw1[1]=str_replace(".","", $rw1[1]);
				$rw1[2]=str_replace(".","", $rw1[2]);
				$rw1[3]=str_replace(".","", $rw1[3]);
				$rw1[4]=str_replace(".","", $rw1[4]);
				$rw1[5]=str_replace(".","", $rw1[5]);

				$sumatotal=$rw1[1]+$rw1[2]+$rw1[3]+$rw1[4]-$rw1[5]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="detallependiente"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("%PRESTAMO",1,0,0); 
	$FB->titulo_azul1("PRESTAMO",1,0,0); 
	$FB->titulo_azul1("FLETE",1,0,0); 
	$FB->titulo_azul1("%SEGURO",1,0,0); 
	$FB->titulo_azul1("- ABONO",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		$sql="SELECT cue_numeroguia,cue_porprestamo,cue_prestamo,cue_valorflete,cue_pordeclarado,cue_abono FROM `cuentaspromotor`  inner join ciudades on idciudades=cue_idciudaddes WHERE `cue_fecha` like '$fechaab%' and  cue_estado>=8  and cue_estado!=10  and  cue_estado<=14  and cue_tipoevento=3 and inner_sedes=$id_param  order by `cue_fecha` ";
	//	$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>
				<td>".$rw1[4]."</td>
				<td>".$rw1[5]."</td>
				";
				$rw1[1]=str_replace(".","", $rw1[1]);
				$rw1[2]=str_replace(".","", $rw1[2]);
				$rw1[3]=str_replace(".","", $rw1[3]);
				$rw1[4]=str_replace(".","", $rw1[4]);
				$rw1[5]=str_replace(".","", $rw1[5]);

				$sumatotal=$rw1[1]+$rw1[2]+$rw1[3]+$rw1[4]-$rw1[5]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="detallecompras"){


	$FB->titulo_azul1("ID",1,0,5); 
	$FB->titulo_azul1("Fecha",1,0,0); 
	$FB->titulo_azul1("Operador",1,0,0); 
	$FB->titulo_azul1("Tipo",1,0,0); 
	$FB->titulo_azul1("Valor ",1,0,0); 
	$FB->titulo_azul1("Descripcion ",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		$sql="SELECT `idasignaciondinero`,`asi_fecha`, usu_nombre, `asi_tipo`, `asi_valor`,  `asi_descripcion`, `asi_idautoriza`, `asi_idpromotor` FROM `asignaciondinero` inner join usuarios on asi_idpromotor=idusuarios WHERE idasignaciondinero>0  and `asi_fecha` like '$fechaab%'  and asi_idciudad=$id_param and asi_tipo='Asignar Dinero' order by `asi_fecha` ";
	//	$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>
				<td>".$rw1[4]."</td>
				<td>".$rw1[5]."</td>
				";

				$rw1[4]=str_replace(".","", $rw1[4]);
	

				$sumatotal=$rw1[4]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }else if($tabla=="detalletranspaso"){


	$FB->titulo_azul1("ID",1,0,5); 
	$FB->titulo_azul1("Fecha",1,0,0); 
	$FB->titulo_azul1("Operador",1,0,0); 
	$FB->titulo_azul1("Tipo",1,0,0); 
	$FB->titulo_azul1("Valor ",1,0,0); 
	$FB->titulo_azul1("Descripcion ",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		$sql="SELECT `idasignaciondinero`,`asi_fecha`, usu_nombre, `asi_tipo`, `asi_valor`,  `asi_descripcion`, `asi_idautoriza`, `asi_idpromotor` FROM `asignaciondinero` inner join usuarios on asi_idpromotor=idusuarios WHERE idasignaciondinero>0  and `asi_fecha` like '$fechaab%'  and asi_idciudad=$id_param and asi_tipo='Transpaso Dinero' order by `asi_fecha` ";
	//	$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>
				<td>".$rw1[4]."</td>
				<td>".$rw1[5]."</td>
				";

				$rw1[4]=str_replace(".","", $rw1[4]);
	

				$sumatotal=$rw1[4]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="detallegastos"){


	$FB->titulo_azul1("ID",1,0,5); 
	$FB->titulo_azul1("Fecha",1,0,0); 
	$FB->titulo_azul1("Operador",1,0,0); 
	$FB->titulo_azul1("Tipo",1,0,0); 
	$FB->titulo_azul1("Valor ",1,0,0); 
	$FB->titulo_azul1("Descripcion ",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		$sql="SELECT `idasignaciondinero`,`asi_fecha`, usu_nombre, `asi_tipo`, `asi_valor`,  `asi_descripcion`, `asi_idautoriza`, `asi_idpromotor` FROM `asignaciondinero` inner join usuarios on asi_idpromotor=idusuarios WHERE idasignaciondinero>0  and `asi_fecha` like '$fechaab%'  and usu_idsede=$id_param and asi_tipo='Gastos' order by `asi_fecha` ";
	//	$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>
				<td>".$rw1[4]."</td>
				<td>".$rw1[5]."</td>
				";

				$rw1[4]=str_replace(".","", $rw1[4]);
	

				$sumatotal=$rw1[4]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 
 else if($tabla=="detalleenviados"){

	$FB->titulo_azul1("Fecha",1,0,5); 
$FB->titulo_azul1("Usuario",1,0,0); 
$FB->titulo_azul1("Sede Origen / Destino",1,0,0); 
$FB->titulo_azul1("Transaccion",1,0,0); 
$FB->titulo_azul1("Descripcion",1,0,0); 
$FB->titulo_azul1("Valor ",1,0,0); 
$FB->titulo_azul1("Valor Aprobado",1,0,0); 
$fechaab=$_REQUEST["ide"];

 $sql="SELECT `idcajamenor`, `caj_fecharegistro`, `usu_nombre`,`sed_nombre`, `caj_tipotransacion`, `caj_descripcion`, `caj_valor`,`caj_usucom`, 
`caj_cantcom`, `caj_feccom`,caj_idciudaddes,caj_idciudadori  
FROM `cajamenor` inner join usuarios on caj_idusuario=idusuarios 
inner join sedes on idsedes=caj_idciudaddes and `caj_fecharegistro` like '$fechaab%'  and caj_tipotransacion in ('Consignacion','Envio de Dinero Efectivo') WHERE idcajamenor>0 and caj_idciudadori='$id_param'  ORDER BY caj_fecharegistro  ASC ";
	$DB1->Execute($sql); $va=0;
	$sumatotal=0;
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		
		$sql2="SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes='$rw1[11]'";
		$DB->Execute($sql2);
		$rw=mysqli_fetch_row($DB->Consulta_ID);

		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			echo "
			<td>".$rw1[1]."</td>
			<td>".$rw1[2]."</td>
			<td>".$rw[1]." / ".$rw1[3]."</td>
			<td>".$rw1[4]."</td>
			<td>".$rw1[5]."</td>
			<td>".$rw1[6]."</td>

			<td>".$rw1[8]."</td>

			";

		//	$rw1[6]=str_replace(".","", $rw1[6]);
			$rw1[8]=str_replace(".","", $rw1[8]);


			$sumatotal=$rw1[8]+$sumatotal;
		echo "</tr>";
	}
	$FB->titulo_azul1("TOTAL",1,0,5); 
	$sumatotal=number_format($sumatotal,0,".",".");	
	$FB->titulo_azul1("$ $sumatotal",1,0,0); 

 }
 else if($tabla=="detalleprestamosoper"){

	$FB->titulo_azul1("Fecha",1,0,5); 
	$FB->titulo_azul1("Operador",1,0,0); 
	$FB->titulo_azul1("Tipo",1,0,0); 
	$FB->titulo_azul1("Valor ",1,0,0); 
	$FB->titulo_azul1("Descripcion ",1,0,0); 
	$fechaab=$_REQUEST["ide"];

 $sql="SELECT `iddeudapromotor`, `deu_fecha`, usu_nombre,   `deu_tipo` , `deu_valor`, `due_descripcion`, `deu_idautoriza`, `deu_idpromotor` FROM `duedapromotor`  inner join usuarios on deu_idpromotor=idusuarios WHERE iddeudapromotor>0  and `deu_fecha`='$fechaab' and deu_idciudad='$id_param'  and deu_tipo='Prestamos' order by `deu_fecha`";
	$DB1->Execute($sql); $va=0;
	$sumatotal=0;
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			echo "
			<td>".$rw1[1]."</td>
			<td>".$rw1[2]."</td>
			<td>".$rw1[3]."</td>
			<td>".$rw1[4]."</td>
			<td>".$rw1[5]."</td>
			";

		//	$rw1[6]=str_replace(".","", $rw1[6]);
			$rw1[4]=str_replace(".","", $rw1[4]);


			$sumatotal=$rw1[4]+$sumatotal;
		echo "</tr>";
	}
	$FB->titulo_azul1("TOTAL",1,0,5); 
	$sumatotal=number_format($sumatotal,0,".",".");	
	$FB->titulo_azul1("$ $sumatotal",1,0,0); 


 }
 else if($tabla=="detallegastosper"){

	$FB->titulo_azul1("Fecha",1,0,5); 
	$FB->titulo_azul1("Operador",1,0,0); 
	$FB->titulo_azul1("Tipo",1,0,0); 
	$FB->titulo_azul1("Valor ",1,0,0); 
	$FB->titulo_azul1("Descripcion ",1,0,0); 
	$fechaab=$_REQUEST["ide"];

 $sql="SELECT `iddeudapromotor`, `deu_fecha`, usu_nombre,   `deu_tipo` , `deu_valor`, `due_descripcion`, `deu_idautoriza`, `deu_idpromotor` FROM `duedapromotor`  inner join usuarios on deu_idpromotor=idusuarios WHERE iddeudapromotor>0  and `deu_fecha`='$fechaab' and deu_idciudad='$id_param'  and deu_tipo='Pagos' order by `deu_fecha`";
	$DB1->Execute($sql); $va=0;
	$sumatotal=0;
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			echo "
			<td>".$rw1[1]."</td>
			<td>".$rw1[2]."</td>
			<td>".$rw1[3]."</td>
			<td>".$rw1[4]."</td>
			<td>".$rw1[5]."</td>
			";

		//	$rw1[6]=str_replace(".","", $rw1[6]);
			$rw1[4]=str_replace(".","", $rw1[4]);


			$sumatotal=$rw1[4]+$sumatotal;
		echo "</tr>";
	}
	$FB->titulo_azul1("TOTAL",1,0,5); 
	$sumatotal=number_format($sumatotal,0,".",".");	
	$FB->titulo_azul1("$ $sumatotal",1,0,0); 


 }
 else if($tabla=="detallegastossede"){

	$FB->titulo_azul1("Fecha",1,0,5); 
$FB->titulo_azul1("Usuario",1,0,0); 
$FB->titulo_azul1("Sede Origen / Destino",1,0,0); 
$FB->titulo_azul1("Transaccion",1,0,0); 
$FB->titulo_azul1("Descripcion",1,0,0); 
$FB->titulo_azul1("Valor ",1,0,0); 
$FB->titulo_azul1("Valor Aprobado",1,0,0); 
$fechaab=$_REQUEST["ide"];

 $sql="SELECT `idcajamenor`, `caj_fecharegistro`, `usu_nombre`,`sed_nombre`, `caj_tipotransacion`, `caj_descripcion`, `caj_valor`,`caj_usucom`, 
`caj_cantcom`, `caj_feccom`,caj_idciudaddes,caj_idciudadori  
FROM `cajamenor` inner join usuarios on caj_idusuario=idusuarios 
inner join sedes on idsedes=caj_idciudaddes and `caj_feccom` like '$fechaab%'  and caj_tipotransacion in ('Gastos') WHERE idcajamenor>0 and caj_idciudadori='$id_param'  ORDER BY caj_fecharegistro  ASC ";
	$DB1->Execute($sql); $va=0;
	$sumatotal=0;
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		
		$sql2="SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes='$rw1[11]'";
		$DB->Execute($sql2);
		$rw=mysqli_fetch_row($DB->Consulta_ID);

		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			echo "
			<td>".$rw1[1]."</td>
			<td>".$rw1[2]."</td>
			<td>".$rw[1]." / ".$rw1[3]."</td>
			<td>".$rw1[4]."</td>
			<td>".$rw1[5]."</td>
			<td>".$rw1[6]."</td>

			<td>".$rw1[8]."</td>

			";

		//	$rw1[6]=str_replace(".","", $rw1[6]);
			$rw1[8]=str_replace(".","", $rw1[8]);


			$sumatotal=$rw1[8]+$sumatotal;
		echo "</tr>";
	}
	$FB->titulo_azul1("TOTAL",1,0,5); 
	$sumatotal=number_format($sumatotal,0,".",".");	
	$FB->titulo_azul1("$ $sumatotal",1,0,0); 

 }	else if($tabla=="detalleremesas"){

	$FB->titulo_azul1("ID",1,0,5); 
	$FB->titulo_azul1("Fecha",1,0,0); 
	$FB->titulo_azul1("Sede Origen",1,0,0); 
	$FB->titulo_azul1("Sede Destino",1,0,0); 
	$FB->titulo_azul1("Pago en?",1,0,0); 
	$FB->titulo_azul1("Operario Remesa / Recoge ",1,0,0); 
	$FB->titulo_azul1("Valor Aprobado",1,0,0); 

	$fechaab=$_REQUEST["ide"];
	//	$sql="SELECT `idasignaciondinero`,`asi_fecha`, usu_nombre, `asi_tipo`, `asi_valor`,  `asi_descripcion`, `asi_idautoriza`, `asi_idpromotor` FROM `asignaciondinero` inner join usuarios on asi_idpromotor=idusuarios WHERE idasignaciondinero>0  and `asi_fecha` like '$fechaab%'  and usu_idsede=$id_param and asi_tipo='Gastos' order by `asi_fecha` ";
	 $sql="SELECT idgastos,`gas_fecharegistro`,gas_feccom ,`gas_fecrecogida`,`gas_idciudadori`,`sed_nombre`,`gas_bus`,`gas_pagar`,`gas_nomremesa`,gas_iduserrecoge,gas_cantcom FROM `gastos` inner join usuarios on gas_idusuario=idusuarios and gas_cantcom>0 inner join sedes on idsedes=gas_idciudaddes
		WHERE idgastos>0  and (gas_idciudadori='$id_param' and gas_pagar='Sede Origen' and gas_feccom like '$fechaab%')  or (gas_idciudaddes='$id_param' and gas_pagar='Sede Destino' and  gas_fechavalida like '$fechaab%' and gas_nomvalida!='' )  ORDER BY idgastos";

		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>";
			if($rw1[7]=='Sede Origen'){
				echo "<td>".$rw1[2]."</td>";
			}elseif($rw1[7]=='Sede Destino'){
				echo "<td>".$rw1[3]."</td>";
			}
			$sql2="SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes='$rw1[4]'";
			$DB->Execute($sql2);
			$rw=mysqli_fetch_row($DB->Consulta_ID);

			$sql5="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$rw1[9]' ";
			$DB->Execute($sql5);
			$nombreuser=$DB->recogedato(1);

				echo "	<td>".$rw[1]."</td>
				<td>".$rw1[5]."</td>
				<td>".$rw1[7]."</td>
				<td>".$rw1[8]." /
				".$nombreuser."</td>
				<td>".$rw1[10]."</td>
				";

				$rw1[10]=str_replace(".","", $rw1[10]);
	

				$sumatotal=$rw1[10]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="facturarcreditos"){
	$param4='ingresado';
	$fecha=$_REQUEST["ide"];

/* 	$slq="SELECT `pre_obsevaciones`,`pre_correctiva`,`pre_responsable` FROM `pre-operacional` where preidusuario='$iduser' and prefechaingreso like '$fecha%'";	
	$DB->Execute($slq); 
	$rw1=mysqli_fetch_row($DB->Consulta_ID); */

	include_once("detalle_crearfacturacreditos.php");


}  else if($tabla=="preoperacional"){
	$param4='ingresado';
	$fecha=$_REQUEST["ide"];

	$slq="SELECT `pre_obsevaciones`,`pre_correctiva`,`pre_responsable` FROM `pre-operacional` where preidusuario='$iduser' and prefechaingreso like '$fecha%'";	
	$DB->Execute($slq); 
	$rw1=mysqli_fetch_row($DB->Consulta_ID);
	include_once("preoperacional.php");


} 
else if($tabla=="tipocontrato"){
	$contrato=$_REQUEST["ide"];
	$FB->llena_texto("Tipo de Contrato:",22,82, $DB, $tipocontrato, "","$contrato", 2, 0);
	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);
}
else if($tabla=="zonatrabajo"){
	$fecha=$_REQUEST["ide"];
	$FB->llena_texto("Zona:",6,2,$DB,"(SELECT `idzonatrabajo`,`zon_nombre` FROM zonatrabajo where idzonatrabajo>0 )", "", "", 2, 1);

	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("param3", 1, 13, $DB, "", "", $fecha, 5, 0);

}else if($tabla=="horaoficina"){
	$hora=date("H:i:s");
	$FB->llena_texto("Retorno de Oficina:", 3, 102, $DB, "", "", "$hora", 2, 0);
	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);

}else if($tabla=="horaretorno"){
	$hora=date("H:i:s");
	$FB->llena_texto("Retorno de Almuerzo:", 3, 102, $DB, "", "", "$hora", 2, 0);
	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);

}else if($tabla=="horaalmuerzo"){
	$hora=date("H:i:s");
	$FB->llena_texto("Hora de Almuerzo:", 3, 102, $DB, "", "", "$hora", 2, 0);
	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);

}else if($tabla=="ingresousuario"){
	$fecha=$_REQUEST["ide"];
	$FB->llena_texto("Motivo Ingreso:", 4, 82, $DB, $motivoingreso, "", "", 2, 1);
	$FB->llena_texto("Descripcion:", 5, 1, $DB, "", "", "", 2, 0);
	$FB->llena_texto("Zona:",6,2,$DB,"(SELECT `idzonatrabajo`,`zon_nombre` FROM zonatrabajo where idzonatrabajo>0 )", "", "", 2, 0);

	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("param3", 1, 13, $DB, "", "", $fecha, 5, 0);
	

 }else if($tabla=="Abonos"){

	$idservicio=$_REQUEST["ide"];
	$FB->llena_texto("Valor:",1, 118, $DB, "", "", "", 2, 1);
	$FB->llena_texto("param5", 1, 13, $DB, "", "", "$idservicio", 5, 0);
	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);

 }else if($tabla=="TipoPago"){

	//$idservicio=$_REQUEST["ide"];
	$FB->llena_texto("Tipo de Pago:", 4, 82, $DB, $tipopagos, "", "", 2, 1);
	$FB->llena_texto("Fecha de Pago:",5, 10, $DB, "", "", "$fechaactual", 1, 0);
	//$FB->llena_texto("param5", 1, 13, $DB, "", "", "$idservicio", 5, 0);
	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);

 }
 else if($tabla=="devolucion"){

	$idservicio=$_REQUEST["ide"];
	$FB->llena_texto("Valor:",1, 118, $DB, "", "", "$id_param", 2, 1);
	$FB->llena_texto("param5", 1, 13, $DB, "", "", "$idservicio", 5, 0);
	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);

 }
 else if($tabla=="cambiarfactura"){

	$valor=$_REQUEST["ide"];
	$FB->llena_texto("# Factura:",1, 1, $DB, "", "", "$valor", 2, 1);
	$FB->llena_texto("param5", 1, 13, $DB, "", "", "$valor", 5, 0);
	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);

 }
 else if($tabla=="fecharadicado"){


	$FB->llena_texto("Fecha de Pago:",1, 10, $DB, "", "", "$fechaactual", 1, 0);
	$FB->llena_texto("Imagen", 3, 6, $DB, "", "", "",1,0);
	$FB->llena_texto("param2", 1, 13, $DB, "", "", $id_param, 5, 0);

 }
 elseif($tabla=="pruebaalcohol"){

	$fecha=$_REQUEST["ide"];
	$FB->llena_texto("Prueba de Alcohol:", 1, 82, $DB, $pruebaalcohol, "", "", 2, 1);
	$FB->llena_texto("Imagen", 2, 6, $DB, "", "", "",1,0);

	$opcion=explode(' ',$id_param);
	if($opcion[0]=='update'){
		$metodo='update';
	}else{
		$metodo='insert';
	}

	$FB->llena_texto("param3", 1, 13, $DB, "", "", $fecha, 5, 0);
	$FB->llena_texto("param4", 1, 13, $DB, "", "", $opcion[1], 5, 0);
	$FB->llena_texto("param5", 1, 13, $DB, "", "", $metodo, 5, 0);


 }elseif($tabla=="RegistrarPago"){
	$id_param2=$_REQUEST["ide"];
	$FB->llena_texto("Fecha de Pago:",1, 10, $DB, "", "", "$fechaactual", 1, 0);
	$FB->llena_texto("Valor Pagado:",2, 118, $DB, "", "", "", 1, 1);
	$FB->llena_texto("Documento:", 112, 6, $DB, "", "", "",4, 0);

	$FB->llena_texto("idhojadevida", 1, 13, $DB, "", "", $id_param2, 5, 0);
	$FB->llena_texto("idincapacidades", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("condecion", 1, 13, $DB, "", "", "RegistrarPago", 5, 0);

 }elseif($tabla=="reportealarmas"){
	  
	 $id_param2=$_REQUEST["ide"];
	$FB->llena_texto("Fecha de Vencimiento:",1, 10, $DB, "", "", "$id_param2", 1, 0);
	$FB->llena_texto("Documento:", 5, 6, $DB, "", "", "",4, 0);

	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);

 }
 else if($tabla=="detallerecogido"){

	$FB->titulo_azul1("ID",1,0,5); 
	$FB->titulo_azul1("VALOR",1,0,0); 
	$FB->titulo_azul1("OPERADOR",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		//$sql="SELECT ser_guiare ,`ser_valorabono` FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$sql="SELECT  idasignaciondinero,`asi_valor`,asi_idpromotor FROM `asignaciondinero` inner join usuarios on idusuarios=asi_idautoriza WHERE `asi_fecha` like '$fechaab%'  and asi_idciudad=$id_param and roles_idroles not in (2,3) and asi_tipo='entregado'";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				";
				$sql5="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$rw1[2]' ";
				$DB->Execute($sql5);
				$nombreuser=$DB->recogedato(1);
				echo "<td>".$nombreuser."</td>";
				$sumatotal=$rw1[1]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$sumatotal=number_format($sumatotal,0,".",".");	
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }else if($tabla=="Devolucionescuentas"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("IDSERVICIO",1,0,0); 
	$FB->titulo_azul1("VALOR",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		//$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		 $sql="SELECT ser_guiare ,abo_valor,abo_idservicio FROM `abonosguias` inner join servicios on  idservicios=abo_idservicio WHERE abo_iduser='$id_param' and abo_fecha like '$fechaab%' and `abo_estado`='devolucion'";

		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[1]."</td>
				";
				$sumatotal=$rw1[1]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
else if($tabla=="Abonoscuentas"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("VALOR",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		//$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$sql="SELECT ser_guiare ,abo_valor FROM `abonosguias` inner join servicios on  idservicios=abo_idservicio WHERE abo_iduser='$id_param' and abo_fecha like '$fechaab%' and `abo_estado`='abono'";

		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				";
				$sumatotal=$rw1[1]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="Abonossedes"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("VALOR",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		//$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$sql="SELECT ser_guiare ,abo_valor FROM `abonosguias` inner join servicios on  idservicios=abo_idservicio WHERE abo_idsede='$id_param' and abo_fecha like '$fechaab%' and `abo_estado`='abono'";

		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				";
				$sumatotal=$rw1[1]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="Devolucionsedes"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("VALOR",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		//$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$sql="SELECT ser_guiare ,abo_valor FROM `abonosguias` inner join servicios on  idservicios=abo_idservicio WHERE abo_idsede='$id_param' and abo_fecha like '$fechaab%' and `abo_estado`='devolucion'";

		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				";
				$sumatotal=$rw1[1]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 /* else if($tabla=="Abonoscuentas"){

	$FB->titulo_azul1("GUIA",1,0,5); 
	$FB->titulo_azul1("VALOR",1,0,0); 
	//$idusuarioab=$id_param['idusuario'];
	//$fechaab=$id_param['fecha'];
	$fechaab=$_REQUEST["ide"];
		$sql="SELECT ser_guiare ,`ser_valorabono`FROM `servicios` INNER JOIN guias ON idservicios=gui_idservicio where gui_idusuario='$id_param' and gui_fechacreacion like '$fechaab%' and ser_estado<100 and ser_valorabono>0";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[0]."</td>
				<td>".$rw1[1]."</td>
				";
				$sumatotal=$rw1[1]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 } */
 else if($tabla=="dineroentregado"){

	$FB->titulo_azul1("Valor",1,0,5); 
	$FB->titulo_azul1("Eliminar",1,0,0); 

	$fechaab=$_REQUEST["ide"];
		 $sql="SELECT idasignaciondinero ,`asi_valor` FROM `asignaciondinero`  WHERE  `asi_fecha`='$fechaab' and `asi_idpromotor`='$id_param' and asi_tipo='entregado'";
		$DB1->Execute($sql); $va=0;
		$sumatotal=0;
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "
				<td>".$rw1[1]."</td>
				";
			$DB->edites($id_p, "cuentasentrega", 2,0);
				$sumatotal=$rw1[1]+$sumatotal;
			echo "</tr>";
		}
		$FB->titulo_azul1("TOTAL",1,0,5); 
		$FB->titulo_azul1("$ $sumatotal",1,0,0); 
 }
 else if($tabla=="Buzonmovil"){ 

	$FB->llena_texto("Titulo:", 1,1, $DB, "", "", "", 1, 0);
	$FB->llena_texto("Mensaje:", 2,9, $DB, "", "", "", 1, 0);
	$sql="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE  (usu_estado=1 or usu_filtro=1) and usu_idsede='$id_sedes'";
  //  $sql="SELECT `idusuarios`,`usu_nombre`,zon_nombre FROM  seguimiento_user inner join zonatrabajo on seg_idzona=idzonatrabajo  inner join  `usuarios` on idusuarios=seg_idusuario inner join ciudades on inner_sedes=usu_idsede WHERE  seg_fechaalcohol='$fechaactual' and (usu_estado=1 or usu_filtro=1)  and `seg_motivo`='Ingreso'  and usu_idsede='$id_sedes'";
	$FB->llena_texto("Para Operario:", 3, 2, $DB,"($sql)", "", "", 2, 1);

 }else if($tabla=="Asignar Paquete"){ 

$rw[4]=0;
$idsede=$_REQUEST["idciudad"];

$FB->llena_texto("Tipo de Operador:",1,82, $DB, $vehiculo, "cambio_ajax2(this.value,27, \"llega_sub1\", \"param2\", 1,  $idsede)",@$rw[1], 17, 1);
$FB->llena_texto("Operador:", 2, 444, $DB, "llega_sub1", "", "",4,1);

$sql="SELECT ser_estado,ser_motivo FROM servicios where idservicios=$id_param";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);
if($rw[0]==5){
$FB->llena_texto("MOTIVO DE NO RECOGIDA:",3,9, $DB, "", "",@$rw[1] ,1, 0);	
	
}

$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);

$FB->llena_texto("condicion", 1, 13, $DB, "", "", "1", 5, 0);

}
else if($tabla=="Entregar valor"){ 

$idciudad=$_REQUEST["idciudad"];
$valorapagar=$_REQUEST["valordos"];
$conde2="and usu_idsede=$idciudad";
$FB->llena_texto("Fecha de Busqueda:", 1, 10, $DB, "", "", "$fechaactual", 4, 0);
$FB->llena_texto("Operario:",2,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE  (usu_estado=1 or usu_filtro=1) $conde2", "", $id_param, 1, 1);
$FB->llena_texto("Valor:",3, 118, $DB, "", "", "", 2, 1);
$FB->llena_texto("param4", 4, 13, $DB, "", "", $idciudad, 5, 0);

$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", $id_usuario, 5, 0);
$FB->llena_texto("valorapagar", 1, 13, $DB, "", "", $valorapagar, 5, 0);
$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);

}
else if($tabla=="Confirmar"){
	$idciudad=$_REQUEST["idciudad"];
	$FB->llena_texto("Dinero que Llego:",6, 118, $DB, "", "", "", 2, 1);
	if($idciudad=='Gastos'){
  	$FB->llena_texto("Gastos de:",9,2, $DB, "SELECT * FROM `clasificacion_gastos` ", "cambio_ajax2(this.value, 21, \"llega_sub1\", \"param10\", 1,$id_param)","", 17, 1);
	  $FB->llena_texto("Tipo:", 10, 4, $DB, "llega_sub1", "", "",4,1);
 }
  	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
  	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", "confirmar", 5, 0);
  	$FB->llena_texto("tipo_gastos", 1, 13, $DB, "", "", "$idciudad", 5, 0);

}
else if($tabla=="Confirmargastos"){
	$idciudad=$_REQUEST["idciudad"];
	$FB->llena_texto("Valor:",8, 118, $DB, "", "", "", 2, 1);
	if($idciudad=='Gastos'){
		$FB->llena_texto("Gastos de:",9,2, $DB, "SELECT * FROM `clasificacion_gastos` ", "cambio_ajax2(this.value, 21, \"llega_sub1\", \"param10\", 1,$id_param)","", 17, 1);
		$FB->llena_texto("Tipo:", 10, 4, $DB, "llega_sub1", "", "",4,1);
   }
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", "Confirmargastos", 5, 0);
	$FB->llena_texto("tipo_gastos", 1, 13, $DB, "", "", "$idciudad", 5, 0);

}
else if($tabla=="Aprobar"){
	
	$FB->llena_texto("Fecha de aprobacion:", 7, 10, $DB, "", "", "$fechaactual", 4, 0);
	$FB->llena_texto("Dinero Aprobado para el gasto:",6, 118, $DB, "", "", "", 2, 1);
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", "aprobar", 5, 0);

}
else if($tabla=="Verificar Remesa"){
	
	//$FB->llena_texto("Dinero Aprobado para el gasto:",6, 118, $DB, "", "", "", 2, 1);
	$FB->llena_texto("Descripcion:",2,9, $DB, "", "","" ,1, 1);		
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", "Verificar Remesa", 5, 0);

}
else if($tabla=="Cierre del dia"){
	
	 $valorjson=$_REQUEST["valordos"];
	 $valor2json=$_REQUEST["varcal"];
	 $fecharecierre=$_REQUEST["fecharecierre"];
	 $idciudad=$_REQUEST["idciudad"];
	 $valorjson=json_encode($valorjson, JSON_FORCE_OBJECT);
	// $valor2json=json_encode($valor2json, JSON_FORCE_OBJECT);
	 if($nivel_acceso==1){ 
		echo "<div class='alert alert-danger'>
		<strong> CIERRE DIARIO </strong> ¿DESEA HACER EL CIERRE DE ESTE DIA  POR ESTE VALOR?
	  ";
	  echo " <input name='dinero' id='dinero'   type='text' value='$id_param' >
		</div>";

	 }else{
		echo "<div class='alert alert-danger'>
		<strong> CIERRE DIARIO </strong> ¿DESEA HACER EL CIERRE DE ESTE DIA  POR ESTE VALOR $id_param?
	  </div>";
	  $FB->llena_texto("dinero", 1, 13, $DB, "", "", $id_param, 5, 0);

	 }
	//print_r($valor2json);

	$FB->llena_texto("fecharecierre", 1, 13, $DB, "", "", $fecharecierre, 5, 0);
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $idciudad, 5, 0);
	$FB->llena_texto("valoresjs", 1, 13, $DB, "", "", $valorjson, 5, 0);
	$FB->llena_texto("valores2js", 1, 13, $DB, "", "", $valor2json, 5, 0);

} 
else if($tabla=="Recoger Paquete"){ 

$FB->llena_texto("¿Paquete Recogido?:",1,82, $DB, $recogido, "cambio_ajax2(this.value, 11, \"llega_sub1\", \"param2\", 1,$id_param)",@$rw[1], 17, 1);
$FB->llena_texto("", 2, 4, $DB, "llega_sub1", "", "",4,0);
$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);

$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("id_param1", 1, 13, $DB, "", "", "", 5, 0);
$FB->llena_texto("encomiendas", 1, 13, $DB, "", "", "0", 5, 0);
}
else if($tabla=="Recoger oficina"){ 

	$FB->llena_texto("¿Paquete Recogido?:",1,82, $DB, $recogido, "cambio_ajax2(this.value, 11, \"llega_sub1\", \"param2\", 1,$id_param)",@$rw[1], 17, 1);
	$FB->llena_texto("", 2, 4, $DB, "llega_sub1", "", "",4,0);
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
	
	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("id_param1", 1, 13, $DB, "", "", "operadoroficina", 5, 0);
	$FB->llena_texto("encomiendas", 1, 13, $DB, "", "", "0", 5, 0);
	}
else if($tabla=="Entregar Guias"){ 

$FB->llena_texto("¿Paquete Entregado?:",1,82, $DB, $entregado, "cambio_ajax2(this.value, 12, \"llega_sub1\", \"param2\", 1,$id_param)",@$rw[1], 17, 1);
$FB->llena_texto("", 2, 4, $DB, "llega_sub1", "", "",4,0);
$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);

$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
}
else if($tabla=="Factura"){

 $sql="SELECT `idclientes`,`ser_consecutivo`, `ser_resolucion`,`cli_nombre`,  `ser_destinatario`, `ser_telefonocontacto`,`ciu_nombre`,
 `ser_direccioncontacto`, `ser_paquetedescripcion`, `ser_piezas`,`ser_clasificacion`, `ser_valorprestamo`, 
 `ser_valorabono`, `ser_valorseguro`, `ser_tipopaquete`,`cli_iddocumento`, `cli_telefono`, `cli_email`, 
 `cli_idciudad`, `cli_direccion`,  `ser_fechaentrega`,`ser_prioridad`,  `idservicios` FROM `clientes` inner join clientesdir on cli_idclientes=idclientes  inner join rel_sercli on idclientes=ser_idclientes 
 inner join servicios on  ser_idservicio=idservicios  inner join ciudades on ser_ciudadentrega=idciudades where idservicios=$id_param ";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	

$planillas=explode("/",$rw[1]);
include("imprimir.php");	
$rw[9]=$tipopago[$rw[9]];

	}
else if($tabla=="Editar datos"){ 

 $sql="SELECT `idclientes`, `cli_iddocumento`, `cli_telefono`, `cli_email`, `cli_idciudad`, `cli_direccion`, `cli_nombre`, `cli_clasificacion`,`ser_telefonocontacto`, `ser_destinatario`, `ser_direccioncontacto`,`ser_ciudadentrega`, `ser_tipopaquete`, `ser_paquetedescripcion`, `ser_fechaentrega`,`ser_prioridad`,  `ser_valorprestamo`, `ser_valorabono`, `ser_valorseguro`, `idservicios`,cli_retorno,idclientesdir,ser_idusuarioguia FROM 
			serviciosdia  where idservicios=$id_param";
			$DB1->Execute($sql);
			$rw=mysqli_fetch_array($DB1->Consulta_ID);
			$blo=0;
			$blo2="";
						
			@$param4=$rw[4];
			if($nivel_acceso!=1){  $cond6=" WHERE inner_sedes='$id_sedes' and inner_estados=1"; }  else { $cond6=" WHERE inner_estados=1"; }
			if($rw[22]!=0){ $blo=2;  $blo2="disabled";   }
			
			$FB->titulo_azul1("Remitente",10,0, 5);  

		//$FB->llena_texto("CC / Nit:",1, 117, $DB, "", "", $rw[1], 1, 0);
		$FB->llena_texto("Tel&eacute;fonos :",2,120, $DB, "", "", $rw[2], 1, $blo);
		echo  "<tr bgcolor='#FFFFFF' ><td>Remitente:</td><td colspan=1><div id='clientesdir'>";
		echo " <input name='param6' id='param6' class='trans'  type='text' value='$rw[6]' onkeypress='return noenter();' $blo2>
		</div></td>";

		$FB->llena_texto("Ciudad:",4,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM `ciudades` $cond6)", "", "$param4", 1, $blo);


		@$direcc=explode("&",$rw[5]);
		@$param5=$direcc[0];
		@$param51=$direcc[1];
		@$param19=$direcc[2];
		@$param20=$direcc[3];
		@$param23=$direcc[4];
		echo "<tr bgcolor='#FFFFFF' ><td>Lugar de Recogida:</td>
	<td align='left' ><select class='trans'  name='param5' id='param5'  $blo2 >";
	echo "<option  value='0'>Seleccione...</option>";
    $sql="SELECT `iddireccion`, `dir_nombre` FROM `direccion` ";
    $LT->llenaselect($sql,1,1, $param5, $DB);
    echo "</select>
	<input name='param51' id='param51' class='trans'  type='text' value='$param51' onkeypress='return noenter();' $blo2>
	</td>";

	echo "</tr><tr bgcolor='#F3F3F3' ><td></td>
	<td align='left' ><select class='trans'  name='param19' id='param19' $blo2 >";
	echo "<option  value='0'>Seleccione...</option>";
    $sql="SELECT `idlugar`, `lug_nombre` FROM `lugar`  ";
    $LT->llenaselect($sql,1,1, $param19, $DB);
    echo "</select>
	<input name='param20' id='param20' class='trans'  type='text' value='$param20' onkeypress='return noenter();' $blo2>
	</td>
	
	</tr>";

		$FB->llena_texto("Barrio:", 23, 1, $DB, "", "", $param23, 1, $blo);	
		$FB->llena_texto("Email:", 3, 111, $DB, "", "", $rw[3], 17	, $blo);	
		$FB->titulo_azul1("Destinatario",9,0,5); 

		$FB->llena_texto("Tel&eacute;fono:",8, 120, $DB, "", "", $rw[8], 17, 1);
		$FB->llena_texto("Nombre:",9, 1, $DB, "", "", $rw[9], 17, 1);
		$FB->llena_texto("Ciudad:",11,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM `ciudades`  where inner_estados=1)", "", "$rw[11]", 1, 1);

		@$direcc2=explode("&",$rw[10]);
		@$param10=$direcc2[0];
		@$param101=$direcc2[1];
		@$param21=$direcc2[2];
		@$param22=$direcc2[3];
		@$param24=$direcc2[4];

	echo "</tr><tr bgcolor='#F3F3F3' ><td>Direcci&oacute;n del Contacto:</td>
	<td align='left' ><select class='trans'  name='param10' id='param10' >";
	echo "<option  value='0'>Seleccione...</option>";
    $sql="SELECT `iddireccion`, `dir_nombre` FROM `direccion` ";
    $LT->llenaselect($sql,1,1, $param10, $DB);

    echo "</select>
	<input name='param101' id='param101' class='trans'  type='text' value='$param101' onkeypress='return noenter();'>
	</td></tr>";

	echo "<tr bgcolor='#FFFFFF' ><td>Lugar de Entrega:</td>
	<td align='left' ><select class='trans'  name='param21' id='param21' >";
	echo "<option  value='0'>Seleccione...</option>";
    $sql="SELECT `idlugar`, `lug_nombre` FROM `lugar`  ";
    $LT->llenaselect($sql,1,1, $param21, $DB);
    echo "</select>
	<input name='param22' id='param22' class='trans'  type='text' value='$param22' onkeypress='return noenter();'>
	</td>
	";
	$FB->llena_texto("Barrio:", 24, 1, $DB, "", "", $param24, 1, 0);

	$FB->llena_texto("id_param0", 1, 13, $DB, "", "", "$rw[21]", 5, 0); //idclientes
	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", "$rw[19]", 5, 0);  // idservicio
	
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
	$FB->llena_texto("param1", 1, 13, $DB, "", "", "EDITAR DATOS", 5, 0);
	$FB->llena_texto("id_param1", 1, 13, $DB, "", "", "recogidas", 5, 0);
	$FB->llena_texto("encomiendas", 1, 13, $DB, "", "", "$blo", 5, 0);
	$FB->llena_texto("dir", 1, 13, $DB, "", "", $dir, 5, 0);

	}
else if($tabla=="Editar Datos Guia"){ 	

 $sql="SELECT `idclientes`, `cli_iddocumento`, `cli_telefono`, `cli_email`, `cli_idciudad`, `cli_direccion`, `cli_nombre`, `ser_iddocumento`,`ser_telefonocontacto`, `ser_destinatario`, `ser_direccioncontacto`,`ser_ciudadentrega`,
 `ser_tipopaquete`, `ser_paquetedescripcion`, `ser_fechaentrega`,`ser_prioridad`,  `ser_valorprestamo`, `ser_valorabono`, `ser_valorseguro`, `idservicios`,cli_retorno,idclientesdir,ser_descllamada,date(ser_fecharegistro) 
 ,`ser_peso`,`ser_guiare`,ser_volumen,`ser_piezas`,ser_descripcion,ser_verificado,ser_tipopaq,ser_clasificacion,`ser_valor`, `ser_estado`,`ser_fechafinal`, `ser_fechaentrega`, `ser_prioridad`,  `ser_recogida`, `ser_motivo`,
 `ser_fechaconfirmacion`, `ser_fechaasignacion`, `ser_estado`,ser_devolverreci,ser_idverificadopeso,ser_descentrega
 FROM  serviciosdia  where idservicios=$id_param ";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	

   include("editardatos.php");

}
else if($tabla=="Cuentas"){ 	
	
	include("cuentas.php");
 
}
else if($tabla=="Cotizar"){ 	
	
	  include("cotizar.php");
   
 } else if($tabla=="Temperatura"){ 	
	
/* echo	'<div class="form-group">
	<div class="btn btn-success btn-file">
		<i class="fa fa-paperclip"></i>  Temperatura
		<input type="file" name="paramc4" />
	</div>
	<p class="help-block">Tama&ntilde;o: 215px x 215px</p>
</div>'; */
$slq="SELECT idpreoperacinal FROM `pre-operacional` where preidusuario='$id_usuario' and prefechaingreso like '$fechaactual%'";	
$DB->Execute($slq); 
$rw2=mysqli_fetch_row($DB->Consulta_ID);

$FB->llena_texto("Imagen Temperatura:",2, 6, $DB, "", "", "",2, 0); 
$FB->llena_texto("id_param", 1, 13, $DB, "", "", $rw2[0], 5, 0);

 }
else if($tabla=="recorridooperador"){ 
	
	 $param33=$id_param;
	 $fechaactual=$_REQUEST["ide"];
	include("detalle_recorrido.php");

}else if($tabla=="recorridooperadorruta"){ 
	
	$param33=$id_param;
	$fechaactual=$_REQUEST["ide"];
   include("detalle_recorrido_ruta.php");

}
else if($tabla=="Recogidas"){ 

  $sql="SELECT `idclientes`, `cli_iddocumento`, `cli_nombre`,  `cli_telefono`, `cli_email`, `ciu_nombre`, `cli_direccion`, `cli_clasificacion`, `cli_idciudad`,  `cli_tipo`,
`idservicios`, `ser_destinatario`, `ser_telefonocontacto`,`ser_ciudadentrega`,`ser_direccioncontacto`, `ser_tipopaquete`,`ser_piezas`, `ser_paquetedescripcion`, 
  `ser_horaentrega`,`ser_clasificacion`,`ser_valorprestamo`, `ser_valorseguro`,`ser_valorabono`, `ser_consecutivo`,`ser_idresponsable`, `ser_iduserverific`,
  `ser_idasignacion`,`ser_peso`,`ser_guiare`,`ser_fechafinal`,`ser_valor`,  `ser_fechaentrega`, `ser_prioridad`,  `ser_recogida`, `ser_motivo`,  `ser_fecharegistro`,
  `ser_fechaconfirmacion`, `ser_fechaasignacion`, `ser_estado`,ser_devolverreci,ser_volumen,ser_idverificadopeso,ser_descentrega FROM serviciosdia  where idservicios=$id_param ";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	

if($rw[0]=="" or $rw[0]==0){

  $sql="SELECT `idclientes`, `cli_iddocumento`, `cli_nombre`,  `cli_telefono`, `cli_email`, `ciu_nombre`, `cli_direccion`, `cli_clasificacion`, `cli_idciudad`,  `cli_tipo`,
`idservicios`, `ser_destinatario`, `ser_telefonocontacto`,`ser_ciudadentrega`,`ser_direccioncontacto`, `ser_tipopaquete`,`ser_piezas`, `ser_paquetedescripcion`, 
  `ser_horaentrega`,`ser_clasificacion`,`ser_valorprestamo`, `ser_valorseguro`,`ser_valorabono`, `ser_consecutivo`,`ser_idresponsable`, `ser_iduserverific`,
  `ser_idasignacion`,`ser_peso`,`ser_guiare`,`ser_fechafinal`,`ser_valor`,  `ser_fechaentrega`, `ser_prioridad`,  `ser_recogida`, `ser_motivo`,  `ser_fecharegistro`,
  `ser_fechaconfirmacion`, `ser_fechaasignacion`, `ser_estado`,ser_devolverreci,ser_volumen,ser_idverificadopeso,ser_descentrega FROM servicios2 inner join rel_sercli  on idservicios=ser_idservicio  inner join clientesservicios on idclientesdir=ser_idclientes inner join clientes on idclientes=cli_idclientes  inner join ciudades on idciudades=ser_ciudadentrega  where idservicios=$id_param ";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	

}

if($rw[38]==6 and $rw[41]==1){
	$rw[38]=14;
}
//echo $rw[38];
$estadoguia=$estado_guia["$rw[38]"];

$FB->titulo_azul1("Estado de la GUIA: $estadoguia  ",10,0, 5); 

$FB->titulo_azul1("Datos Cliente",10,0, 5);  
$rw[7]=$clasificacion[$rw[7]];
$rw[19]=$tipopago[$rw[19]];
$rw[6]=str_replace("&"," ", $rw[6]);
$rw[14]=str_replace("&"," ", $rw[14]);

echo "<tr bgcolor='#FFFFFF' >
          <td>CC / Nit:</td><td >$rw[1]</td>
		  <td>Nombre Del Cliente:</td><td >$rw[2]</td>
          <td>Tel&eacute;fonos:</td><td >$rw[3]</td>
          
     </tr>";
	 		$sel="SELECT ciu_nombre FROM ciudades where idciudades=$rw[8]";
		$DB->Execute($sel);		
		$idciudad=$DB->recogedato(0);	
	 
echo "<tr bgcolor='#F3F3F3' >
		  <td>Email:</td><td >$rw[4]</td>
          <td>Ciudad :</td><td >$idciudad</td>
          <td>Direccion:</td><td >$rw[6]</td>     
     </tr>";
echo "<tr bgcolor='#FFFFFF' >
          <td colspan='2'>Clasificaci&oacute;n:</td><td colspan='4'>$rw[7]</td>
     </tr>";

$FB->titulo_azul1("Datos Destinatario",10,0, 5);  


$rw[15]=utf8_encode($rw[15]);
echo "<tr bgcolor='#FFFFFF' >
          <td>Nombre Destinatario:</td><td >$rw[11]</td>
		  <td>Tel&eacute;fono:</td><td >$rw[12]</td>
          <td>Ciudad Destino:</td><td >$rw[5]</td>
          
     </tr>";
echo "<tr bgcolor='#F3F3F3' >
		  <td>Direccion del Contacto:</td><td >$rw[14]</td>
            <td>Hora Recogida:</td><td >$rw[18]</td>
          <td></td><td ></td>  
     </tr>";
	 
	 $FB->titulo_azul1("Servicio",10,0, 5); 
	 if($rw[39]==1){ $rw[39]='SI'; }else{ $rw[39]='NO'; }
	 
 echo "<tr bgcolor='#FFFFFF' >
	  <td># Guia/Pre Guia:</td><td >$rw[23] / $rw[28]</td>
	  
	  <td>Devolver Recibido:</td><td> $rw[39]</td>
	  <td>Tipo de paquete:</td><td >$rw[15]</td>
	       
 </tr>";
	 
echo "<tr bgcolor='#F3F3F3' >
		<td>Piezas:</td><td >$rw[16]</td> 
        <td>Dice contener:</td><td >$rw[17]</td>
         <td>Tipo Pago:</td><td >$rw[19]</td>
     </tr>";

	  

$planillas=explode("/",$rw[23]);	


	
		$sql2="SELECT idusuarios,usu_nombre FROM usuarios where idusuarios in ($rw[24],$rw[25],$rw[26])";
		$DB->Execute($sql2);
		while($rw2=mysqli_fetch_row($DB->Consulta_ID))
		{
			$dato[$rw2[0]]=$rw2[1];
		}

//	echo $rw[23];
$rw[20]=str_replace(".","", $rw[20]);
	echo "<tr bgcolor='#F3F3F3' >
          <td>Peso:</td><td >$rw[27]</td>
          <td>Volumen:</td><td > $rw[40]</td>
		  <td>Valor de Prestamo:</td><td>$ $rw[20]</td>
     </tr>";
		
	 	$sql="SELECT `pre_porcentaje` FROM `prestamo` WHERE `pre_inicio`<'$rw[20]' and `pre_final`>='$rw[20]'";
		$DB->Execute($sql);
		$porprestamo=$DB->recogedato(0);
		$dosporcentaje=explode(" ",$porprestamo); 
		if(@$dosporcentaje[1]=='%'){
			
			$porprestamo=($rw[20]*@$dosporcentaje[0])/100;
		}
		$rw[21]=str_replace(".","", $rw[21]);
		$seguro=(intval($rw[21])*1)/100;
		$rw[21]=number_format($rw[21],0,".",".");
	 echo "<tr bgcolor='#FFFFFF' >
		  
		  <td>Cobro x Prestamo:</td><td>$ $porprestamo</td>
		<td>Abono:</td><td>$ $rw[22]</td>
		<td>Valor Asegurado:</td><td >$ $rw[21]</td>
      </tr>";
	  $rw[9]=number_format($rw[9],0,".",".");
		
		$seguro=number_format($seguro,0,".",".");
		$rw[30]=number_format($rw[30],0,".",".");
		
		$sql="SELECT sum(abo_valor) FROM `abonosguias` WHERE `abo_idservicio`='$id_param' and `abo_estado`='devolucion'";
		$DB->Execute($sql);
		$devoluciong=$DB->recogedato(0);

	echo "<tr bgcolor='#F3F3F3' >
	 
		   <td>Valor Seguro:</td><td>$ $seguro</td>
		  <td>Vr Flete:</td><td>$ $rw[30]</td>
		  <td>Devoluciones:</td><td>$ $devoluciong</td>
     </tr>";
	 
$FB->titulo_azul1("Seguimito Guia",10,0, 5); 


  $sql="SELECT `idguias`,`gui_usucreado`, `gui_fechacreacion`, `gui_usuvalida`, `gui_fechavalidacion`, `gui_usurecogida`, `gui_fecharecogida`, 
`gui_usupeso`, `gui_fechapeso`, `gui_usuvalpeso`, `gui_fechavalpeso`, `gui_ensede`, `gui_fechaensede`, `gui_validasede`, `gui_fechavalidasede`,
 `gui_encomienda`, `gui_fechaencomienda`,`gui_userecomienda`, `gui_fechaentrega`,`gui_recogio`, `gui_fecharecogio`, `gui_useredita`, `gui_fechaedita`,`gui_userdevolucion`,`gui_fechadevolucion` 
 
 FROM `guias` WHERE  `gui_idservicio`=$id_param";
$DB->Execute($sql);
$rw2=mysqli_fetch_array($DB->Consulta_ID);	
	 
echo "<tr bgcolor='#F3F3F3' >
		 <td>Creada Por:</td><td >".$rw2[1]."</td>
		 <td>Fecha:</td><td >".$rw2[2]."</td>
		 <td></td><td ></td>  
      </tr>";	
	  
	  echo "<tr bgcolor='#FFFFFF' >
		 <td>Validada Por:</td><td >".$rw2[3]."</td>
		 <td>Fecha:</td><td >".$rw2[4]."</td>
		 <td></td><td ></td>  
      </tr>";
	  
echo "<tr bgcolor='#F3F3F3' >
		 <td>Asigno Recogida:</td><td >".$rw2[5]."</td>
		 <td>Fecha:</td><td >".$rw2[6]."</td>
		 <td></td><td ></td>  
      </tr>";	
	  
	  echo "<tr bgcolor='#FFFFFF' >
		 <td>Pesada Por:</td><td >".$rw2[7]."</td>
		 <td>Fecha:</td><td >".$rw2[8]."</td>
		 <td></td><td ></td>  
      </tr>";	

echo "<tr bgcolor='#F3F3F3' >
		 <td>Peso validado Por:</td><td >".$rw2[9]."</td>
		 <td>Fecha:</td><td >".$rw2[10]."</td>
		 <td></td><td ></td>  
      </tr>";	
	  
	  echo "<tr bgcolor='#FFFFFF' >
		 <td>Asigno otra sede:</td><td >".$rw2[11]."</td>
		 <td>Fecha:</td><td >".$rw2[12]."</td>
		 <td></td><td ></td>  
      </tr>";		  

echo "<tr bgcolor='#F3F3F3' >
		 <td>Valido llegada sede:</td><td >".$rw2[13]."</td>
		 <td>Fecha:</td><td >".$rw2[14]."</td>
		 <td></td><td ></td>  
      </tr>";	
	  
	  echo "<tr bgcolor='#FFFFFF' >
		 <td>Asigno Operario:</td><td >".$rw2[15]."</td>
		 <td>Fecha:</td><td >".$rw2[16]."</td>
		 <td></td><td ></td>  
      </tr>";
	  

	  
	  echo "<tr bgcolor='#F3F3F3' >
		 <td>Edito Información:</td><td >".$rw2[21]."</td>
		 <td>Fecha:</td><td >".$rw2[22]."</td>
		 <td></td><td ></td>  
      </tr>";		  

echo "<tr bgcolor='#FFFFFF' >
		 <td>Recogio Paquete:</td><td >".$rw2[19]."</td>
		 <td>Fecha:</td><td >".$rw2[20]."</td>
		 <td></td><td ></td>  
      </tr>";	
		
		if($rw[38]==11){
			echo "<tr bgcolor='#F3F3F3' >
			<td>Guia Devuelta:</td><td >".$rw2[17]."</td>
			<td>Fecha:</td><td >".$rw2[18]."</td>
			<td></td><td ></td>  
			 </tr>";

		}	else {
	  echo "<tr bgcolor='#F3F3F3' >
		 <td>Entrego Encomienda:</td><td >".$rw2[17]."</td>
		 <td>Fecha:</td><td >".$rw2[18]."</td>
		 <td></td><td ></td>  
			</tr>";
		
		}	
	  
	  echo "<tr bgcolor='#FFFFFF' >
		 <td>Recibio Devolucion:</td><td >".$rw2[23]."</td>
		 <td>Fecha:</td><td >".$rw2[24]."</td>
		 <td></td><td ></td>  
      </tr>";	
	  
	 $FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);

}
else if($tabla=="Peso"){ 
$sql="SELECT `ser_peso`,`ser_valor`,`ser_pendientecobrar`,`ser_clasificacion`,ser_volumen,ser_guiare,ser_descripcion,ser_ciudadentrega FROM `servicios` WHERE `idservicios`=$id_param";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	
$clasificacion=0;
if($rw[3]==1 and $rw[2]==0){

$clasificacion=1;
}else if($rw[3]==2){
		$clasificacion=2;
}
if($nivel_acceso!=1){ 
	if($rw[0]!=''){ $valor="min=$rw[0]";  } else { $valor=""; }
	if($rw[4]!=''){ $valor2="min=$rw[4]";  } else { $valor2=""; }

}else {
	$valor="";
	$valor2="";
}	

$FB->llena_texto("PESO KG:",1,123, $DB, "", "$valor",$rw[0] ,1,1);	
$FB->llena_texto("VOLUMEN:",4,125, $DB, "", "$valor2",$rw[4],1, 0);	
$FB->llena_texto("# GUIA:",6,1, $DB, "", "","$rw[5]" ,1, 0);	
$FB->llena_texto("FOTO GUIA", 10, 6, $DB, "", "", "",1,0);	
$FB->llena_texto("ESTADO PAQUETE:",2,9, $DB, "", "","$rw[6]" ,1, 2);		
	

$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("clasificacion", 1, 13, $DB, "", "", $clasificacion, 5, 0);
$FB->llena_texto("caso", 1, 13, $DB, "", "", 1, 5, 0);
$FB->llena_texto("param5", 1, 13, $DB, "", "", $id_param2, 5, 0);
$FB->llena_texto("param16", 1, 13, $DB, "", "", $rw[7], 5, 0);
}else if($tabla=="Fotoguia"){ 
	$dato=explode("_",$_REQUEST["ide"]);
	$guia=$dato[0];
	$tipo=$dato[1];

	$FB->llena_texto("FOTO GUIA", 10, 60, $DB, "", "", "",1,0);	
	$FB->llena_texto("param6", 1, 13, $DB, "", "", "$guia", 5, 0);
	$FB->llena_texto("param7", 1, 13, $DB, "", "", "$tipo", 5, 0);
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);

}else if($tabla=="validapeso"){ 

$sql="SELECT `ser_peso`,`ser_valor`,`ser_pendientecobrar`,`ser_clasificacion`,ser_volumen,ser_descripcion,ser_guiare,ser_ciudadentrega FROM `servicios` WHERE `idservicios`=$id_param";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	
if($nivel_acceso!=1){ 
	if($rw[0]!=''){ $valor="min=$rw[0]";  } else { $valor=""; }
	if($rw[4]!=''){ $valor2="min=$rw[4]";  } else { $valor2=""; }

}else {
	$valor="";
	$valor2="";
}



 $slqs="SELECT idimagenguias FROM imagenguias WHERE ima_nombre='$rw[6]' and ima_tipo='Recogida' ";
$DB1->Execute($slqs); 
 $idmagen=$DB1->recogedato(0);

$FB->llena_texto("PESO KG:",1,123, $DB, "", "$valor",$rw[0] ,1,1);	
$FB->llena_texto("VOLUMEN:",4,125, $DB, "", "$valor2",$rw[4],1, 0);	
$FB->llena_texto("ESTADO PAQUETE:",2,9, $DB, "", "",$rw[5] ,1, 0);	
$FB->llena_texto("# GUIA:",6,1, $DB, "", "",$rw[6],1, 0);	
$FB->llena_texto("FOTO GUIA", 10, 60, $DB, "", "", "$idmagen",1,0);	
$FB->llena_texto("VERIFICADO:",3, 5, $DB, "", "", "", 1, 1);

if($rw[3]==1 and $rw[2]==0){
	$clasificacion=1;
} else if($rw[3]==2){
	$clasificacion=2;
}else {
	$clasificacion=0;
}

$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("clasificacion", 1, 13, $DB, "", "", $clasificacion, 5, 0);
$FB->llena_texto("caso", 1, 13, $DB, "", "", 2, 5, 0);
$FB->llena_texto("param5", 1, 13, $DB, "", "", $id_param2, 5, 0);
$FB->llena_texto("param16", 1, 13, $DB, "", "", $rw[7], 5, 0);
}
else if($tabla=="descargaoficina"){ 
	$sql="SELECT `ser_peso`,`ser_valor`,`ser_pendientecobrar`,`ser_clasificacion`,ser_volumen,ser_descripcion,ser_guiare,ser_ciudadentrega,ser_destinatario,ser_direccioncontacto,cli_idciudad,ser_idservicio FROM `servicios`
	inner join rel_sercli  on idservicios=ser_idservicio  inner join clientesservicios on idclientesdir=ser_idclientes
	 WHERE `ser_guiare`='$id_param'";
	$DB->Execute($sql);
	$rw=mysqli_fetch_array($DB->Consulta_ID);	
	if($nivel_acceso!=1){ 
		if($rw[0]!=''){ $valor="min=$rw[0]";  } else { $valor=""; }
		if($rw[4]!=''){ $valor2="min=$rw[4]";  } else { $valor2=""; }
	
	}else {
		$valor="";
		$valor2="";
	}
	$rw[9]=str_replace("&"," ", $rw[9]);
	$FB->llena_texto("CIUDAD:",17,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM ciudades where idciudades=$rw[7])", "", "$rw[7]", 1, 0);
	$FB->llena_texto("DESTINATARIO:",18, 1, $DB, "", "","$rw[8]", 4,0);
	$FB->llena_texto("DIRECCION:",19, 1, $DB, "", "","$rw[9]", 4,0);
	$FB->llena_texto("PESO KG:",1,123, $DB, "", "$valor",$rw[0] ,1, 'min=1');	
	$FB->llena_texto("VOLUMEN:",4,125, $DB, "", "$valor2",$rw[4],1, 0);	
	$FB->llena_texto("ESTADO PAQUETE:",12,82, $DB, $estadopaquete, "",@$rw[5], 1, 1);
	$FB->llena_texto("# GUIA:",6,1, $DB, "", "",$rw[6],1, 0);		
	
	if($rw[3]==1 and $rw[2]==0){
		$clasificacion=1;
	} else if($rw[3]==2){
		$clasificacion=2;
	}else {
		$clasificacion=0;
	}
	$FB->llena_texto("id_param", 1, 13, $DB, "", "", $rw[11], 5, 0);
	$FB->llena_texto("id_param2", 1, 13, $DB, "", "", $rw[11], 5, 0);
	$FB->llena_texto("clasificacion", 1, 13, $DB, "", "", $clasificacion, 5, 0);
	$FB->llena_texto("caso", 1, 13, $DB, "", "", 2, 5, 0);
	$FB->llena_texto("param5", 1, 13, $DB, "", "", $rw[10], 5, 0);
	$FB->llena_texto("param3", 1, 13, $DB, "", "", 1, 5, 0);
	$FB->llena_texto("param16", 1, 13, $DB, "", "", $rw[7], 5, 0);
	}
else if($tabla=="Usuarios-Roles"){ 
$FB->abre_form("form1","nuevo_adminok.php","post");
$slqs="SELECT usu_nombre FROM usuarios WHERE usu_mail='$id_param' ";
$DB1->Execute($slqs); 
$eventos=$DB1->recogedato(0);
?>
<div class="modal-body"><div class="form-group">
<div class="input-group"><h4><?php echo utf8_encode($eventos); ?></h4></div>
<?php 
$sql="SELECT idroles, rol_nombre FROM roles ORDER BY rol_nombre ";
$DB->Execute($sql); echo "<table width='100%' class='Intabla'><tr>"; $va=0;
while($rw1=mysqli_fetch_row($DB->Consulta_ID)){ 
	if($va==5){ $va=0; echo "</tr><tr>"; } $va++;
	$slqs="SELECT COUNT(*) FROM usuarios WHERE usu_mail='$id_param' AND roles_idroles='$rw1[0]'";
	$DB1->Execute($slqs); 
	if($DB1->recogedato(0)>0){ $conss1="checked"; } else { $conss1=""; } 
	echo "<td width='2%'><input type='checkbox' id='roles' name='roles[]' style='width:35px;' value='$rw1[0]' $conss1></td><td width='18%'>".utf8_encode($rw1[1])."</td>";
} 
echo "</table>";
?>
</div>
<?php 
$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);

} 

$FB->llena_texto("tabla", 1, 13, $DB, "", "", $tabla, 5, 0);
$FB->llena_texto("dir", 1, 13, $DB, "", "", $dir, 5, 0);
$FB->cierra_form(); 
$DB->cerrarconsulta(); 
?>