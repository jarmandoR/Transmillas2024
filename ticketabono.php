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
@$pagina2=$_REQUEST["pagina2"];

?>


    <script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/html2canvas.js"></script>
   <script type="text/javascript">
  

		var nivel='<?php echo $nivel_acceso;  ?>';
    var redirecionar='<?php echo $pagina2;  ?>';
    
  
    
        $(function() {
			
			
			var factura = document.getElementById('factura').value;
			factura =factura+'.jpg';
			//alert(factura);
			 downloadCanvas('imagen', factura);
			 
            function downloadCanvas(canvasId, filename) {
                // Obteniendo la etiqueta la cual se desea convertir en imagen
                var domElement = document.getElementById(canvasId);

                // Utilizando la función html2canvas para hacer la conversión
                html2canvas(domElement, {
                    onrendered: function(domElementCanvas) {
                        // Obteniendo el contexto del canvas ya generado
                        var context = domElementCanvas.getContext('2d');

                        // Creando enlace para descargar la imagen generada
                        var link = document.createElement('a');
                        link.href = domElementCanvas.toDataURL("image/png");
                        link.download = filename;

                        // Chequeando para browsers más viejos
                        if (document.createEvent) {
                            var event = document.createEvent('MouseEvents');
                            // Simulando clic para descargar
                            event.initMouseEvent("click", true, true, window, 0,
                                0, 0, 0, 0,
                                false, false, false, false,
                                0, null);
                            link.dispatchEvent(event);
								if(nivel==3){
								window.location = redirecionar;	
							}
                        } else {
                            // Simulando clic para descargar
                            link.click();
							
							if(nivel==3){
                window.location = redirecionar;	
                
							}
                        }
                    }
                });
            }
 
        });
    </script>
  <link rel="stylesheet" href="css/imprimir.css">
      <style type="text/css">
        #imagen {
			width: 400px;
        }
    </style>
 <?php

$date=date("Y-m-d");

$sql2="SELECT `idsedes`, `sed_nombre`, `sed_telefono`, `sed_direccion` FROM `sedes` WHERE idsedes=$id_sedes";
$DB1->Execute($sql2);
$rw2=mysqli_fetch_array($DB1->Consulta_ID);	

$sql3="SELECT `idabono`, `abo_fecha`, `abo_valor`, `abo_idservicio`, `abo_iduser`, `abo_idsede`, `abo_estado`,usu_nombre FROM `abonosguias` inner join usuarios on idusuarios=abo_iduser where idabono=$id_param";
$DB1->Execute($sql3);
$rw3=mysqli_fetch_array($DB1->Consulta_ID);	

 $sql="SELECT `idclientes`,`ser_consecutivo`, `cli_nombre`,  `ser_destinatario`, `ser_telefonocontacto`,`ciu_nombre`,
 `ser_direccioncontacto`, `ser_paquetedescripcion`, `ser_piezas`,`ser_clasificacion`, `ser_valorprestamo`, 
 `ser_valorabono`, `ser_valorseguro`,`ser_resolucion`, `ser_pendientecobrar`,ser_valor,ser_peso,`cli_idciudad`,`ser_ciudadentrega`,
 `ser_tipopaq` ,`cli_telefono`, `cli_direccion`,ser_volumen,ser_verificado,ser_prioridad,ser_guiare,ser_estado,ser_devolverreci,ser_fecharegistro FROM serviciosdia where idservicios=$rw3[3]";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	


 $sql5="SELECT `cli_iddocumento` FROM `clientes` inner join clientesdir on cli_idclientes=idclientes  WHERE cli_telefono='$rw[4]'";
$DB1->Execute($sql5);
$rw5=mysqli_fetch_array($DB1->Consulta_ID);	

$planillas=explode("/",$rw[1]);

@$rw[9]=$tipopago[$rw[9]];
$rw[6]=str_replace("&"," ", $rw[6]);
$rw[21]=str_replace("&"," ", $rw[21]);
$rw[10]=str_replace(".","", $rw[10]);
$rw[12]=str_replace(".","", $rw[12]);
$abono=number_format($rw3[2],0,".","."); 
$seguro=($rw[12]*1)/100;
$numerofectuara=$id_param+1000;
if($rw3[6]=='devolucion'){
  $titulo1='ABONO A REMESA';
  $titulo2='VALOR DEVOLUCION';

}else{
  $titulo1='DEVOLUCION A REMESA';
  $titulo2='VALOR ABONO';
}
 	$html ="
	<div id='imprimir' class='ticket'  >
	<img src='images/logonuevo.png' alt='Logotipo'>
    <p class='centrado'>
      <br>NIT:901089478-8
      <br>SUCURSAL:  $rw2[1] 
      <br>$rw2[3] 
      <br>TEL : $rw2[2]
     <br>$fechatiempo
     </p>
     <table>
        <tr>
				<td>
           <div style='font-size:25px;text-align:center;' aling=center >$titulo1 #:$numerofectuara _ $rw[5]</div>
           <div style='font-size:25px;text-align:center;' aling=center > REMESA #: $rw[1] </div>
				</td>
				</tr>
				</table>
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
          <td class='columna2'>$rw[20]</td>
		";
		$html.=  "<tr><th class='columna1'>DESTINATARIO:</th>
		<td class='columna2'>  &nbsp $rw[3]</td>
        </tr>
        <tr>
          <th class='columna1'>T&Eacute;LEFONO:</th>
          <td class='columna2'>$rw[4]</td>
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
       
    $html.="
  <tr>
  <td colspan=2  class='columna3' style='font-size:22px;text-align:center;' > $titulo2: $abono</td>
  </tr>

  ";	
		

 

$html.="</table><table> <tr>

<td class='columna2' style='text-align:left;' >
<p> ¡GRACIAS POR SU CONFIANZA!
<br>El cliente acepta las condiciones de transporte
<br>consulte nuestra politica de contrato en: 
<br>www.transmillas.com/politica.php</p>
</td>
<td class='columna1'>
<img src='img/politicaweb.png' alt='politica' style='max-width:80%;width:auto;height:auto;'/>
</td>

</tr>";  
  
      $html.="<tr><td colspan=2 class='columna4' >
      <br> RECIBE CONFORME: $rw3[7]</br> 
     <br>ENTREGADO POR: ______________________</br>
     <br>CC/NIT: __________________________________</br>    
        </td> </tr>";

        $html2="";

        $html2.=" <tr><td class='columna3' >
        <br>Declaro que los recursos financieros que 
        <br> permiten realizar la presente Compra.
        <br>Por el valor $ $abono pesos moneda 
        <br>colombianatiene origen o proviene de:
        <br>_______________________________
        <br>Declara que estos Recursos no 
        <br>provienen de ninguna actividad
        <br> ilicita de las comtepladas
        <br>en el codigo Penal colombiano o  
        <br> de cualquier Norma que lo notifique 
        <br>  o adicione, Dicho dinero  no forma
        <br> parte de los ingresos de la empresa.
        <br>Transmillas logistica y trasnportadora S.A.S.
        </td>
        </tr></table>";  
        
		$html.=$html2;
		$html.="</tbody>
		</br>
		</br>
		</br>	
		 </div>";

  
  ?>

  <body>
  <input id="factura" name="factura" type="hidden" value="<?php echo $rw[1]; ?>">
    <div id="imagen">
    <?php echo $html; 
      // echo "
    ?>
    </div>

</body>


 