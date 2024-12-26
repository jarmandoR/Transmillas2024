<?php 
require("login_autentica.php"); 
include("layout.php");
//include("cabezote4.php"); 

$FB->titulo_azul1("Reporte Creditos",9,0,5);  
$FB->abre_form("form1","","post");
$fechados= date("d-m-Y",strtotime($fechaactual."- 2 week"));
?>
<script>
function llena_datos(ex, nivel, ordby, asc)
{
	//p1=document.getElementById('param1').value;
	//p2=document.getElementById('param2').value;
	p1=0;
	p2=0;
	p3=document.getElementById('param3').value;	
	p4=document.getElementById('param4').value;
	p5=document.getElementById('param5').value;
	p6=document.getElementById('param6').value;

	if(ex==3){
		if(p3=='' || p3==null){
			alert('Por favor Seleccione un Cliente');
			exit;
		}
	}
	
	var pagina=0; 
	if(ordby=="undefined"){ ordby=""; }
	if(asc=="undefined" || asc=="" ){ asc="ASC"; }
	if(ex==1){
		destino="reporte_excel.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6+"&pagina="+pagina+"&idfactura="+ordby+"&preguia="+ex;
		location.href=destino;
	}
	else if(ex==2){
		destino="detalle_reportecreditos.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6+"&pagina="+pagina+"&idfactura="+ordby+"&preguia="+ex;
		MostrarConsulta4(destino, "destino_vesr");
	}

}



</script>
<?php 
	if($param4!=''){  $fechainicio=$param4;}else{ $fechainicio=date('Y-01-01');  }
	if($param5!=''){  $fechaactual=$param5;}
	//echo $fechainicial;
	$FB->llena_texto("Fecha de Inicial:", 4, 10, $DB, "", "", "$fechainicio", 17, 0);
	$FB->llena_texto("Fecha de Final:", 5, 10, $DB, "", "", "$fechaactual", 4, 0);

$FB->llena_texto("Cliente:",3, 2, $DB, "(SELECT `cre_nombre`,`cre_nombre` FROM `creditos`)", "", "$param9",1,1);
$FB->llena_texto("Estado:",6,82,$DB,$estadofac,"","",4,0);

echo "<td><button type='button' class='btn btn-success' onclick='llena_datos(2, $nivel_acceso, \"id_nombre\", \"ASC\");'>Consultar </button></td></tr>";
$FB->div_valores("destino_vesr",12); 

$FB->cierra_form(); 

include("footer.php");


?>