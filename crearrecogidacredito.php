<?php 
require("login_autentica.php"); 
include("layout.php");
include("cabezote4.php"); 

$FB->titulo_azul1("Crear Recogida Creditos",9,0,5);  
$FB->abre_form("form1","","post");
//echo '<form action="nuevo_adminok.php" method="post" enctype="multipart/form-data" name="form1" id="form1" >';

// $fechainicial=date("01/m/Y");
$fechados= date("d-m-Y",strtotime($fechaactual."- 2 week"));
?>
<script>

var genviar2;

function agregarguia(idguia,prestamo,flete,idservicio)
{
total=document.getElementById('param1').value;
valortotal=parseInt(total)+parseInt(prestamo)+parseInt(flete);
document.getElementById("param1").value=valortotal;
//console.log(genviar2);
var paramguia=idservicio;
genviar2.push(paramguia);

document.getElementById(idguia).style.display='none';
document.getElementById("agregar").innerHTML +="<tr id='"+idguia+"2'><td>"+idguia+"</td><td>"+prestamo+"</td><td>"+flete+"</td><td>"+
"<button type='button' class='btn btn-danger' "+
"onclick='borrarguia(\""+idguia+"\",\""+prestamo+"\",\""+flete+"\",\""+idservicio+"\")'>Quitar</button></td></tr>";
document.getElementById("param9").value=genviar2;
}
function borrarguia(idguia,prestamo,flete,idservicio)
{
	var guia=idguia;
	document.getElementById(idguia).style.display='';
	$("#"+guia+"2").remove();

	total=document.getElementById('param1').value;
	valortotal=parseInt(total)-parseInt(prestamo)-parseInt(flete);
	document.getElementById("param1").value=valortotal;
	//var genviar2=document.getElementById("param9").value;
	//genviar2=genviar.split(",");
	var paramguia=idservicio.toString();
	var index = genviar2.indexOf(paramguia);
	if (index > -1) {
		genviar2.splice(index,1);
	}
	console.log(genviar2);
	document.getElementById("param9").value=genviar2;
}

function guardarfactura(dato)
{
 	p1=document.getElementById('param1').value;
	p2=document.getElementById('param2').value;
	//p3=document.getElementById('param3').value;
	p4=document.getElementById('param4').value;
	p5=document.getElementById('param5').value;
	p8=document.getElementById('param8').value;
	p9=document.getElementById('param9').value;
	if(p2==''){
		alert('Digite un Numero de Factura');
	}else{
		destino="nuevo_adminok.php?param1="+p1+"&param2="+p2+"&param4="+p4+"&param5="+p5+"&param8="+p8+"&param9="+genviar2+"&tabla=crearfactura";
		window.location=destino; 
	}


	
}

</script>
<body onload="setTimeout('myFunction()',1000);">
<?php 

	if($param4!=''){  $fechaactual1=$param4;}else{ $fechaactual1=$fechaactual; }
	if($param5!=''){  $fechaactual=$param5;}
	//echo $fechainicial;
	$FB->llena_texto("Cliente:",3, 2, $DB, "(SELECT `cre_nombre`,`cre_nombre` FROM `creditos` where cre_nombre='$param3')", "", "$param3",1,0);
	$FB->llena_texto("Fecha Recogida:", 4, 10, $DB, "", "", "$fechaactual1", 4, 0);
	$FB->llena_texto("Sede :",5,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde2 )", "cambio_ajax2(this.value, 16, \"llega_sub1\", \"param33\", 1, 0)", "$param35",1, 0);
	$FB->llena_texto("Operario:", 2, 444, $DB, "llega_sub1", "", "",4,0);

	$FB->llena_texto("param6", 4, 13, $DB, "", "", $param6, 5,2);
	$FB->llena_texto("tabla", 4, 13, $DB, "", "", "crearrecogidacredito", 5,2);
	echo "<td><button type='button' class='btn btn-success'  onclick='guardarfactura(1)' >Crear Factura</button></td></tr>";	
//	$FB->llena_texto("", 3, 142, $DB, "Crear Factura", "","", 1, 0);
$FB->div_valores("destino_vesr",12); 

$FB->cierra_form(); 

include("footer.php");


?>
<script>
	//p1=document.getElementById('param1').value;
	p1=0;
	p2=document.getElementById('param2').value;
	p3=document.getElementById('param3').value;	
	p4=document.getElementById('param4').value;
	p5=document.getElementById('param5').value;
	p6=document.getElementById('param6').value;

	//alert(p3);
	var pagina=0; 
	var asc="ASC";
	
		destino="detalle_crearfacturacreditos.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6+"&pagina="+pagina+"&asc="+asc;
		MostrarConsulta4(destino, "destino_vesr");

		function myFunction(){
			total=document.getElementById('param7').value;
			valortotal=parseInt(total);
			document.getElementById("param1").value=valortotal;
			var  genviar=document.getElementById("param9").value;
			genviar2=genviar.split(",");

			document.getElementById("param9").value=genviar2;
		}
	//	sleep(2000);

</script>
