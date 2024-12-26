<?php
require("login_autentica.php");
include("layout.php");
?>
<script language="javascript">
function llena_datos2(ord, asc)
{
	p1=document.getElementById('param1').value;
	p2=document.getElementById('param2').value;
	destino="detalle_iniciogestores.php?p1="+p1+"&p2="+p2+"&ord="+ord+"&asc="+asc;
	MostrarConsulta4(destino, "destino_vesr")
}
</script>
<body onLoad="llena_datos2('ied_nombre', 'ASC'); ">
<?php
$FB->abre_form("form1","","post");
$FB->titulo_azul1("Instituciones Educativas",9,0, 4);  
$FB->llena_texto("", 1, 19, $DB, "", "", "",1,0); $FB->llena_texto("", 1, 19, $DB, "", "", "",4,0);
$FB->llena_texto("Secretar&iacute;as:",2,2,$DB,"SELECT DISTINCT(idsecretarias), sec_nombre FROM secretarias $cond_rol1 ORDER BY sec_nombre", 
"llena_datos2(\"ied_nombre\", \"ASC\");","",1,0);
$FB->llena_texto("Buscar", 1, 115, $DB, "", "autocomplet2(this.value);", "",4,0);
$FB->div_valores("destino_vesr",6); 
$FB->cierra_tabla(); 
$FB->cierra_form(); 
require("footer.php"); ?>