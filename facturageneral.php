<?php

$html ="";

while($rw=mysqli_fetch_row($DB3->Consulta_ID))
{
 $sql3="SELECT `ciu_nombre`, `cli_iddocumento` FROM `clientes` inner join clientesservicios on cli_idclientes=idclientes inner join ciudades on idciudades=cli_idciudad WHERE idclientes=$rw[0]";
$DB2->Execute($sql3);
$rw3=mysqli_fetch_array($DB2->Consulta_ID);	


$sql2="SELECT `idsedes`, `sed_nombre`, `sed_telefono`, `sed_direccion` FROM `sedes` inner join ciudades on inner_sedes=idsedes WHERE idciudades=$rw[17]";
$DB1->Execute($sql2);
$rw2=mysqli_fetch_array($DB1->Consulta_ID);	 

 $sql5="SELECT `cli_iddocumento` FROM `clientes` inner join clientesservicios on cli_idclientes=idclientes  WHERE cli_telefono='$rw[4]'";
$DB->Execute($sql5);
$rw5=mysqli_fetch_array($DB->Consulta_ID);	 

$planillas=explode("/",$rw[1]);

@$rw[9]=$tipopago[$rw[9]];
$rw[6]=str_replace("&"," ", $rw[6]);
$rw[21]=str_replace("&"," ", $rw[21]);
$rw[10]=str_replace(".","", $rw[10]);
$rw[12]=str_replace(".","", $rw[12]);
$abono=str_replace(".","", $rw[11]);
$seguro=($rw[12]*1)/100;
if($param33!=''){	
	
	if($rw[26]>=9){
		$tipoo='Entrega:';
	}
	else{
		$tipoo='Recoge:';
	}
	$usuguia=$param39; 

}else if($rw[26]>=9){
	$tipoo='Entrega:';
	$sql="SELECT gui_userecomienda FROM `guias` where gui_idservicio=$id_param ";
		$DB->Execute($sql);
		 $usuguia=$DB->recogedato(0);
	}else{
		$tipoo='Recoge:';
		$sql="SELECT gui_recogio FROM `guias` where gui_idservicio=$id_param ";
		$DB->Execute($sql);
		 $usuguia=$DB->recogedato(0);
	}
	$userg = explode(" ", $usuguia);
	$Usuariog=$userg[0]." ".$userg[1];
	 // 

	 $html .="
	 <div id='imprimir' class='ticket'  >
	 <img src='images/logoticket.png' alt='Logotipo'>
	 <p class='centrado'>Transmillas logistica y transportadora S.A.S.
	   <br>NIT:901089478-8
	   <br>SUCURSAL:  $rw2[1] 
	   <br>$rw2[3] TEL : $rw2[2]
		<br>$fechatiempo
	  </p>
	  <table>
		 <tr>
		 <td>
				 <img src='img/politicaweb.png' alt='politica' style='max-width:100%;width:auto;height:auto;'/>
				 </td>
				 <td>
			<div style='font-size:25px;text-align:center;' aling=center >DESTINO: $rw[5]</div>
			<div style='font-size:25px;text-align:center;' aling=center >REMESA #: $rw[1] </div>
			<div style='font-size:25px;text-align:center;' aling=center >REMESA #: $rw[25] </div>
				 </td>
				 </tr>
				 </table>
	  <div style='font-size:25px;text-align:center;' aling=center >$tipoo#: $Usuariog </div>
	 <table>
	   <thead>
		 <tr>
		 </tr>
	   </thead>
	   <tbody>
		 <tr>";

        $html.=  "<tr><th class='columna1'>REMITENTE:</th>
		<td class='columna1'><b>$rw[2]</b></td>
        </tr>
        <tr>
          <th class='columna1'>T&Eacute;LEFONO:</th>
          <td class='columna1'><b>*******</b></td>
        </tr>
        <tr>
          <th class='columna1'>CIUDAD:</th>
          <td class='columna1'><b>$rw3[0]</b></td>
        </tr>
        <tr>
          <th class='columna1'>DIRECCI&Oacute;N:</th>
          <td class='columna1'><b>$rw[21]</b></td>
        </tr>
		<tr>
          <th class='columna1'>CC/NIT:</th>
          <td class='columna1'><b>$rw3[1]</b></td>
        </tr>
		";
	//	$html.=  "<tr><th class='columna1'>---------------------</th><td class='columna1'>--------------------</td></td></tr>";
		$html.=  "<tr><th class='columna1'>DESTINATARIO:</th>
		<td class='columna1'> <b>  $rw[3]</b></td>
        </tr>
        <tr>
          <th class='columna1'>T&Eacute;LEFONO:</th>
          <td class='columna1'><b>*******</b></td>
        </tr>
        <tr>
          <th class='columna1'>CIUDAD:</th>
          <td class='columna1'><b>$rw[5]</b></td>
        </tr>
        <tr>
          <th class='columna1'>DIRECCI&Oacute;N:</th>
          <td class='columna1'><b>$rw[6]</b></td>
        </tr>
		<tr>
          <th class='columna1'>CC/NIT:</th>
          <td class='columna1'><b>$rw5[0]</b></td>
        </tr>
		";
   	//	$html.=  "<tr><th class='columna1'>---------------------</th><td class='columna1'>--------------------</td></td></tr>";
       
	   $cond=" "; $cond1=" "; 
	  if($rw[23]==1 ){$cond="&#9632;";} else if($rw[23]==0) { $cond1="&#9632;";} else { $cond=" "; $cond1=" ";  }
		$credito=$rw[9];
		if($rw[9]=='Credito'){ 
      $sqlc="SELECT rel_nom_credito FROM `rel_sercre` where idservicio=$id_param ";
      $DB->Execute($sqlc);
       $creditouser=$DB->recogedato(0);
			 $credito=$rw[9]."/ ".$creditouser;  
			
    }

	   $html.= "
	   <tr>
          <th class='columna1'>TIPO:</th>
          <td class='columna1'><b>$rw[19]</b></td>
        </tr>
	   <tr>
          <th class='columna1'>DICE CONTENER:</th>
          <td class='columna1'><b>$rw[7]</b></td>
        </tr>
        <tr>
          <th class='columna1'>PIEZAS:</th>
          <td class='columna1'><b>$rw[8]</b></td>
        </tr>
        <tr>
          <th class='columna1'>TIPO PAGO:</th>
          <td class='columna1'><b>$credito</b></td>
        </tr>
		<tr>
			  <th class='columna1'>PESO Kg:</th>
			  <td class='columna1'><b>$rw[16]</b></td>
		</tr>		
		<tr>
			  <th class='columna1'>VOLUMEN:</th>
			  <td class='columna1'><b>$rw[22]</b></td>
		</tr>
		<tr>
			  <th class='columna1'>VERIFICADO:</th>
			  <td class='columna1'><b>SI   $cond NO  $cond1 </b></td>
		</tr>
		";
		
		$html2="";


	 $sql="SELECT `pre_porcentaje` FROM `prestamo` WHERE `pre_inicio`<'$rw[10]' and `pre_final`>='$rw[10]'";
		$DB->Execute($sql);
		 $porprestamo=$DB->recogedato(0);
	//$porprestamo=0;
		$dosporcentaje=explode(" ",$porprestamo); 
		
		if(@$dosporcentaje[1]=='%'){
			
			 $porprestamo=($rw[10]*@$dosporcentaje[0])/100;
		}
		 // echo $porprestamo;
		$totalprestamo=$rw[10]+$porprestamo-$abono;
		$totalflete=$rw[15]+$seguro;
    if($rw[25]>=9 and $rw[9]=='Contado'){
					$totalfinal=$totalprestamo;
			}else {
						if($rw[16]>=1)
						{
						$totalfinal=$totalflete+$totalprestamo;
						}else {
							$totalfinal=0;
							$totalflete=0;
						}
			}
		$totalflete=number_format($totalflete,0,".",".");
		$totalprestamo=number_format($totalprestamo,0,".",".");
		$totalfinal=number_format($totalfinal,0,".",".");
		$porprestamo=number_format($porprestamo,0,".","."); 
		$seguro=number_format($seguro,0,".","."); 
		@$abono=number_format($abono,0,".","."); 
		@$rw[10]=number_format($rw[10],0,".","."); 
		@$rw[15]=number_format($rw[15],0,".","."); 
		@$rw[12]=number_format($rw[12],0,".","."); 
		 
			$html2.="<tr>
			  <th colspan=2  class='columna1' >VALOR COMPRA: $ $rw[10]</th>
			</tr>
			<tr>
			  <th colspan=2  class='columna1' >COBRO COMPRA: $ $porprestamo</th>
			</tr>
			<tr>
			<tr>
			  <th colspan=2  class='columna1' >ABONO: $ $abono</th>
			</tr>
			<tr>
			  <th colspan=2  class='columna1' style='font-size:22px;text-align:center;' >TOTAL FLETE + COMPRA:  $totalfinal</th>
			</tr>
			<tr>
			<th colspan=2  class='columna1' > 
			</br>
			</br>  </th>
			</tr>
			<tr>
			<th colspan=2  class='columna1' > </th>
			</tr>
			<tr>
			</tr>
			";	


			$html.="<tr>
			  <th colspan=2  class='columna1' >VALOR ASEGURADO: $ $rw[12]</th>
			</tr>
			<tr>
			   <th colspan=2  class='columna1' > VALOR SEGURO: $ $seguro</th>
			</tr>
			<tr>
			  <th colspan=2  class='columna1' > VALOR FLETE: $ $rw[15]</th>
			</tr>
			<tr>
			<th colspan=2  class='columna1' style='font-size:22px;text-align:center;' >  TOTAL FLETE: $totalflete</th>
			</tr>
		
			";	

	  if($rw[27]==1){
      $html.=" <tr><td colspan=2  class='columna3' style='font-size:22px;text-align:center;'  ><strike><b>¡OJO! DEVOLVER RECIBIDO.</b> </strike>  </td></tr>"; 
    }
				
				if($rw[16]<=0){ $html.=" <tr><td colspan=2  class='columna3' >PENDIENTE POR LIQUIDAR EN LA OFICINA. </td></tr>"; }

		 $html.=" <tr><td colspan=2  class='columna4' >			 
					<p><b> ¡GRACIAS POR SU CONFIANZA!
					<br>El cliente acepta las condiciones de transporte
					<br>consulte nuestra politica de contrato en:
					<br>www.transmillas.com/politica.php</b></p>
					</td>
			</tr>"; 
  
	   
	   if($rw[26]<=8){

		$html.="<tr><td colspan=2 class='columna4' >
		<p>
		<br> FIRMA REMITENTE: ____________________________</br>
		<br>CC/NIT: ______________________________________</br>     
		</p>
		</td> </tr>";
	  
	   }else{

		$html.="<tr><td colspan=2 class='columna4' >
		<p>  
		<br>FIRMA DESTINATARIO: __________________________</br></br>
		<br>CC/NIT: ______________________________________</br>
		</p>
		</td> </tr>";

	   }
		$html.=$html2;
		$html.="</tbody>
		</table>
		</br>
		</br>
		
		
		 </div>";
		 $code = $rw[1];
     $data=$code;

     barcode('phpqrcode/temp/'.$code.'.png', $code, 60, 'horizontal', 'code128', true);	
     //$pdf->Image('temp/'.$code.'.png',4,$y,60,0,'PNG');
    
     $html.= "<div>
     <img src='phpqrcode/temp/$code.png' style='width:73%;'  alt='codigobarras'>
     </div>";
}	

  ?>
 