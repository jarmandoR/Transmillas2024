<?php 
require("login_autentica.php"); 
include("layout.php");
//include("cabezote4.php"); 
$fechaactual=date("Y-m-d");
if($nivel_acceso==1 or $nivel_acceso==12){
	if($param35!=''){  
		 $conde2=""; 
		
	 }  else {
		 $param35=$id_sedes;
	 }
}
else {	
	$param35=$id_sedes;
	  $conde2.=" and idsedes='$id_sedes' "; 		
}
?>
<head>

	</head>
<body onLoad="llena_datos(0,<?php echo $nivel_acceso;?> , '', 'ASC'); 
 cambio_ajax2(<?php echo $param35;?>, 16, 'llega_sub1', 'param33', 1, <?php echo $param33;?>);
">
<script>


timer2 =0;
function llena_datos(ex, nivel, ordby, asc)
{
//	p1=document.getElementById('param31').value;
	p1=0;
	p2=document.getElementById('param32').value;
	p3=document.getElementById('param33').value;
	p4=document.getElementById('param34').value;
	p5=document.getElementById('param35').value;
	//p7=document.getElementById('param37').value;
	p7=0;
	var pagina=0; 
	if(ordby=="undefined"){ ordby=""; }
	if(asc=="undefined" || asc=="" ){ asc="ASC"; }
	if(ex==1){
		destino="detalle_reporoperxl.php?p1="+p1+"&p2="+p2+"&p4="+p4;
		location.href=destino;
	}
	else {
		destino="detalle_reporoper.php?param31="+p1+"&param32="+p2+"&param33="+p3+"&param34="+p4+"&param35="+p5+"&param37="+p7+"&pagina="+pagina+"&ordby="+ordby+"&asc="+asc;
		MostrarConsulta4(destino, "destino_vesr")
	}
	clearTimeout(timer2);
	timer2=setTimeout(function(){llena_datos(0,nivel,'','ASC')},600000); // 3000ms = 3s
}



</script>
<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
$FB->titulo_azul1("Seguimiento Operadores",9,0,5);  
$FB->abre_form("form1","","post");



$FB->llena_texto("Fecha de Inicial:", 34, 10, $DB, "", "", "$fechaactual", 1, 0);
if($nivel_acceso==1 or $nivel_acceso==12){
$FB->llena_texto("Fecha de Final:", 32, 10, $DB, "", "", "$fechaactual", 1, 0);
}else{
	$FB->llena_texto("param32", 1, 13, $DB, "", "", "0", 5, 0);

}
$FB->llena_texto("Sede :",35,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde2 )", "cambio_ajax2(this.value, 16, \"llega_sub1\", \"param33\", 1, 0)", "$param35",4, 0);
$FB->llena_texto("Operario:", 33, 444, $DB, "llega_sub1", "", "",1,0);
//$FB->llena_texto("Estado:",37,82,$DB,$estadosguias,"","$param37",4,0); 
//echo "<td><button type='button' class='btn btn-primary btn-lg' onclick='buscarsede(4);'>Imprimir Codigos</button></td>";

$FB->llena_texto("", 37, 277, $DB, "", "", "llena_datos(0, $nivel_acceso, \"id_nombre\", \"ASC\");",4,0);
$FB->div_valores("destino_vesr",12); 

$FB->cierra_form(); 

include("footer.php");
?>