<?php 
require("../login_autentica.php"); 
include("../layout.php");
 $fechaactual =date("Y-m-d");

$FB->titulo_azul1("  Enrutamiento  Entregas y Recogidas",1,0,5);  
?> 
<!DOCTYPE html>
<html lang="es">
<head>
</head>
<body>
<hr><br>

<?php
require_once ('config.php');
$id_usuario=591;
$Querydrag_drop      = ("SELECT  orden_idservicio,orden_iduserencargado,orden_id,orden,ord_estado,ord_tipo FROM ord_recoentregas WHERE orden_iduserencargado =$id_usuario and orden_fechadiaejecucion ='2021-09-09' order by orden asc ");
//$sles5="SELECT  orden_idservicio,orden_iduserencargado,orden_id,orden,ord_estado,ord_tipo FROM ord_recoentregas WHERE orden_iduserencargado =$id_usuario and orden_fechadiaejecucion ='2021-09-09' order by orden asc ";

$resultadodrag_drop  = mysqli_query($con, $Querydrag_drop);
?>

<div class="row sortable"  id="drop-items">

<?php
while ($dataDrag_Drop = mysqli_fetch_assoc($resultadodrag_drop)) { 
    
    
    
    if($dataDrag_Drop['ord_tipo']=='Recogida' or $dataDrag_Drop['ord_tipo']='Entrega'){
        $idservicio=$dataDrag_Drop['orden_idservicio'];
        $sql6="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`,`cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,
            `ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_estado,ser_visto,usu_nombre,`ser_fechaasignacion`,`ser_consecutivo`,ser_valorprestamo,ser_guiare
            FROM serviciosdia inner join usuarios on ser_idresponsable=idusuarios   where
             idservicios='$idservicio'";
             /* ser_estado in (3,9) and  */
             
      } else{  
        $sql6="SELECT `idgastos`, `gas_fecharegistro`, `usu_nombre`, `gas_idciudadori`, `sed_nombre`, `gas_empresa`, `gas_bus`, `gas_telconductor`,`gas_pagar`,`gas_iduserremesa`, `gas_nomremesa`,`gas_descripcion`,`gas_peso`,`gas_piezas`,`gas_valor`,gas_usucom,
        gas_cantcom,gas_feccom ,gas_idciudaddes,gas_iduserrecoge,gas_recogio,gas_entrego,gas_fecrecogida,'0' as ser_estado 
        FROM `gastos` inner join usuarios on gas_idusuario=idusuarios inner join sedes on idsedes=gas_idciudaddes
         WHERE idgastos='$idservicio'";   
      
    }
    $resultados  = mysqli_query($con, $sql6);
    $datosfinales = mysqli_fetch_assoc($resultados);
    $estados=$datosfinales['ser_estado'];

    if($estados==3){
        $hora=$datosfinales['ser_fechaentrega'];
        $dir=str_replace("&"," ", $datosfinales['cli_direccion']);
    }elseif($estados==10){ //cambiar a 9
        $hora='';
        $dir=str_replace("&"," ", $datosfinales['ser_direccioncontacto']);
    }elseif($estados==0){
        $hora='';
        $dir="Empresa TR: ".$datosfinales['gas_empresa']." -
				# BUS:".$datosfinales['gas_bus']."-
				Tel Conductor:".$datosfinales['gas_telconductor'];
    }
    
    

    ?>


    <div class="col-12 col-xs-1" data-index="<?php echo $datosfinales['orden_id']; ?>" data-position="<?php echo $datosfinales['orden']; ?>">
        <div class="drop__card">
            <div class="drop__data">          
                <div>
                    <h1 class="drop__name"><?php echo $dataDrag_Drop['ord_tipo']; ?></h1>
                    <h1 class="drop__name"><?php echo $hora; ?></h1>
                    <span class="drop__profession"><?php echo $dir; ?></span>
                </div>
            </div>
            <div class="circulo">
                <h2><?php echo $dataDrag_Drop['orden']; ?> </h2>
            </div>            
        </div>
    </div>



    <?php } ?>

  </div>

  
<script type="text/javascript" charset="utf-8" src="assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" charset="utf-8" src="assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" charset="utf-8" src="assets/js/jquery.ui.touch-punch.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
       $('.sortable').sortable({
           update: function (event, ui) {
               $(this).children().each(function (index) {
                    if ($(this).attr('data-position') != (index+1)) {
                        $(this).attr('data-position', (index+1)).addClass('updated');
                    }
               });

               guardandoPosiciones();
           }
       });
    });

    function guardandoPosiciones() {
        var positions = [];
        $('.updated').each(function () {
           positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
           $(this).removeClass('updated');
        });

        $.ajax({
           url: 'ajax.php',
           method: 'POST',
           dataType: 'text',
           data: {
               update: 1,
               positions: positions
           }, success: function (response) {
                console.log(response);
           }
        });
    }
</script>
</body>
</html>