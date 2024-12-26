<?php
require("login_autentica.php"); 
include("layout.php");
$nivel_acceso=$_SESSION['usuario_rol'];
$id_usuario=$_SESSION['usuario_id'];
$id_sedes=$_SESSION['usu_idsede'];
?>
<body onLoad="
<?php 
if($param2=='' or $param2==0){
	echo "cambio_ajax2('0',22, 'llega_sub2', 'param6',1, 0);";
}else{
	echo "cambio_ajax2($param2,22, 'llega_sub2', 'param6',1,$param6);";
}
echo "cambio_ajax2(0, 15,'llega_sub1','param7', 2, 0);";
?>

">
<?php
 

$FB->titulo_azul1("Valida  Gastos  ",9,0,7);  

if($nivel_acceso==1 or $nivel_acceso==10 or $nivel_acceso==12){ $conde4=""; 	 } else { $conde4=" and idsedes=$id_sedes";  }
$FB->llena_texto("Fecha de inicio:", 5, 10, $DB, "", "", "$fechaactual", 17, 0);
$FB->llena_texto("Fecha fin:", 4, 10, $DB, "", "", "$fechaactual", 4, 0);
$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde4 )", "cambio_ajax2(this.value, 15, \"llega_sub1\", \"param7\", 2, 0)", "$param1", 1, 0);
$FB->llena_texto("Validado:", 3, 82, $DB, $estados, "", "$param3", 4, 0);

$FB->llena_texto("", 37, 277, $DB, "", "", "llena_datos(0, $nivel_acceso, \"id_nombre\", \"ASC\");",4,0);
echo "</table><table>";
$FB->div_valores("destino_vesr",6); 
include("footer.php");
?>
<script>
function llena_datos(ex, nivel, ordby, asc)
{
	p1=document.getElementById('param1').value;
	//p2=document.getElementById('param2').value;
	p3=document.getElementById('param3').value;
	p2=0;
	p4=document.getElementById('param4').value;
	p5=document.getElementById('param5').value;
	p6=0;
	p7=0;
	//p6=document.getElementById('param6').value;
	//p7=document.getElementById('param7').value;
	
	var pagina=0; 
	if(ordby=="undefined"){ ordby=""; }
	if(asc=="undefined" || asc=="" ){ asc="ASC"; }
	if(ex==1){
		destino="detalle_reportegastosexcel.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param5="+p5+"&param6="+p6+"&param7="+p7;
		location.href=destino;
	}
	else {
		destino="detalle_validagastos.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param5="+p5+"&param4="+p4+"&param6="+p6+"&param7="+p7;
		MostrarConsulta4(destino, "destino_vesr")
	}
}
</script>