<?php
require("login_autentica.php"); 
require_once("expdf/lib/pdf/mpdf.php");  
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$DB2 = new DB_mssql;
$DB2->conectar();

$date=date("Y-m-d");

 $sql="SELECT `idclientes`,`ser_consecutivo`, `cli_nombre`,  `ser_destinatario`, `ser_telefonocontacto`,`ciu_nombre`,
 `ser_direccioncontacto`, `ser_paquetedescripcion`, `ser_piezas`,`ser_clasificacion`, `ser_valorprestamo`, 
 `ser_valorabono`, `ser_valorseguro`,`ser_resolucion`, `ser_pendientecobrar`,ser_valor,ser_peso,`cli_idciudad`,`ser_ciudadentrega` FROM serviciosdia where idservicios=$id_param ";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	

$planillas=explode("/",$rw[1]);

 $rw[9]=$tipopago[$rw[9]];
$rw[6]=str_replace("&"," ", $rw[6]);
$rw[12]=str_replace(".","", $rw[12]);
$abono=str_replace(".","", $rw[11]);
$seguro=($rw[12]*1)/100;
   // <img src='images/imprimir.png' alt='Logotipo'>
 	$html ="
	<div id='imprimir' class='ticket'  >
    <p class='centrado'>REMESA DE TRANSPORTE
      <br>NIT:901089478-8
      <br>RESOLUCI&Oacute;N:$rw[13]
      <br># DE GUIA:$rw[1]
      <br>$fechatiempo</p>
    <table>
      <thead>
        <tr>
        </tr>
      </thead>
      <tbody>
        <tr>";
        $html.= '<th class="columna1">DESTINATARIO:</th>';
        $html.=  "<td class='columna2'>$rw[3]</td>
        </tr>
        <tr>
          <th class='columna1'>T&eacute;LEFONO:</th>
          <td class='columna2'>$rw[4]</td>
        </tr>
        <tr>
          <th class='columna1'>CIUDAD:</th>
          <td class='columna2'>$rw[5]</td>
        </tr>
        <tr>
          <th class='columna1'>DIRECCI&oacute;N:</th>
          <td class='columna2'>$rw[6]</td>
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
          <td class='columna2'>$rw[9]</td>
        </tr>

		";
		
		if($rw[9]=="Contado" and $rw[14]==0){
		
		
		 $valortotal=$rw[15]+$seguro; 
		$seguro=number_format($seguro,0,".",".");

			
	  $html.="<tr>
			  <th class='columna1'>PRESTAMO:</th>
			  <td class='columna2'>$rw[10]</td>
			</tr>
			<tr>
			  <th class='columna1'>ABONO:</th>
			  <td class='columna2'>$rw[11]</td>
			</tr>
			<tr>
			  <th class='columna1'>Vr DECLARADO:</th>
			  <td class='columna2'>$rw[12]</td>
			</tr> 
			<tr>
			  <th class='columna1'>Peso Kg:</th>
			  <td class='columna2'>$rw[16]</td>
			</tr><tr>
			  <th class='columna1'>Vr Flete:</th>
			  <td class='columna2'>$ $rw1[0]</td>
			</tr>
			<tr>
			  <th class='columna1'>% Vr Declarado:</th>
			  <td class='columna2'>$seguro</td>
			</tr><tr>
			  <th class='columna1'>TOTAL FLETE:</th>
			  <td class='columna2'>$ $valortotal</td>
			</tr>";	
			
		}else if($condicion==2) {

		 
		 		$sql="SELECT `pre_porcentaje` FROM `prestamo` WHERE `pre_inicio`<'$rw[10]' and `pre_final`>='$rw[10]'";
		$DB->Execute($sql);
		$porprestamo=$DB->recogedato(0);
		
		$dosporcentaje=explode(" ",$porprestamo); 
		
		if(@$dosporcentaje[1]=='%'){
			
			$porprestamo=($rw[1]*@$dosporcentaje[0])/100;
		}
		 
		$totalprestamo=$rw[10]+$porprestamo-$abono;
		$totalflete=$rw[15]+$seguro;
		$totalfinal=$totalflete+$totalprestamo;
		$totalflete=number_format($totalflete,0,".",".");
		$totalprestamo=number_format($totalprestamo,0,".",".");
		$totalfinal=number_format($totalfinal,0,".",".");
		$porprestamo=number_format($porprestamo,0,".","."); 
		 
			$html.="<tr>
			  <th class='columna1'>Valor de Prestamo:</th>
			  <td class='columna2'>$ $rw[10]</td>
			</tr><tr>
			  <th class='columna1'>Cobro x Prestamo:</th>
			  <td class='columna2'>$ $porprestamo[0]</td>
			</tr>
			<tr>
			  <th class='columna1'>Abono:</th>
			  <td class='columna2'>-$ $abono</td>
			</tr><tr>
			  <th class='columna1'>TOTAL PRESTAMO:</th>
			  <td class='columna2'>$ $totalprestamo</td>
			</tr>";	

			$html.="<tr>
			  <th class='columna1'>% Vr Declarado:</th>
			  <td class='columna2'>$ $seguro</td>
			</tr><tr>
			  <th class='columna1'>Vr Flete:</th>
			  <td class='columna2'>$ $rw1[0]</td>
			</tr>
			<tr>
			  <th class='columna1'></th>
			  <td class='columna2'></td>
			</tr><tr>
			  <th class='columna1'>TOTAL FLETE:</th>
			  <td class='columna2'>$ $totalflete</td>
			</tr><tr>
			  <th class='columna1'>TOTAL A PAGAR:</th>
			  <td class='columna2'>$ $totalfinal</td>
			</tr>";	

		}
		else {
				$html.="<tr>
				  <th class='columna1'>PRESTAMO:</th>
				  <td class='columna2'>$rw[10]</td>
				</tr>
				<tr>
				  <th class='columna1'>ABONO:</th>
				  <td class='columna2'>$rw[11]</td>
				</tr>
				<tr>
				  <th class='columna1'>Vr DECLARADO:</th>
				  <td class='columna2'>$rw[12]</td>
				</tr> ";
			
		}
        $html.="<tr>
          <th class='columna1'>CLIENTE:</th>
          <td class='columna2'>$rw[2]</td>
        </tr>
        <tr>
          <th class='columna1'>FIRMA:</th>
          <td class='columna2'></td>
        </tr>
      </tbody>
    </table>
    <p class='centrado'>¡GRACIAS POR SU CONFIANZA!
      <br>El cliente acepta las condiciones de transporte
      <br>consulte nuestra politica 
	  <br>de contrato en www.transmillas.com/politica.php</p>
  </div>"; 

	
 	$mpdf=new mPDF('c', array(58,350),'','');
	$css= file_get_contents('expdf/reportes/css/style.css');
	$mpdf->writeHTML($css,1);
	$mpdf->writeHTML($html);
	//$mpdf->Output('reporte.pdf','I');  
	$mpdf->Output('factura_numero.pdf','D');  
?>