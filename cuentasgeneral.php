<?php 
require("login_autentica.php"); 
include("layout.php");
//include("cabezote4.php"); 
?>
<head>

	</head>
<body onLoad="llena_datos(0,<?php echo $nivel_acceso;?> , '', 'ASC'); 
 cambio_ajax2(0, 16, 'llega_sub1', 'param33', 1, <?php echo $param33;?>);
">
<script>


timer2 =0;
function llena_datos(ex, nivel, ordby, asc)
{
	p1=document.getElementById('param31').value;
	//p6=document.getElementById('param36').value;
	p2=document.getElementById('param32').value;
	p3=document.getElementById('param33').value;
	p7=0;
	//p4=document.getElementById('param34').value;
	p5=document.getElementById('param35').value;
	//p7=document.getElementById('param37').value;
	
	var pagina=0; 
	if(ordby=="undefined"){ ordby=""; }
	if(asc=="undefined" || asc=="" ){ asc="ASC"; }
	if(ex==1){
		destino="detalle_cuentasgexcel.php?param31="+p1+"&param32="+p2+"&param33="+p3+"&param35="+p5+"&param37="+p7+"&pagina="+pagina+"&ordby="+ordby+"&asc="+asc;
		location.href=destino;
	}
	else {
		destino="detalle_cuentasgeneral.php?param31="+p1+"&param32="+p2+"&param33="+p3+"&param35="+p5+"&param37="+p7+"&pagina="+pagina+"&ordby="+ordby+"&asc="+asc;
		MostrarConsulta4(destino, "destino_vesr")
	}
//	clearTimeout(timer2);
//	timer2=setTimeout(function(){llena_datos(0,nivel,'','ASC')},600000); // 3000ms = 3s
}

function validarcuentas(des)
{

var valorguia= document.getElementById("codigoEscaneado").value;

var ciudado= document.getElementById("param35").value;
if(ciudado==0){

	alert('Seleccione la ciudad de Destino');

}else {


	var guia="";
	var trueorfalse = false;	
		datos = {"valores":valorguia};
		$.ajax({
				url: "finalizarguia.php",
				type: "POST",
				data: datos,
				async: false,
				success: function(result) {

					guia= result.resultado;
					if(guia==2){
						
						 alert('La GUIA NO ESTA EN ESTADO FINALIZADO DE ENTREGA ,  VERIFIQUE');

					}else {
						//$("#mensaje").modal("show"); 
							var divvalor= document.getElementById("mensajeguia");
							divvalor.innerHTML="<div class='alert alert-success'><strong>OK!</strong>  GUIA: "+valorguia+" ENVIADA CON EXITO</div>";

							document.getElementById("codigoEscaneado").value = "";
							document.getElementById("codigoEscaneado").focus();
							$("#"+valorguia).remove();
							
					}
				}
			});	
			
	}	
	return false;	
	
}
</script>
<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
$FB->titulo_azul1("Cuentas General",9,0,5);  
$FB->abre_form("form1","","post");


if($nivel_acceso==1 or $nivel_acceso==10){
	if($param35!=''){   $conde2=""; }  

}
else {	

	  $conde2.=" and idsedes='$id_sedes' "; 	
	
}
/* $FB->llena_texto("Fecha Inicinio:", 34, 10, $DB, "", "", "$fechaactual", 1, 0);
$FB->llena_texto("Fecha Final:", 36, 10, $DB, "", "", "$fechaactual", 4, 0); */
$FB->llena_texto("Sede :",35,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde2 )", "cambio_ajax2(this.value, 16, \"llega_sub1\", \"param33\", 1, 0)", "$param35",1, 1);
$FB->llena_texto("Operario:", 33, 444, $DB, "llega_sub1", "", "",4,0);
$FB->llena_texto("Busqueda por:",31,82,$DB,$busqueda,"",$param1,1,0);
$FB->llena_texto("Dato:", 32, 1, $DB, "", "","$param32", 4,0);

echo '<tr><td class="text">Escanear Código: </td><td align="right" ><div class="form-group">
<div class="input-group">
	<div class="input-group-addon"><i class="fa fa-barcode"></i></div>
	<input autofocus type="text" class="form-control producto" name="codigoEscaneado" id="codigoEscaneado" autocomplete="off" onchange="validarcuentas(this);">
</div>
</div></td>';

echo '</tr><tr><div id="mensajeguia" ></div></tr>';

$FB->llena_texto("", 37, 277, $DB, "", "", "llena_datos(0, $nivel_acceso, \"id_nombre\", \"ASC\");",1,0);
$FB->div_valores("destino_vesr",12); 


$FB->cierra_form(); 

include("footer.php");
?>