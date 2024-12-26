<?php 
require("login_autentica.php"); 
include("layout.php");
?>
<script language="javascript">
function llena_datos()
{
	p1=document.getElementById('param1').value;
	if(document.getElementById('param2')){ p2=document.getElementById('param2').value; } else { p2=0;} 
	p3=document.form1.param3.value;
	destino="resultados_documentos.php?param1="+p1+"&param2="+p2+"&param3="+p3;
	MostrarConsulta4(destino, "destino_vesr");
}
</script>
<body onLoad="llena_datos(); ">
<?php
if(isset($_REQUEST["param1"])){ $param1=$_REQUEST["param1"]; } else {$param1="";}
$FB->titulo_azul1("Documentos",9,0, 4);  
$FB->abre_form("form1","","post");
$FB->llena_texto("Proyectos:",1,2,$DB,"SELECT idproyectos, pro_nombre FROM proyectos ORDER BY pro_nombre","llena_datos();",$param1,1,0);
$FB->llena_texto("Tipo de documento:",2,2,$DB,"SELECT idtipodocumentos, tid_nombre FROM tipodocumentos ORDER BY tid_nombre ASC","llena_datos();","",4,0);
$FB->llena_texto("Buscar:", 3, 15, $DB, "autocomplet1(this.value);", "llena_datos();", "", 1, 0);
$FB->llena_texto("", 5, 17, $DB, "", "llena_datos();", "", 3, 0);
$FB->cierra_form();
$FB->div_valores("destino_vesr",4); 
$FB->cierra_tabla(); 
require("footer.php"); ?>