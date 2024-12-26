<?php
require("login_autentica.php");
require("layout2.php");
require("layout3.php");
?>
<body onLoad="cambio_ajax2(param1.value, 18, 'llega_sub1', 'param2', 1, 1);">
<?php $FB->titulo_azul1("$tabla",9,0, 4);  ?>
<tr><td><table width="100%" border="0" align="center" cellspacing="2" bordercolor="#001A55">
<?php
$tabla1=$tabla;
switch ($tabla)
{
?>
<?php case "Carga Masiva": 
if($cond!=1)
{
	if($cond!=2){
		if(isset($_REQUEST["va"])) {$va=$_REQUEST["va"]; } else {$va=0;} 
		for($i=1; $i<$va; $i++)
		{
			$param=$_REQUEST["pregs$i"];
			$idpre=$_REQUEST["idpre$i"];
			$sel="INSERT INTO preguntasusuarios (idpreguntasusuarios, usuarios_idusuarios, preguntas_idpreguntas, pru_fecha, pru_respuesta) 
			VALUES ('','$id_usuario', '$idpre', '".date("Y-m-d H:i:s")."', '$param')";
			$DB->Execute($sel);
		}
	}
}
$sql1="SELECT enc_estado FROM encuestas WHERE idencuestas='$id_encuesta'  ";
$DB->Execute($sql1);
if($DB->recogedato(0)==1){
$FB->abre_form("form11","cargaok.php","post"); ?>
<tr><td colspan="4">
<form action="cargaok1.php" method="post" name="form1" enctype="multipart/form-data">
<table width="60%" cellpadding="0" cellspacing="0"><tr bgcolor="#F5F5F5"><td align="center">
<a href="datos/carga_preguntas.csv">Descargar Formato</a></td>
<td align="right"><input type="file" id="param65" name="param65"></td><td align="right"><input type="submit" value="Cargar"></td></tr></table>
</form>
</td></tr>
<?php $FB->cierra_form(); } ?>
<tr><td>
<?php 
$FB->abre_form("form1","","post"); 
$FB->titulo_azul1("Consultar",9,0, 4);  
$FB->llena_texto("Preguntas:",1,2,$DB,"SELECT idpreguntas, pre_pregunta FROM preguntas WHERE  encuestas_idencuestas='$id_encuesta' AND pre_tipo='1. Indicad' ORDER BY CAST(pre_codigo AS UNSIGNED) ASC", "cambio_ajax2(param1.value, 18, \"llega_sub1\", \"param2\", 1, 1)","",1,0);
$FB->llena_texto("Parametrizaci&oacute;n", 2, 4, $DB, "llega_sub1", "", "",4,0);
$FB->llena_texto("", 3, 19, $DB, "", "", " ",1,0);
$FB->llena_texto("", 4, 27, $DB, "", "llena_datos(2,0)", "llena_datos(1,0);",4,0); ?>
<tr><td align="left" colspan="4"><?php include("agregar.php"); ?></td></tr>
<?php
$FB->div_valores("destino_vesr",4); 
$FB->cierra_tabla(); 
$FB->cierra_form(); 
break;
} 
require("footer.php"); ?>