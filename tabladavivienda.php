<?php 
include("../connection/variables.php"); 
require_once "clases/conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();
$sql = "SELECT `Idtransdavivienda`, `Fecha_Sistema`, `Documento`, `Descripcion_Motivo`, `Transaccion`, `Oficina_Recaudo`, `Nit_Originador`, `Valor_Cheque`, `Valor_Total`, `Referencia1`, `Referencia2`, `factura` FROM `transdavivienda`";
$result = mysqli_query($conexion, $sql);

$campos = mysqli_fetch_fields($result);
?>

<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered" id="iddatatable">
        <thead style="background-color: #dc3545;color: white; font-weight: bold;">
            <tr>
                <?php
                foreach ($campos as $campo) {
                    if($campo->name=='Idtransdavivienda'){
                        $campo->name='ID';
                    }
                    echo "<th>" . $campo->name . "</th>";
                }
                ?>
                <th>Actualizar Factura</th>
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
                <td>Actualizar Factura</td>
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
                    $consulta="Idtransdavivienda=$mostrar[0]"; 
                    ?>
                    <td style="text-align: center;">
                        <?php
                        // Mostrar campo de texto y botón si la factura es diferente de "Sin facturar"
                        if ($mostrar[11] != 'Sin facturar') {
                            ?>
                            <div>
                                <input type="text" id="inputFactura<?php echo $mostrar[0]; ?>" placeholder="Nuevo valor">
                                <button class="btn btn-primary btn-sm" onclick="actualizarFactura('<?php echo $consulta; ?>')">
                                    Actualizar
                                </button>
                            </div>
                            <?php
                        }
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <span class="btn btn-danger btn-sm" onclick="eliminarDatos('<?php echo $consulta; ?>','transdavivienda')">
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

    function actualizarFactura(idTransaccion) {
    // Obtener el nuevo valor de la factura
    var nuevoValor = $('#inputFactura' + idTransaccion).val();

    // Realizar la actualización solo si el nuevo valor no está vacío
    if (nuevoValor.trim() !== '') {
        // Hacer la solicitud AJAX para actualizar la factura
        $.ajax({
            type: 'POST',
            url: 'actualizar_factura.php', // Cambia esto por la ruta correcta del script de actualización
            data: { idTransaccion: idTransaccion, nuevoValor: nuevoValor },
            success: function(response) {
                if(response=='ok'){
                      // Actualizar la columna en la tabla con el nuevo valor
                      $('#inputFactura' + idTransaccion).closest('td').text(nuevoValor);
                     // Manejar la respuesta del servidor (puedes mostrar un mensaje de éxito, error, etc.)
                     alert("La factura se actualizó correctamente.");  
                }
               
            },
            error: function(error) {
                console.error(error);
            }
        });
    } else {
        alert('Ingrese un nuevo valor para la factura.');
    }
}

</script>
