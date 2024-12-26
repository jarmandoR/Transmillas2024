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





        .container-left {
            float: left;
            margin-right: 10px; /* Espacio entre botones */
        }

        .container-right {
            float: right;
            margin-left: 10px; /* Espacio entre botones */
        }
        .email-button {
            display: inline-flex;
            align-items: center;
            background-color: #2196F3; /* Color de fondo */
            color: white; /* Color del texto */
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
			width: 150px; /* Ajusta según sea necesario */
            height: 40px; /* Ajusta según sea necesario */
        }
        .file-button {
            display: inline-flex;
            align-items: center;
            background-color: #4CAF50; /* Color de fondo */
            color: white; /* Color del texto */
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        .email-button i {
            margin-right: 8px; /* Espacio entre el icono y el texto */
        }

        .file-button i {
            margin-right: 8px; /* Espacio entre el icono y el texto */
        }



        .file-button {
            background-color: #4CAF50;
        }
        #loading {
            display: none; /* Ocultar inicialmente */
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000; /* Asegurarse de que está por encima de otros elementos */
        }
                /* Estilos específicos para la tabla de preguntas */
        .tabla-preguntas {
            width: 100%;
            border-collapse: collapse;
        }
        .tabla-preguntas th, .tabla-preguntas td {
            border: 1px solid gray;
            
            padding: 8px;
            text-align: left;
        }
        
        .tabla-preguntas th {
            background-color: #003366; /* Azul oscuro */
            color: white; /* Letra blanca */
        }
        #loading {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000; /* Asegurarse de que está por encima de otros elementos */
        }
        .search-box {
            position: relative;
            width: 300px;
            justify-content: flex-end; /* Alinear a la derecha */
        }
        .search-box input[type="text"] {
            width: 100%;
            padding: 10px;
            padding-left: 40px; /* Espacio para el icono */
            border: 2px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
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
    p9=document.getElementById('param9').value;
    p10=document.getElementById('param10').value;
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
		destino="detalle_facturascreditos.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6+"&pagina="+pagina+"&idfactura="+ordby+"&preguia="+ex+"&param9="+p9+"&param10="+p10;
		MostrarConsulta4(destino, "destino_vesr");
	}
	else if(ex==4){
		
		destino="creditos_excel.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6+"&pagina="+pagina+"&idfactura="+ordby+"&preguia="+ex;
		location.href=destino;
	}else if(ex==5){
		destino="pdfcredit.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6+"&pagina="+pagina+"&idfactura="+ordby+"&preguia="+ex;
		location.href=destino;

	}else if(ex==6){
		destino="pruebas_software.php?param1="+p1+"&param2="+p2+"&param3="+p3+"&param4="+p4+"&param5="+p5+"&param6="+p6+"&pagina="+pagina+"&idfactura="+ordby+"&preguia="+ex+"&ver=si&prefac="+asc;
		// location.href=destino;
        window.open(destino, '_blank');

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
	$FB->llena_texto("Cliente:",3, 280, $DB, "(SELECT `cre_nombre`,`cre_nombre` FROM `creditos` inner join `hojadevidacliente` on hoj_clientecredito =idcreditos where hoj_estado='Activo' )", "", "$param9",17,1);
	$FB->llena_texto("Estado Facturas:",7,82,$DB,$estadofac,"","",4,0);
	$FB->llena_texto("Estado Creditos:",6,82,$DB,$estadocreditos,"","",17,0);
	$FB->llena_texto("# Factura:", 2, 1, $DB, "", "","$param2", 4,0);
    $FB->llena_texto("# Pre-Factura:", 10, 1, $DB, "", "","$param2", 4,0);
	$FB->llena_texto("Cliente sin facturar:",3, 2, $DB, "(SELECT `cre_nombre`,`cre_nombre` FROM `creditos` WHERE cre_nombre not in (SELECT CAST(fac_credito AS CHAR ) AS Credito FROM facturascreditos WHERE MONTH(fac_fechaprefac) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) and fac_credito!='EXTERNOS'))", "", "$param9",17,1);
	$FB->llena_texto("# Nit:", 9, 1, $DB, "", "","$param2", 4,0);
		

echo '<td align="right">';
if($nivel_acceso==1){

    echo "<a href='#' onclick='buscardatoscredito()'>Ver informacion Credito </a>";
}
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
let idsSeleccionados = [];

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

function sendEmail(idfac){


    
            // const fileNames = 
            // let arrayParam = encodeURIComponent(JSON.stringify(fileNames));
            // console.log(fileNames);


            const email = document.getElementById('param2');
            const body = document.getElementById('param5');
            const formData = new FormData();

            //agregar correo
            formData.append('correo', email.value);
            //agregar correo
            formData.append('body', body.value);
            formData.append('idfac', idfac);

            const loadingElement = document.getElementById('loading');

            // Mostrar el GIF de carga
            loadingElement.style.display = 'block';
            // Enviar datos al servidor
            fetch('email_facvencida.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                console.log(result);
                alert(result);
                // idsSeleccionados = [];
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al enviar el correo');
            }).finally(() => {
                // Ocultar el GIF de carga
                loadingElement.style.display = 'none';
            });

}

function sendEmailfac (idfac){


    
// const fileNames = 
// let arrayParam = encodeURIComponent(JSON.stringify(fileNames));
// console.log(fileNames);

var checkboxf = document.getElementById('param10');
var param11   = document.getElementById('param11');


const email = document.getElementById('param2');
const body = document.getElementById('param5');
var inputFile0 = document.getElementById('param3').files[0];
var inputFile1 = document.getElementById('param6').files[0];

const formData = new FormData();

//agregar correo
formData.append('correo', email.value);
// formData.append('correos', idsSeleccionados.value);
formData.append('correos', JSON.stringify(idsSeleccionados));

if (checkboxf.checked) {
    console.log('chequeado');
    
            var linkFac = document.getElementById('linkfac');
            formData.append('linkFac', linkFac.value);
            // console.log("El checkbox está marcado.");
        } else {
            // console.log("El checkbox no está marcado.");
        }
if (param11.checked) {
    console.log('chequeado');
    
            var linkFac1 = document.getElementById('linkfac1');
            formData.append('linkfac1', linkfac1.value);
            // console.log("El checkbox está marcado.");
} else {
            // console.log("El checkbox no está marcado.");
}
//agregar correo linkfac1
formData.append('body', body.value);
formData.append('idfac', idfac);
formData.append('File0', inputFile0);
formData.append('File1', inputFile1);


const loadingElement = document.getElementById('loading');

// Mostrar el GIF de carga
loadingElement.style.display = 'block';
// Enviar datos al servidor
fetch('email_fac.php', {
    method: 'POST',
    body: formData
})
.then(response => response.text())
.then(result => {
    console.log(result);
    alert(result);
    // idsSeleccionados = [];
})
.catch(error => {
    console.error('Error:', error);
    alert('Error al enviar el correo');
}).finally(() => {
    // Ocultar el GIF de carga
    loadingElement.style.display = 'none';
});

}




// Función para manejar los clics en los checkboxes
function selecionado(iduser,correo) {
    var checkbox = document.getElementById(iduser+"s");
    // const checkbox = event.target;
    const id = correo;

    if (checkbox.checked) {
        // Si el checkbox está marcado, agregar el ID al array
        idsSeleccionados.push(correo);
    } else {
        // Si el checkbox está desmarcado, eliminar el ID del array
        const index = idsSeleccionados.indexOf(correo);
        if (index !== -1) {
            idsSeleccionados.splice(index, 1);
        }
    }

    console.log("IDs seleccionados:", idsSeleccionados);
}
</script>