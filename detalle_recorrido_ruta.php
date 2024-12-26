<?php 

$conde=" ";
$conde2=" ";
$conde3=" ";
if($param34!=''){ $fechaactual=$param34;  }

if($param33!=''){ $conde3 ="and ((ser_idresponsable='$param33' and date(ser_fechaasignacion)='$fechaactual') or (ser_idusuarioguia='$param33' and date(ser_fechaguia)='$fechaactual' )) ";  } 
	
$FB->titulo_azul1("#",1,'2%',7); 
$FB->titulo_azul1("Guia",1,'5%',0); 
//$FB->titulo_azul1("Ciudad",1,'5%',0); 
$FB->titulo_azul1("Direccion",1,'5%',0); 
//$FB->titulo_azul1("Tipo	",1,'5%',0); 
$FB->titulo_azul1("Estado",1,'5%',0); 
$FB->titulo_azul1("Asignada",1,'5%',0); 
$FB->titulo_azul1("Tomada",1,'5%',0); 
$FB->titulo_azul1("Recogida",1,'5%',0); 
$FB->titulo_azul1("Diferencia",1,'5%',0); 

$conde1=""; 
$datos='';
$guias='';
$pila=array();

 $sql6="SELECT seg_motivo,zon_nombre,seg_fechaingreso,seg_horaalmuerzo,seg_horaregreso,seg_horaoficina,seg_fechafinalizo FROM `seguimiento_user` inner join zonatrabajo on seg_idzona=idzonatrabajo where seg_idusuario='$param33' and date(seg_fechaingreso)='$fechaactual' and seg_motivo='Ingreso'";
$DB1->Execute($sql6);
	while($rw6=mysqli_fetch_row($DB1->Consulta_ID))
	{
		if($rw6[1]==null){
			$rw6[1]='Sin Zona';
		}
			$datos=["guia"=>"Ingreso","direccion"=>"$rw6[1]","estado"=>"Ingreso","asignada"=>"$rw6[2]","tomada"=>"$fechaactual $rw6[6]","recogida"=>"$rw6[2]"];
			array_push($pila,$datos);

		if($rw6[6]!=null){
			$datos=["guia"=>"Salio Trabajo","direccion"=>"$rw6[1]","estado"=>"Termino","asignada"=>"$fechaactual $rw6[6]","tomada"=>"$fechaactual $rw6[6]","recogida"=>"$fechaactual $rw6[6]"];
			array_push($pila,$datos);
		}	
	}

 $sql="SELECT `idcuentaspromotor`,`cue_idoperpendiente`, `cue_fechapcobrar` ,`cue_numeroguia`, `cue_idciudadori`, 
`cue_idciudaddes`,`cue_tipoevento`,`cue_estado`,cue_pendientecobrar,cue_fechaasigno FROM `cuentaspromotor` WHERE cue_estado>=3 and cue_estado<=11  and cue_idoperpendiente='$param33' and date(cue_fechapcobrar) = '$fechaactual'  and cue_pendientecobrar in (1,2)  ORDER BY cue_fecharecogida,cue_fecha ASC";
$DB1->Execute($sql);
 $va=0; 
	while($rw4=mysqli_fetch_row($DB1->Consulta_ID))
	{
		$tipo='Xcobrar';
		if($rw4[8]==1){
			$proceso='PXC Sin Cobrar';
			$fecha='0000-00-00 00:00:00';
		}else{
			$proceso='PXC Cobrada';
			$fecha=$rw4[2];
		}

		$sql11="SELECT `idciudades` FROM `usuarios` inner join ciudades on inner_sedes=usu_idsede WHERE idciudades in ($rw4[4],$rw4[5]) and idusuarios='$rw4[1]'";
		$DB2->Execute($sql11);
		$rw3=mysqli_fetch_row($DB2->Consulta_ID);	

		$sql12="SELECT `idservicios`, `cli_direccion`, `ser_direccioncontacto` FROM `serviciosdia` WHERE ser_guiare='$rw4[3]'";
			$DB2->Execute($sql12);
			$rw5=mysqli_fetch_row($DB2->Consulta_ID);
		if($rw4[4]==$rw3[0]){
			$direccion=str_replace("&"," ", $rw5[1]);
		}else{
			$direccion=str_replace("&"," ", $rw5[2]);
		}
		//$datos.="{guia=>'$rw4[3]',direccion=>'$direccion',estado=>'$proceso',asignada=>'$rw4[9]',recogida=>'$fecha'},";
		$datos=["guia"=>"$rw4[3]","direccion"=>"$direccion","estado"=>"$proceso","asignada"=>"$rw4[9]","tomada"=>"$rw4[9]","recogida"=>"$fecha"];
		array_push($pila,$datos);

	}



  $sql="SELECT `idseguimientoruta`, `seg_guia`,`seg_direccion`, `seg_estado`, `seg_fecha`,  `seg_fechaestado`,`seg_fechafinalizo`, `seg_idservicio`,  `seg_idusuario`, `seg_tipo`, `seg_descripcion` FROM `seguimientoruta` WHERE  seg_fecha like '%$fechaactual%' and seg_idusuario='$param33' order by seg_fechaasigno asc ";
	$DB->Execute($sql);
 $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$estado="";
		$id_p=$rw1[0];

		$datos=["guia"=>"$rw1[1]","direccion"=>"$rw1[2]","estado"=>"$rw1[3]","asignada"=>"$rw1[4]","tomada"=>"$rw1[5]","recogida"=>"$rw1[6]"];
		array_push($pila,$datos);
	
	}


		usort($pila, function ($a, $b) {
		return strcmp($a["recogida"], $b["recogida"]);
	});

	foreach($pila as $dato) {

		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>".$va."</td>";	
		foreach($dato as $titulo=>$valor){
			$color2='';
			if($titulo=='estado'){

					if($valor=='Sin Recoger' or $valor=='Sin Entregar' or $valor=='PXC Sin Cobrar' or $valor=='Asignada'){
						$color2="#FFFF33";
			
					}else if($valor=='NO Recogida' or $valor=='NO entregado') {
						$color2="#FF3C33";
					}else if($valor=='Cambioruta') {
						$color2="#F08080";
					}
					else if($valor=='Recogida' or $valor=='Entregado' or $valor=='PXC Cobrada' or $valor=='completado') {
						 $color2="#6EFF33";
					}else if($valor=='En ruta' ){
						$color2="#6495ED";
					}
					else {
						$color2=$color;
					}
			}else if($titulo=='recogida'){

				$fecha=$valor;
				if($va>=2 and $fecha!='0000-00-00 00:00:00'){
			
					$datetime1 = new DateTime($fechaanterior);
					$datetime2 = new DateTime($fecha);
					$dteDiff  = $datetime1->diff($datetime2);
					$diferencia2=$dteDiff->format("%H:%I:%S");
				   
					   $fechaanterior=$fecha;
				   }else{
					   $fechaanterior=$fecha;
				   }

				$valor=substr($fecha, 10, 9);
			}elseif($titulo=='asignada'){
				if($valor==''){

				}
			}



			echo "<td bgcolor='$color2' >".$valor."</td>";	
			
		}
		echo "<td  >".$diferencia2."</td>";	
		echo "</tr>"; 
	}


?>
