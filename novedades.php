<?php
require("login_autentica.php");
include("layout.php");
?>
<script language="javascript">
function llena_datos3()
{
	p1=document.getElementById('param1').value;
	if(document.getElementById('param2')){ p2=document.getElementById('param2').value; } else { p2=0;} 
	p3=document.getElementById('param3').value;
	p4=document.getElementById('param4').value;
	p5=document.getElementById('param5').value;
	p6=document.getElementById('param6').value;
	destino="detalle_novedades.php?p1="+p1+"&p2="+p2+"&p3="+p3+"&p4="+p4+"&p5="+p5+"&p6="+p6;
	MostrarConsulta4(destino, "destino_vesr");
}
</script>
<body onLoad="cambio_ajax2(param1.value, 32, 'llega_sub2', 'param2', 1, 0); llena_datos3();">
<?php 
$FB->abre_form("form1","","post");
$FB->titulo_azul1("Novedades",9,0, 4);  
$FB->llena_texto("Fecha inicial:",5, 10, $DB, "", "", "llena_datos3();",1,0);
$FB->llena_texto("Fecha final:",6, 10, $DB, "", "", "llena_datos3();",3,0);
$FB->llena_texto("Secretar&iacute;as:",1,2,$DB,"SELECT idsecretarias, sec_nombre FROM secretarias ORDER BY sec_nombre", 
"cambio_ajax2(this.value, 32, \"llega_sub2\", \"param2\", 1, 0); llena_datos3();","",4,0);
$FB->llena_texto("Instituci&oacute;n Educativa:", 2, 4, $DB, "llega_sub2", "", "",1,0);
$FB->llena_texto("Novedad:",3,2,$DB,"SELECT  'Alarma reportada',  'Alarma reportada' UNION SELECT DISTINCT (nov_tabla), nov_tabla FROM novedades", "llena_datos3();","",1,1);
$FB->llena_texto("Estado:", 4, 8, $DB, $estadonov, "", "llena_datos3();", 3, 0);
$FB->llena_texto("",3,19,$DB,"","","",1,0);
$FB->llena_texto("", 4, 277, $DB, "", "", "llena_datos3();",4,0);
$FB->div_valores("destino_vesr",6); 
$FB->cierra_tabla(); 
$FB->cierra_form(); 
require("footer.php"); ?>