<?php 
require("login_autentica.php");
include("cabezote3.php"); 

//if($_REQUEST["asc"]!=""){ $asc=$_REQUEST["asc"]; } else {$asc="ASC"; } $asc2=""; if($asc=="ASC"){ $asc2="DESC";}
$asc="ASC";

$conde=" ";
$conde2=" ";
$conde3=" ";
if($param34!=''){ $fechaactual=$param34." 00:00:00";  }
if($param36!=''){ $fechainicial=$param36." 23:59:59";  }
if($param33!=''){ $conde="and (`cue_idoperador`= '$param33' or  `cue_idoperentrega`= '$param33' )";  }
if($param35!=''){
	
	$id_sedes=$param35; 

	$idcidades=ciudadesedes($id_sedes,$DB);
	if($idcidades=='0'){
		$conde2="";

	}else {
	  $conde2=" and cue_idciudaddes in $idcidades and cue_idoperentrega>0  "; 	
	}	
}


$conde1=""; 
$conde3="and (cue_idoperador>0 )"; 

if($param32!="" and $param31!=""){ 
 $conde1="and $param31 like '%$param32%' "; 
  }else { $conde1="  "; } 

//if($param1==""){ $param1="ser_prioridad"; } c  `cue_idoperador`, `cue_idoperentrega`

//if($param33!=''){ $conde3 =" and (cue_idoperador='$param9' or cue_idoperentrega='$param9'  )"; }
//if($param8!=''){ $conde3 =" and $param8='$param9'"; }

//date(cue_fecharecogida)>='$fechaactual' and  date(cue_fecharecogida)<='$fechainicial'
if($param35!=''){
  $sql="SELECT `idservicios`,cue_fecharecogida,`cue_fecha`,ser_consecutivo,ser_guiare,cue_tipoevento, `cue_valorflete`, `cue_prestamo`,`cue_porprestamo`,`cue_vrdeclarado`, `cue_pordeclarado`,  `cue_abono`,cue_tipopago,cue_validar,cue_usuvalido,ser_estado
 FROM servicios inner join cuentaspromotor on cue_idservicio=idservicios where ser_estado>='7' and ser_estado<='14' and cue_validar=0 $conde $conde1 $conde2   $conde3 ORDER BY ser_guiare  $asc ";
}
$totalcontado=0;
$totalalcobro=0;
$totalcredito=0;
$totalprestamo=0;
$totalporprestamo=0;
$totalseguro=0;
$totalporseguro=0;
$totalabono=0;
$totaltotales=0;
$html1= "";
$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		$html1.= "<tr class='text' id='$rw1[3]' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		//$direc1=str_replace("&"," ", $rw1[4]);
		//$direct2=str_replace("&"," ", $rw1[7]);


		$html1.=  "<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		";

		if($rw1[5]==1){  //contado
		$totalcontado=$rw1[6]+$totalcontado;
		$html1.="<td>$ ".$rw1[6]."</td>
		<td>$ 0</td>
		<td>$ 0</td>
		";	
			
		}else if($rw1[5]==2){  //credito
			
			$totalcredito=$rw1[6]+$totalcredito;
			$html1.=  "<td>$ 0</td>
		<td>$ ".$rw1[6]."</td>
		<td>$ 0</td>
		";
		
		}else if($rw1[5]==3){  //al cobro
			
			$totalalcobro=$rw1[6]+$totalalcobro;
			$html1.=  "<td>$ 0</td>
		<td>$ 0</td>
		<td>$".$rw1[6]."</td>
		";
		
		}else {
			$html1.=  "<td>$ 0</td>
		<td>$ 0</td>
		<td>$ 0</td>
		";
		}

		$totalprestamo=$rw1[7]+$totalprestamo;
		$totalporprestamo=$rw1[8]+$totalporprestamo;
		$totalseguro=$rw1[9]+$totalseguro;
		$totalporseguro=$rw1[10]+$totalporseguro;
		$totalabono=$rw1[11]+$totalabono;
		$html1.=  "
		<td>$ ".$rw1[7]."</td>
		<td>$ ".$rw1[8]."</td>
		<td>$ ".$rw1[9]."</td>
		<td>$ ".$rw1[10]."</td>
		<td>$ ".$rw1[11]."</td>

		";
		
		$totales=$rw1[6]+$rw1[7]+$rw1[8]+$rw1[10];
		$totaltotales=$totales+$totaltotales;

		$html1.=  "<td> $".$totales."</td><td> ".$rw1[12]."</td><td> ".$estado_guia[$rw1[15]]."</td>";
		$html1.=  "<td><div id='campo$va'>";
		 if($rw1[13]==1){ $st="SI"; $colorfondo="#074f91"; } else { $st="NO"; $colorfondo="#941727"; } 
		$html1.=  "<select  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  name='param14' id='param14'  onChange='cambio_ajax2(this.value,72, \"campo$va\", \"$va\", 1, $id_p)'  required>";
		$html1.=$LT->llenaselect_re($st,$estado_rec);
			$html1.=  "</select></div></td>";
		
		//echo "<td> ".$rw1[14]."</td>";
		
		$html1.=  "<td align='center' ><a  onclick='pop_dis5($id_p,\"Recogidas\")';  style='cursor: pointer;' title='Recogidas' ><img src='img/recogidas.png'></a></td>";
		$html1.=  "</tr>"; 
	}

	$totalcontado=number_format($totalcontado,0,".",".");
	$totalcredito=number_format($totalcredito,0,".",".");
	$totalalcobro=number_format($totalalcobro,0,".",".");
	$totalprestamo=number_format($totalprestamo,0,".",".");
	$totalporprestamo=number_format($totalporprestamo,0,".",".");
	$totalporseguro=number_format($totalporseguro,0,".",".");
	$totalabono=number_format($totalabono,0,".",".");
	$totaltotales=number_format($totaltotales,0,".",".");

	$FB->titulo_azul1("Total GUIAS: $va",1,0,7); 

	$FB->titulo_azul1("Total CONTADO: $totalcontado",1,0,0); 
	$FB->titulo_azul1("Total CREDITOS: $totalcredito",1,0,0); 
	$FB->titulo_azul1("Total ALCOBRO: $totalalcobro",1,0,0); 
	$FB->titulo_azul1("Total PRESTAMOS: $totalprestamo",1,0,0); 
	$FB->titulo_azul1("Total %PRESTAMOS: $totalporprestamo",1,0,0); 
	$FB->titulo_azul1("Total %SEGUROS: $totalporseguro",1,0,0); 
	$FB->titulo_azul1("Total ABONOS: $totalabono",1,0,0); 
	$FB->titulo_azul1("Total DINERO GUIAS: $totaltotales ",1,0,0); 


$FB->titulo_azul1("Fecha Recogida ",1,0,7); 
$FB->titulo_azul1("Fecha Entrega",1,0,0); 
$FB->titulo_azul1("#Guia",1,0,0); 
$FB->titulo_azul1("Pre-guia",1,0,0); 

$FB->titulo_azul1("Contado",1,0,0); 
$FB->titulo_azul1("Credito",1,0,0); 
$FB->titulo_azul1("AL Cobro",1,0,0); 
$FB->titulo_azul1("Prestamos",1,0,0); 
$FB->titulo_azul1("%Pre.",1,0,0); 
$FB->titulo_azul1("Seguro",1,0,0); 
$FB->titulo_azul1("%Seguro",1,0,0); 
$FB->titulo_azul1("Abonos",1,0,0); 

$FB->titulo_azul1("Total Guia",1,0,0); 

$FB->titulo_azul1("Servicio",1,0,0); 
$FB->titulo_azul1("Estado",1,0,0); 

$FB->titulo_azul1("Validar",1,0,0); 
//$FB->titulo_azul1("Validado Por",1,0,0); 

$FB->titulo_azul1("Datos",1,0,0); 

	echo $html1;
//	echo "<tr><td align='center' > Total Datos:$va</td>"; 
	
	//echo "</tr>"; 

	$FB->titulo_azul1("Total GUIAS: $va",1,0,7); 

	$FB->titulo_azul1("Total CONTADO: $totalcontado",1,0,0); 
	$FB->titulo_azul1("Total CREDITOS: $totalcredito",1,0,0); 
	$FB->titulo_azul1("Total ALCOBRO: $totalalcobro",1,0,0); 
	$FB->titulo_azul1("Total PRESTAMOS: $totalprestamo",1,0,0); 
	$FB->titulo_azul1("Total %PRESTAMOS: $totalporprestamo",1,0,0); 
	$FB->titulo_azul1("Total %SEGUROS: $totalporseguro",1,0,0); 
	$FB->titulo_azul1("Total ABONOS: $totalabono",1,0,0); 
	$FB->titulo_azul1("Total DINERO GUIAS: $totaltotales ",1,0,0); 

include("footer.php");
?>