<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Título de tu página</title>
	<?php require_once "scripts.php";  ?>
	<style>
		/* Establecer la altura y el ancho de varios elementos al 100% de la ventana */
		html, body, .container, .row, .col-sm-12,.card-body {
			height: 100%;
			width: 100%;
			margin: 0;
			padding: 0;
		}

		#tablaDatatable {
			height: 100%;
			width: 100%;
		}

		.container {
			max-width: 100%;
		}

		   /* Ajustar el tamaño de fuente inversamente proporcional al número de columnas */
		   .dataTables_wrapper table.dataTable thead th,
        .dataTables_wrapper table.dataTable tbody td {
            font-size: calc(6px + 1vw - 1px * var(--column-count)); /* Ajusta según sea necesario */
        }
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">

					<div class="card-body">
						<hr>
						<table id="tablaDatatable" class="display"></table>

					</div>

			</div>
		</div>
	</div>

</body>
</html>

<script type="text/javascript">



	$(document).ready(function(){

		$('#tablaDatatable').load('tabladavivienda.php');
	});


</script>

<script type="text/javascript">

	function eliminarDatos(id,tabla){
		alertify.confirm('Eliminar un Registro', '¿Seguro de eliminar este Registro :(?', function(){ 

			$.ajax({
				type:"POST",
				data:"id=" + id+"&tabla=" + tabla,
				url:"procesos/eliminar.php",
				success:function(r){
					if(r==1){
						$('#tablaDatatable').load('tabladavivienda.php');
						alertify.success("Eliminado con exito !");
					}else{
						alertify.error("No se pudo eliminar...");
					}
				}
			});

		}
		, function(){

		});
	}
</script>