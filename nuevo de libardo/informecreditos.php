<?php 
require("login_autentica.php"); 
include("layout.php");
//include("cabezote4.php"); 

$FB->titulo_azul1("Creditos",9,0,5);  
$FB->abre_form("form1","","post");
// $fechainicial=date("01/m/Y");
$fechados= date("d-m-Y",strtotime($fechaactual."- 2 week"));
?>
<style>
    .btn-with-bancolombia,
    .btn-with-davivienda {
        width: 150px; /* Ajusta según sea necesario */
        height: 40px; /* Ajusta según sea necesario */
        background-size: cover;
    }

    .btn-with-bancolombia {
        background-image: url('img/botonbancolombia.jpg');
    }

    .btn-with-davivienda {
        background-image: url('img/botondavivienda.jpg');
    }
</style>

<script>

function buscardatoscredito()
{

    // Obtener el elemento select por su ID
    var selectElement = document.getElementById('param3');

    // Obtener el valor seleccionado
    var valorSeleccionado = selectElement.value;
    if(valorSeleccionado=='' || valorSeleccionado=='0'){

        alert('Debe seleccionar un Credito');

    }else{
        
        // Llamar a la función con el valor seleccionado
        pop_dis16(valorSeleccionado, "datosdefactura", "");

    }
    

}

function crearfaactura()
{
	destino="crearfactura.php?metodo=crear";
	location.href=destino;

}

function editarfactura(datos)
{
	destino="crearfactura.php?"+datos;
	location.href=destino;

}
function desvincularfacturas()
{
	//p1=document.getElementById('param1').value;
	p2=document.getElementById('param2').value;
	p3=document.getElementById('param3').value;	
	p4=document.getElementById('param4').value;
	p5=document.getElementById('param5').value;
	p6=document.getElementById('param6').value;
	p1=document.getElementById('param7').value;

	alert("Esta seguro que desea desvincular las guias");

/* 	destino="detalle_creditos_desvincular.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6;
	MostrarConsulta4(destino, "destino_vesr"); */

 // Realizar la petición AJAX
 $.ajax({
      type: 'POST',
      url: 'detalle_creditos_desvincular.php',
      data: {
        param2: p2,
        param3: p3,
        param4: p4,
        param5: p5,
        param6: p6,
        param1: p1
      },
      success: function(response) {
        // Manejar la respuesta del servidor
        console.log(response);
		alert(response);
        // Puedes mostrar la respuesta en un elemento HTML
      //  $('#result').html(response);
      },
      error: function(xhr, status, error) {
        // Manejar errores de la petición AJAX
        console.error(error);
      }
    });

	destino="detalle_creditos.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6;
		MostrarConsulta4(destino, "destino_vesr");

}
function llena_datos(ex, nivel, ordby, asc)
{
	//p1=document.getElementById('param1').value;
	p2=document.getElementById('param2').value;
	p3=document.getElementById('param3').value;	
	p4=document.getElementById('param4').value;
	p5=document.getElementById('param5').value;
	p6=document.getElementById('param6').value;
	p1=document.getElementById('param7').value;

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
		destino="creditos_excel.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6+"&pagina="+pagina+"&idfactura="+ordby+"&preguia="+ex;
		location.href=destino;
	}
	else if(ex==2){
		destino="detalle_facturascreditos.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6+"&pagina="+pagina+"&idfactura="+ordby+"&preguia="+ex;
		MostrarConsulta4(destino, "destino_vesr");
	}
	else if(ex==4){
		
		destino="creditos_excel.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6+"&pagina="+pagina+"&idfactura="+ordby+"&preguia="+ex;
		location.href=destino;
	}else if(ex==5){
		destino="pdfcredit.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6+"&pagina="+pagina+"&idfactura="+ordby+"&preguia="+ex;
		location.href=destino;

	}
	else {
		destino="detalle_creditos.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6+"&pagina="+pagina+"&idfactura="+ordby+"&preguia="+ex;
		MostrarConsulta4(destino, "destino_vesr");
	}
}

</script>
<?php 

echo "<tr>
    <td>
        <div class='form-group'>
            <label class='btn btn-success btn-file'>
                <i class='fa fa-paperclip'></i> Adjuntar Archivo
                <input type='file' name='excelFile' id='excelFile' accept='.xls, .xlsx' style='display: none;'>
            </label>
        </div>
        <button type='button' class='btn btn-primary' onclick=\"enviarFormulario('Davivienda')\">Cargar Davivienda</button>
        <button type='button' class='btn btn-success' onclick=\"enviarFormulario('Bancolombia')\">Cargar Bancolombia</button>
    </td>
    <td>
        <button type='button' class='btn btn-primary btn-with-bancolombia' onclick=\"abrirPopup('bancolombia.php','BANCOLOMBIA')\"></button>
    </td>
    <td>
        <button type='button' class='btn btn-primary btn-with-davivienda' onclick=\"abrirPopup('davivienda.php','DAVIVIENDA')\"></button>
    </td>
</tr>";
	 

	// echo '<button type="button" class="btn btn-primary" onclick="abrirPopup()">Abrir Popup con Iframe</button>';


	if($param4!=''){  $fechainicio=$param4;}
	if($param5!=''){  $fechaactual=$param5;}
	//echo $fechainicial;
	$FB->llena_texto("Fecha de Inicial:", 4, 10, $DB, "", "", "$fechainicio", 17, 0);
	$FB->llena_texto("Fecha de Final:", 5, 10, $DB, "", "", "$fechaactual", 4, 0);
	$FB->llena_texto("Cliente:",3, 2, $DB, "(SELECT `cre_nombre`,`cre_nombre` FROM `creditos`)", "", "$param9",17,1);
	$FB->llena_texto("Estado Facturas:",7,82,$DB,$estadofac,"","",4,0);
	$FB->llena_texto("Estado Creditos:",6,82,$DB,$estadocreditos,"","",17,0);
	$FB->llena_texto("# Factura:", 2, 1, $DB, "", "","$param2", 4,0);

	$FB->llena_texto("Cliente sin facturar:",3, 2, $DB, "(SELECT `cre_nombre`,`cre_nombre` FROM `creditos` WHERE cre_nombre not in (SELECT CAST(fac_credito AS CHAR ) AS Credito FROM facturascreditos WHERE MONTH(fac_fechaprefac) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) and fac_credito!='EXTERNOS'))", "", "$param9",17,1);


echo '<td align="right">';
echo "<a href='#' onclick='buscardatoscredito()'>Ver informacion Credito </a>";
echo 'Exportar a :<a href="#" onclick="llena_datos(1, 1, &quot;id_nombre&quot;, &quot;ASC&quot;);" target=""><img src="img/excel.jpg" width="30"></a></td>';
echo '<td align="right">Exportar a pdf :<a href="#" onclick="llena_datos(5, 1, &quot;id_nombre&quot;, &quot;ASC&quot;);" target=""><img src="img/pdfimagen.png" width="30"></a></td>';
echo "";
echo "</tr>";

echo "<tr><td><button type='button' class='btn btn-info' onclick='llena_datos(0, $nivel_acceso, \"id_nombre\", \"ASC\");'>Consultas Creditos</button></td>";
if($nivel_acceso==1){
	echo "<td><button type='button' class='btn btn-danger' onclick='desvincularfacturas();'>Desvincular  Guias</button></td>";

}
echo "<td><button type='button' class='btn btn-warning' onclick='llena_datos(2, $nivel_acceso, \"id_nombre\", \"ASC\");'>Consultar Facturas</button></td>
<td><button type='button' class='btn btn-primary' onclick='crearfaactura();'>Crear Factura Externa</button>
<button type='button' class='btn btn-success' onclick='llena_datos(3, $nivel_acceso, \"id_nombre\", \"ASC\");'>Crear PRE-Factura</button></td></tr>";

//echo "<tr><td><input type='file' name='excelFile' id='excelFile' accept='.xls, .xlsx'> <button type='button' onclick='enviarFormulario(Davivienda)'>Cargar Davivienda.</button> <button type='button' onclick='enviarFormulario(Bancolombia)'>Cargar Bancolombia.</button></td></tr>";
//echo "<tr><td><input type='file' name='excelFile' id='excelFile' accept='.xls, .xlsx'> <button type='button' onclick=\"enviarFormulario('Davivienda')\">Cargar Davivienda</button> <button type='button' onclick=\"enviarFormulario('Bancolombia')\">Cargar Bancolombia</button></td> </tr>";







$FB->div_valores("destino_vesr",12); 

$FB->cierra_form(); 



/* echo '<div class="modal fade" id="miModalbancos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">';
			include('datatable-master/bancolombia.php'); 
		echo' </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		</div>
	</div>
</div>
</div>'; */

include("footer.php");
?>
<script>

function enviarFormulario(direccion) {
    try {
        var formData = new FormData();
        var inputFile = document.getElementById('excelFile').files[0];

        if (inputFile) {
            formData.append('excelFile', inputFile);

            var xhr = new XMLHttpRequest();
            var url = (direccion === 'Davivienda') ? 'procesar_excel.php' : 'procesar_excel_bancolombia.php';
            xhr.open('POST', url, true);

            // Evento que se ejecutará cuando la solicitud sea completada
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Éxito: mostrar respuesta del servidor
                    alert(xhr.responseText);
                } else {
                    // Error: mostrar mensaje de error
                    alert('Error al procesar el archivo.' + xhr.status);
                }
            };

            // Enviar solo el archivo
            xhr.send(formData);
        } else {
            throw new Error('Por favor, seleccione un archivo antes de enviar.');
        }
    } catch (error) {
        alert('Excepción capturada: ' + error.message);
    }
}


function enviarFormulario2($direccion) {
    var formData = new FormData();
    var inputFile = document.getElementById('excelFile').files[0];

    if (inputFile) {
        formData.append('excelFile', inputFile);

        var xhr = new XMLHttpRequest();
		if($direccion=='Davivienda'){
			xhr.open('POST', 'procesar_excel.php', true);
		}else{
			xhr.open('POST', 'procesar_excel_bancolombia.php', true);
		}
       

        // Evento que se ejecutará cuando la solicitud sea completada
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Éxito: mostrar respuesta del servidor
                alert(xhr.responseText);
            } else {
                // Error: mostrar mensaje de error
                alert('Error al procesar el archivo.'+xhr.status);
            }
        };

        // Enviar solo el archivo
        xhr.send(formData);
    } else {
        alert('Por favor, seleccione un archivo antes de enviar.');
    }
}



    function abrirPopupiframe(url,tipo) {

		// Abre una ventana emergente con un iframe
		var iframeUrl = 'datatable-master/'+url;
		var iframeHtml = '<iframe src="' + iframeUrl + '" frameborder="0" style="width:100%; height:100vh;"></iframe>';

		// Crea un modal de Bootstrap
		var modal = $('<div class="modal" style="width:90%" tabindex="-1" role="dialog"></div>');
		modal.html('<div class="modal-dialog" role="document" style="width:100%"><div class="modal-content" style="width:100%">' +
			'<div class="modal-header">' +
				'<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
					'<span aria-hidden="true">&times;</span>' +
				'</button>' +
				'<h4 class="modal-title">INFORME DE '+tipo+'</h4>' +
			'</div>' +
			'<div class="modal-body" style="width:100%">' + iframeHtml + '</div>' +
			'</div></div>');

		// Agregar el modal al cuerpo del documento
		$('body').append(modal);

		// Mostrar el modal
		modal.modal('show');

        // Maneja el evento de cierre del modal para eliminar el iframe del DOM al cerrar el modal
        modal.on('hidden.bs.modal', function () {
            modal.remove();
        });
    }


	function abrirPopup(url, tipo) {
    // Abre una nueva pestaña del navegador
    window.open('datatable-master/' + url, '_blank');
}
</script>