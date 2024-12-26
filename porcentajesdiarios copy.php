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

$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde4)", "", "$id_sedes", 1, 1);
$FB->llena_texto("Fecha de Busqueda:", 2, 10, $DB, "", "", "$fechaactual", 4, 0);

$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

//$FB->titulo_azul1("Reasignar",1,0,0); 
//$FB->titulo_azul3("Validar",2,0,2,$param_edicion);

$conde3=""; 
$html="";

$html=  '</table>
  <div id="contenedor" style="display:flex;height:415px; overflow: scroll;">

   <div id="segundo" style="width: 34%; float:left;">';
  

	   $sql="SELECT `idcuentaspromotor`, `cue_numeroguia`,'RECOGIDA' as estado,cue_tipoevento, cue_tipo,cue_valorflete,cue_porcentajerecogida,cue_porcentajeentrega,cue_kilostotal
	  FROM cuentaspromotor  where cue_estado in (4,6,14,7,8,9,10)  and cue_fecharecogida like '$param2%' and cue_idciudadori in $ciudades and cue_tipoevento=1
	  UNION
	  SELECT `idcuentaspromotor`, `cue_numeroguia`,'ENTREGA' as estado,cue_tipoevento, cue_tipo,cue_valorflete,cue_porcentajerecogida,cue_porcentajeentrega,cue_kilostotal
	  FROM cuentaspromotor  where  cue_estado in (10) and  cue_fecha like '$param2%' and cue_idciudaddes in $ciudades and cue_tipoevento=1
	   ORDER BY idcuentaspromotor desc ";
	 $DB->Execute($sql); $va=0; 
	 
	 while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	 {
		 $id_p=$rw1[0];
		 
		 $va++; $p=$va%2;
		 if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

		 $estado=$estado_guia[$rw1[2]];
		 $estado=$rw1[2];
		 $estapaquetedo=$rw1[3];
		 $kilos=$rw1[7];
		 if($estapaquetedo=='0'){
			 $sql1="SELECT ser_tipopaq,(ser_peso+ser_volumen) as kilos from servicios where ser_guiare='$rw1[1]'";
			$DB1->Execute($sql1);
			$rw2=mysqli_fetch_row($DB1->Consulta_ID);
			$estapaquetedo=$rw2[0];
			$kilos=$rw2[1];
		 }

		 $valorporcentaje=0;
		 if($rw1[4]>0){
			 $sql6="SELECT `idporcentajespaquetes`, `por_porcentaje` FROM `porcentajespaquetes`  WHERE  por_idsede='$param1' and por_tiposervicio='Contado' and '$kilos'>=por_kilosgramosmin and '$kilos'<=por_kilogramosmaximo and (por_idpaquete='$estapaquetedo' or por_idpaquete='') order by idporcentajespaquetes desc limit 1";
			 $DB1->Execute($sql6);
			 $porcentaje=$DB1->recogedato(1);
		     $valorporcentaje=($rw1[4]*$porcentaje)/100;
		 }

		 $html1.= "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		 $html1.=  "
		 <td>".$rw1[1]."</td>
		 <td>".$estado."</td>
		 <td>".$kilos."</td>
		 <td>".$rw1[4]."</td>
		 <td>".$valorporcentaje."</td>
		 ";

		$sumavalor=$rw1[4]+$sumavalor;
		$sumaporcentaje=$valorporcentaje+$sumaporcentaje;

	 }

	 $html.= '<table class="table table-hover"><tr bgcolor="#868A08" class="tittle3"><td>Guias Contado</td></tr><tr><td>';
/* 
 	$FB->titulo_azul1("Guia",1,0,7); 
	$FB->titulo_azul1("Estado",1,0,0); 
	$FB->titulo_azul1("Kilos",1,0,0); 
	$FB->titulo_azul1("Valor",1,0,0); 
	$FB->titulo_azul1("Porcentaje",1,0,0);  */
	//echo $html1;
	$html2= '</table></td></tr></table></div>

   <div id="tercero" style="width: 33%; float:left;">';



		$sql="SELECT `idcuentaspromotor`, `cue_numeroguia`,'RECOGIDA' as estado, cue_tipo,cue_valorflete,cue_porcentajerecogida,cue_porcentajeentrega,cue_kilostotal
		FROM cuentaspromotor  where cue_estado in (4,6,14,7,8,9,10)  and cue_fecharecogida like '$param2%' and cue_idciudadori in $ciudades and cue_tipoevento=3
		UNION
		SELECT `idcuentaspromotor`, `cue_numeroguia`,'ENTREGA' as estado, cue_tipo,cue_valorflete,cue_porcentajerecogida,cue_porcentajeentrega,cue_kilostotal
		FROM cuentaspromotor  where  cue_estado in (10) and  cue_fecha like '$param2%' and cue_idciudaddes in $ciudades and cue_tipoevento=3
		 ORDER BY idcuentaspromotor desc ";

	 $DB->Execute($sql); $va=0; 
		 while($rw1=mysqli_fetch_row($DB->Consulta_ID))
		 {
			$id_p=$rw1[0];
		 
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
   
			//$estado=$estado_guia[$rw1[2]];
			$estado=$rw1[2];
			$estapaquetedo=$rw1[3];
			$kilos=$rw1[7];
			if($estapaquetedo=='0'){
				$sql1="SELECT ser_tipopaq,(ser_peso+ser_volumen) as kilos from servicios where ser_guiare='$rw1[1]'";
			   $DB1->Execute($sql1);
			   $rw2=mysqli_fetch_row($DB1->Consulta_ID);
			   $estapaquetedo=$rw2[0];
			   $kilos=$rw2[1];
			}
   
			$valorporcentaje=0;
			if($rw1[4]>0){
				$sql6="SELECT `idporcentajespaquetes`, `por_porcentaje` FROM `porcentajespaquetes`  WHERE  por_idsede='$param1' and por_tiposervicio='Al Cobro' and '$kilos'>=por_kilosgramosmin and '$kilos'<=por_kilogramosmaximo and (por_idpaquete='$estapaquetedo' or por_idpaquete='') order by idporcentajespaquetes desc limit 1";
				$DB1->Execute($sql6);
				$porcentaje=$DB1->recogedato(1);
				$valorporcentaje=($rw1[4]*$porcentaje)/100;
			}
   
			$html3.= "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			$html3.= "
			<td>".$rw1[1]."</td>
			<td>".$estado."</td>
			<td>".$kilos."</td>
			<td>".$rw1[4]."</td>
			<td>".$valorporcentaje."</td>
			";

			$sumavalor2=$rw1[4]+$sumavalor2;
			$sumaporcentaje2=$valorporcentaje+$sumaporcentaje2;

		 }
		 $html2.= '<table class="table table-hover"><tr bgcolor="#04B404" class="tittle3"><td>Guias Al cobro</td></tr><tr><td>';
		/*  $FB->titulo_azul1("Guia",1,0,7); 
		 $FB->titulo_azul1("Estado",1,0,0); 
		 $FB->titulo_azul1("Paquete",1,0,0); 
		 $FB->titulo_azul1("Valor",1,0,0); 
		 $FB->titulo_azul1("Porcentaje",1,0,0); 
		 echo 	$html2; */

		 $html4.=  '</table></td></tr></table></div>

   <div id="cuarto" style="width: 33%; float:left;">';


		$sql="SELECT `idcuentaspromotor`, `cue_numeroguia`,'RECOGIDA' as estado, cue_tipo,cue_valorflete,cue_porcentajerecogida,cue_porcentajeentrega,cue_kilostotal
		FROM cuentaspromotor  where cue_estado in (4,6,14,7,8,9,10)  and cue_fecharecogida like '$param2%' and cue_idciudadori in $ciudades and cue_tipoevento=2
		UNION
		SELECT `idcuentaspromotor`, `cue_numeroguia`,'ENTREGA' as estado, cue_tipo,cue_valorflete,cue_porcentajerecogida,cue_porcentajeentrega,cue_kilostotal
		FROM cuentaspromotor  where  cue_estado in (10) and  cue_fecha like '$param2%' and cue_idciudaddes in $ciudades and cue_tipoevento=2
		 ORDER BY idcuentaspromotor desc "; 
	  $DB->Execute($sql); $va=0; 
		  while($rw1=mysqli_fetch_row($DB->Consulta_ID))
		  {
			$id_p=$rw1[0];
		 
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
   
			//$estado=$estado_guia[$rw1[2]];
			$estado=$rw1[2];
			$estapaquetedo=$rw1[3];
			$kilos=$rw1[7];
			if($estapaquetedo=='0'){
				$sql1="SELECT ser_tipopaq,(ser_peso+ser_volumen) as kilos from servicios where ser_guiare='$rw1[1]'";
			   $DB1->Execute($sql1);
			   $rw2=mysqli_fetch_row($DB1->Consulta_ID);
			   $estapaquetedo=$rw2[0];
			   $kilos=$rw2[1];
			}
   
			$valorporcentaje=0;
			if($rw1[4]>0){
				$sql6="SELECT `idporcentajespaquetes`, `por_porcentaje` FROM `porcentajespaquetes`  WHERE  por_idsede='$param1' and por_tiposervicio='Credito' and '$kilos'>=por_kilosgramosmin and '$kilos'<=por_kilogramosmaximo and (por_idpaquete='$estapaquetedo' or por_idpaquete='') order by idporcentajespaquetes desc limit 1";
				$DB1->Execute($sql6);
				$porcentaje=$DB1->recogedato(1);
				$valorporcentaje=($rw1[4]*$porcentaje)/100;
			}
   
			$html5.= "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			$html5.= "
			<td>".$rw1[1]."</td>
			<td>".$estado."</td>
			<td>".$kilos."</td>
			<td>".$rw1[4]."</td>
			<td>".$valorporcentaje."</td>
			";

			$sumavalor3=$rw1[4]+$sumavalor3;
			$sumaporcentaje3=$valorporcentaje+$sumaporcentaje3;

		  }

		  $html4.=  '<table class="table table-hover"><tr bgcolor="#FF4000" class="tittle3"><td>Guias Credito</td></tr><tr><td>';
		//  echo 	$html3;	  
	$html5.=  '</table></td></tr></table></div>
</div>';

 $total=$sumavalor+$sumavalor2+$sumavalor3;
 $totalporcentaje=$sumaporcentaje+$sumaporcentaje2+$sumaporcentaje3;

$FB->titulo_azul1("Contado",1,0,7); 
$FB->titulo_azul1("$sumavalor",1,0,0); 
$FB->titulo_azul1("Porcentaje",1,0,0); 
$FB->titulo_azul1("$sumaporcentaje",1,0,0); 
$FB->titulo_azul1("AL cobro",1,0,0); 
$FB->titulo_azul1("$sumavalor2",1,0,0); 
$FB->titulo_azul1("Porcentaje",1,0,0); 
$FB->titulo_azul1("$sumaporcentaje2",1,0,0); 
$FB->titulo_azul1("Credito",1,0,0); 
$FB->titulo_azul1("$sumavalor3",1,0,0); 
$FB->titulo_azul1("Porcentaje",1,0,0); 
$FB->titulo_azul1("$sumaporcentaje3",1,0,0); 
$FB->titulo_azul1("TOTAL",1,0,0); 
$FB->titulo_azul1("$total",1,0,0); 
$FB->titulo_azul1("Porcentajes",1,0,0); 
$FB->titulo_azul1("$totalporcentaje",1,0,0); 

echo 	$html;
$FB->titulo_azul1("Guia",1,0,7); 
$FB->titulo_azul1("Estado",1,0,0); 
$FB->titulo_azul1("Kilos",1,0,0); 
$FB->titulo_azul1("Valor",1,0,0); 
$FB->titulo_azul1("Porcentaje",1,0,0); 
echo 	$html1;	
echo 	$html2;
$FB->titulo_azul1("Guia",1,0,7); 
$FB->titulo_azul1("Estado",1,0,0); 
$FB->titulo_azul1("Kilos",1,0,0); 
$FB->titulo_azul1("Valor",1,0,0); 
$FB->titulo_azul1("Porcentaje",1,0,0); 
echo 	$html3;	
echo 	$html4;
$FB->titulo_azul1("Guia",1,0,7); 
$FB->titulo_azul1("Estado",1,0,0); 
$FB->titulo_azul1("Kilos",1,0,0); 
$FB->titulo_azul1("Valor",1,0,0); 
$FB->titulo_azul1("Porcentaje",1,0,0); 
echo 	$html5;		
include("footer.php");

?>