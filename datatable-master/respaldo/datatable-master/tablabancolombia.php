<?php 
include("../connection/variables.php"); 
require_once "clases/conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();

// Capturar el valor de la variable desde la URL
$datos = isset($_GET['datos']) ? $_GET['datos'] : "";

if ($datos == 'historicos') {
    $cond = " where Factura!='Sin facturar'";
    $idtable = "tablaHistoricos";  // Cambiado el ID para la tabla de Históricos
} else {
    $cond = " where  Factura='Sin facturar'";
    $idtable = "iddatatable";
}

$sql = "SELECT `Idtransbancolombia`, `Fecha`, `Descripcion`, `SucursalCanal`, `Referencia1`, `Referencia2`, `Documento`, `Valor`,Factura,guia FROM `transbancolombia` $cond order by Fecha desc";
$result = mysqli_query($conexion, $sql);

$campos = mysqli_fetch_fields($result);
?>

<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered" id="<?php echo $idtable; ?>">
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
                <th>Confirmar</th>
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
                <td>Confirmar</td>
                <td>Eliminar</td>
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
                    if($campos[$clave]->name == 'Factura'){
                      
                        $consulta="Idtransbancolombia=$mostrar[0]"; 
                        ?>
                        <td style="text-align: center;" id="tdFactura<?php echo $mostrar[0]; ?>">
                            <?php
                            // Mostrar campo de texto y botón si la factura es diferente de "Sin facturar"
                            if ($mostrar[8] == 'Sin facturar'){
                                ?>
                                <div>
                                    <input type="text" id="inputFactura<?php echo $mostrar[0]; ?>" placeholder="# Factura" style="width: 150px;">
                                    <button class="btn btn-primary btn-sm" onclick="actualizarFactura('<?php echo $mostrar[0]; ?>')">
                                        Actualizar
                                    </button>
                                </div>
                                <?php
                            }else{
                                echo "$mostrar[8]";  
                            }
                            ?> 
                            </td>   
                            <?php
                        }elseif($campos[$clave]->name == 'guia'){
                      
                            $consulta="Idtransbancolombia=$mostrar[0]"; 
                            ?>
                            <td style="text-align: center;" id="tdFactura<?php echo $mostrar[0]; ?>">
                                <?php
                                // Mostrar campo de texto y botón si la factura es diferente de "Sin facturar"
                                if ($mostrar[9] == ''){
                                    ?>
                                    <div>
                                        <input type="text" id="inputGuia<?php echo $mostrar[0]; ?>" placeholder="# Guia" style="width: 150px;">
                                        <button class="btn btn-primary btn-sm" onclick="actualizarGuia('<?php echo $mostrar[0]; ?>')">
                                            Actualizar
                                        </button>
                                    </div>
                                    <?php
			                        echo "<td><input type='checkbox'  onchange='selecionado($idusuario)' class='checkbox' id='".$idusuario."s' value='$idusuario'></td>";

                                }else{
                                    echo "$mostrar[9]";  
                                }
                                ?> 
                                </td>   
                                <?php

                        }elseif ($campos[$clave]->name != 'Factura') {
                            echo "<td>$valor</td>";
                        }

                    }
                    ?>
                    <?php
                    if ($mostrar[9] != ''){
					echo "<td align='center' >
					<a  onclick='pop_dis10($mostrar[9],\"Confirmartransferencia\",\"$mostrar[7]\")';  style='cursor: pointer;' title='Confirmar' ><img src='../img/Confirmar1.png'></a></td>";
                    }else {
                        echo "<td align='center' >Actualice primero el numero de guia</td>";
                    }
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

