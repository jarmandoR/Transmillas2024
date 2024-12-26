<?php 
include("../connection/variables.php"); 
require_once "clases/conexion.php";
$obj = new conectar();
 $conexion = $obj->conexion();
$sql = "SELECT `Idtransbancolombia`, `Fecha`, `Descripcion`, `SucursalCanal`, `Referencia1`, `Referencia2`, `Documento`, `Valor`,Factura FROM `transbancolombia`";
$result = mysqli_query($conexion, $sql);

$campos = mysqli_fetch_fields($result);
?>

<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered" id="iddatatable">
        <thead style="background-color: #dc3545;color: white; font-weight: bold;">
            <tr>
                <?php
                foreach ($campos as $campo) {
					if($campo->name=='Idtransbancolombia'){
						$campo->name='ID';
					}
                    echo "<th>" . $campo->name . "</th>";
                }
                ?>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tfoot style="background-color: #ccc;color: white; font-weight: bold;">
            <tr>
                <?php
                foreach ($campos as $campo) {
                    echo "<td>" . $campo->name . "</td>";
                }
                ?>
                <td>Eliminar</td>
            </tr>
        </tfoot>
        <tbody>
            <?php 
            while ($mostrar = mysqli_fetch_row($result)) {
                ?>
                <tr>
                    <?php 
                    foreach ($mostrar as $valor) {
                        echo "<td>$valor</td>";
                    }
					$consulta="Idtransbancolombia=$mostrar[0]"; 
                    ?>
                    <td style="text-align: center;">
                        <span class="btn btn-danger btn-sm" onclick="eliminarDatos('<?php  echo $consulta ?>','transbancolombia')">
                            <span class="fa fa-trash"></span>
                        </span>
                    </td>
                </tr>
                <?php 
            }
            ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#iddatatable').DataTable();
    });
</script>
