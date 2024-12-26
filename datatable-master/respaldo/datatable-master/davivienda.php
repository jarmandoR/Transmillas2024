<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Informe Davivienda</title>
	<?php require_once "scripts.php";  ?>
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
					<?php if($nivel_acceso==1) { ?>
					<li class="nav-item">
						<a class="nav-link" id="historicos-tab" data-toggle="tab" href="#historicos">Históricos</a>
					</li>
					<?php } ?>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade show active" id="informe">
						<div class="card-header">
							INFORME DAVIVIENDA
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
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function eliminarDatos(id, tabla) {
			alertify.confirm('Eliminar un Registro', '¿Seguro de eliminar este Registro :(?', function () {
				$.ajax({
					type: "POST",
					data: "id=" + id + "&tabla=" + tabla,
					url: "procesos/eliminar.php",
					success: function (r) {
						if (r == 1) {
							location.reload();
							alertify.success("Eliminado con éxito !");
						} else {
							alertify.error("No se pudo eliminar...");
						}
					}
				});
			}, function () {});
		}

		function actualizarFactura(idTransaccion) {
			var nuevoValor = $('#inputFactura' + idTransaccion).val();

			if (nuevoValor.trim() !== '') {
				$.ajax({
					type: 'POST',
					url: 'actualizar_factura.php',
					data: { idTransaccion: idTransaccion, nuevoValor: nuevoValor, tabla: 'Davivienda' },
					success: function (response) {
						console.log(response);
						if (response == 'OK') {
							$('#tdFactura' + idTransaccion).text(nuevoValor);
							alertify.success("La factura se actualizó correctamente !");
						}
					},
					error: function (error) {
						console.error(error);
					}
				});
			} else {
				alert('Ingrese un nuevo valor para la factura.');
			}
		}

		$(document).ready(function () {
			cargarContenidoPestanaActiva();

			$('.nav-tabs a').on('shown.bs.tab', function (e) {
				cargarContenidoPestanaActiva();
			});

			function cargarContenidoPestanaActiva() {
				var pestanaActivaId = $('.nav-tabs .active').attr('href');
				var datos = (pestanaActivaId === '#historicos') ? 'historicos' : 'informe';
				var idTabla = (pestanaActivaId === '#historicos') ? 'tablaHistoricos' : 'tablaInforme';

				$('#' + idTabla).load('tabladavivienda.php?datos=' + datos, function () {
					$('#' + idTabla).DataTable();
				});
			}
		});
	</script>
</body>
</html>
