<?php 
include("../connection/variables.php"); 
require_once "clases/conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();

// Capturar el valor de la variable desde la URL
$datos = isset($_GET['datos']) ? $_GET['datos'] : "";

if ($datos == 'historicos') {
    $cond = " where Factura!='Sin facturar' and guia='' ";
    $idtable = "tablaHistoricos";  // Cambiado el ID para la tabla de Históricos
} else if($datos == 'historicosGuias') {
    $cond = " where  Factura='Sin facturar' and guia!=''";
    $idtable = "tablaHistoricosGuias";
}else {
    $cond = " where  Factura='Sin facturar' and guia=''";
    $idtable = "iddatatable";
}

$sql = "SELECT `Idtransbancolombia`, `Fecha`, `Descripcion`, `SucursalCanal`, `Referencia1`, `Referencia2`, `Documento`, `Valor`,Factura,guia FROM `transbancolombia` $cond order by Fecha desc";
$result = mysqli_query($conexion, $sql);

$campos = mysqli_fetch_fields($result);
?>

    <div class="table-responsive" style="float: left; margin-right: 10px;">
        <table class="table table-hover table-condensed table-bordered" id="<?php echo $idtable; ?>">
        <thead style="background-color: #dc3545;color: white; font-weight: bold;">
                <tr>
                    <?php
                    foreach ($campos as $campo) {
                        if($campo->name=='Idtransbancolombia'){
                            $campo->name='ID';
                        }
                        if($campo->name=='guia'or $campo->name=='Factura'){
                            
                        }else {
                            echo "<th>" . $campo->name . "</th>";
                        }


                    }
                    if ($datos == 'historicos' or $datos == 'historicosGuias') {
                        echo "<th>Guias</th>";
                        echo "<th># Factura</th>";
                    }

                    ?>
                    <th>Confirmar</th>
                    <th>Seleccionar</th>
                    <th>Remover</th>
                </tr>
            </thead>
            <tfoot style="background-color: #ccc;color: white; font-weight: bold;">
                <tr>
                    <?php
                    // foreach ($campos as $campo) {
                    //     echo "<td>" . $campo->name . "</td>";
                    // }

                    ?>
                    <td colspan="11"></td>
                    
                </tr>
            </tfoot>
            <tbody>
                <?php 
                while ($mostrar = mysqli_fetch_row($result)) {
                    ?>
                    <tr id='<?echo$mostrar[0];?>'>
                        <?php 
                        
                        foreach ($mostrar as $clave => $valor) {
                            // Excluir la columna "factura"
                            
                        if($campos[$clave]->name == 'Factura'){
                        
                            $consulta="Idtransbancolombia=$mostrar[0]"; 
                            ?>
                                <?php
                                // Mostrar campo de texto y botón si la factura es diferente de "Sin facturar"
                                if ($mostrar[8] == 'Sin facturar'){
                                    ?>

                                    <?php

                                }else{
                                }
                                ?> 
                                <?php
                            }elseif($campos[$clave]->name == 'guia'){
                        
                                $consulta="Idtransbancolombia=$mostrar[0]"; 
                                ?>
                                    <?php
                                    // Mostrar campo de texto y botón si la factura es diferente de "Sin facturar"
                                    if ($mostrar[9] == ''){
                                        ?>
                                        
                                        <?php

                                    }else{
                                    }
                                    ?> 
                                    <?php

                            }elseif ($campos[$clave]->name != 'Factura') {
                                echo "<td>$valor</td>";
                            }

                            

                        }
                        if ($datos == 'historicos' or $datos == 'historicosGuias') {
                            echo "<td>$mostrar[9]</td>";
                            echo "<td>$mostrar[8]</td>";
                        }
                        ?>
                        <?php
                        if ($mostrar[9] != ''){
                        echo "<td align='center' >
                        <a  onclick='pop_dis10($mostrar[9],\"Confirmartransferencia\",\"$mostrar[7]\")';  style='cursor: pointer;' title='Confirmar' ><img src='../img/Confirmar1.png'></a></td>";
                        }else {
                            echo "<td align='center' >Actualice</td>";
                        }
                        echo "<td><input type='checkbox'  onchange='selecionado($mostrar[0])' class='checkbox' id='".$mostrar[0]."s' value='$mostrar[0]'></td>";

                        ?>
                        <td style="text-align: center;">
                        <span class="btn btn-danger btn-sm" onclick="eliminarDatos('<?php  echo $mostrar[0] ?>','Bancolombia')">
                            <span class="fa fa-minus-circle"></span>
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

                    $sql2 = "SELECT Count(*) FROM `transbancolombia` where guia like '%$mostrar1[2]%' order by Fecha desc";

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
                    <th colspan="4">Factura</th>
                    <th colspan="3">Cliente</th>
                    <th >Valor</th>
                    <!-- <th>Foto</th> -->

                </thead>
                
                <?php
                $conde1.=" and date(pag_fecha)>='$param5' and date(pag_fecha)<='$param4'";
                $sql3="SELECT `idfacturascreditos`, `fac_fechafactura`,`fac_credito`, `fac_numerofactura`, `fac_fechaprefac`,`fac_idservicios`, `fac_iduserpre`,`fac_numeroref`, `fac_fechafacturado`, `fac_fechavencimiento`, `fac_estado`,`fac_tipopago`,`fac_iduserfac`,fac_precio,`fac_fecharadicado`,fac_fechapago,fac_notacredito,fac_fecharafacturado,fac_pagoconfir,fac_userconfirmo,fac_fechacomfir,fac_valorpendiente,fac_preciofinal,fac_correoven, fac_nit FROM `facturascreditos` WHERE   (fac_tipopago='Pendiente' or fac_tipopago is  null) and fac_fechafactura>'2023-06-01' and fac_estado='Facturado'     ORDER BY fac_fechafactura desc";
                    $result3 = mysqli_query($conexion, $sql3);

                    // $campos = mysqli_fetch_fields($result1);
            while ($mostrar3 = mysqli_fetch_row($result3)) {

                $sql4 = "SELECT Count(*) FROM `transbancolombia` where Factura like '%$mostrar3[7]%' order by Fecha desc";

                $result4 = mysqli_query($conexion, $sql4);

                // $campos = mysqli_fetch_fields($result1);
                        while ($mostrar4 = mysqli_fetch_row($result4)) {

                            $existee=$mostrar4[0];
                        }

                    if ($existee>0) {
                        
                    }else {
                        echo "<tr id='$mostrar3[7]'>";              
                        echo "<td colspan='3'><input type='checkbox'  onchange='selecionado3(\"$mostrar3[7]\")' class='checkbox' id='".$mostrar3[7]."s' value='$mostrar3[7]'></td>";
                        echo "<td colspan='4' >$mostrar3[7]</td>";
                        echo "<td colspan='3'>$mostrar3[2]</td>";
                        echo "<td >$mostrar3[13]</td>";
                        echo "</tr>";
                    }
                    

            
            
                }
                ?>
        </table>
        
    <?php

}
?>

