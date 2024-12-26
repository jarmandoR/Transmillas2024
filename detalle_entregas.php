<?php 
require("login_autentica.php");
include("cabezote3.php"); 

//if($_REQUEST["asc"]!=""){ $asc=$_REQUEST["asc"]; } else {$asc="ASC"; } $asc2=""; if($asc=="ASC"){ $asc2="DESC";}
$asc="ASC";
 $conde2=" ";
 $conde3="";	

$conde3="";	

$conde="and ser_fechaguia like '$fechaactual%'"; 
if($param34!=''){ $conde="and ser_fechaguia like '$param34%'";  $fechaactual=$param34;  }

if($param35!='' and $param35!='0'){ $id_sedes=$param35; $conde2="and inner_sedes=$id_sedes"; }  else { $conde2=""; }
if($nivel_acceso==1){
	
}else if($nivel_acceso==3) {
	
$conde3="and ser_idusuarioguia='$id_usuario'";	

}else {
	
	$conde2="and inner_sedes=$id_sedes";
}

echo$sedes="SELECT sed_mostrarTelefonoClientes FROM `sedes` WHERE idsedes='$id_sedes' ";
$DB1->Execute($sedes); 
echo$mostrarNumero=$DB1->recogedato(0);

$FB->titulo_azul1("Guia",1,0,7); 
$FB->titulo_azul1("Guia Relacionada",1,0,0); 
$FB->titulo_azul1("Destinatario",1,0,0); 
$FB->titulo_azul1("Ciudad",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("T&eacute;lefono",1,0,0); 
$FB->titulo_azul1("Asignado A",1,0,0); 
$FB->titulo_azul1("Entrega",1,0,0); 
$FB->titulo_azul1("Verificado",1,0,0); 

//$FB->titulo_azul3("Validar",2,0,2,$param_edicion);

$conde1=""; 
$conde4="";



if($param32!="" and $param32!="0" and $param31!=""){ 
 $conde1="and $param31 like '%$param32%' "; 
  }else { $conde1="  "; } 

  if($param31==""){ $param31="ser_prioridad"; } 

   $sql="SELECT `idservicios`, `ser_consecutivo`, `ser_destinatario`, `ciu_nombre`,`ser_direccioncontacto`, `ser_telefonocontacto`,`usu_nombre`,ser_estado,ser_visto,ser_guiare
 FROM serviciosdia
 inner join usuarios on ser_idusuarioguia=idusuarios where ser_estado in (9,10) $conde $conde2 $conde1 $conde3 ORDER BY ser_fechaguia $asc ";

	$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		$rw1[4]=str_replace("&"," ", $rw1[4]);
		if ($mostrarNumero=="si" or $mostrarNumero=="SI" or $mostrarNumero=="Si") {
			$telefono=$rw1[5];
		}else {
			$telefono=" ";
		}

		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>".$rw1[1]."</td>
		<td>".$rw1[9]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$telefono."</td>
		<td>".$rw1[6]."</td>

		";
		if($rw1[7]==9){
		echo "<td align='center' >";
		echo "<a  onclick='pop_dis13($id_p,\"Entregar Guias\")';  style='cursor: pointer;' title='Entregar Guias' ><img src='img/caja.png'></a></td>";
		}else if($rw1[7]==10) {		
		echo "<td align='center' >";
	//	echo "<a class='btnPrint' href='imprimir.php?id_param=$id_p&condicion=2'><img src='img/imprimir.png'></a>";
		echo "<a href='ticketfactura.php?id_param=$id_p' target='_blank'><img src='img/imprimir.png'></a>";
		if($nivel_acceso==1){
			echo "<a  onclick='pop_dis13($id_p,\"Entregar Guias\")';  style='cursor: pointer;' title='Entregar Guias' ><img src='img/caja.png'></a></td>";
			
		}else{
			echo "</td>";
		}
		}
		
		echo "<td><div id='campo$va'>"; if($rw1[8]==1){ $st="SI"; $colorfondo="#074f91"; } else { $st="NO"; $colorfondo="#941727"; } 
		echo "<select  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  name='param14' id='param14'  onChange='cambio_ajax2(this.value, 70, \"campo$va\", \"$va\", 1, $id_p)'  required>";
		$LT->llenaselect_ar($st,$estado_rec);
		echo "</select></div></td>";
		
		
	echo "</tr>"; 
	}



?>
