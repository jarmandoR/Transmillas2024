<?php 
require("login_autentica.php"); 
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$rol_nombre=$_SESSION['rol_nombre'];
$id_sedes=$_SESSION['usu_idsede'];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$FB = new funciones_varias;
$QL = new sql_transact;
$LT = new llenatablas;
$param_edicion=1; $rcrear=1; 

?>
<html>
<head>

</head>
<body>
<?php
  $sql="SELECT `idclientes`,`ser_consecutivo`, `cli_nombre`,  `ser_destinatario`, `ser_telefonocontacto`,`ciu_nombre`,
 `ser_direccioncontacto`, `ser_paquetedescripcion`, `ser_piezas`,`ser_clasificacion`, `ser_valorprestamo`, 
 `ser_valorabono`, `ser_valorseguro`,`ser_resolucion`, `ser_pendientecobrar`,ser_valor,ser_peso,`cli_idciudad`,`ser_ciudadentrega` FROM serviciosdia where idservicios=$id_param ";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	

$planillas=explode("/",$rw[1]);
$rw[9]=$tipopago[$rw[9]];
$rw[6]=str_replace("&"," ", $rw[6]);
$seguro=($rw[12]*1)/100;
   // <img src='images/imprimir.png' alt='Logotipo'>
 	$downloadfile="
    <p class='centrado'>REMESA DE TRANSPORTE
      <br>NIT:901089478-8
      <br>RESOLUCI&Oacute;N:$rw[13]
      <br># DE GUIA:$rw[1]
      <br>$fechatiempo</p>

   ";
        $downloadfile= '<br>DESTINATARIO:  ';
        $downloadfile=  "<td class='columna2'>$rw[3]</td>
          <br>T&eacute;LEFONO:  
          <td class='columna2'>$rw[4]</td>
            <br>CIUDAD:  
          <td class='columna2'>$rw[5]</td>
            <br>DIRECCI&oacute;N:  
          <td class='columna2'>$rw[6]</td>
            <br>DESCRIPCI&oacute;N:  
          <td class='columna2'>$rw[7]</td>
            <br>PIEZAS:  
          <td class='columna2'>$rw[8]</td>
            <br>TIPO PAGO:  
          <td class='columna2'>$rw[9]</td>
            <br>PRESTAMO:  
          <td class='columna2'>$rw[10]</td>
            <br>ABONO:  
          <td class='columna2'>$rw[11]</td>
            <br>SEGURO:  
          <td class='columna2'>$rw[12]</td>
        </tr> 
		";
		
		if($rw[9]=="Contado" and $rw[14]==0){
		
		 $sql1="SELECT `pre_kilo`,`pre_adicional` FROM `precios` WHERE `pre_idciudadori`=$rw[17]  and `pre_idciudaddes`=$rw[18]";
		$DB->Execute($sql1);
		$rw1=mysqli_fetch_row($DB->Consulta_ID); 
		

		
		if($rw[16]>3){ $varor1=$rw1[0]*3;  $valor2=($rw[15]-3)*$rw1[1];  $valortotal=$varor1+$varor1+$seguro;   }
		else { $valortotal=($rw[15]*3)+$seguro;  }
		
		 $sql="UPDATE servicios SET ser_valor=$valortotal WHERE idservicios='$id_param' ";
		$DB1->Execute($sql);	
			
	  $filecontent="<tr>
			    <br>Peso Kg:  
			  <td class='columna2'>$rw[16]</td>
			</tr><tr>
			    <br>Valor Kg:  
			  <td class='columna2'>$ $rw1[0]</td>
			</tr>
			<tr>
			    <br>1%SEGURO:  
			  <td class='columna2'>$seguro</td>
			</tr><tr>
			    <br>Valor ToTal:  
			  <td class='columna2'>$ $valortotal</td>
			</tr>";	
			
		}
        $filecontent="<tr>
            <br>CLIENTE:  
          <td class='columna2'>$rw[2]</td>
            <br>FIRMA:  
          <td class='columna2'></td>
      </tbody>
    </table>
    <p class='centrado'>¡GRACIAS POR SU CONFIANZA!
      <br>El cliente acepta las condiciones de transporte
      <br>consulte nuestra politica 
	  <br>de contrato en www.transmillas.com/politica.php</p>
  </div>"; 
  
  $downloadfile="Reporte_Auditoria.txt";

header ("Content-Disposition: attachment; filename=\"exportar.txt\"" ); 
header("Content-Type: application/force-download");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".strlen($filecontent));
header("Pragma: no-cache");
header("Expires: 0");
echo $filecontent;
 ?>
</body>

</html>