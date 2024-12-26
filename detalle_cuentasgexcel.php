<?php
header('Content-type: application/vnd.ms-excel; charset=utf-8');
header("Content-Disposition: attachment; filename=reporte_general.xls;  charset=utf-8");
header("Pragma: no-cache");
header("Expires: 0");  
require("login_autentica.php");
//include("layout.php");
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();


$asc="ASC";

$conde=" ";
$conde2=" ";
$conde3=" ";
$conde4=" ";
if($param34!=''){ $fechaactual=$param34." 00:00:00";  }
if($param36!=''){ $fechainicial=$param36." 23:59:59";  }
if($param33!=''){ $conde="and (`cue_idoperador`= '$param33' or  `cue_idoperentrega`= '$param33' )";  }
if($param35!=''){ $id_sedes=$param35; 

	$idcidades=ciudadesedes($id_sedes,$DB);
	if($idcidades=='0'){
		$conde2="";

	}else {
	  $conde2=" and (cue_idciudadori in $idcidades )"; 	
	}	
}

if($param38!=''){  

	$idcidadesdes=ciudadesedes($param38,$DB);
	if($idcidadesdes=='0'){
		$conde4="";

	}else {
	  $conde4=" and (ser_ciudadentrega in $idcidadesdes )"; 	
	}	
}
	
 ?>
    <table width="99%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="">
     <tr bgcolor="#F75700">
     <td width="10%"  class=""><div align="center" class="tittle2">Fecha Recogida</div></td>
     <td width="10%"  class=""><div align="center" class="tittle2">Fecha Entrega</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">#Guia</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Pre-guia</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Contado+%</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Credito+%</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">AL Cobro+%</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Prestamos</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">%Pre.</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Seguro</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">%Seguro</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Abonos</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Total Guia</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Servicio</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Destino</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Destinatario</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Direccion</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Telefono</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Piezas</div></td>
	
       </tr>
     <?php	
$conde1=""; 
$conde3="and (cue_idoperador>0 )"; 

if($param32!="" and $param31!=""){ 
 $conde1="and $param31 like '%$param32%' "; 
  }else { $conde1="  "; } 

//if($param1==""){ $param1="ser_prioridad"; } c  `cue_idoperador`, `cue_idoperentrega`

//if($param33!=''){ $conde3 =" and (cue_idoperador='$param9' or cue_idoperentrega='$param9'  )"; }
//if($param8!=''){ $conde3 =" and $param8='$param9'"; }


 $sql="SELECT `idservicios`,cue_fecharecogida,`cue_fecha`,ser_consecutivo,ser_guiare,cue_tipoevento, `cue_valorflete`, `cue_prestamo`,`cue_porprestamo`,`cue_vrdeclarado`, `cue_pordeclarado`,  `cue_abono`,cue_tipopago,cue_validar,cue_usuvalido,ciu_nombre,ser_destinatario,ser_direccioncontacto,ser_telefonocontacto,ser_piezas
 FROM servicios inner join cuentaspromotor on cue_idservicio=idservicios inner join ciudades on ser_ciudadentrega=idciudades  where date(cue_fecharecogida)>='$fechaactual' and  date(cue_fecharecogida)<='$fechainicial' $conde $conde1 $conde2   $conde3 $conde4 ORDER BY ser_guiare  $asc ";

$DB->Execute($sql); 
$va=0; 
$totalcontado=0;
$totalcredito=0;
$totalalcobro=0;
$totalguias=0;
$totalprestamos=0;
$totalporp=0;
$totalseguro=0;
$totalpors=0;
$totalabonos=0;

	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		//$direc1=str_replace("&"," ", $rw1[4]);
		$direct2=str_replace("&"," ", $rw1[17]);


		echo "<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		";

		if($rw1[5]==1){  //contado
			$contado=$rw1[6]+$rw1[10];
		echo "<td>$ ".$contado."</td>
		<td>$ 0</td>
		<td>$ 0</td>
		";	
		
		$totalcontado=$rw1[6]+$rw1[10]+$totalcontado;
			
		}else if($rw1[5]==2){  //credito
			$credito=$rw1[6]+$rw1[10];
		echo "<td>$ 0</td>
		<td>$ ".$credito."</td>
		<td>$ 0</td>
		";
		$totalcredito=$rw1[6]+$rw1[10]+$totalcredito;
		
		}else if($rw1[5]==3){  //al cobro
			$alcobro=$rw1[6]+$rw1[10];
		echo "<td>$ 0</td>
		<td>$ 0</td>
		<td>$".$alcobro."</td>
		";
		$totalalcobro=$rw1[6]+$rw1[10]+$totalalcobro;
		
		}else {
			echo "<td>$ 0</td>
		<td>$ 0</td>
		<td>$ 0</td>
		";
		}
		echo "
		<td>$ ".$rw1[7]."</td>
		<td>$ ".$rw1[8]."</td>
		<td>$ ".$rw1[9]."</td>
		<td>$ ".$rw1[10]."</td>
		<td>$ ".$rw1[11]."</td>
		";
		
		$totalprestamos=$rw1[7]+$totalprestamos;
		$totalporp=$rw1[8]+$totalporp;
		$totalseguro=$rw1[9]+$totalseguro;
		$totalpors=$rw1[10]+$totalpors;
		$totalabonos=$rw1[11]+$totalabonos;
		
		
		$totales=$rw1[6]+$rw1[7]+$rw1[8];

		echo "<td> $".$totales."</td><td> ".$rw1[12]."</td>
		";
		$totalguias=$totales+$totalguias;
		echo "<td> ".$rw1[15]."</td>
		<td> ".$rw1[16]."</td>
		<td> ".$direct2."</td>		
		<td> ".$rw1[18]."</td>
		<td> ".$rw1[19]."</td>
		";

		echo "</tr>"; 
	}
	
?>
   <tr bgcolor="#F75700">
     <td width="10%"  class=""><div align="center" class="tittle2">Totales :</div></td>
     <td width="10%"  class=""><div align="center" class="tittle2">Datos: <?php	echo $va;?></div></td>
	<td width="10%"  class=""><div align="center" class="tittle2"> </div></td>
	<td width="10%"  class=""><div align="center" class="tittle2"> </div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">$<?php	echo $totalcontado;?></div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">$<?php	echo $totalcredito;?></div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">$<?php	echo $totalalcobro;?></div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">$<?php	echo $totalprestamos;?></div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">$<?php	echo $totalporp;?></div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">$<?php	echo $totalseguro;?></div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">$<?php	echo $totalpors;?></div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">$<?php	echo $totalpors;?></div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">$<?php	echo $totalabonos;?></div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">$<?php	echo $totalguias;?></div></td>
	

       </tr>

</table>
