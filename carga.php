<?php
require("login_autentica.php");
include("layout.php"); 
if(isset($_REQUEST["id_encuesta"])){ $id_encuesta=$_REQUEST["id_encuesta"]; } else { $id_encuesta=""; }
if(isset($_REQUEST["tabla"])){ $tabla=$_REQUEST["tabla"]; } else { $tabla="Formulario"; }
?>
<script language="javascript">
function llena_datos(vari, pagina)
{
	p1=document.getElementById('param1').value;  
	tabla=document.getElementById('tabla1').value; 
	p3=""; p4="";
	if(p1==185){ destino="detalle_resultados62.php?p1="+p1+"&p3="+p3+"&p4="+p4+"&pagina="+pagina+"&tabla="+tabla; }
	else { 	destino="detalle_resultados61.php?p1="+p1+"&p3="+p3+"&p4="+p4+"&pagina="+pagina+"&tabla="+tabla; }
	MostrarConsulta4(destino, "destino_vesr");
}
</script>
<?php 
echo "<body onload='llena_datos(1,0);'>";
$sqls="SELECT aci_nombre FROM actindgener WHERE idactindgener='$id_encuesta' ";
$DB1->Execute($sqls);
$encuesta=$DB1->recogedato(0);
$FB->titulo_azul1("$tabla - $encuesta",9,0, 4);  ?>
<tr><td><table width="100%" border="0" align="center" cellspacing="2" bordercolor="#001A55">
<?php
$sql1="SELECT COUNT(*) FROM actindgener WHERE idactindgener='$id_encuesta' ";
$DB->Execute($sql1);
if($DB->recogedato(0)==1){
	$FB->abre_form("form11","cargaok.php","post"); ?>
	<tr><td colspan="4"><table width="70%" cellpadding="0" cellspacing="0"><tr bgcolor="#F5F5F5"><td align="center">
	<a href="descarga_formato.php?id_encuesta=<?php echo $id_encuesta; ?>">Descargar Formato</a></td>
	<td align="right"><input type="file" id="param65" name="param65"></td><td align="right">
	<input type="submit" style="width:200px;" value="Carga Masiva" class='form-control'></td></tr></table></td></tr>
<?php 
	$FB->llena_texto("tabla", 1, 13, $DB, "", "", $tabla, 5, 0);
	$FB->llena_texto("id_encuesta", 1, 13, $DB, "", "", $id_encuesta, 5, 0);
	$FB->cierra_form(); 
} 
echo "<tr><td>";
$FB->abre_form("form1","","post"); 
$FB->titulo_azul1("Consultar",9,0, 4);  
$FB->llena_texto("Formulario:",1,26,$DB,"SELECT idactindgener, aci_nombre FROM actindgener WHERE aig_fuente='$tabla' ORDER BY aci_nombre", "llena_datos(1,0);",$id_encuesta,1,0);
$FB->llena_texto("", 4, 277, $DB, "", "", "llena_datos(1,0);",4,0); 
$FB->div_valores("destino_vesr",4); 
$FB->llena_texto("tabla1", 1, 13, $DB, "", "", $tabla, 5, 0);
$FB->cierra_tabla(); 
$FB->cierra_form(); 
require("footer.php"); ?>