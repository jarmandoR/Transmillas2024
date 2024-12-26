<?php 
include("../connection/variables.php"); 
require_once "clases/conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();

// Capturar el valor de la variable desde la URL
$datos = isset($_GET['datos']) ? $_GET['datos'] : "";

if ($datos == 'historicos') {
    $cond = " where factura!='Sin facturar'";
    $idtable = "tablaHistoricos";  // Cambiado el ID para la tabla de Históricos
} else {
    $cond = " where  factura='Sin facturar'";
    $idtable = "iddatatable";
}

$sql = "SELECT `Idtransdavivienda`, `Fecha_Sistema`, `Documento`, `Descripcion_Motivo`, `Oficina_Recaudo`,`Valor_Total`,`factura`,`Transaccion`,`Nit_Originador` FROM `transdavivienda` $cond";
$result = mysqli_query($conexion, $sql);

$campos = mysqli_fetch_fields($result);
?>

<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered" id="<?php echo $idtable; ?>">
        <thead style="background-color: #dc3545;color: white; font-weight: bold;">
            <tr>
                <?php
                
                foreach ($campos as $campo) {
                    $valorcolum='50';
                    if($campo->name=='Idtransdavivienda'){
                        $campo->name='ID';
                        $valorcolum='20';
                    }
                    $nombreColumna = str_replace('_', ' ', $campo->name);

                    echo "<th style='max-width: $valorcolum px;'>" . $nombreColumna . "</th>";
                }
                ?>
                <th style='max-width: 30px;'>Eliminar</th>
            </tr>
        </thead>
        <tfoot style="background-color: #ccc;color: white; font-weight: bold;">
            <tr>
                <?php
                foreach ($campos as $campo) {
                    echo "<td style='max-width: 50px;'>" . $campo->name . "</td>";
                }
                ?>
                <td style='max-width: 50px;'>Eliminar</td>
            </tr>
        </tfoot>
        <tbody>
            <?php 
            while ($mostrar = mysqli_fetch_row($result)) {
                ?>
                <tr>
                    <?php 
                   foreach ($mostrar as $clave => $valor) {
                    // Excluir la columna "factura"
                    if ($campos[$clave]->name != 'factura') {
                        echo "<td style='max-width: 50px;'>$valor</td>";
                    }else{
                  
                    $consulta="Idtransdavivienda=$mostrar[0]"; 
                    ?>
                    <td style='max-width: 50px; text-align: center;' id="tdFactura<?php echo $mostrar[0]; ?>">
                        <?php
                        // Mostrar campo de texto y botón si la factura es diferente de "Sin facturar"
                        if ($mostrar[6] == 'Sin facturar') {
                            ?>
                            <div>
                                <input type="text" id="inputFactura<?php echo $mostrar[0]; ?>" placeholder="# Factura" style="width: 150px;">
                                <button class="btn btn-primary btn-sm" onclick="actualizarFactura('<?php echo $mostrar[0]; ?>')">
                                    Actualizar
                                </button>
                            </div>
                            <?php
                        }else{
                            echo "$mostrar[6]";  
                        }
                    }
                }
                        ?>
                    </td>
                    <td style='max-width: 30px; text-align: center;' >
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


