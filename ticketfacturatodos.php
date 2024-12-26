<?php
require("login_autentica.php"); 
//require_once("expdf/lib/pdf/mpdf.php");  
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$id_sedes=$_SESSION['usu_idsede'];
include 'barcode.php';
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$DB2 = new DB_mssql;
$DB2->conectar();
$tiposervicio="";
if(isset($pagina2)) { $pagina2=$_REQUEST["pagina2"]; 

} 
else {
  $pagina2=$_REQUEST["pagina2"];

}

?>


  <link rel="stylesheet" href="css/imprimir.css">
      <style type="text/css">
        #imagen {
			width: 480px;
        }
    </style>
 <?php
// Haciendo la conversión y descarga de la imagen al presionar el botón
//$('#boton-descarga').click(function() {
  
//});
$date=date("Y-m-d");

$sql2="SELECT `idsedes`, `sed_nombre`, `sed_telefono`, `sed_direccion` FROM `sedes` WHERE idsedes=$id_sedes";
$DB1->Execute($sql2);
$rw2=mysqli_fetch_array($DB1->Consulta_ID);	



 $sql="SELECT `idclientes`,`ser_consecutivo`, `cli_nombre`,  `ser_destinatario`, `ser_telefonocontacto`,`ciu_nombre`,
 `ser_direccioncontacto`, `ser_paquetedescripcion`, `ser_piezas`,`ser_clasificacion`, `ser_valorprestamo`, 
 `ser_valorabono`, `ser_valorseguro`,`ser_resolucion`, `ser_pendientecobrar`,ser_valor,ser_peso,`cli_idciudad`,`ser_ciudadentrega`,
 `ser_tipopaq` ,`cli_telefono`, `cli_direccion`,ser_volumen,ser_verificado,ser_prioridad,ser_guiare,ser_estado,ser_devolverreci,ser_fecharegistro,ser_descripcion   FROM serviciosdia where idservicios=$id_param ";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	

if ($rw[16]<=30) {
	$pesok="Transporte de carga";
	$sies30kg="<p>Servicio de carga 30 kilos</p>";
}else {
	$pesok=$rw[16];
	$sies30kg="";
}

$sql3="SELECT `ciu_nombre`, `cli_iddocumento` FROM `clientes` inner join clientesdir on cli_idclientes=idclientes inner join ciudades on idciudades=cli_idciudad WHERE idclientes=$rw[0]";
$DB2->Execute($sql3);
$rw3=mysqli_fetch_array($DB2->Consulta_ID);	


 $sql5="SELECT `cli_iddocumento` FROM `clientes` inner join clientesdir on cli_idclientes=idclientes  WHERE cli_telefono='$rw[4]'";
$DB1->Execute($sql5);
$rw5=mysqli_fetch_array($DB1->Consulta_ID);	

$planillas=explode("/",$rw[1]);

@$rw[9]=$tipopago[$rw[9]];
$rw[6]=str_replace("&"," ", $rw[6]);
$rw[21]=str_replace("&"," ", $rw[21]);
$rw[10]=str_replace(".","", $rw[10]);
$rw[12]=str_replace(".","", $rw[12]);
$abono=str_replace(".","", $rw[11]);
$seguro=($rw[12]*1)/100;
if($rw[26]>=10){
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
 	$html ="
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
		<td class='columna2'>$rw[2]</td>
        </tr>
        <tr>
          <th class='columna1'>T&Eacute;LEFONO:</th>
          <td class='columna2'>*******</td>
        </tr>
        <tr>
          <th class='columna1'>CIUDAD:</th>
          <td class='columna2'>$rw3[0]</td>
        </tr>
        <tr>
          <th class='columna1'>DIRECCI&Oacute;N:</th>
          <td class='columna2'>$rw[21]</td>
        </tr>
		<tr>
          <th class='columna1'>CC/NIT:</th>
          <td class='columna2'>$rw3[1]</td>
        </tr>
		";
	//	$html.=  "<tr><th class='columna1'>---------------------</th><td class='columna2'>--------------------</td></td></tr>";
		$html.=  "<tr><th class='columna1'>DESTINATARIO:</th>
		<td class='columna2'>  &nbsp $rw[3]</td>
        </tr>
        <tr>
          <th class='columna1'>T&Eacute;LEFONO:</th>
          <td class='columna2'>*******</td>
        </tr>
        <tr>
          <th class='columna1'>CIUDAD:</th>
          <td class='columna2'>$rw[5]</td>
        </tr>
        <tr>
          <th class='columna1'>DIRECCI&Oacute;N:</th>
          <td class='columna2'>$rw[6]</td>
        </tr>
		<tr>
          <th class='columna1'>CC/NIT:</th>
          <td class='columna2'>$rw5[0]</td>
        </tr>
		";
   	//	$html.=  "<tr><th class='columna1'>---------------------</th><td class='columna2'>--------------------</td></td></tr>";
       
	   $cond="&#9633"; $cond1="&#9633"; 
	  if($rw[23]==1 ){$cond="&#9632;";} else if($rw[23]==0) {$cond1="&#9632;";} else { $cond="&#9633;"; $cond1="&#9633;";  }
	$credito=$rw[9];
	$sqls="SELECT tip_nom FROM `tiposervicio` inner join guias on gui_tiposervicio=idtiposervicio where gui_idservicio=$id_param ";
	$DB->Execute($sqls);
	 $tiposervicio=$DB->recogedato(0);
	 if($tiposervicio==''){
		$tiposervicio='Carga via terrestre';
	 }

    if($rw[9]=='Credito'){ 
      $sqlc="SELECT rel_nom_credito FROM `rel_sercre` where idservicio=$id_param ";
      $DB->Execute($sqlc);
       $creditouser=$DB->recogedato(0);
	  $credito=$rw[9]."/ ".$creditouser;  

    }
	$sqld="SELECT pag_estado FROM `pagoscuentas` WHERE pag_idservicio ='$id_param' ";
	$DB->Execute($sqld);
	 $estadopago=$DB->recogedato(0);
	 if($estadopago=="Pendiente X cobrar"){
		$estadopagof="Este servicio no a sido pagado";

	 }else{

		$estadopagof="";

	 }
	  
	   $html.= "
	   <tr>
          <th class='columna1'>TIPO:</th>
          <td class='columna2'>$rw[19]</td>
        </tr>
	   <tr>
          <th class='columna1'>DICE CONTENER:</th>
          <td class='columna2'>$rw[7]</td>
        </tr>
        <tr>
          <th class='columna1'>PIEZAS:</th>
          <td class='columna2'>$rw[8]</td>
        </tr>
        <tr>
          <th class='columna1'>TIPO PAGO:</th>
          <td class='columna2'>$credito / $estadopagof</td>
		</tr>
		<tr>
        <th class='columna1'>TIPO SERVICIO:</th>
        <td class='columna2'>$tiposervicio</td>
      </tr>
		<tr>
			  <th class='columna1'>PESO Kg:</th>
			  <td class='columna2'>$pesok</td>
		</tr>		
		<tr>
			  <th class='columna1'>VOLUMEN:</th>
			  <td class='columna2'>$rw[22]</td>
		</tr>
		<tr>
			  <th class='columna1'>VERIFICADO:</th>
			  <td class='columna2'>SI   $cond NO  $cond1 </td>
		</tr>
		";
		
		$estadopaquete=$rw[29];
		$html.=" <tr><td colspan=2 class='columna3' >
	<p><b> ¡ESTADO DEL PAQUETE!</strike>
	<br>$estadopaquete</b></p>
	</td>
	</tr>";  

		$html2="";


		 $sql="SELECT `pre_porcentaje` FROM `prestamo` WHERE `pre_inicio`<'$rw[10]' and `pre_final`>='$rw[10]'";
		$DB->Execute($sql);
		 $porprestamo=$DB->recogedato(0);
		
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


/* 			if($rw[9]=='Credito'){
				$rw[15]=0;
				$totalflete=0;
				$totalfinal=0;
			} */
		$totaldevolucion=$totalfinal* -1;
		$totaldevolucion=number_format($totaldevolucion,0,".",".");
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
			  <td colspan=2  class='columna3' >VALOR COMPRA: $ $rw[10]</td>
			</tr>
			<tr>
			  <td colspan=2  class='columna3' >COBRO COMPRA: $ $porprestamo</td>
			</tr>
			<tr>
			  <td colspan=2  class='columna3' >ABONO: $ $abono</td>
			</tr>
			<tr>
			  <td colspan=2  class='columna3'style='font-size:22px;text-align:center;' >TOTAL FLETE + COMPRA:  $totalfinal</td>
			</tr>";	
			if($rw[26]>=6 and $totalfinal<1){
				
				$html2.="<tr>
				<td colspan=2  class='columna3'style='font-size:22px;text-align:center;' >DEVOLUCION:  $totaldevolucion</td>
			  </tr>";
			}
			$html.=" <tr><td colspan=2 class='columna3' >
			<p><b> ¡EL VALOR DECLARADO DEL  ENVIO ES: $ $rw[12]!</strike>
			</td>
			</tr>"; 
			$html.="
			<tr>
			   <td colspan=2  class='columna3' > VALOR SEGURO: $ $seguro</td>
			</tr>
			<tr>
			  <td colspan=2  class='columna3' > VALOR FLETE: $ $rw[15]</td>
			</tr>
			<tr>
			<td colspan=2  class='columna3' style='font-size:22px;text-align:center;' >  TOTAL FLETE: $totalflete</td>
			</tr>

			";	
			
			if($rw[27]==1){
				$html.=" <tr><td colspan=2  class='columna3' style='font-size:26px;text-align:center;'  ><strike><b>¡OJO! DEVOLVER RECIBIDO.</b> </strike> </td></tr>"; 
			}
		
		//}
	
				
				if($rw[16]<=0){ $html.=" <tr><td colspan=2  class='columna3' >PENDIENTE POR LIQUIDAR EN LA OFICINA. </td></tr>"; }

     $html.=" <tr><td colspan=2 class='columna3' >
					<p> ¡GRACIAS POR SU CONFIANZA!
					<br>El cliente acepta las condiciones de transporte
					<br>consulte nuestra politica de contrato en www.transmillas.com/politica.php</p>
				</td>

			</tr>"; 

			$html.="<tr><td colspan=2 class='columna3'>$sies30kg</td></tr>"; 

	   
	   if($rw[26]<=8){

		$html.="<tr><td colspan=2 class='columna4' >
		<br> FIRMA REMITENTE:_________________________</br>
		   <br>CC/NIT: __________________________________</br>     
		  </td> </tr>";
	  
	   }else{
			$html.="<tr><td colspan=2 class='columna4' >	  
		   <br>FIRMA DESTINATARIO: ______________________</br>
			   <br>CC/NIT: __________________________________</br>
			  </td> </tr>";
	   }

		$html.=$html2;
		$html.="</tbody>
		</table>
		
		 </div>";
     $code = $rw[1];
     $data=$code;

     barcode('phpqrcode/temp/'.$code.'.png', $code, 60, 'horizontal', 'code128', true);	
     //$pdf->Image('temp/'.$code.'.png',4,$y,60,0,'PNG');
    
     $html.= "<div>
     <img src='phpqrcode/temp/$code.png'  style='width:73%;' alt='codigobarras'>
     </div>";
  ?>
  <body>
  <input id="factura" name="factura" type="hidden" value="<?php echo $rw[1]; ?>">
    <div id="imagen">
		<?php echo $html; ?>
    </div>

</body>


 