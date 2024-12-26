<?php
require("login_autentica.php");
include("layout.php");
require("cabezote1.php");
//require("cabezote4.php");
require("connection/numletras.php");

$FB->abre_form("form1","nuevo_adminok.php","post");

$FB->titulo_azul1("Configuracion de Facturacion",9,0,5); 

$FB->llena_texto("Ciudad :", 1, 2,$DB,"SELECT `idsedes`,`sed_nombre` FROM `sedes`","cambio_ajax2(this.value,10, \"llega_sub1\", \"param2\", 1, 0)",$rw[1],1,1);
$FB->llena_texto("", 2, 4, $DB, "llega_sub1", "","",2,0);
$FB->llena_texto("tabla", 1, 13, $DB, "", "", "Codigo-Ciudad", 5, 0);
echo "<tr bgcolor='#F5F5F5'><td align='center' colspan='4'><input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip' type='' 
			onClick='javascript:history.back();' value='Cerrar' style='width:190px;'> 
			<input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip' type='submit' name='enviar' value='GUARDAR' style='width:190px;' ></td></tr>";

$FB->cierra_tabla(); 
$FB->cierra_form();
 ?>