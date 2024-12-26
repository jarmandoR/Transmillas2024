<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<title>Informe Davivienda</title>
	<?php require_once "scripts.php";  
	$id_nombre=$_GET['id_nombre'];     ?>
	<style>
		/* Establecer la altura y el ancho de varios elementos al 100% de la ventana */
		html, body, .container, .row, .col-sm-12, .card-body {
			height: 100%;
			width: 100%;
			margin: 0;
			padding: 0;
		}

		#tablaInforme,
		#tablaHistoricos {
			height: 100%;
			width: 100%;
		}

		.container {
			max-width: 100%;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active" id="informe-tab" data-toggle="tab" href="#informe">Informe</a>
					</li>
				
					<li class="nav-item">
						<a class="nav-link" id="historicos-tab" data-toggle="tab" href="#historicos">Históricos facturas</a>
					</li>
					<li class="nav-item">
                        <a class="nav-link" id="Historicos-tab" data-toggle="tab" href="#historicosGuias">Históricos guias</a>
                    </li>
					
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade show active" id="informe">
						<div class="card-header">
							INFORME DAVIVIENDA
							<button class="btn btn-primary btn-sm" onclick="actualizarFactura()">Actualizar factura </button>
                        	<button class="btn btn-primary btn-sm" onclick='actualizarGuia("<?echo $id_nombre;?>")'>Actualizar guia</button>
						</div>
						<div class="card-body">
							<hr>
							<table id="tablaInforme" class="display"></table>
						</div>
					</div>
					<div class="tab-pane fade" id="historicos">
						<div class="card-header">
							INFORME HISTÓRICOS DAVIVIENDA
						</div>
						<div class="card-body">
							<hr>
							<table id="tablaHistoricos" class="display"></table>
						</div>
					</div>
					<div class="tab-pane fade" id="historicosGuias">
                        <div class="card-header">
                            INFORME HISTORICOS GUIAS
                        </div>
                        <div class="card-body">
                            <hr>
                            <table id="tablaHistoricosGuias" class="display"></table>
                        </div>

                        <!-- Contenido de la pestaña Históricos (puedes agregar lo necesario aquí) -->
                    </div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		    let idsSeleccionados = [];
			let idsSeleccionados2 = [];
			let idsSeleccionados3 = [];
		function eliminarDatos(id, tabla) {
			alertify.confirm('Eliminar un Registro', '¿Seguro de eliminar este Registro :(?', function () {
				$.ajax({
					type: "POST",
					data: "idTransaccion=" + id + "&tabla=" + tabla,
					url: "remover.php",
					success: function (r) {
						if (r.includes("OK")) {
							location.reload();
							alertify.success("Removido con éxito !");
						} else {
							alertify.error("No se pudo remover...");
						}
					}
				});
			}, function () {});
		}

		// function actualizarFactura(idTransaccion) {
		// 	var nuevoValor = $('#inputFactura' + idTransaccion).val();

		// 	if (nuevoValor.trim() !== '') {
		// 		$.ajax({
		// 			type: 'POST',
		// 			url: 'actualizar_factura.php',
		// 			data: { idTransaccion: idTransaccion, nuevoValor: nuevoValor, tabla: 'Davivienda' },
		// 			success: function (response) {
		// 				console.log(response);
		// 				if (response == 'OK') {
		// 					$('#tdFactura' + idTransaccion).text(nuevoValor);
		// 					alertify.success("La factura se actualizó correctamente !");
		// 				}
		// 			},
		// 			error: function (error) {
		// 				console.error(error);
		// 			}
		// 		});
		// 	} else {
		// 		alert('Ingrese un nuevo valor para la factura.');
		// 	}
		// }

		$(document).ready(function () {
			cargarContenidoPestanaActiva();

			$('.nav-tabs a').on('shown.bs.tab', function (e) {
				cargarContenidoPestanaActiva();
			});

			// function cargarContenidoPestanaActiva() {
			// 	var pestanaActivaId = $('.nav-tabs .active').attr('href');
			// 	var datos = (pestanaActivaId === '#historicos') ? 'historicos' : 'informe';
			// 	var idTabla = (pestanaActivaId === '#historicos') ? 'tablaHistoricos' : 'tablaInforme';

			// 	$('#' + idTabla).load('tabladavivienda.php?datos=' + datos, function () {
			// 		$('#' + idTabla).DataTable();
			// 	});
			// }


            function cargarContenidoPestanaActiva() {
                var pestanaActivaId = $('.nav-tabs .active').attr('href');
                var datos, idTabla;

                // Determinar los datos y la tabla según la pestaña activa
                if (pestanaActivaId === '#historicos') {
                    datos = 'historicos';
                    idTabla = 'tablaHistoricos';
                } else if (pestanaActivaId === '#informe') {
                    datos = 'informe';
                    idTabla = 'tablaInforme';
                } else if (pestanaActivaId === '#historicosGuias') {
                    datos = 'historicosGuias'; // Nuevo parámetro para la nueva pestaña
                    idTabla = 'tablaHistoricosGuias';
                }

                // Cargar contenido y luego inicializar DataTables
                $('#' + idTabla).load('tabladavivienda.php?datos=' + datos, function() {
                    $('#' + idTabla).DataTable({
                        "order": [[1, 'desc']],  // Ordenar por la columna 1 en orden descendente
                        "pageLength": 50         // Mostrar 50 registros por página
                    });
                });
            }


		});


		
    // Función para manejar los clics en los checkboxes
    function selecionado(iduser) {
		var checkbox = document.getElementById(iduser+"s");
        // const checkbox = event.target;
        const id = iduser;

        if (checkbox.checked) {
            // Si el checkbox está marcado, agregar el ID al array
            idsSeleccionados.push(id);
        } else {
            // Si el checkbox está desmarcado, eliminar el ID del array
            const index = idsSeleccionados.indexOf(id);
            if (index !== -1) {
                idsSeleccionados.splice(index, 1);
            }
        }

        console.log("IDs seleccionados:", idsSeleccionados);
    }
    function selecionado2(iduser) {
		var checkbox = document.getElementById(iduser+"s");
        // const checkbox = event.target;
        const id = iduser;

        if (checkbox.checked) {
            // Si el checkbox está marcado, agregar el ID al array
            idsSeleccionados2.push(id);
        } else {
            // Si el checkbox está desmarcado, eliminar el ID del array
            const index = idsSeleccionados2.indexOf(id);
            if (index !== -1) {
                idsSeleccionados2.splice(index, 1);
            }

        }

        console.log("IDs seleccionados:", idsSeleccionados2);
    }
    function selecionado3(iduser) {
		var checkbox = document.getElementById(iduser+"s");
        // const checkbox = event.target;
        const id = iduser;

        if (checkbox.checked) {
            // Si el checkbox está marcado, agregar el ID al array
            idsSeleccionados3.push(id);
        } else {
            // Si el checkbox está desmarcado, eliminar el ID del array
            const index = idsSeleccionados3.indexOf(id);
            if (index !== -1) {
                idsSeleccionados3.splice(index, 1);
            }
        }

        console.log("IDs seleccionados:", idsSeleccionados3);
    }

	function actualizarFactura() {

if (idsSeleccionados3.length === 0 || idsSeleccionados.length === 0) {
	console.log("El array NO contiene elementos");
} else {
   
					Swal.fire({
                        title: 'Escribe tu comentario',
                        input: 'text',
                        inputPlaceholder: 'Ingresa tu comentario aquí',
                        showCancelButton: true,
                        confirmButtonText: 'Enviar',
                        cancelButtonText: 'Cancelar',
                        inputValidator: (value) => {
                            if (!value) {
                                return 'Por favor ingresa un comentario.';
                            }
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const comentario = result.value; // Captura el texto del input
                            console.log('Comentario ingresado:', comentario); // Acción con el valor ingresado
                            Swal.fire('¡Comentario enviado!', `Tu comentario: "${comentario}"`, 'success');
                        
							$.ajax({
								type: 'POST',
								url: 'actualizar_factura.php', // Cambia esto por la ruta correcta del script de actualización
								data: { idTransaccion: JSON.stringify(idsSeleccionados),tabla:'Davivienda',facturas: JSON.stringify(idsSeleccionados3),descripcion:comentario},
								success: function(response) {
									console.log(response);
									// if(response=='OK'){
										//$('#tablaDatatable').load('tabladavivienda.php');
										// Actualizar el valor directamente en la celda
										// $('#tdFactura' + idTransaccion).text(nuevoValor);
											alert("Las facturas se actualizó correctamente!");
											
											idsSeleccionados.forEach(id => {
												console.log("ID:", id);
												const fila = document.getElementById(id);
												if (fila) {
													fila.style.display = 'none'; // Ocultar la fila
												}
											});
											idsSeleccionados3.forEach(id => {
												console.log("ID:", id);
												const fila = document.getElementById(id);
												if (fila) {
													fila.style.display = 'none'; // Ocultar la fila
												}
											});
									// }
									idsSeleccionados3 = [];
									idsSeleccionados = [];
								},
								error: function(error) {
									console.error(error);
								}
							});
                        
                        
                        
                        
                        }
                    });



















}
}

function actualizarGuia(nombre,idFila) {
// Obtener el nuevo valor de la factura
// var nuevoValor = $('#inputGuia' + idTransaccion).val();

// Realizar la actualización solo si el nuevo valor no está vacío
if (idsSeleccionados2.length === 0 || idsSeleccionados.length === 0) {
	console.log("El array NO contiene elementos");
} else {
   
	$.ajax({
		type: 'POST',
		url: 'actualizar_guia.php', // Cambia esto por la ruta correcta del script de actualización
		data: { idTransaccion: JSON.stringify(idsSeleccionados),tabla:'Davivienda',guias: JSON.stringify(idsSeleccionados2),id_nombre:nombre },
		success: function(response) {
			console.log(response);
			if(response=='OK'){
				//$('#tablaDatatable').load('tabladavivienda.php');
				// Actualizar el valor directamente en la celda
				// $('#tdFactura' + idTransaccion).text(nuevoValor);
					 alert("Las guias se actualizó correctamente !");

					idsSeleccionados.forEach(id => {
						console.log("ID:", id);
						const fila = document.getElementById(id);
						if (fila) {
							fila.style.display = 'none'; // Ocultar la fila
						}
					});
					idsSeleccionados2.forEach(id => {
						console.log("ID:", id);
						const fila = document.getElementById(id);
						if (fila) {
							fila.style.display = 'none'; // Ocultar la fila
						}
					});
					idsSeleccionados2 = [];
					idsSeleccionados = [];
			}
		
		},
		error: function(error) {
			console.error(error);
		}
	});
}
// if (nuevoValor.trim() !== '') {
	// Hacer la solicitud AJAX para actualizar la factura

// } else {
// 	alert('Ingrese un nuevo valor para la factura.');
// }
}


function abrirPopup(idparam) {
            // Define las variables
            const variable1 = "valor1";
            const variable2 = "valor2";

            // Construye la URL con los parámetros GET
            const url = `https://sistema.transmillas.com/detalle_pop.php?id_param=${encodeURIComponent(idparam)}&tabla=Recogidas`;

            // Abre el popup
            window.open(
                url, // URL de la página
                "PopupWindow", // Nombre del popup
                "width=800,height=600,scrollbars=yes,resizable=yes" // Opciones del popup
            );
        }


	</script>
</body>
</html>
