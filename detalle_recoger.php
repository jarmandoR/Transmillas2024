<?php 
require("login_autentica.php");
include("cabezote3.php"); 

//if($_REQUEST["asc"]!=""){ $asc=$_REQUEST["asc"]; } else {$asc="ASC"; } $asc2=""; if($asc=="ASC"){ $asc2="DESC";}
$asc="ASC";

$conde=" ";
$conde2=" ";
$conde3=" ";
if($param34!=''){ $fechaactual=$param34;  }

if($param35!=''){ $id_sedes=$param35; } 

	$idcidades=ciudadesedes($id_sedes,$DB);
	if($idcidades=='0'){
		$conde2="";

	}else {
	  $conde2=" and (cli_idciudad in $idcidades  or (inner_sedes=$id_sedes and ser_idusuarioguia!='0') )"; 	
	}	
	
//	  $conde2=" and ((cli_idciudad in $idcidades and ser_estado in (5,6,7,8) ) or (inner_sedes=$id_sedes and ser_estado in (9,10,11) ) ))"; 	


$FB->titulo_azul1("Guia",1,0,7); 
$FB->titulo_azul1("#",1,0,0); 
$FB->titulo_azul1("Remitente",1,'5%',0); 
//$FB->titulo_azul1("Teléfono",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("Destinatario",1,'2%',0); 
//$FB->titulo_azul1("Teléfono",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("Ciudad",1,0,0); 
$FB->titulo_azul1("Servicio",1,0,0); 

$FB->titulo_azul1("Operarios	",1,0,0); 


$FB->titulo_azul1("Estado	",1,0,0); 
$FB->titulo_azul1("Visto",1,0,0); 
$FB->titulo_azul1("Proceso	",1,0,0); 
$FB->titulo_azul1("Datos",1,0,0); 
$FB->titulo_azul1("Whatsapp",1,0,0); 
/* if($nivel_acceso==1 or $nivel_acceso==5){
	$FB->titulo_azul1("Editar",1,0,0); 
} */

//$FB->titulo_azul3("Validar",2,0,2,$param_edicion);

$conde1=""; 

if($param32!="" and $param31!=""){ 
 $conde1="and $param31 like '%$param32%' "; 
  }else { $conde1="  "; } 

//if($param1==""){ $param1="ser_prioridad"; } 
$conde4="and (ser_fechaguia like '$fechaactual%' or ser_fechaasignacion like '$fechaactual%' )";

  
  
    if($param33!=''){ 
		if ($param33==476 or $param33==476) {
			$conde3 ="and ((ser_idresponsable='$param33' and ser_fechaasignacion like '$fechaactual%') or (ser_idusuarioguia='$param33' and ser_fechaguia like '$fechaactual%' )) "; $conde4=""; 
	    }else {
			$conde3 ="and ((ser_idresponsable='$param33' and ser_fechaasignacion like '$fechaactual%') or (ser_idusuarioguia='$param33' and ser_fechaguia like '$fechaactual%' )) "; $conde4=""; 

		}
	} 
	if($param37!=''){ 
		if($param37=='Recogidas'){
			$conde4 =" and ser_fechaasignacion like '$fechaactual%'";
			$conde3 =" and ser_idresponsable='$param33'"; 
		} else if($param37=='Encomiendas'){
			$conde4 =" and ser_fechaguia like '$fechaactual%'";
			$conde3 =" and ser_idusuarioguia='$param33'"; 
		}
	
	}
	 if($param33==''){ $conde3 =" "; } 

$sql="SELECT `idservicios`,`cli_nombre`,`cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,
 `ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_estado,ser_fechaguia,ser_visto,`ser_fechaasignacion`,`ser_consecutivo`,ser_guiare,ser_idresponsable,ser_idusuarioguia,ser_visto
 FROM serviciosdia   where ser_estado>=3 and ser_estado<=11  
 $conde1 $conde2 $conde3 $conde $conde4 ORDER BY ser_prioridad $asc ";

 
$DB->Execute($sql);
 $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$estado="";
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		//$rw1[9]=$tipopago[$rw1[9]];
		$rw1[3]=str_replace("&"," ", $rw1[3]);
		$rw1[6]=str_replace("&"," ", $rw1[6]);
		echo "<td>".$rw1[13]."</td>
		<td>".$rw1[14]."</td>
		<td>".$rw1[1]."</td>
		
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		
		<td>".$rw1[6]."</td>
		<td>".$rw1[7]."</td>
		<td>".$rw1[8]."</td>";
		$operario ="";
		$nompromotor =" ";
		
		if($rw1[16]==$rw1[15]){
			
			$estado.="Encomiendas / Recogidas";
			$sql2="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$rw1[16]' and  (usu_estado=1 or usu_filtro=1) ";
			$DB2->Execute($sql2);
			$rw2=mysqli_fetch_row($DB2->Consulta_ID);
			$operario ="$rw2[1]"; 

		}else if($rw1[16]!='0'){
			
			$estado.="Encomiendas ";
			$sql2="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$rw1[16]' and  (usu_estado=1 or usu_filtro=1) ";
			$DB2->Execute($sql2);
			 $rw2=mysqli_fetch_row($DB2->Consulta_ID);
			 $operario ="$rw2[1]";

		}else if($rw1[15]!='0'){
			
			$estado.="Recogidas ";
		 	$sql2="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$rw1[15]' and  (usu_estado=1 or usu_filtro=1)";
			$DB2->Execute($sql2);
			$rw2=mysqli_fetch_row($DB2->Consulta_ID);
			$operario ="$rw2[1]"; 
		}
	
		$visto="";
		$proceso =" ";
		
		if($rw1[9]==3){
			$color2="#FFFF33";
			$proceso.="Sin Recoger ";
			if($rw1[17]==1){
			
			$visto="img/visto.png";
				
			} else{
				
				$visto="img/novisto.png";
			}

		}else if($rw1[9]==5) {
			$color2="#FF3C33";
			$proceso.="NO Recogida ";
			$visto="img/visto.png";
		}
		else if($rw1[9]==4 or ($rw1[9]>=6 and $rw1[9]<=8)) {
			$color2="#6EFF33";
			$proceso.="Recogida ";
			$visto="img/visto.png";
		}
		else if($rw1[9]==9) {
			$color2="#FFFF33";
			$proceso.="Sin Entregar";
		}
		else if($rw1[9]==11) {
			$color2="#FF3C33";
			$proceso.="NO Entregado";
			if($rw1[17]==1){
						$visto="img/visto.png";
					} else{
					$visto="img/novisto.png";
				}
		}
		else if($rw1[9]==10) {
			$color2="#6EFF33";
			$proceso.="Entregado";
			$visto="img/visto.png";
		}else {
			$proceso.='';
		}
				
  echo "<td>".$operario."</td>
			 <td>".$estado."</td>";
		

		echo "<td align='center'  >";
		echo "<a  onclick='pop_dis5($id_p,\"Recogidas\")';  style='cursor: pointer;' title='Recogidas' ><img src='$visto'></a></td>";
		
		echo "<td>".$proceso."</td>
		
		";
		echo "<td align='center' bgcolor='$color2' >";
		echo "<a  onclick='pop_dis5($id_p,\"Recogidas\")';  style='cursor: pointer;' title='Recogidas' ><img src='img/recogidas.png'></a></td>";
/* 		if($nivel_acceso==1 or $nivel_acceso==5){
				if($rw1[9]>=3 or $rw1[9]<=4){
						echo "<td align='center' bgcolor='$color2' data-toggle='tooltip' data-placement='top'  title='' ><a  onclick='pop_dis1($id_p, \"Verificar Datos\",\"recogidas.php\")';  style='cursor: pointer;' title='Verificar Datos' >
						<img src='img/informacion.jpg'></a>";
						echo '</td>';
				} else {
					echo "<td align='center' bgcolor='$color2' >";
					echo "<a  onclick='pop_dis13($id_p,\"Editar datos\")';  style='cursor: pointer;' title='Editardatos' ><img src='img/informacion.jpg'></a></td>";
			
				}
	} */
	$colortd="";
	$sql5="SELECT count(*) FROM `registro` WHERE mensaje_enviado in('15','16') and `id_servicio`='$id_p' ";
	$DB1->Execute($sql5);
	$canti=$DB1->recogedato(0);
	
	if ($canti>0) {
		$colortd="style='background-color: #ffcc00;'";
	}else{
		$colortd="";
	}
	echo "<td ".$colortd."'><input type='checkbox'  onchange='selecionado($id_p)' class='checkbox' id='".$id_p."s' value='$id_p'></td></tr>";
	

		echo "</tr>"; 
	}

?>
