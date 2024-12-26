<?php 
require("login_autentica.php"); 
include("layout.php");
$FB->titulo_azul1("Carga Masiva",9,0,7);  
$FB->abre_form("form1","carga_masivaok.php","post");
$FB->titulo_azul1("Seleccione un archivo de carga",9, 0, 4); 
$FB->llena_texto("Tipo de carga:", 1, 8, $DB, $tipo_carga,"","",2, 1);
$FB->llena_texto("Seleccione archivo .csv: ", 2, 6, $DB, "","","",2, 1);
$FB->llena_texto("", 3, 4, $DB, "llega_sub1", "", "",2, 0);
?>
<tr bgcolor="#F5F5F5"><td colspan="2" align="right"><input type="submit" value="Carga Masiva" class='form-control'></td></tr>
<?php $FB->cierra_form();
require("footer.php"); ?>
