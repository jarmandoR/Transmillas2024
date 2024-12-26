<?php 
require("login_autentica.php");
include("cabezote3.php"); 

//if($_REQUEST["asc"]!=""){ $asc=$_REQUEST["asc"]; } else {$asc="ASC"; } $asc2=""; if($asc=="ASC"){ $asc2="DESC";}
$asc="ASC";
 $conde2=" ";
 $conde3="";	

 $conde="and ser_fechaasignacion like '$fechaactual%'"; 
 if($param34!=''){ $conde="and ser_fechaasignacion like '$param34%'";  $fechaactual=$param34;  }
if($nivel_acceso==1){
	if($param35!=''){ $id_ciudad=$param35;  $conde2="and cli_idciudad=$id_ciudad"; }  else {  $id_ciudad=""; }

}else {
	$idcidades=ciudadesedes($id_sedes,$DB);
	if($idcidades=='0'){
		$conde2="";

	}else {
	  $conde2=" and cli_idciudad in $idcidades   "; 	
	}	
	
}


$FB->titulo_azul1("Fecha Ingreso",1,0,7); 
$FB->titulo_azul1("Fecha Recogida",1,0,0); 
$FB->titulo_azul1("Cliente",1,0,0); 
$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("Destinatario",1,0,0); 
$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 

$FB->titulo_azul1("Ciudad",1,0,0); 
$FB->titulo_azul1("Servicio",1,0,0); 

if($nivel_acceso!=3){
$FB->titulo_azul1("Operador",1,0,0); 	
}
$FB->titulo_azul1("Recoger ",1,0,0); 
$FB->titulo_azul1("Imprimir ",1,0,0); 

$FB->titulo_azul1("VERIFICADO",1,0,0); 
$FB->titulo_azul1("RECOGIDO",1,0,0); 
$FB->titulo_azul1("EDITAR",1,0,0); 
$FB->titulo_azul1("MOTIVO",1,0,0); 
$FB->titulo_azul1("CANCELAR",1,0,0); 


//$FB->titulo_azul3("Validar",2,0,2,$param_edicion);

$conde1=""; 
$conde4="";

if($param37!=''){ 
				if($param37=='Verificado'){ 
				
						$conde4="and ser_visto='1'";
						
				} elseif($param37=='Sin Verificar'){ 
				
					$conde4="and ser_visto='0'";
				
				} elseif($param37=='Sin Recoger'){ 
				
						$conde4="and ser_estado='3'";
				}
	}

if($param31!="" and $param36!=""){ 
 $conde1="and $param31 like '%$param36%' "; 
  }else { $conde1="  "; } 

  if($param31==""){ $param31="ser_prioridad"; } 
  
 $sql="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`,`cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,`ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,
 ser_estado,ser_visto,usu_nombre,`ser_fechaasignacion`,ser_valorprestamo,ser_llamadarecogido
 FROM serviciosdia inner join usuarios on ser_idresponsable=idusuarios   where ser_estado in (3,4) $conde $conde1 $conde2 $conde3 $conde4 ORDER BY $param31 $asc ";

$DB->Execute($sql); $va=0; $va2=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; 
		$va2++; 
		$p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		$rw1[4]=str_replace("&"," ", $rw1[4]);
		$rw1[7]=str_replace("&"," ", $rw1[7]);
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>".$rw1[13]."</td>
		<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		<td>".$rw1[8]."</td>
		";
		
		if($rw1[9]=="Compra"){
			
			$rw1[9]=$rw1[9].":".$rw1[14];
		}
		echo "<td>".$rw1[9]."</td>";
		if($nivel_acceso!=3){
			
			echo "<td>".$rw1[12]."</td>"; 	
		}
		
		echo "<td align='center' >";
		echo "<a  onclick='pop_dis133($id_p,\"Recoger Paquete\")';  style='cursor: pointer;' title='Recoger Paquete' ><img src='img/caja.png'></a></td>";
		
		if($rw1[10]==4) {	
	//	echo "<a class='btnPrint' href='imprimir.php?id_param=$id_p'><img src='img/imprimir.png'></a>";
	//	echo "<a  href='ticketfacturapdf.php?id_param=$id_p'><img src='img/pdf.png'></a>";		
		echo "<td align='center' >";
		echo "<a href='ticketfactura.php?id_param=$id_p' target='_blank'><img src='img/imprimir.png'></a></td>";
		
		} else {
			echo "<td></td>";
		}
		
		echo "<td><div id='campo$va'>"; if($rw1[11]==1){ $st="SI"; $colorfondo="#074f91"; } else { $st="NO"; $colorfondo="#941727"; } 
		echo "<select  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  name='param14' id='param14'  onChange='cambio_ajax2(this.value, 66, \"campo$va\", \"$va\", 1, $id_p)'  required>";
			$LT->llenaselect_ar($st,$estado_rec);
		echo "</select></div></td>";

		echo "<td><div id='campo2$va2'>"; if($rw1[15]==1){ $st2="SI"; $colorfondo="#074f91"; } else { $st2="NO"; $colorfondo="#941727"; } 
		echo "<select  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  name='param15' id='param15'  onChange='cambio_ajax2(this.value, 64, \"campo2$va2\", \"$va2\", 1, $id_p)'  required>";
			$LT->llenaselect_ar($st2,$estado_rec);
		echo "</select></div></td>";
		
		echo "<td align='center'  data-toggle='tooltip' data-placement='top'  title='' ><a  onclick='pop_dis1($id_p, \"Verificar Datos\", \"recogeroficina.php\")';  style='cursor: pointer;' title='Verificar Datos' >
				<img src='img/informacion.jpg'></a>";
		echo '</td>';
		
		$descrip="des_$va";
		//$FB->llena_texto("Descripcion:",$descrip,9, $DB, "", "",@$rw[1] ,1, 0);	
		echo "<td><textarea name='des_$va' id='des_$va' value='' style='width:195px; class='text' ></textarea></td>";
		
			echo "<td><div id='campo$va'>";
			echo "<select  style='width:120px;border:1px solid #f9f9f9;background-color:#074f91;color:#f9f9f9;font-size:15px'  name='$va' id='$va'   class='borrar' required>";
			$LT->llenaselect_ar("Selecccione...",$estados);
			echo "</select></div><input name='servicio_$va' id='servicio_$va' type='hidden'  value='$rw1[0]'></td>";
		
		
	echo "</tr>"; 
	}


?>
