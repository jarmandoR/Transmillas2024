<?php 
require("login_autentica.php"); 
include("layout.php");
 $fechaactual =date("Y-m-d");
 $id_usuario= $_SESSION['usuario_id'];
 
?> 
<!DOCTYPE html>
<html lang="es">
<head>
<style>
  .drop__card, .drop__data{
    display: flex;
    align-items: center;
  }
  
 
  .drop__name{
    font-size: 1rem;
    color: #263fbf;
  }
  
  .drop__dir{
    font-size: 2rem;
    color: #0d0d0e;
  }
    
  /* Class name for the chosen item */
  .sortable-chosen{
    box-shadow: 1px 1px 2px #E1E1E1;
  }
  
  /* Class name for the dragging item */
  .sortable-drag{
    opacity: 0;
  }

</style>
</head>
<body>
<hr><br>
<div> 
<div> 
<?php

if($nivel_acceso==1){
    $id_usuario=226;
    $fechaactual='2021-10-04';
}



$sles4="SELECT max(orden) from ord_recoentregas WHERE orden_iduserencargado =$id_usuario and orden_fechadiaejecucion='$fechaactual'";
$DB_m1->Execute($sles4); 
 $ordenn=$DB_m1->recogedato(0);
         
 $FB->titulo_azul1("Enrutamiento  Entregas y Recogidas",1,0,5);  
 
echo "<tr>";
if ($ordenn=='' or $ordenn==0) {
    $ordenultimo=1;
}else{
  $ordenultimo=$ordenn+1;  
}

$conde3="and ((ser_idresponsable='$id_usuario' and ser_fechaasignacion like '$fechaactual%' and ser_estado=3 ) or ( ser_idusuarioguia='$id_usuario' and ser_fechaguia like '$fechaactual%' and ser_estado=9))"; 
$conde1=""; 
//entregas y recogidas asignadas al usuario

$sql="SELECT `idservicios`,`ser_fechaasignacion`,ser_estado
 FROM servicios inner join usuarios on ser_idresponsable=idusuarios where ser_estado in (3,9) 
 and idservicios not in (SELECT  orden_idservicio FROM ord_recoentregas WHERE orden_iduserencargado='$id_usuario' 
 and orden_fechadiaejecucion='$fechaactual' and ord_tipo in ('Recogida','Entrega'))  $conde3  ORDER BY ser_fechaentrega $asc ";

$DB->Execute($sql); $va=0; 
$cont=0;
    while($rw1=mysqli_fetch_row($DB->Consulta_ID))
    {
        $estado=$rw1[2];
        if($estado==3){
          
            $tipo='Recogida';
        }else{
            $tipo='Entrega';
        }

        $sql1="INSERT INTO `ord_recoentregas`(`orden_idservicio`, `orden_iduserencargado`,  `orden_fecha`, `orden` , `orden_fechadiaejecucion`,`ord_tipo`) VALUES ('$rw1[0]','$id_usuario','$rw1[1]','$ordenultimo','$fechaactual','$tipo')";
         $DB1->Execute($sql1);
         $ordenultimo++;
    }


   //remesas del usuaio asignado.

    $conde22=" and (gas_iduserrecoge='$id_usuario' and gas_recogio=0 ) or (gas_iduserremesa='$id_usuario' and gas_entrego=0)"; 
    $conde11="and ((date(gas_fecharegistro)<='$fechaactual' and gas_usucom<=0 ) OR (date(gas_feccom)>='$fechaactual' ))";   

    $fecha=date("d-m-Y",strtotime($fecha_actual."- 10 days")); 

   $sql="SELECT `idgastos`, `gas_fecharegistro`
   FROM `gastos` inner join usuarios on gas_idusuario=idusuarios 
    WHERE idgastos>0  and gas_fecharegistro>='$fecha' and idgastos in (SELECT  orden_idservicio FROM ord_recoentregas WHERE orden_iduserencargado='$id_usuario' and orden_fechadiaejecucion='$fechaactual' and ord_tipo='Remesa') $conde11 $conde22 ORDER BY gas_fecharegistro desc";

    $DB1->Execute($sql);
    while($rw2=mysqli_fetch_row($DB1->Consulta_ID))
    {
    $tipo='Remesa';
    $sql1="INSERT INTO `ord_recoentregas`(`orden_idservicio`, `orden_iduserencargado`,  `orden_fecha`, `orden` , `orden_fechadiaejecucion`,`ord_tipo`) VALUES ('$rw2[0]','$id_usuario','$rw2[1]','$ordenultimo','$fechaactual','$tipo')";
        $DB1->Execute($sql1);
        $ordenultimo++;
    }  



    $Querydrag_drop = ("SELECT  orden_idservicio,orden_iduserencargado,orden_id,orden,ord_estado,ord_tipo FROM ord_recoentregas WHERE orden_iduserencargado =$id_usuario and orden_fechadiaejecucion ='$fechaactual' order by orden asc ");
    $DB->Execute($Querydrag_drop); 
?>
 </div>
<div class="row sortable"  id="drop-items">

<?php

$orden1=0;
while ($dataDrag_Drop = mysqli_fetch_assoc($DB->Consulta_ID)) { 
   
        $imprimir=0;
    if($dataDrag_Drop['ord_tipo']=='Recogida' or $dataDrag_Drop['ord_tipo']='Entrega'){
        $idservicio=$dataDrag_Drop['orden_idservicio'];
        $sql6="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`,`cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,
            `ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_estado,ser_visto,usu_nombre,`ser_fechaasignacion`,`ser_consecutivo`,ser_valorprestamo,ser_guiare
            FROM serviciosdia inner join usuarios on ser_idresponsable=idusuarios   where
            ser_estado in (3,9) and  idservicios='$idservicio'";
           
             
      } elseif($dataDrag_Drop['ord_tipo']=='Remesa'){  
        $sql6="SELECT `idgastos`, `gas_fecharegistro`, `usu_nombre`, `gas_idciudadori`, `sed_nombre`, `gas_empresa`, `gas_bus`, `gas_telconductor`,`gas_pagar`,`gas_iduserremesa`,
         `gas_nomremesa`,`gas_descripcion`,`gas_peso`,`gas_piezas`,`gas_valor`,gas_usucom, gas_cantcom,gas_feccom ,gas_idciudaddes,gas_iduserrecoge,gas_recogio,gas_entrego,gas_fecrecogida,'2000' as ser_estado 
        FROM `gastos` inner join usuarios on gas_idusuario=idusuarios inner join sedes on idsedes=gas_idciudaddes
         WHERE idgastos='$idservicio'";   
          
    }

   
        $orden1++;
        $DB_m2->Execute($sql6); 
        $datosfinales=mysqli_fetch_assoc($DB_m2->Consulta_ID);

        $estados=$datosfinales['ser_estado'];
     if($estados!=''){
        if($estados==3){
            $hora=$datosfinales['ser_fechaentrega'];
            $dir=str_replace("&"," ", $datosfinales['cli_direccion']);
            $dir2=str_replace("&","+", $datosfinales['cli_direccion']);
            $dir2=str_replace("#","+",$dir2);
        }elseif($estados==9){ //cambiar a 9
            $hora='';
            $dir=str_replace("&"," ", $datosfinales['ser_direccioncontacto']);
            $dir2=str_replace("&","+", $datosfinales['ser_direccioncontacto']);
            $dir2=str_replace("#","+",$dir2);
        }elseif($estados==2000){
            $hora='';
            $dir="Empresa TR: ".$datosfinales['gas_empresa']." -
                    # BUS:".$datosfinales['gas_bus']."-
                    Tel Conductor:".$datosfinales['gas_telconductor'];
        }
  
        if($dataDrag_Drop['ord_estado']=='Sin Ordenar'){
            
            $clasesse='alert alert-danger';
        }else{
            $clasesse='alert alert-success';
        }
        

    ?>



    <div class="<?php echo $clasesse;?>" data-index="<?php echo $dataDrag_Drop['orden_id']; ?>" data-position="<?php echo $orden1; ?>">
  
    <div class="drop__card">
            <div class="">       
                <div>
                    <h1 class="drop__name"><?php echo $dataDrag_Drop['ord_tipo']." ".$hora." ".$dataDrag_Drop['ord_estado']; ?></h1>
                     <h2 class="drop__dir"><?php echo $dir;  echo $dataDrag_Drop['orden_id']; ?></h2>
                </div>
            </div>
            <div>
                <h2><?php echo $orden1." ".'<a href="https://www.google.com/maps/place/'.$dir2.'+colombia" target="_blank">Mapa</a>'; ?> </h2>
            </div>                
     </div>
     </div>




    <?php }else{
                $idelimi=$dataDrag_Drop['orden_id'];
                 $sql7="Delete from ord_recoentregas WHERE  orden_id=$idelimi";
                 $DB_m2->Execute($sql7); 
                 
         }
    }
    echo "</tr></table>";
    ?>

  </div>
  </div>
 

  
  <script type="text/javascript" charset="utf-8"  src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery.ui.touch-punch.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
       $('.sortable').sortable({
         
           update: function (event, ui) {
            var ordem_atual = $(this).sortable("serialize");
               $(this).children().each(function (index) {
                   console.log(index);
                   console.log($(this).attr('data-position'));
                  //  console.log($(this).attr('data-index'));
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
           url: 'ajaxordenar.php',
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