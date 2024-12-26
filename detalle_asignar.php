<?php 
require("login_autentica.php");
include("cabezote3.php"); 

//if($_REQUEST["asc"]!=""){ $asc=$_REQUEST["asc"]; } else {$asc="ASC"; } $asc2=""; if($asc=="ASC"){ $asc2="DESC";}
$asc="ASC";
$idsederemesas=$id_sedes;
if($nivel_acceso==1){
	if($param35!=''){ 
		$id_sedes=$param35; 
		$idsederemesas=$param35;
		$idcidades=ciudadesedes($id_sedes,$DB);
		if($idcidades=='0'){
			$conde2="";
	
		}else {
		  $conde2=" and cli_idciudad in $idcidades   "; 	
		}	
	
	}  else {  $id_ciudad=""; }

}else {
	$idcidades=ciudadesedes($id_sedes,$DB);
	if($idcidades=='0'){
		$conde2="";

	}else {
	  $conde2=" and cli_idciudad in $idcidades   "; 	
	}	
	
}


$FB->titulo_azul1("Fecha Ingreso",1,0,7); 
$FB->titulo_azul1("Hora Recogida",1,0,0); 
$FB->titulo_azul1("Remitente",1,0,0); 
$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("Destinatario",1,0,0); 
$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("Ciudad",1,0,0); 
$FB->titulo_azul1("Validado",1,0,0); 
$FB->titulo_azul1("Tipo de Paquete",1,0,0); 
$FB->titulo_azul1("Contiene",1,0,0); 
$FB->titulo_azul1("Servicio",1,0,0); 
$conde3=""; 
if($param34==2){ 
	if($param33!=""){ $conde3="and usu_nombre like '%$param33%'"; } 
$FB->titulo_azul1("Mensajero",1,0,0); 
$estado='3'; 
} else { $estado='2'; }
$FB->titulo_azul1("Asignar",1,0,0); 
$FB->titulo_azul1("Editar",1,0,0); 
$FB->titulo_azul1("Devolver",1,0,0); 
$FB->titulo_azul1("MOTIVO",1,0,0); 
if($nivel_acceso==1 or $nivel_acceso==5){

$FB->titulo_azul1("CANCELAR",1,0,0); 
}
$conde1=""; 


if($param32!="" and $param31!=""){ 
 $conde1="and $param31 like '%$param32%' "; 
  }else { $conde1="  "; } 

  if($param31==""){ $param31="ser_prioridad"; } 
 

 $sql="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`, `cli_telefono`,`cli_direccion`, `ser_destinatario`,
 `ser_telefonocontacto`,`ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_estado,usu_nombre,ser_fecharegistro,
 `ser_tipopaquete`,`ser_iduserverific`,cli_idciudad,ser_paquetedescripcion,ser_ciudadentrega
 FROM `clientes` inner join clientesservicios on cli_idclientes=idclientes  
 inner join rel_sercli on idclientesdir=ser_idclientes 
 inner join servicios on  ser_idservicio=idservicios
 inner join ciudades on ser_ciudadentrega=idciudades 
 left  join usuarios on idusuarios=ser_idresponsable where ser_estado in ($estado) $conde1 $conde2  $conde3 ORDER BY $param31 $asc ";

$DB1->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
		
		$id_p=$rw1[0];
		 $va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		//if($rw1[10]==5){ $color="#ec7878"; }
		$rw1[4]=str_replace("&"," ", $rw1[4]);
		$rw1[7]=str_replace("&"," ", $rw1[7]);
		echo "<tr  id='$id_p' class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		
		$sql5="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$rw1[14]' and  (usu_estado=1 or usu_filtro=1) ";
		$DB->Execute($sql5);
		$nompromotor=$DB->recogedato(1);
		
		echo "<td>".$rw1[12]."</td>
		<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		<td>".$rw1[7]."</td>
		<td>".$rw1[8]."</td>
		<td>".$nompromotor."</td>
		<td>".$rw1[13]."</td>
		<td>".$rw1[16]."</td>
		<td>".$rw1[9]."</td>
		";
		if($param34==2){ echo "<td>".$rw1[11]."</td>"; } else { }
		
		$sql1="SELECT gui_tiposervicio from guias where gui_idservicio=$id_p";
		$DB->Execute($sql1);
		$valortserv=$DB->recogedato(0);

			
		$sql2="SELECT `idcreditos` FROM `rel_sercre`  inner join  `creditos` on cre_nombre=rel_nom_credito where idservicio='$id_p'";
		$DB->Execute($sql2);
		$rw4=mysqli_fetch_row($DB->Consulta_ID);
		$creditos=$rw4[0];

	

		echo "<td align='center' >";
		echo "<a  onclick='pop_dis24($id_p,\"Asignar Paquete\",$rw1[15])';  style='cursor: pointer;' title='Asignar Paquete' ><img src='img/paquete.png'></a></td>";
		echo "<td align='center'  data-toggle='tooltip' data-placement='top'  title='' ><a  onclick='pop_dis1($id_p, \"Verificar Datos\", \"asignarpaquete.php\"); setTimeout(function(){buscarservicio($rw1[15],$rw1[17],\"$creditos\",\"$rw1[9]\",$valortserv)},1000);'  style='cursor: pointer;' title='Verificar Datos' >
				<img src='img/informacion.jpg'></a>";
		echo '</td>';
		


		echo "<td align='center' class='devolver' >";
		echo "<button type='button' class='btn btn-info' onclick='devolver($id_p,$va)'>Devolver</button>";
		echo '</td>';

		$descrip="des_$va";
		echo "<td><textarea name='des_$va' id='des_$va' value='' style='width:195px; class='text' ></textarea></td>";

		if($nivel_acceso==1 or $nivel_acceso==5){
			
			echo "<td><div id='campo$va'>";
			echo "<select  style='width:120px;border:1px solid #f9f9f9;background-color:#074f91;color:#f9f9f9;font-size:15px'  name='$va' id='$va'   class='borrar' required>";
			$LT->llenaselect_ar("Selecccione...",$estados);
			echo "</select></div><input name='servicio_$va' id='servicio_$va' type='hidden'  value='$rw1[0]'></td>";
		

		}
	}

	$conde33=" ";

	if($param3==''){   $conde33=""; } 
	else{
		$conde33="gas_iduserrecoge=$param3";
	}


	$FB->titulo_azul1("Sede Origen",1,0,5); 
	$FB->titulo_azul1("Sede Destino",1,0,0); 	
	$FB->titulo_azul1("Datos TR",1,0,0); 
	$FB->titulo_azul1("Tel Conductor",1,0,0); 
	$FB->titulo_azul1("Pagar en?",1,0,0); 
	$FB->titulo_azul1("Descripcion",1,0,0); 
	$FB->titulo_azul1("Peso",1,0,0); 
	$FB->titulo_azul1("Piezas",1,0,0); 
	$FB->titulo_azul1("Confirmo",1,0,0); 
	$FB->titulo_azul1("Valor Aprobado",1,0,0); 
	$FB->titulo_azul1("Fecha Confirmacion",1,0,0);	
	$FB->titulo_azul1("LLamo",1,0,0); 
	$FB->titulo_azul1("Descripcion Llamada",1,0,0); 
	$FB->titulo_azul1("Confirmar Recogida",1,0,0);  


	 $sql2="SELECT `idgastos`, `gas_fecharegistro`, `usu_nombre`, `gas_idciudadori`, `sed_nombre`, `gas_empresa`, `gas_bus`,
	`gas_telconductor`,`gas_pagar`,`gas_iduserremesa`, `gas_nomremesa`,`gas_descripcion`,`gas_peso`,`gas_piezas`,`gas_valor`,
	 gas_usucom,gas_cantcom,gas_feccom ,gas_idciudaddes,gas_iduserrecoge,gas_recogio,gas_entrego,gas_fecrecogida, `gas_descrecogio`,
	`gas_nomvalida`, `gas_fechavalida`,`gas_userllamo`, `gas_fechallamo`, `gas_llamodesc`, `gas_estadollamada` 
	 FROM `gastos` inner join usuarios on gas_idusuario=idusuarios inner join sedes on idsedes=gas_idciudaddes
	  WHERE idgastos>0 and gas_iduserrecoge=0  and gas_usucom!=''   and gas_nomvalida='' and gas_feccom>='2020-12-01' and gas_feccom<='$fechaactual' and gas_idciudaddes='$idsederemesas' and gas_estadollamada='1' ORDER BY gas_fecrecogida  asc";
	$DB1->Execute($sql2); 
	
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	{
		$estado="";
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#EDEA10";} else{$color="#EDEA10";}

		$sql2="SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes='$rw1[3]'";
		$DB->Execute($sql2);
		$rw=mysqli_fetch_row($DB->Consulta_ID);
		
echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

  echo "<td>".$rw[1]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5] / $rw1[6] ."</td>
		<td>".$rw1[7]."</td>
		<td>".$rw1[8]."</td>
		<td>".$rw1[11]."</td>
		<td>".$rw1[12]."</td>
		<td>".$rw1[13]."</td>
		<td>".$rw1[15]."</td>
		<td>".$rw1[16]."</td>
		<td>".$rw1[17]."</td>
		<td>".$rw1[26]."</td>
		<td>".$rw1[28]."</td>";

		if($rw1[15]!=''){
			echo "<td align='center' >";
			echo "<a  onclick='pop_dis27($id_p,\"asignar remesa\",$rw1[18],\"asignarpaquete.php\")';  style='cursor: pointer;' title='Asignar Remesa' ><img src='img/paquete.png'></a></td>";
		}else{
			echo "<td align='center' >Pendiente por Aprobar
		</td>";
		}
	
	echo "</tr>"; 

	} 



?>
