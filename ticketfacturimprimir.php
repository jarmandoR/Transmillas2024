<?php
require("login_autentica.php"); 
//require_once("expdf/lib/pdf/mpdf.php");  
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$id_sedes=$_SESSION['usu_idsede'];

$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$DB2 = new DB_mssql;
$DB2->conectar();


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



/*  $sql="SELECT `idclientes`,`ser_consecutivo`, `cli_nombre`,  `ser_destinatario`, `ser_telefonocontacto`,`ciu_nombre`,
 `ser_direccioncontacto`, `ser_paquetedescripcion`, `ser_piezas`,`ser_clasificacion`, `ser_valorprestamo`, 
 `ser_valorabono`, `ser_valorseguro`,`ser_resolucion`, `ser_pendientecobrar`,ser_valor,ser_peso,`cli_idciudad`,`ser_ciudadentrega`,
 `ser_tipopaq` ,`cli_telefono`, `cli_direccion`,ser_volumen,ser_verificado,ser_prioridad,ser_guiare FROM serviciosdia where idservicios=$id_param ";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	


$sql3="SELECT `ciu_nombre`, `cli_iddocumento` FROM `clientes` inner join clientesservicios on cli_idclientes=idclientes inner join ciudades on idciudades=cli_idciudad WHERE idclientes=$rw[0]";
$DB2->Execute($sql3);
$rw3=mysqli_fetch_array($DB2->Consulta_ID);	


 $sql5="SELECT `cli_iddocumento` FROM `clientes` inner join clientesservicios on cli_idclientes=idclientes  WHERE cli_telefono='$rw[4]'";
$DB1->Execute($sql5);
$rw5=mysqli_fetch_array($DB1->Consulta_ID);	

$planillas=explode("/",$rw[1]);

@$rw[9]=$tipopago[$rw[9]];
$rw[6]=str_replace("&"," ", $rw[6]);
$rw[21]=str_replace("&"," ", $rw[21]);
$rw[10]=str_replace(".","", $rw[10]);
$rw[12]=str_replace(".","", $rw[12]);
$abono=str_replace(".","", $rw[11]);
$seguro=($rw[12]*1)/100; */


/* open a connection to the printer */
//$printer = printer_open("Lexmark X850e XL V");
/* write the text to the print job */
//printer_write($printer, $lipsum);
/* close the connection */
//printer_close($printer);


	/* get the sample text */
	$lipsum = file_get_contents('lipsum.txt');
	
	/* open a connection to the printer */
	$printer = printer_open("PDFCreator");
	printer_start_doc($printer, "Doc");
	printer_start_page($printer);
	
	/* font management */
	$barcode = printer_create_font("Free 3 of 9 Extended", 400, 200, PRINTER_FW_NORMAL, false, false, false, 0);
	$arial = printer_create_font("Arial", 148, 76, PRINTER_FW_MEDIUM, false, false, false, 0);
	
	/* write the text to the print job */
	printer_select_font($printer, $barcode);
	printer_draw_text($printer, "*123456*", 50, 50);
	printer_select_font($printer, $arial);
	printer_draw_text($printer, "123456", 250, 500);
	
	/* font management */
	printer_delete_font($barcode);
	printer_delete_font($arial);
	
	/* close the connection */
	printer_end_page($printer);
	printer_end_doc($printer);
	printer_close($printer);
?>

  <body>
  <input id="factura" name="factura" type="hidden" value="<?php echo $rw[1]; ?>">
    <div id="imagen">
		<?php echo $html; ?>
    </div>

</body>


 