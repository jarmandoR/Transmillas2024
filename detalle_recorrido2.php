<?php 

$conde=" ";
$conde2=" ";
$conde3=" ";
if($param34!=''){ $fechaactual=$param34;  }
	
if($param33!=''){ $conde3 ="and ((cue_idoperador='$param33' and cue_fecharecogida like '$fechaactual%') or (cue_idoperentrega='$param33' and cue_fecha like '$fechaactual%' )) ";  } 
	
$FB->titulo_azul1("#",1,0,7); 
$FB->titulo_azul1("Guia",1,0,0); 
//$FB->titulo_azul1("Ciudad",1,'5%',0); 
$FB->titulo_azul1("Direccion",1,'5%',0); 
//$FB->titulo_azul1("Tipo	",1,'5%',0); 
$FB->titulo_azul1("Estado",1,'5%',0); 
$FB->titulo_azul1("Asignada",1,'5%',0); 
$FB->titulo_azul1("Recogida",1,'5%',0); 
$FB->titulo_azul1("Diferencia",1,'5%',0); 

$conde1=""; 

/*   $sql="SELECT `idservicios`,`cli_nombre`,`cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,
 `ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_estado,ser_fechaguia,ser_visto,`ser_fechaasignacion`,
 `ser_consecutivo`,ser_guiare,ser_idresponsable,ser_idusuarioguia,ser_visto,cli_idciudad
 FROM serviciosdia   where ser_estado>=3 and ser_estado<=11  
 $conde2 $conde3 ORDER BY ser_fechaasignacion,ser_fechaguia ASC ";
 */

 $sql="SELECT `idcuentaspromotor`, `cue_idservicio`, `cue_idoperador`, `cue_idoperentrega`,`cue_fecha`, `cue_fecharecogida`,  `cue_numeroguia`, `cue_idciudadori`, 
`cue_idciudaddes`,`cue_tipoevento`,`cue_estado`,`cue_idoperpendiente`, `cue_fechapcobrar`,cue_idoperador, cue_fecharecogida,cue_idoperentrega,cue_fecha  FROM `cuentaspromotor` WHERE cue_estado>=3 and cue_estado<=11  $conde3  ORDER BY cue_fecharecogida,cue_fecha ASC";

$DB2->Execute($sql);
 $va=0; 
	while($rw1=mysqli_fetch_row($DB2->Consulta_ID))
	{

 		$estado="";
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		
		$rw1[6]=str_replace("&"," ", $rw1[6]); 

		if($rw1[2]==$param33){ // recogida
		 	 $sql11="SELECT cli_idciudad,cli_direccion,gui_fecharecogida FROM clientesservicios inner join rel_sercli on idclientesdir=ser_idclientes inner join servicios on ser_idservicio=idservicios inner join guias on idservicios=gui_idservicio where idservicios='$rw1[1]'";
			$DB1->Execute($sql11);
			$rw11=mysqli_fetch_row($DB1->Consulta_ID);
			$direccion=str_replace("&"," ", $rw11[1]);
			//$ciudad=$rw11[1];  
			$tipo='Recogida';
			$fecha=$rw1[5];
			$fechaasignada=$rw11[2];

		}elseif($rw1[3]==$param33){ // entrega
		
			$sql11="SELECT ser_ciudadentrega,ser_direccioncontacto,gui_fecharecogida FROM servicios inner join guias on idservicios=gui_idservicio where idservicios='$rw1[1]'";
			$DB1->Execute($sql11);
			$rw11=mysqli_fetch_row($DB1->Consulta_ID);
			$direccion=str_replace("&"," ", $rw11[1]); 
			$tipo='Entrega';
			$fecha=$rw1[4];
			$fechaasignada=$rw11[2];
		}

	if($va>=2){
			
		 $datetime1 = new DateTime($fechaanterior);
		 $datetime2 = new DateTime($fecha);
		 $dteDiff  = $datetime1->diff($datetime2);
		 $diferencia2=$dteDiff->format("%H:%I:%S");
		
			$fechaanterior=$fecha;
		}else{
			$fechaanterior=$fecha;
		}
		echo "<td>".$va."</td>	
		<td>".$rw1[6]."</td>
		<td>".$direccion."</td>		
		";
		$nompromotor =" ";
		
		$proceso =" ";		
		if($rw1[10]==3){
			$color2="#FFFF33";
			$proceso.="Sin Recoger ";

		}else if($rw1[10]==5) {
			$color2="#FF3C33";
			$proceso.="NO Recogida ";

		}
		else if($rw1[10]==4 or ($rw1[10]>=6 and $rw1[10]<=8)) {
			$color2="#6EFF33";
			$proceso.="Recogida ";
		}
		else if($rw1[10]==9) {
			$color2="#FFFF33";
			$proceso.="Sin Entregar";
		}
		else if($rw1[10]==11) {
			$color2="#FF3C33";
			$proceso.="NO Entregado";
		}
		else if($rw1[10]==10) {
			$color2="#6EFF33";
			$proceso.="Entregado";
		}else {
			$proceso.='';
		}
		$fechar=substr($rw1[14], 0,10);
		$fechae=substr($rw1[16], 0,10);

		if($rw1[13]==$rw1[15] and $fechar==$fechae){  
			$color3=$color3;
			$proceso2=$proceso;
			$color2="#6EFF33";
			$proceso="Recogida "; 

		}

		$horaentrega=substr($fecha, 10, 8);
		$horaasignada=substr($fechaasignada, 10, 8);
		echo "<td align='center' bgcolor='$color2' >";
		echo "$proceso</td>";
		echo "<td>".$horaasignada."</td>";
		echo "<td>".$horaentrega."</td>";
		echo "<td>".$diferencia2."</td>";
		echo "</tr>"; 
	}

?>
