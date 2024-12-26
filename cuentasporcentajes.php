<?php 
require("login_autentica.php"); 
include("layout.php");
include("cabezote4.php"); 

?>
<head>
<script>
function llena_datos(ex, nivel, ordby, asc)
{
	p1=document.getElementById('param1').value;
	p2=document.getElementById('param2').value;
	p3=document.getElementById('param3').value;


	if(ex==1){
		destino="detalle_cuentasporcentajesexcel.php?param31="+p1+"&param32="+p2+"&param33="+p3;
		location.href=destino;
	}
	else {
		destino="detalle_cuentasporcentaje.php?param31="+p1+"&param32="+p2+"&param33="+p3;
		MostrarConsulta4(destino, "destino_vesr")
	}
}


</script>
</head>

<body onload="">

<?php 

if($nivel_acceso==1 or $nivel_acceso==10 or $nivel_acceso==9){ $conde2="";  } else { $conde2=" and idsedes=$id_sedes";  }
if($param1!=''){ 
	$id_sedes=$param1; 
	$idcidades=ciudadesedes($param1,$DB);
	if($idcidades=='0'){
		$conde1="";

	}else {
	  $ciudades=$idcidades; 	
	}
} else {  

	$idcidades=ciudadesedes($id_sedes,$DB);
	if($idcidades=='0'){
		$ciudades="";

	}else {
	$ciudades=$idcidades; 	
	}

}

$FB->abre_form("form1","","post");
$FB->titulo_azul1("Porcentajes Guias Diarias",9,0,5);  
$FB->abre_form("form1","","post");

$conde="and ser_fechaguia like '$fechaactual%'"; 

if($param2!=''){ $conde="and ser_fechaguia like '$param2%' ";  $fechaactual=$param2;  }else{ $param2=$fechaactual; }

$FB->llena_texto("Fecha Inicinio:", 2, 10, $DB, "", "", "$fechaactual", 1, 0);
$FB->llena_texto("Fecha Final:", 3, 10, $DB, "", "", "$fechaactual", 4, 0);
$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde4)", "", "$id_sedes", 1, 1);
$FB->llena_texto("", 37, 277, $DB, "", "", "llena_datos(0);",1,0);
$FB->div_valores("destino_vesr",12); 

$FB->cierra_form(); 

include("footer.php");


?>