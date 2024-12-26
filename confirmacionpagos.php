

<?php
require("login_autentica.php"); 
include("layout.php");
$nivel_acceso=$_SESSION['usuario_rol'];
$id_nombre=$_SESSION['usuario_nombre'];
?>
<script>
	function buscarFac(){
		p1=document.getElementById('param21').value;
		p2=document.getElementById('param22').value;	
		p3=document.getElementById('param23').value;
		p4=document.getElementById('param24').value;
		console.log(p1+p2+p3+p4);


		var ruta="fechaini="+p1+"&fechafin="+p2+"&cliente="+p3+"&nit="+p4;


		$.ajax({

		url: 'buscaFacturas.php',
		type: 'POST',
		data: ruta,
		})
		.done(function(res){

			$('#cuerpo').html(res);
		})
		.fail(function(){

			// console.log("error");
		})
		.always(function(){


		});

	}
	buscarFac();

</script>
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
<?php

$conde1="";
$conde2="";

$FB->titulo_azul1("Verificacion de Pagos",9,0,7); 
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
        <button type='button' class='btn btn-primary btn-with-bancolombia' onclick=\"abrirPopup('bancolombia.php?id_nombre=$id_nombre','BANCOLOMBIA')\"></button>
    </td>
    <td>
        <button type='button' class='btn btn-primary btn-with-davivienda' onclick=\"abrirPopup('davivienda.php?id_nombre=$id_nombre','DAVIVIENDA')\"></button>
    </td>
</tr>"; 
$FB->abre_form("form1","","post");

//if($nivel_acceso==1 or $nivel_acceso==10){ $conde4=""; 	 } else { $conde4=" and idsedes=$id_sedes";  }

$FB->llena_texto("Fecha de inicio:", 5, 10, $DB, "", "", "$fechainicio", 1, 0);
$FB->llena_texto("Fecha fin:", 4, 10, $DB, "", "", "$fechaactual", 4, 0);

$FB->llena_texto("Operario:",1,2,$DB,"SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE  (usu_estado=1 or usu_filtro=1)", "", "$param1", 1, 0);
$FB->llena_texto("Tipo de transaccion:",3,2, $DB, "SELECT idtipospagos,pag_nombre FROM `tipospagos` WHERE pag_estado like '%Activo%' and idtipospagos!=1 order by idtipospagos", "", "$param3", 4, 0);
$FB->llena_texto("confirmar:", 2, 82, $DB, $confirmar, "", "$param6", 4, 1);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
$FB->cierra_form(); 



$FB->titulo_azul1("Fecha",1,0,5); 
$FB->titulo_azul1("Guia",1,0,0); 
$FB->titulo_azul1("Idservicio",1,0,0); 
$FB->titulo_azul1("Operario",1,0,0); 
$FB->titulo_azul1("Transaccion",1,0,0); 
$FB->titulo_azul1("Cuenta",1,0,0); 
$FB->titulo_azul1("Valor Guia",1,0,0); 
$FB->titulo_azul1("Imagen transaccion",1,0,0); 
$FB->titulo_azul1("confirmar",1,0,0); 
$FB->titulo_azul1("Confirmo",1,0,0); 
$FB->titulo_azul1("Fecha Confirmacion",1,0,0); 
$FB->titulo_azul1("Valor Confirmado",1,0,0); 
$FB->titulo_azul1("# transacion",1,0,0); 
$FB->titulo_azul1("Imagen",1,0,0); 


if($nivel_acceso==1){
$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
}
if($param5!=''){
$conde1.=" and date(pag_fecha)>='$param5' and date(pag_fecha)<='$param4'";
}else{
	$conde1.=" and date(pag_fecha)>='$fechainicio' and date(pag_fecha)<='$fechaactual'"; 	
}
if($param1!=''){
	$conde2.="and pag_idoperario='$param1'";
}

if($param3!='' and $param3!='0'){
	$conde2.="and pag_tipopago='$param3'";
}


if($param2=="" or $param2=="0"){
	$conde2.=" and pag_userverifica=''";
}else{
	$conde2.=" and pag_userverifica!=''";
}


 $sql="SELECT `idpagoscuentas`, `pag_fecha`,`pag_guia`,`pag_idservicio`,usu_nombre, `pag_nombre`,`pag_cuenta`,   `pag_valor`,  `pag_userverifica`, `pag_fechaverifica`,`pag_tipopago`,`pag_idoperario`, pagoscuentas.pag_estado, pag_valorconfirmado,pag_numerotrans,pag_img_transaccion FROM `pagoscuentas` 
  inner join usuarios on pag_idoperario=idusuarios inner join tipospagos on idtipospagos=pag_tipopago  $conde2  WHERE idpagoscuentas>0 $conde1  ORDER BY idpagoscuentas  ASC ";


$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
//	$rw1[6]=number_format($rw1[6],0,".",".");
		$sql2="SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes='$rw1[11]'";
		$DB->Execute($sql2);
		$rw=mysqli_fetch_row($DB->Consulta_ID);

	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>".$rw1[1]."</td>
		<td align='center' ><a  onclick='pop_dis5($rw1[3],\"Recogidas\")';  style='cursor: pointer;' title='Detalle Guia' >$rw1[2]</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		<td>".$rw1[7]."</td>
		";
		if ($rw1[15]!="") {
			echo"<td><a href='img_transacciones/".$rw1[15]."' target='_blank'>ver imagen</a></td>";
		}else{
			echo"<td></td>";
		}
		
			if(($nivel_acceso==1 or $nivel_acceso==5 or $nivel_acceso==11) and $rw1[8]!=''){
			echo "<td align='center' >
			<a  onclick='pop_dis10($id_p,\"Confirmartransferencia\",\"$rw1[4]\")';  style='cursor: pointer;' title='Confirmar' ><img src='img/Confirmar1.png'></a></td>";
			}else {
				if($nivel_acceso==1){
					echo "<td align='center' >
					<a  onclick='pop_dis10($id_p,\"Confirmartransferencia\",\"$rw1[4]\")';  style='cursor: pointer;' title='Confirmar' ><img src='img/Confirmar1.png'></a></td>";
				
				}else {
						echo "	<td><img src='img/Confirmar.png'></a></td>";
					}
			}
	
		
		echo "	
		<td>".$rw1[8]."</td>
		<td>".$rw1[9]."</td>
		<td>".$rw1[13]."</td>
		<td>".$rw1[14]."</td>	
		";
/* 
		$sql="SELECT cla_nombre,tipo_nombre FROM `tipo_gastos` inner join clasificacion_gastos on inner_clasificacion_gastos=idclasificacion_gastos where idtipo_gastos='$rw1[12]';";
		$DB->Execute($sql);
		$rw3=mysqli_fetch_array($DB->Consulta_ID); */
		

		$LT->llenadocs2($DB, "pagoscuentas", $id_p, 1, 35, 1);

	if($nivel_acceso==1){
		$DB->edites($id_p, "pagoscuentas", 2,"delete");
	}
	echo "</tr>";
}


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