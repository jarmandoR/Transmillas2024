<?php 
require("login_autentica.php"); 
include("layout.php");
$fechaactual=date("Y-m-d");
?>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<style>
  .my-btn {
    margin-top: 20px;
    margin-bottom: 40px;
  }
</style>
<div class="container mt-5">
  <form class="mb-3">
    <div class="row">
      <div class="col-md-3">
        <label for="fecha">Fecha:</label>
        <input type="date" value="<?php echo$fechaactual?>" class="form-control" id="fecha">
      </div>
      <div class="col-md-3">
        <?php 
        $FB->llena_texto("Usuario:",32,2, $DB, "SELECT `idusuarios`,usu_nombre FROM  `usuarios`  WHERE  (usu_estado=1 or usu_filtro=1) ", "", $param32, 4, 0);
        ?>
      </div>
      <div class="col-md-2 mt-3">
       
          <button type="submit" class="btn btn-primary mt-4 my-btn">Filtrar</button>

      </div>
    </div>
  </form>
  <table id="usuarioslogin" class="table table-striped">
    <thead>
      <tr>
      <th class="sortable">ID Usuario</th>
      <th class="sortable">Nombre de usuario</th>
      <th class="sortable">Rol</th>
      <th class="sortable">IP</th>
      <th class="sortable">Fecha de ingreso</th>
      <th class="sortable">Tipo de dispositivo</th>
      </tr>
    </thead>
  </table>
</div>
<script>
$(document).ready(function() {
  // Configurar la datatable
  var table = $('#usuarioslogin').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "buscarlogin.php", // Archivo PHP que devuelve los datos de la tabla
      "type": "POST",
      "data": function(d) {
        // Agregar los valores de los filtros de búsqueda
        d.fecha = $('#fecha').val();
        d.usuario = $('#param32').val();
	    	d.start = d.start;
        d.length = d.length;
      }
    },
    "columns": [
      {"data": "idusername"},
      {"data": "username"},
      {"data": "rolname"},
      {"data": "ip"},
      {"data": "login_date"},
      {"data": "device_type"}
    ],
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
    },"order": [[4, "desc"]] // ordenar por la columna de fecha de ingreso de forma descendente
 
  });

 // Agregar la clase 'sortable' a los encabezados de las columnas que se pueden ordenar
 $('.sortable').on('click', function() {
    var column = table.column($(this).index());
    var direction = column.order()[0] === 'asc' ? 'desc' : 'asc';
    column.order(direction).draw();
  });

  // Agregar la acción del formulario de filtros de búsqueda
  $('form').submit(function(e) {
    console.log("Enviando datos");
    e.preventDefault();
    table.ajax.reload();
  });
});
</script>

<?php 
include("footer.php");
?>