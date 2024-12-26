<?php 
require("login_autentica.php"); 
include("layout.php");
include("cabezote4.php"); 

$FB->titulo_azul1("Crear Factura Creditos",9,0,5);  
$FB->abre_form("form1","","post");
// $fechainicial=date("01/m/Y");
$fechados= date("d-m-Y",strtotime($fechaactual."- 2 week"));
?>
<script>


function agregarguia(idguia,prestamo,flete)
{
total=document.getElementById('param1').value;
valortotal=parseInt(total)+parseInt(prestamo)+parseInt(flete);
document.getElementById("param1").value=valortotal;

document.getElementById(idguia).style.display='none';
document.getElementById("agregar").innerHTML +="<tr id='"+idguia+"2'><td>"+idguia+"</td><td>"+prestamo+"</td><td>"+flete+"</td><td>"+
"<button type='button' class='btn btn-danger' "+
"onclick='borrarguia(\""+idguia+"\",\""+prestamo+"\",\""+flete+"\")'>Quitar</button></td></tr>";

}
function borrarguia(idguia,prestamo,flete)
{
	var guia=idguia;
	document.getElementById(idguia).style.display='';
	$("#"+guia+"2").remove();

	total=document.getElementById('param1').value;
	valortotal=parseInt(total)-parseInt(prestamo)-parseInt(flete);
	document.getElementById("param1").value=valortotal;
}

function llena_datos(ex, nivel, ordby, asc)
{
	//p1=document.getElementById('param1').value;
	p1=0;
	p2=document.getElementById('param2').value;
	p3=document.getElementById('param3').value;	
	p4=document.getElementById('param4').value;
	p5=document.getElementById('param5').value;

	
	var pagina=0; 
	if(ordby=="undefined"){ ordby=""; }
	if(asc=="undefined" || asc=="" ){ asc="ASC"; }
	if(ex==1){
		destino="creditos_facturacreditoexcel.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&pagina="+pagina+"&ordby="+ordby+"&asc="+asc;
		location.href=destino;
	}
	else {
		destino="detalle_crearfacturacreditos.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&pagina="+pagina+"&ordby="+ordby+"&asc="+asc;
		MostrarConsulta4(destino, "destino_vesr")
	}
	clearTimeout(timer2);
	timer2=setTimeout(function(){llena_datos(0,nivel,'','ASC')},600000); // 3000ms = 3s
}

</script>
<?php 
	if($param4!=''){  $fechaactual1=$param4;}else{ $fechaactual1=$fechaactual; }
	if($param5!=''){  $fechaactual=$param5;}
	//echo $fechainicial;
	$FB->llena_texto("Cliente:",3, 2, $DB, "(SELECT `cre_nombre`,`cre_nombre` FROM `creditos`)", "llena_datos(this.value, $nivel_acceso, \"id_nombre\", \"ASC\");", "$param9",1,0);
	$FB->llena_texto("Fecha de Radicado:", 4, 10, $DB, "", "", "$fechaactual1", 4, 0);
	$FB->llena_texto("Fecha de Vencimiento:", 5, 10, $DB, "", "", "$fechaactual", 17, 0);
	$FB->llena_texto("N&#176; Factura:", 2, 1, $DB, "", "","$param2", 4,0);
	$FB->llena_texto("Valor de la Factura:", 1, 1, $DB, "", "","0", 1,0);
	$FB->llena_texto("tabla", 4, 13, $DB, "", "", "crearfactura", 5,2);

	echo "<td><button type='submit' class='btn btn-success' onclick='crearfactura()'>Crear Factura</button></td></tr>";
//$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
$FB->div_valores("destino_vesr",12); 

$FB->cierra_form(); 

include("footer.php");


?>