<?php 
//   include("../cabezote4.php"); 
include("../connection/variables.php"); 
require_once "clases/conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();    
$id_nombre=$_GET['id_nombre'];                  
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe Bancolombia</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php require_once "scripts.php";  ?>
    <style>
        /* Establecer la altura y el ancho de varios elementos al 100% de la ventana */
        html, body, .container, .row, .col-sm-12, .card-body {
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 100%;
        }

        /* Ajustar el tamaño de fuente inversamente proporcional al número de columnas */
        .dataTables_wrapper table.dataTable thead th,
        .dataTables_wrapper table.dataTable tbody td {
            font-size: calc(8px + 1vw - 1px * var(--column-count)); /* Ajusta según sea necesario */
        }
      
        /* Estilo del Modal */
        .modal {
            display: none; /* Ocultar por defecto */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0); /* Fondo oscuro */
            background-color: rgba(0,0,0,0.4); /* Fondo con opacidad */
        }

        /* Contenido del Modal */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        /* Estilo del botón de cerrar */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
                    <?php 
                        // if($nivel_acceso==1) { 
                        
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" id="historicos-tab" data-toggle="tab" href="#historicos">Históricos Facturas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="Historicos-tab" data-toggle="tab" href="#historicosGuias">Históricos guias</a>
                    </li>
                    
                    <?php 
                        // }
                     ?>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="informe">
                        <div class="card-header">
                            INFORME BANCOLOMBIA
                        <button class="btn btn-primary btn-sm" onclick="actualizarFactura()">Actualizar factura </button>
                        <button class="btn btn-primary btn-sm" onclick='actualizarGuia("<?echo $id_nombre;?>")'>Actualizar guia</button>

                        </div>
                        <!-- <div class="card-header">     
                        <button class="btn btn-primary btn-sm" onclick="actualizarGuia('hol')">Actualizar</button>
                        </div> -->
                        <div class="card-body">
                            <hr>
                            <table id="tablaInforme" class="display"></table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="historicos">
                        <div class="card-header">
                            INFORME HISTORICOS BANCOLOMBIA
                        </div>
                        <div class="card-body">
                            <hr>
                            <table id="tablaHistoricos" class="display"></table>
                        </div>

                        <!-- Contenido de la pestaña Históricos (puedes agregar lo necesario aquí) -->
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
                        console.log(r);
                        if (r.includes("OK")) {
                            // Recargar la página actual
                            location.reload();
                            // Opcionalmente, puedes recargar solo la tabla si es un componente dinámico
                            // $('#tablaDatatable').DataTable().ajax.reload();
                            alertify.success("Eliminado con éxito !");
                        } else {
                            alertify.error("No se pudo eliminar...");
                        }
                    }
                });
            }, function () {

            });
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
                                data: { idTransaccion: JSON.stringify(idsSeleccionados),tabla:'Bancolombia',facturas: JSON.stringify(idsSeleccionados3),descripcion:comentario},
                                success: function(response) {
                                    console.log(response);
                                    // if(response=='OK'){
                                        //$('#tablaDatatable').load('tabladavivienda.php');
                                        // Actualizar el valor directamente en la celda
                                        // $('#tdFactura' + idTransaccion).text(nuevoValor);
                                            // alert("Las facturas se actualizó correctamente!");
                                            
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
						data: { idTransaccion: JSON.stringify(idsSeleccionados),tabla:'Bancolombia',guias: JSON.stringify(idsSeleccionados2),id_nombre:nombre },
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

            
			
        $(document).ready(function(){
            // Cargar el contenido de la pestaña activa al cargar la página
            cargarContenidoPestanaActiva();

            // Agregar un controlador de eventos para el cambio de pestaña
            $('.nav-tabs a').on('shown.bs.tab', function (e) {
                cargarContenidoPestanaActiva();
            });

            // function cargarContenidoPestanaActiva() {
            //     var pestanaActivaId = $('.nav-tabs .active').attr('href');
            //     var datos = (pestanaActivaId === '#historicos') ? 'historicos' : 'informe';
            //     var idTabla = (pestanaActivaId === '#historicos') ? 'tablaHistoricos' : 'tablaInforme';

            //     // Cargar contenido y luego inicializar DataTables
            //     $('#' + idTabla).load('tablabancolombia.php?datos=' + datos, function() {
            //         // $('#' + idTabla).DataTable();
            //         $('#' + idTabla).DataTable({
            //             "order": [[1, 'desc']],  // Asegúrate de que el índice sea el de la columna de 'Fecha'
            //             "pageLength": 50  
            //         });
            //     });
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
                $('#' + idTabla).load('tablabancolombia.php?datos=' + datos, function() {
                    $('#' + idTabla).DataTable({
                        "order": [[1, 'desc']],  // Ordenar por la columna 1 en orden descendente
                        "pageLength": 50         // Mostrar 50 registros por página
                    });
                });
            }

        });
        // Función para abrir el popup
        function pop_dis10(id_p, tipo, valor) {
            // Mostrar el modal
            document.getElementById("modalPopup").style.display = "block";
            
            // Opcional: puedes rellenar los inputs con los valores de id_p, tipo o mensaje si los necesitas
            document.getElementById("input1").value = '';   // Ejemplo de cómo llenar los inputs
            document.getElementById("input2").value = valor;   // Ejemplo de cómo llenar los inputs
            document.getElementById("input3").value = ''; // Ejemplo de cómo llenar los inputs
            document.getElementById("input4").value = id_p; // Ejemplo de cómo llenar los inputs

        }

        // Función para cerrar el popup
        function closeModal() {
            document.getElementById("modalPopup").style.display = "none";
        }

        // Función para manejar el formulario
        function submitForm() {
            var input1Value = document.getElementById("input1").value;
            var input2Value = document.getElementById("input2").value;
            var input4Value = document.getElementById("input4").value; // Si quieres usar el valor del input 3
            var input3 = document.getElementById("input3"); // El input tipo 'file'

            // Crear el objeto FormData para enviar el archivo y los otros datos
            var formData = new FormData();

            // Agregar los datos al FormData
            // formData.append("id_param", id_p);  // Asumimos que 'idclinte' está definido en otro lugar
            formData.append("param6", input1Value);
            formData.append("param8", input2Value);
            formData.append("id_param", input4Value);

            // Agregar el archivo al FormData
            if (input3.files.length > 0) {
                formData.append("param_file", input3.files[0]); // 'param_file' es el nombre del campo del archivo en el servidor
            }

            // Enviar la solicitud AJAX con FormData
            $.ajax({
                url: "actualizar_pago.php",  // Cambia esto con la URL de tu archivo PHP
                type: "POST",
                data: formData,
                processData: false,  // Esto le dice a jQuery que no procese los datos
                contentType: false,  // Esto le dice a jQuery que no configure el tipo de contenido, ya que será 'multipart/form-data'
                success: function(respuesta) {
                    console.log(respuesta);  // Aquí puedes manejar la respuesta del servidor
                },
                error: function(xhr, status, error) {
                    console.log("Error al enviar los datos: ", error);
                }
            });

            // Cerrar el modal después de confirmar
            closeModal();
        }


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
 <!-- Ventana Modal (popup) -->
<div id="modalPopup" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Confirmar Transferencia</h2>
        <form id="formPopup">
            <label for="input1">Numero de transacion:</label>
            <input type="text" id="input1" name="input1" placeholder="Numero de transacion:"><br><br>

            <label for="input2">Valor Confirmado:</label>
            <input type="text" id="input2" name="input2" placeholder="Valor Confirmado:"><br><br>

            <label for="input3">Foto comprobante:</label>
            <input type="file" id="input3" name="input3" placeholder="Ingrese dato 3"><br><br>

            <input type="hidden" id="input4" name="input4" placeholder="Ingrese dato 3"><br><br>
            <button type="button" onclick="submitForm()">Confirmar</button>
        </form>
    </div>
</div>   
</body>
</html>