<?php 
require("login_autentica.php"); 
include("layout.php");
//include("cabezote4.php"); 
$fechaactual=date("Y-m-d");
?>
<head>

	</head>
<body onLoad="<?php
echo "llena_datos(0,$nivel_acceso, '', 'ASC');";
 echo "cambio_ajax2(0, 16, 'llega_sub1', 'param32', 1, $param32);";
 ?>
">
<script>


timer2 =0;
function llena_datos(ex, nivel, ordby, asc)
{
	p1=document.getElementById('param32').value;
	p2=document.getElementById('param33').value;
	p3=document.getElementById('param35').value;
	p4=document.getElementById('param36').value;

	if(ex==1){
		destino="detalle_reportetareasexcel.php?p1="+p1+"&p2="+p2+"&p4="+p4;
		location.href=destino;
	}
	else {
		destino="detalle_reportetareas.php?param32="+p1+"&param33="+p2+"&param35="+p3+"&param36="+p4;
		MostrarConsulta4(destino, "destino_vesr")
	}
	//clearTimeout(timer2);
	//timer2=setTimeout(function(){llena_datos(0,nivel,'','ASC')},600000); // 3000ms = 3s
}

</script>
<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
 if($nivel_acceso==1 or $nivel_acceso==12){
	 
}
if($rcrear==1) { $FB->nuevoname("Tareas", $condecion, "Crear tarea"); }
$FB->titulo_azul1("Reporte de tareas programadas",9,0,5);  



if($nivel_acceso==1 or $nivel_acceso==12){
	if($param35!=''){   $conde2=""; }  

}
else {	
	$param35=$id_sedes;
	  $conde2.=" and idsedes='$id_sedes' "; 	
	
}

//$FB->llena_texto("Sede :",35,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde2 )", "cambio_ajax2(this.value, 16, \"llega_sub1\", \"param35\", 1, 0)", "$param35",1, 0);
$FB->llena_texto("Estado:",36,82, $DB, $estadosac, "", "", 1, 0);
$FB->llena_texto("Sede Origen:",35,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde2  )", "cambio_ajax2(param33.value, 36, \"llega_sub1\", \"param32\", 1, this.value)", "$id_sedes", 4, 0);
$FB->llena_texto("Roles:",33,2,$DB,"SELECT idroles, rol_nombre FROM roles ORDER BY rol_nombre","cambio_ajax2(this.value, 36, \"llega_sub1\", \"param32\", 2, param35.value)",$param33,1,0);
$FB->llena_texto("Operario:", 32, 444, $DB, "llega_sub1", "", "",4,0);


$FB->llena_texto("", 37, 277, $DB, "", "", "llena_datos(0, $nivel_acceso, \"id_nombre\", \"ASC\");",1,0);
$FB->div_valores("destino_vesr",12); 

$FB->cierra_form(); 

include("footer.php");

?>