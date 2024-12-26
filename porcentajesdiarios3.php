<?php 
require("login_autentica.php"); 
include("layout.php");
include("cabezote4.php"); 

?>
<head>
<script>
function buscarsede(dato)
{

	p1=document.getElementById('param1').value;
	p2=document.getElementById('param2').value;

	p6=document.getElementById('param6').value;
	p5=document.getElementById('param5').value;
	p4=document.getElementById('param4').value;
	if(dato==3){
		destino="ticketfacturatodos3.php?param1="+p1+"&param2="+p2+"&param4="+p4+"&param5="+p5+"&param6="+p6;
	
	}

	window.location=destino;
	
}


</script>
</head>

<body onload="">

<?php 

if($nivel_acceso==1 or $nivel_acceso==10 or $nivel_acceso==9){ $conde2="";  } else { $conde2=" and idsedes=$id_sedes";  }
if($param1!=''){ 
	$id_sedes=$param1; 
	$idcidades=ciudadesedes($param1,$DB);
	if($idcidades=='0'){
		$conde1="";

	}else {
	  $ciudades=$idcidades; 	
	}
} else {  

	$idcidades=ciudadesedes($id_sedes,$DB);
	if($idcidades=='0'){
		$ciudades="";

	}else {
	$ciudades=$idcidades; 	
	}

}

$FB->abre_form("form1","","post");
$FB->titulo_azul1("Porcentajes Guias Diarias",9,0,5);  
$FB->abre_form("form1","","post");

$conde="and ser_fechaguia like '$fechaactual%'"; 

if($param2!=''){ $conde="and ser_fechaguia like '$param2%' ";  $fechaactual=$param2;  }else{ $param2=$fechaactual; }
if($param3!=''){  $fechafinal=$param3; }else{  $fechafinal=$fechaactual; }
$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde4)", "", "$id_sedes", 1, 1);
$FB->llena_texto("Fecha de inicio:", 2, 10, $DB, "", "", "$fechaactual", 4, 0);
$FB->llena_texto("Fecha de Fin:", 3, 10, $DB, "", "", "$fechafinal", 4, 0);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

$conde3=""; 
$html="";

if($param1!=''){ 

/* 	 $sql23="CREATE  TABLE cuentaspromotor2 as  SELECT `idcuentaspromotor`, `cue_numeroguia`,cue_tipoevento, cue_idservicio,cue_valorflete,cue_kilostotal,cue_transferencia,inner_sedes,cue_estado,cue_fecharecogida,cue_fecha,cue_idciudaddes,cue_idciudadori
	FROM cuentaspromotor inner join ciudades on idciudades=cue_idciudadori  where   cue_estado in (4,6,14,7,8,9,10) and ((cue_fecha>='2022-09-01 00:00:00' and cue_fecha<='2022-12-05 23:59:59') or (cue_fecharecogida>='2022-09-01' and cue_fecharecogida<='2022-12-05 23:59:59'))
	ORDER BY cue_tipoevento,idcuentaspromotor desc";
	$DB1->Execute($sql23);	

	$sql24="CREATE TABLE kilostotal as SELECT (ser_peso+ser_volumen) as kilos,ser_guiare from servicios where idservicios in (select cue_idservicio from cuentaspromotor2)";
	$DB1->Execute($sql24); */	
}
$html=  '</table>
  <div id="contenedor" style="display:flex;height:415px; overflow: scroll;">
   <div id="segundo" style="width: 74%; float:left;">';

	$sql="SELECT `idcuentaspromotor`, `cue_numeroguia`,cue_tipoevento, cue_idservicio,cue_valorflete,cue_kilostotal,cue_transferencia,inner_sedes from  cuentaspromotor2 where cue_estado in (10) and  cue_fecha like '$param2%' and cue_idciudaddes in $ciudades ";
	$DB->Execute($sql); $va=0; 
	 
	 while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	 {
		 $id_p=$rw1[0];
		 $va++; $p=$va%2;
		 if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		 
		 //$estado=$estado_guia[$rw1[2]];
		 $estado=$rw1[2];
		 if($estado=='Contado' and $rw1[6]!='Efectivo' and $rw1[6]!=''){
			$estado=$rw1[6];
		 }

		 $tipopago1=$tipopago[$rw1[2]];
		 $kilos=$rw1[5];

		 $sql32="Select gui_tiposervicio,tip_nom from guias inner join tiposervicio on idtiposervicio=gui_tiposervicio WHERE `gui_idservicio`='$rw1[3]'"; 
		 $DB1->Execute($sql32);
		 $rw6=mysqli_fetch_row($DB1->Consulta_ID); 

		 if($kilos=='0'  or $kilos==''){
			//select gui_tiposervicio from guias
			 $sql1="SELECT  kilos from kilostotal where ser_guiare='$rw1[1]'";
			$DB1->Execute($sql1);
			$rw2=mysqli_fetch_row($DB1->Consulta_ID); 
			$kilos=$rw2[0];
			//$kilos=4;
		 }

		 $valorporcentaje=0;
		 if($rw1[4]>0){
			 $sql6="SELECT `idporcentajespaquetes`, `por_porcentaje`,por_porcentajeempresa FROM `porcentajespaquetes`  WHERE  por_idsede='$param1'  and por_idsededestino='$rw1[7]' and por_tiposervicio='$tipopago1' and '$kilos'>=por_kilosgramosmin and '$kilos'<=por_kilogramosmaximo and (por_idpaquete='$rw6[0]' or por_idpaquete='') order by idporcentajespaquetes desc limit 1";
			 $DB1->Execute($sql6);

			 $rw3=mysqli_fetch_row($DB1->Consulta_ID);
			 $porcentaje=$rw3[1];
			 $porempresa=$rw3[2];
		     $valorporcentaje=($rw1[4]*$porcentaje)/100;
		     $valorporempresa=($rw1[4]*$porempresa)/100;
		 }

		 if($rw6[1]=='' or $rw6[1]=='0'){
			$rw6[1]='Carga via terrestre';
		 }elseif($rw6[1]=='1000')
		 {
			$rw6[1]='A convenir';
		 }

		 if($porcentaje==0 or $porcentaje==''){ $color="#C75644"; }

		 $html1.= "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		 $html1.=  "
		 <td>".$rw1[1]."</td>
		 <td>".$tipopago1."</td>
		 <td>".$rw6[1]."</td>
		 <td>".$kilos."</td>
		 <td>".$rw1[4]."</td>
		 <td>".$porcentaje." %</td>
		 <td>".$valorporcentaje."</td>
		 <td>".$porempresa." %</td>
		 <td>".$valorporempresa."</td>
		 ";

		 $sql2="UPDATE `cuentaspromotor` SET cue_porcentaje='$porcentaje',cue_porempresa='$porempresa',cue_valorporcantaje='$valorporcentaje',cue_valorporempresa='$valorporempresa',cue_kilostotal='$kilos' where cue_idservicio=$rw1[3]";
		 $DB1->Execute($sql2);	

		$sumavalor=$rw1[4]+$sumavalor;
		$sumaporcentaje=$valorporcentaje+$sumaporcentaje;
		$sumaporempresa=$valorporempresa+$sumaporempresa;

	 }

	$html.= '<table class="table table-hover"><tr bgcolor="#868A08" class="tittle3"><td>Guias Entregadas</td></tr><tr><td>';
	$html2= '</table></td></tr></table></div>
	<div id="tercero" style="width: 33%; float:left;">';

	$sql="SELECT `idcuentaspromotor`, `cue_numeroguia`,cue_tipoevento,cue_idservicio,cue_valorflete,cue_kilostotal,cue_transferencia,inner_sedes
	FROM cuentaspromotor2   where cue_estado in (4,6,14,7,8,9,10)  and cue_fecharecogida>='$param2' and cue_fecharecogida<='$param3 23:59:59' and cue_idciudadori in $ciudades and cue_tipoevento=1
	";

	 $DB->Execute($sql); $va=0; 
		 while($rw1=mysqli_fetch_row($DB->Consulta_ID))
		 {
			$id_p=$rw1[0];
		 
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
   
			//$estado=$estado_guia[$rw1[2]];
			$estado=$rw1[2];
			$estapaquetedo=$rw1[3];
			$kilos=$rw1[5];
			if($kilos=='0' or $kilos==''){
				$sql1="SELECT  kilos from kilostotal where ser_guiare='$rw1[1]'";
			   $DB1->Execute($sql1);
			   $rw2=mysqli_fetch_row($DB1->Consulta_ID);	   
			   $kilos=$rw2[0];
			}

			$sql32="Select gui_tiposervicio,tip_nom from guias inner join tiposervicio on idtiposervicio=gui_tiposervicio WHERE `gui_idservicio`='$rw1[4]'"; 
			$DB1->Execute($sql32);
			$rw6=mysqli_fetch_row($DB1->Consulta_ID); 
			$estapaquetedo=$rw6[0];
   
			$valorporcentaje=0;
			if($rw1[4]>0){
				$sql6="SELECT `idporcentajespaquetes`, `por_porcentaje`,por_porcentajeempresa FROM `porcentajespaquetes`  WHERE  por_idsede='$param1' and por_tiposervicio='Contado' and '$kilos'>=por_kilosgramosmin and '$kilos'<=por_kilogramosmaximo and (por_idpaquete='$estapaquetedo' or por_idpaquete='') order by idporcentajespaquetes desc limit 1";
				$rw3=mysqli_fetch_row($DB1->Consulta_ID);
				$porcentaje=$rw3[1];
				$porempresa=$rw3[2];
				$valorporcentaje=($rw1[4]*$porcentaje)/100;
				$valorporempresa=($rw1[4]*$porempresa)/100;
			}
   
			$html3.= "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			$html3.= "
			<td>".$rw1[1]."</td>
			<td>".$kilos."</td>
			<td>".$rw1[4]."</td>
			<td>".$valorporcentaje."</td>
			<td>".$valorporempresa."</td>
			";

		
			$sumavalor2=$rw1[4]+$sumavalor2;
			$sumaporcentaje2=$valorporcentaje+$sumaporcentaje2;

		 }
		 $html2.= '<table class="table table-hover"><tr bgcolor="#04B404" class="tittle3"><td>Guias Recogidas Contado</td></tr><tr><td>';

	$html5.=  '</table></td></tr></table></div>
</div>';

 $total=$sumavalor+$sumavalor2+$sumavalor3;
 $totalporcentaje=$sumaporcentaje+$sumaporcentaje2+$sumaporcentaje3;

$FB->titulo_azul1("Total Guias",1,0,7); 
$FB->titulo_azul1("$sumavalor",1,0,0); 
$FB->titulo_azul1("Total Porcentaje sede",1,0,0); 
$FB->titulo_azul1("$sumaporcentaje",1,0,0); 
$FB->titulo_azul1("Total Porcentaje Empresa",1,0,0); 
$FB->titulo_azul1("$sumaporempresa",1,0,0); 
$FB->titulo_azul1("Total guias contado",1,0,0); 
$FB->titulo_azul1("$sumavalor2",1,0,0); 

echo 	$html;
$FB->titulo_azul1("Guia",1,0,7); 
//$FB->titulo_azul1("Estado",1,0,0); 
$FB->titulo_azul1("Tipo pago",1,0,0); 
$FB->titulo_azul1("Tipo Servicio",1,0,0); 
$FB->titulo_azul1("Kilos",1,0,0); 
$FB->titulo_azul1("Valor Guia",1,0,0); 
$FB->titulo_azul1("Porcentaje",1,0,0); 
$FB->titulo_azul1("Valor %",1,0,0); 
$FB->titulo_azul1("% Empresa",1,0,0); 
$FB->titulo_azul1("Valor %",1,0,0); 
echo 	$html1;	
echo 	$html2;
$FB->titulo_azul1("Guia",1,0,7); 
$FB->titulo_azul1("Kilos",1,0,0); 
$FB->titulo_azul1("Valor",1,0,0); 
$FB->titulo_azul1("% sede",1,0,0); 
$FB->titulo_azul1("% Empresa",1,0,0); 
echo 	$html3;	
	
include("footer.php");

?>