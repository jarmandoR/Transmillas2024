<?php 
require("login_autentica.php"); 
include("layout.php");
if($param32=='') { $param32=0;  }
//require("imprimir.php"); 
?>
<head>
<!-- 	<script language="JavaScript" type="text/javascript" src="js/jquery-1.4.4.min"></script> 
 -->    <script src="js/jquery.printPage.js" type="text/javascript"></script>
  

</head>
<body onload="<?php
echo "llena_datos(0,$nivel_acceso, '', 'ASC');";
 echo "cambio_ajax2(0, 16, 'llega_sub1', 'param32', 1, $param32);";
 switch ($tabla)
{
	case "Factura":
	echo "pop_dis4($id_param,'Factura');";
	break;
	
	default:
	
	break;

} 

	?>
">
<script>

function cambioo2(valor, valor2,valor3,valor4)
{
    var ruta="param20="+valor+"&param21="+valor2+"&paramtipser="+valor3+"&cro="+valor4;
    $.ajax({
    
    url: 'detalle_recoleccioncomprarecogida.php',
    type: 'Get',
    data: ruta,
    }).done(function(res){

        $('#respuesta').html(res)
    });
}

timer2 =0;
function llena_datos(ex, nivel, ordby, asc)
{
	p1=document.getElementById('param31').value;
	//if(document.getElementById('param2')){ p2=document.getElementById('param2').value; } else { p2=0;} 
	
	//p2=document.getElementById('param32').value;
	p4=document.getElementById('param34').value;
	p6=document.getElementById('param36').value;
	p7=document.getElementById('param37').value;
	
	if(nivel==1){
	p5=document.getElementById('param35').value;
	p2=document.getElementById('param32').value;
	}else{ 
	p5=0; 
	p2=0; 
	}
	var pagina=0; 
	if(ordby=="undefined"){ ordby=""; }
	if(asc=="undefined" || asc=="" ){ asc="ASC"; }
	if(ex==1){
		destino="detalle_recogerpaquete.php?p1="+p1+"&p2="+p2+"&p6="+p6;
		location.href=destino;
	}
	else {
		destino="detalle_recogerpaquete.php?param31="+p1+"&param32="+p2+"&param34="+p4+"&param35="+p5+"&param36="+p6+"&param37="+p7+"&pagina="+pagina+"&ordby="+ordby+"&asc="+asc;
		MostrarConsulta4(destino, "destino_vesr")
	}
	clearTimeout(timer2);
	timer2=setTimeout(function(){llena_datos(0,nivel,'','ASC')},600000); // 3000ms = 3s
}

  $(function () {
    $(document).on('change', '.borrar', function (event) {
		
		var valor = $(this).val();
		var descripcion=document.getElementById("des_"+$(this).attr('name')).value;
		var idservicio=document.getElementById("servicio_"+$(this).attr('name')).value;
		event.preventDefault();
		$(this).closest('tr').remove();
      	datos = {"tipoguia":"cancelar","servicio":idservicio,"descripcion":descripcion,"llego":valor};
		$.ajax({
				url: "guiasok.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){
				console.log(respuesta);
			});

    });
});



</script>
<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
$FB->titulo_azul1("Recoger Paquete",9,0,5);  
$FB->abre_form("form1","","post");
$conde3="";	

 $conde="and ser_fechaasignacion like '$fechaactual%'"; 
 
if($param34!=''){ $conde="and ser_fechaasignacion like '$param34%'";  $fechaactual=$param34;  }
$FB->llena_texto("Fecha de Busqueda:", 34, 10, $DB, "", "", "$fechaactual", 17, 0);
 $conde2=" ";
if($nivel_acceso==1){
	
	if($param35!=''){ $id_sedes=$param35; $idcidades=ciudadesedes($id_sedes,$DB);  $conde2.=" and cli_idciudad in $idcidades "; } 
	$FB->llena_texto("Sede Origen:",35,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "cambio_ajax2(this.value, 16, \"llega_sub1\", \"param32\", 1, 0)", "$id_sedes", 4, 0);
	$FB->llena_texto("Operario:", 32, 444, $DB, "llega_sub1", "", "",1,0);
	if($param2!=''){ $conde.="and ser_idresponsable='$param2'"; }
	
}
else {
		$idcidades=ciudadesedes($id_sedes,$DB);	
		if($idcidades=='0'){
			//$conde2.="";

		}else {
		  $conde2.=" and cli_idciudad in $idcidades "; 	
		}
	
}
 if($nivel_acceso==3) {
	$conde3="and ser_idresponsable='$id_usuario'";	
}
$FB->llena_texto("Estado:",37,82,$DB,$estadorecogido,"","$param37",4,0);
$FB->llena_texto("Busqueda por:",31,82,$DB,$busqueda,"",$param31,1,0);
$FB->llena_texto("Dato:", 36, 1, $DB, "", "","$param36", 4,0);
$FB->llena_texto("", 38, 277, $DB, "id", "", "llena_datos(0, $nivel_acceso, \"id_nombre\", \"ASC\");",4,0);
echo "</table><table>";
$FB->div_valores("destino_vesr",6); 
 


include("footer.php");
?>
<script>
        function validarNombre() {
            let inputNombre = document.getElementById("param82").value.trim();
            let errorMensaje = document.getElementById("errorNombre");

            // Expresión regular: verifica que haya al menos dos palabras separadas por un espacio
            let regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ]+ [A-Za-zÁÉÍÓÚáéíóúÑñ]+$/;

            if (regex.test(inputNombre)) {
                errorMensaje.style.display = "none"; // Esconde el mensaje si es válido
            } else {
                errorMensaje.style.display = "block"; // Muestra el mensaje si no es válido
            }
        }
    </script>