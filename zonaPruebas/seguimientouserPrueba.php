<?php 
require("login_autentica.php"); 
include("layout.php");
//include("cabezote4.php"); 
$fechaactual=date("Y-m-d");
?>
<head>

	</head>
<body onLoad="llena_datos(0,<?php echo $nivel_acceso;?> , '', 'ASC'); 
 cambio_ajax2(<?php echo $id_sedes;?>, 16, 'llega_sub1', 'param33', 1, 0); 
">
<script>


timer2 =0;
function llena_datos(ex, nivel, ordby, asc)
{
//	p1=document.getElementById('param31').value;
//	
	p1=0;
	p2=document.getElementById('param32').value;
	p3=document.getElementById('param33').value;
	p4=document.getElementById('param34').value;
	p5=document.getElementById('param35').value;
	p6=document.getElementById('param36').value;
	p7=document.getElementById('param37').value;
	//p7=document.getElementById('param37').value;
	var pagina=0; 
	if(ordby=="undefined"){ ordby=""; }
	if(asc=="undefined" || asc=="" ){ asc="ASC"; }
	if(ex==1){
		destino="detalle_seguimientouserxl.php?p1="+p1+"&p2="+p2+"&p4="+p4;
		location.href=destino;
	}
	else {
		destino="detalle_seguimientouserPrueba.php?param31="+p1+"&param32="+p2+"&param33="+p3+"&param34="+p4+"&param35="+p5+"&param36="+p6+"&param37="+p7+"&pagina="+pagina+"&ordby="+ordby+"&asc="+asc;
		MostrarConsulta4(destino, "destino_vesr")
	}
	clearTimeout(timer2);
	timer2=setTimeout(function(){llena_datos(0,nivel,'','ASC')},600000); // 3000ms = 3s
}

</script>
<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
 if($nivel_acceso==1 or $nivel_acceso==12){
	 
	if($rcrear==1) { $FB->nuevoname("SeguimientoUser", $condecion, "Inasistencia"); }
}
if($rcrear==1) { $FB->nuevoname("ingresoprueba", $condecion, "Prueba Alcolemia"); }

// echo'<a class="btn btn-primary" href="controlIngreso.php" role="button">Control de ingreso</a>';
echo "<button type='button' class='btn btn-danger btn-lg' onclick='pop_dis16(\"$id_p\",\"Agregar festivos\",\"$rw1[5]\")' >+Día de descanso</button>";
echo "<button type='button' class='btn btn-danger btn-lg' onclick='pop_dis16(\"$id_p\",\"Vacaciones\",\"$rw1[5]\")' >+Vacaciones</button>";

$FB->titulo_azul1("Ingresos de Personal",9,0,5);  



if($nivel_acceso==1 or $nivel_acceso==12){
	if($param35!=''){   $conde2=""; }  

}
else {	
	$param35=$id_sedes;
	  $conde2.=" and idsedes='$id_sedes' "; 	
	
}

$FB->llena_texto("Fecha de Inicial:", 34, 10, $DB, "", "", "$fechaactual", 1, 0);
$FB->llena_texto("Fecha de Final:", 36, 10, $DB, "", "", "$fechaactual", 4, 0);

$FB->llena_texto("Sede :",35,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde2 )", "cambio_ajax2(this.value, 16, \"llega_sub1\", \"param33\", 1, 0)", "$param35",1, 0);
$FB->llena_texto("Operario:", 33, 444, $DB, "llega_sub1", "", "",4,0);
$FB->llena_texto("Motivo Ingreso:", 32, 82, $DB, $motivoingreso, "", "", 1, 0);
$FB->llena_texto("Tipo de Contrato:",37,82, $DB, $tipocontrato, "", "", 4, 0);

$FB->llena_texto("", 37, 277, $DB, "", "", "llena_datos(0, $nivel_acceso, \"id_nombre\", \"ASC\");",1,0);
$FB->div_valores("destino_vesr",12); 

$FB->cierra_form(); 

include("footer.php");

?>