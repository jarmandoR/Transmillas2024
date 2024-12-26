<?php
/* require("login_autentica.php");
include("cabezote3.php");
include("cabezote1.php"); 
 */
//	error_reporting(0);
//	if($handle = printer_open('\\\192.168.1.33\HP Deskjet 1510 series')){
	if($handle = printer_open('HP Deskjet 1510 series')){
		printer_set_option($handle, PRINTER_MODE, 'RAW');
		printer_start_doc($handle);
		printer_start_page($handle);
/* 		
 $sql="SELECT `idclientes`,`ser_consecutivo`, `ser_horaentrega`, `ser_destinatario`, `ser_telefonocontacto`,`ciu_nombre`,
 `ser_direccioncontacto`,`ser_tipopaquete`, `ser_paquetedescripcion`, `ser_piezas`,`ser_clasificacion`, `ser_valorprestamo`, 
 `ser_valorabono`, `ser_valorseguro`, `cli_iddocumento`, `cli_telefono`, `cli_email`, 
 `cli_idciudad`, `cli_direccion`, `cli_nombre`,  `ser_fechaentrega`,`ser_prioridad`,  `idservicios` FROM `clientes` inner join rel_sercli on idclientes=ser_idclientes 
 inner join servicios on  ser_idservicio=idservicios  inner join ciudades on ser_ciudadentrega=idciudades where idservicios=$id_param ";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID); */	


$planillas=explode("/",$rw[1]);
$line1 = 'FACTURA TRASMILLAS';
$line2 = "FECHA:".date('Y-m-d');
$line3 = "RESOLUCIÓN:".$planillas[0];
$line4 = "PLANILLA:".$planillas[1];
$line5 = "HORA:".$rw[2];
$line6 = "DESTINATARIO:".$rw[3];
$line7 = "TÉLEFONO:".$rw[4];
$line8 = "CIUDAD:".$rw[5];
$line9 = "DIRECCIÓN:".$rw[6];
$line10 = "DESCRIPCIÓN:".$rw[8];
$line11 = "PIEZAS:".$rw[9];
$line12 = "TIPO:".$clasificacion[$rw[10]];
$line13 = "PRESTAMO:".$rw[11];
$line14 = "ABONO:".$rw[12];
$line15 = "SEGURO:".$rw[13];
		
		



		$font = printer_create_font('Arial', 150, 80, 700, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_draw_text($handle, $line1, 150, 50);

		$font = printer_create_font('Arial', 90, 50, 100, false, false, false, 0);
		printer_select_font($handle, $font);
		printer_draw_text($handle, $line2, 150, 250);
		printer_draw_text($handle, $line3, 150, 350);
		printer_draw_text($handle, $line4, 150, 450);
		
		printer_delete_font($font);
		printer_end_page($handle);
		printer_end_doc($handle);
		printer_close($handle);
		echo 'Impresion exitosa.';
	}else{
		echo 'No se pudo conectar a la impresora.';
	}
	
/* 	$file = "factura.txt"; //tu archivo a imprimir
$handle = printer_open("HP Deskjet 930c");
printer_write($handle, $file);
printer_close($handle); */
?>