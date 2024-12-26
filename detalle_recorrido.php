<?php 

$conde=" ";
$conde2=" ";
$conde3=" ";
if($param34!=''){ $fechaactual=$param34;  }

if($param33!=''){ $conde3 ="and ((ser_idresponsable='$param33' and date(ser_fechaasignacion)='$fechaactual') or (ser_idusuarioguia='$param33' and date(ser_fechaguia)='$fechaactual' )) ";  } 
	
$FB->titulo_azul1("#",1,0,7); 
$FB->titulo_azul1("Guia",1,0,0); 

//$FB->titulo_azul1("Ciudad",1,'5%',0); 
$FB->titulo_azul1("Direccion",1,'5%',0); 

$FB->titulo_azul1("Estado",1,'5%',0); 
$FB->titulo_azul1("Asignada",1,'5%',0); 
$FB->titulo_azul1("Recogida",1,'5%',0); 
$FB->titulo_azul1("Diferencia",1,'5%',0); 
$FB->titulo_azul1("Tiempo entrga ",1,'5%',0); 

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
			$datos=["guia"=>"Ingreso","direccion"=>"$rw6[1]","estado"=>"Ingreso","asignada"=>"$rw6[2]","recogida"=>"$rw6[2]"];
			array_push($pila,$datos);
		if($rw6[3]!=null){
			$datos=["guia"=>"Hora Almuerzo","direccion"=>"$rw6[1]","estado"=>"Almorzando","asignada"=>"$fechaactual $rw6[3]","recogida"=>"$fechaactual $rw6[3]"];
			array_push($pila,$datos);
		}
		if($rw6[4]!=null){
			$datos=["guia"=>"Retorno Almuerzo","direccion"=>"$rw6[1]","estado"=>"Retorno","asignada"=>"$fechaactual $rw6[4]","recogida"=>"$fechaactual $rw6[4]"];
			array_push($pila,$datos);
		}
		if($rw6[5]!=null){
			$datos=["guia"=>"Regreso Oficina","direccion"=>"$rw6[1]","estado"=>"Regreso","asignada"=>"$fechaactual $rw6[5]","recogida"=>"$fechaactual $rw6[5]"];
			array_push($pila,$datos);
		}
		if($rw6[6]!=null){
			$datos=["guia"=>"Salio Trabajo","direccion"=>"$rw6[1]","estado"=>"Termino","asignada"=>"$fechaactual $rw6[6]","recogida"=>"$fechaactual $rw6[6]"];
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
		$datos=["guia"=>"$rw4[3]","direccion"=>"$direccion","estado"=>"$proceso","asignada"=>"$rw4[9]","recogida"=>"$fecha"];
		array_push($pila,$datos);

	}

  $sql="SELECT `idservicios`,`cli_nombre`,`cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,
 `ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_estado,ser_fechaguia,ser_visto,`ser_fechaasignacion`,
 `ser_consecutivo`,ser_guiare,ser_idresponsable,ser_idusuarioguia,ser_fechaentrega
 FROM serviciosdia   where ser_estado>=3 and ser_estado<=11  
 $conde2 $conde3 ORDER BY ser_fechaasignacion,ser_fechaguia ASC ";
 $DB->Execute($sql);

 $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		echo$horaentrega=$rw1[17];
		$estado="";
		$imprimirestado='SI';
		$id_p=$rw1[0];
		$rw1[3]=str_replace("&"," ", $rw1[3]);
		$rw1[6]=str_replace("&"," ", $rw1[6]);
		$sql11="SELECT gui_fecharecogida,gui_fechaencomienda FROM guias where gui_idservicio='$id_p'";
		$DB1->Execute($sql11);
		$rw11=mysqli_fetch_row($DB1->Consulta_ID);
		$fecha1=substr($rw11[0], 0, -9); //fecha recogida
		$fecha2=substr($rw11[1], 0, -9); //fecha entrega

		if($rw1[15]==$param33 and $fecha1==$fechaactual){ //user recogida fecha recogida ser_idresponsable
		/* 	$sql11="SELECT `idciudades`, `ciu_nombre`, `inner_sedes` FROM `ciudades` WHERE idciudades=$rw1[18]";
			$DB2->Execute($sql11);
			$rw11=mysqli_fetch_row($DB2->Consulta_ID);
			$ciudad=$rw11[1];  */
			$direccion=$rw1[3];
			$tipo='Recogida';
			$fecha=$rw1[12]; //ser_fechaasignacion
			$fechaentrereco=$rw11[0];
		

		}elseif($rw1[16]==$param33 and $fecha2==$fechaactual){ //user entrega fecha entrega  idusuarioguia 
		
			$ciudad=$rw1[7];
			$direccion=$rw1[6];
			$tipo='Entrega';
			$fecha=$rw1[10]; //ser_fechaguia
			$fechaentrereco=$rw11[1];

		}else{
			$imprimirestado='NO';
		}

	if($imprimirestado!='NO'){
		$nompromotor =" ";		
		$proceso ="";		
		if($rw1[9]==3 and $fecha1==$fechaactual){
			$color2="#FFFF33";
			$proceso.="Sin Recoger";
			$fecha='0000-00-00 00:00:00';

		}else if($rw1[9]==5 and $fecha1==$fechaactual) {
			$color2="#FF3C33";
			$proceso.="NO Recogida";

		}
		else if($rw1[9]==4 or ($rw1[9]>=6 and $rw1[9]<=8) and $fecha1==$fechaactual) {  //or ($rw1[9]>=6 and $rw1[9]<=8)
			$color2="#6EFF33";
			$proceso.="Recogida";
		}
		else if($rw1[9]==9 and $fecha2==$fechaactual) {
			$color2="#FFFF33";
			$proceso.="Sin Entregar";
			$fecha='0000-00-00 00:00:00';
		}
		else if($rw1[9]==11 and $fecha2==$fechaactual) {
			$color2="#FF3C33";
			$proceso.="NO Entregado";
		}
		else if($rw1[9]==10 and $fecha2==$fechaactual) {
			$color2="#6EFF33";
			$proceso.="Entregado";


		}else {


			$sql12="SELECT cue_idoperador,cue_idoperentrega FROM `cuentaspromotor`  where cue_idservicio='$id_p'";
			$DB1->Execute($sql12);
			$rw12=mysqli_fetch_row($DB1->Consulta_ID);
			$idrecoge=$rw12[0]; // recogida
			$identrega=$rw12[1]; // entrega
			if($param33==$idrecoge){
				$color2="#6EFF33";
				$proceso.="Recogida";
			}elseif($param33==$identrega){
				$color2="#6EFF33";
				$proceso.="Entregado";
			}else{
				$proceso.='';
			}
			
		}
		$fechar=substr($rw1[10], 0,10);
		$fechae=substr($rw1[12], 0,10);

		if($rw1[16]==$rw1[15] and $fechar==$fechae){  
			$color3=$color3;
			$proceso2=$proceso;
			$color2="#6EFF33";
			$proceso="Recogida"; 

		}
		$horaentrega=substr($fecha, 10, 9);

		$datos=["guia"=>"$rw1[13]","direccion"=>"$direccion","estado"=>"$proceso","asignada"=>"$fechaentrereco","recogida"=>"$fecha"];
		array_push($pila,$datos);

		if($rw1[16]==$rw1[15] and $fechar==$fechae){

			$direccion=$rw1[6];
			$fecha=$rw1[10]; //ser_fechaguia
			$tipo='Entrega';

			$fechaentrereco=$rw11[1];

			$datos=["guia"=>"$rw1[13]","direccion"=>"$direccion","estado"=>"$proceso2","asignada"=>"$fechaentrereco"];
			array_push($pila,$datos);

		}
	  }
	}


 $sql2="SELECT idgastos,gas_iduserremesa, 'entrega' as tipo, gas_entrego as efectivas,concat_ws('-','Descripcion', gas_descripcion,'Empresa:',gas_empresa,'BUS:',gas_bus) as direccion,gas_fecharegistro as fecha  FROM `gastos` where date(gas_fecharegistro) = '$fechaactual' and gas_iduserremesa='$param33'
	union 
	SELECT idgastos,gas_iduserrecoge, 'recogida' as tipo, gas_recogio as efectivas,concat_ws('-','Descripcion:', gas_descripcion,'Empresa:',gas_empresa,'BUS:',gas_bus) as direccion,gas_fecrecogida as fecha FROM `gastos` where date(gas_fecrecogida)='$fechaactual' and gas_iduserrecoge='$param33'";
   $DB->Execute($sql2);
   while($rw28=mysqli_fetch_row($DB->Consulta_ID))
   {
   
	   if($rw28[2]=='entrega' and $rw28[3]==1){ //entregas efectivas
   
		 //  $remesasentregaefec[$rw28[1]]=$rw28[0];
		 $proceso='Entregado';
		   $datos=["guia"=>"Remesa-$rw28[2]#:$rw28[0]","direccion"=>"$rw28[4]","estado"=>"$proceso","asignada"=>"$rw28[5]","recogida"=>"$rw28[5]"];
	       array_push($pila,$datos);
   
	   }elseif($rw28[2]=='entrega' and $rw28[3]==0){ //entregas fallidas
		   
		$proceso="NO Entregado";
		$datos=["guia"=>"Remesa-$rw28[2]#:$rw28[0]","direccion"=>"$rw28[4]","estado"=>"$proceso","asignada"=>"$rw28[5]","recogida"=>"$rw28[5]"];

   
	   }elseif($rw28[2]=='recogida' and $rw28[3]==1){// recogidas efectivas
   
		$proceso="Recogida";
		$datos=["guia"=>"Remesa-$rw28[2]#:$rw28[0]","direccion"=>"$rw28[4]","estado"=>"$proceso","asignada"=>"$rw28[5]","recogida"=>"$rw28[5]"];

		   
	   }elseif($rw28[2]=='recogida' and $rw28[3]==0){// recogidas fallidas
   
		$proceso="NO Recogida";
		$datos=["guia"=>"Remesa-$rw28[2]#:$rw28[0]","direccion"=>"$rw28[4]","estado"=>"$proceso","asignada"=>"$rw28[5]","recogida"=>"$rw28[5]"];

	   }
	   array_push($pila,$datos);   
   }
	
	// $datos = substr ($datos, 0, -1);
	//print_r($pila);
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

					if($valor=='Sin Recoger' or $valor=='Sin Entregar' or $valor=='PXC Sin Cobrar'){
						$color2="#FFFF33";
			
					}else if($valor=='NO Recogida' or $valor=='NO Entregado') {
						$color2="#FF3C33";
					}
					else if($valor=='Recogida' or $valor=='Entregado' or $valor=='PXC Cobrada') {
						 $color2="#6EFF33";
					}else {
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

            // echo"<td></td>";

			echo "<td bgcolor='$color2' >".$valor."</td>";	
			
		}

		echo "<td  >".$diferencia2."</td>";	
		 echo "<td>".$horaentrega."</td>";
		echo "</tr>"; 
	}


?>
