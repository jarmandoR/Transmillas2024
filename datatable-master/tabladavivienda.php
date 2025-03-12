<?php 
include("../connection/variables.php"); 
require_once "clases/conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();

// Capturar el valor de la variable desde la URL
$datos = isset($_GET['datos']) ? $_GET['datos'] : "";

if ($datos == 'historicos') {
    $cond = "  where Factura!='Sin facturar' and guia='' ";
    $idtable = "tablaHistoricos";  // Cambiado el ID para la tabla de Históricos
}else if($datos == 'historicosGuias') {
    $cond = " where  Factura='Sin facturar' and guia!=''";
    $idtable = "tablaHistoricosGuias";
} else {
    $cond = " where  factura='Sin facturar' and guia=''";
    $idtable = "iddatatable";
}

$sql = "SELECT `Idtransdavivienda`, `Fecha_Sistema`, `Documento`, `Descripcion_Motivo`, `Oficina_Recaudo`,`Valor_Total`,`Transaccion`,`Nit_Originador`,`factura`,guia FROM `transdavivienda` $cond";
$result = mysqli_query($conexion, $sql);

$campos = mysqli_fetch_fields($result);
?>

<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered" id="<?php echo $idtable; ?>">
        <thead style="background-color: #dc3545;color: white; font-weight: bold;">
            <tr>
            <th>Selec</th>
                <?php
                
                foreach ($campos as $campo) {
                    $valorcolum='50';
                    if($campo->name=='Idtransdavivienda'){
                        $campo->name='ID';
                        $valorcolum='20';
                    }
                    $nombreColumna = str_replace('_', ' ', $campo->name);

                    echo "<th>" . $nombreColumna . "</th>";
                }
                ?>
                <th >Remover</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tfoot style="background-color: #ccc;color: white; font-weight: bold;">
            <tr>
            <th style='max-width: 30px;'>Selec</th>
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
                <tr id='<?echo$mostrar[0];?>'>
                    <?php 
                echo "<td><input type='checkbox'  onchange='selecionado($mostrar[0])' class='checkbox' id='".$mostrar[0]."s' value='$mostrar[0]'></td>";

                   foreach ($mostrar as $clave => $valor) {
                    // Excluir la columna "factura"
                    if ($campos[$clave]->name != 'factura') {
                        echo "<td style='max-width: 50px;'>$valor</td>";
                    }else{
                  
                    $consulta="Idtransdavivienda=$mostrar[0]"; 
                    ?>
                    <td style=' text-align: center;' id="tdFactura<?php echo $mostrar[0]; ?>">
                        <?php
                        // Mostrar campo de texto y botón si la factura es diferente de "Sin facturar"
                        if ($mostrar[8] == 'Sin facturar') {
                            ?>
                            <!-- <div>
                                <input type="text" id="inputFactura<?php echo $mostrar[0]; ?>" placeholder="# Factura" style="width: 150px;">
                                <button class="btn btn-primary btn-sm" onclick="actualizarFactura('<?php echo $mostrar[0]; ?>')">
                                    Actualizar
                                </button>
                            </div> -->
                            <?php
                        }else{
                            echo "$mostrar[8]";  
                        }
                    }
                }
                        ?>
                    </td>
                    <td style='max-width: 30px; text-align: center;' >
                        <span class="btn btn-danger btn-sm" onclick="eliminarDatos('<?php echo $mostrar[0]; ?>','transdavivienda')">
                            <span class="fa fa-minus-circle"></span>
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span class="btn btn-danger btn-sm" onclick="QuitarDatos('<?php  echo $mostrar[0] ?>','transdavivienda')">
                            <span class="fa-trash"></span>
                        </span>
                        </td>
                </tr>
                <?php 
               
            }
            ?>
        </tbody>
    </table>
</div>
<?php
if ($datos == 'historicos' or $datos == 'historicosGuias') {

} else {
    ?>
     
            <table class="table table-hover table-condensed table-bordered" id="guias" >
            <thead style="background-color: rgb(7, 79, 145);color: white; font-weight: bold;">
                        <th colspan="11" style="text-align: center;">GUIAS </th>
            </thead>
                    <thead style="background-color: rgb(7, 79, 145);color: white; font-weight: bold;">
                        <th colspan='2' >Seleccionar</th>
                        <th colspan='3'>Guia</th>
                        <th colspan='3'>Valor</th>
                        <th colspan='3'>Foto</th>
                    </thead>
                    
                    <?php
                    $conde1.=" and date(pag_fecha)>='$param5' and date(pag_fecha)<='$param4'";
                    $sql1="SELECT `idpagoscuentas`, `pag_fecha`,`pag_guia`,`pag_idservicio`,usu_nombre, `pag_nombre`,`pag_cuenta`,   `pag_valor`,  `pag_userverifica`, `pag_fechaverifica`,`pag_tipopago`,`pag_idoperario`, pagoscuentas.pag_estado, pag_valorconfirmado,pag_numerotrans,pag_img_transaccion FROM `pagoscuentas` 
                    inner join usuarios on pag_idoperario=idusuarios inner join tipospagos on idtipospagos=pag_tipopago and pag_userverifica=''    WHERE idpagoscuentas>0  ORDER BY idpagoscuentas  ASC ";
                        $result1 = mysqli_query($conexion, $sql1);

                        // $campos = mysqli_fetch_fields($result1);
                while ($mostrar1 = mysqli_fetch_row($result1)) {

                    $sql2 = "SELECT Count(*) FROM `transdavivienda` where guia like '%$mostrar1[2]%' order by Fecha desc";

                    $result2 = mysqli_query($conexion, $sql2);

                    // $campos = mysqli_fetch_fields($result1);
                            while ($mostrar2 = mysqli_fetch_row($result2)) {

                                $existe=$mostrar2[0];
                            }

                        if ($existe>0) {
                            
                        }else {
                            echo "<tr id='$mostrar1[2]'>";
                    
                            echo "<td colspan='2'><input type='checkbox'  onchange='selecionado2(\"$mostrar1[2]\")' class='checkbox' id='".$mostrar1[2]."s' value='$mostrar1[0]'></td>";
                            echo "<td colspan='4'><span style='color: blue; text-decoration: underline; cursor: pointer;' onclick='abrirPopup($mostrar1[3])'>$mostrar1[2]</span></td>";
                            echo "<td colspan='4'>$mostrar1[7]</td>";
                            echo "<td colspan='4'><a href='../img_transacciones/$mostrar1[15]' target='_blank'>Ver foto</a></td>";
                
                            echo "</tr>";
                        }
                        

                
                
                    }
                    ?>
            </table>
      
        
        <table class="table table-hover table-condensed table-bordered" id="<?php echo $idtable; ?>">
                <thead style="background-color: rgb(7, 79, 145);color: white; font-weight: bold;">
                    <th colspan="11" style="text-align: center;">FACTURAS</th>
                </thead>                
                <thead style="background-color: rgb(7, 79, 145);color: white; font-weight: bold;">
                    
                    <th colspan="3">Seleccionar</th>
                    <th colspan="2">Factura</th>
                    <th colspan="2">Valor</th>
                    <th colspan="2">Credito</th>
                    <th colspan="2">Fecha</th>
                    <th colspan="2">Nit</th>
                    
                    <!-- <th>Foto</th> -->

                </thead>
                
                <?php
                $conde1.=" and date(pag_fecha)>='$param5' and date(pag_fecha)<='$param4'";
                $sql3="SELECT `idfacturascreditos`, `fac_fechafactura`,`fac_credito`, `fac_numerofactura`, `fac_fechaprefac`,`fac_idservicios`, `fac_iduserpre`,`fac_numeroref`, `fac_fechafacturado`, `fac_fechavencimiento`, `fac_estado`,`fac_tipopago`,`fac_iduserfac`,fac_precio,`fac_fecharadicado`,fac_fechapago,fac_notacredito,fac_fecharafacturado,fac_pagoconfir,fac_userconfirmo,fac_fechacomfir,fac_valorpendiente,fac_preciofinal,fac_correoven, fac_nit FROM `facturascreditos` WHERE   (fac_tipopago='Pendiente' or fac_tipopago is  null) and fac_fechafactura>'2023-06-01' and fac_estado='Facturado'     ORDER BY fac_fechafactura desc";
                    $result3 = mysqli_query($conexion, $sql3);

                    // $campos = mysqli_fetch_fields($result1);
            while ($mostrar3 = mysqli_fetch_row($result3)) {

                $sql4 = "SELECT Count(*) FROM `transdavivienda` where Factura like '%$mostrar3[7]%' order by Fecha desc";

                $result4 = mysqli_query($conexion, $sql4);

                // $campos = mysqli_fetch_fields($result1);
                        while ($mostrar4 = mysqli_fetch_row($result4)) {

                            $existee=$mostrar4[0];
                        }

                    if ($existee>0) {
                        
                    }else {
                        echo "<tr id='$mostrar3[7]'>";              
                        echo "<td colspan='3'><input type='checkbox'  onchange='selecionado3(\"$mostrar3[7]\")' class='checkbox' id='".$mostrar3[7]."s' value='$mostrar3[7]'></td>";
                        echo "<td colspan='2'>$mostrar3[7]</td>";
                        echo "<td colspan='2'>$mostrar3[13]</td>";
                        echo "<td colspan='2'>$mostrar3[2]</td>";
                        echo "<td colspan='2'>$mostrar3[1]</td>";
                        echo "<td colspan='2'>$mostrar3[24]</td>";
                        echo "</tr>";
                    }
                    

            
            
                }
                ?>
        </table>
        
    <?php

}
?>

