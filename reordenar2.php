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
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }

  .alertper {
    padding: 1px;
    margin-bottom: 2px; 
    font-size: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
    color: #444;
    }

    .container {
  display: flex;
  flex-flow: row wrap-reverse
}

.container > * { width: 100% }

.numeros{
    font-size: 2rem;
    color: #263fbf;
  }

  .hora{
    font-size: 1rem;
    color: #263fbf;
  }
  .orden{
    font-size: 1rem;
    color: #d71930;
  }
  </style>
</head>
<body>

<div class="container">
<div class="uno">  
<?php   
$FB->nuevo("diligencia", $condecion, "");
?>
<table class="table table-hover"><tr bgcolor="#074F91" class="tittle3">

<td colspan=1  align='center'>Enrutamiento  Entregas y Recogidas</td></tr>

</table>
</div>
</div>
<?php

if($nivel_acceso==1){
    $id_usuario=226;
    $fechaactual='2021-10-04';
}



$sles4="SELECT max(orden) from ord_recoentregas WHERE orden_iduserencargado =$id_usuario and orden_fechadiaejecucion='$fechaactual'";
$DB_m1->Execute($sles4); 
 $ordenn=$DB_m1->recogedato(0);
         

 
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

    $fecha=date("Y-m-d",strtotime($fecha_actual."- 10 days")); 

   $sql="SELECT `idgastos`, `gas_fecharegistro`
   FROM `gastos` inner join usuarios on gas_idusuario=idusuarios 
    WHERE idgastos>0  and gas_fecharegistro>='$fecha' and idgastos  not in (SELECT  orden_idservicio FROM ord_recoentregas WHERE orden_iduserencargado='$id_usuario' and orden_fechadiaejecucion='$fechaactual' and ord_tipo='Remesa') $conde11 $conde22 ORDER BY gas_fecharegistro desc";

    $DB1->Execute($sql);
    while($rw2=mysqli_fetch_row($DB1->Consulta_ID))
    {
    $tipo='Remesa';
    $sql1="INSERT INTO `ord_recoentregas`(`orden_idservicio`, `orden_iduserencargado`,  `orden_fecha`, `orden` , `orden_fechadiaejecucion`,`ord_tipo`) VALUES ('$rw2[0]','$id_usuario','$rw2[1]','$ordenultimo','$fechaactual','$tipo')";
        $DB_m2->Execute($sql1);
        $ordenultimo++;
    }  

    $sql3="SELECT `iddiligencias`,`dil_ruta`, `dil_user`, `dil_fecha`, `dil_estado`
    FROM `diligencias` 
    WHERE dil_user='$id_usuario'  and dil_fecha like '$fechaactual%' and `dil_estado`='Activo' and iddiligencias not in (SELECT  orden_idservicio FROM ord_recoentregas WHERE orden_iduserencargado='$id_usuario' and orden_fechadiaejecucion='$fechaactual' and ord_tipo='diligencia')  ORDER BY dil_fecha desc";
 
     $DB1->Execute($sql3);
     while($rw3=mysqli_fetch_row($DB1->Consulta_ID))
     {
     $tipo='diligencia';
     $sql1="INSERT INTO `ord_recoentregas`(`orden_idservicio`, `orden_iduserencargado`,  `orden_fecha`, `orden` , `orden_fechadiaejecucion`,`ord_tipo`) VALUES ('$rw3[0]','$id_usuario','$rw3[3]','$ordenultimo','$fechaactual','$tipo')";
         $DB_m2->Execute($sql1);
         $ordenultimo++;
     } 

    $Querydrag_drop = ("SELECT  orden_idservicio,orden_iduserencargado,orden_id,orden,ord_estado,ord_tipo FROM ord_recoentregas WHERE orden_iduserencargado =$id_usuario and orden_fechadiaejecucion ='$fechaactual' order by orden asc ");
    $DB->Execute($Querydrag_drop); 
?>


<div class="dos sortable"  id="drop-items">

<?php

$orden1=0;
while ($dataDrag_Drop = mysqli_fetch_assoc($DB->Consulta_ID)) { 
   
        $imprimir=0;
         $dataDrag_Drop['ord_tipo'];
        $idservicio=$dataDrag_Drop['orden_idservicio'];
    if($dataDrag_Drop['ord_tipo']=='Recogida' or $dataDrag_Drop['ord_tipo']=='Entrega'){
       
        $sql6="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`,`cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,
            `ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_estado,ser_visto,usu_nombre,`ser_fechaasignacion`,`ser_consecutivo`,ser_valorprestamo,ser_guiare,cli_idciudad
            FROM serviciosdia inner join usuarios on ser_idresponsable=idusuarios   where
            ser_estado in (3,9) and  idservicios='$idservicio'";
           
           
             
      } elseif($dataDrag_Drop['ord_tipo']=='Remesa'){  
      
        $sql6="SELECT `idgastos`, `gas_fecharegistro`, `usu_nombre`, `gas_idciudadori`, `sed_nombre`, `gas_empresa`, `gas_bus`, `gas_telconductor`,`gas_pagar`,`gas_iduserremesa`,
         `gas_nomremesa`,`gas_descripcion`,`gas_peso`,`gas_piezas`,`gas_valor`,gas_usucom, gas_cantcom,gas_feccom ,gas_idciudaddes,gas_iduserrecoge,gas_recogio,gas_entrego,gas_fecrecogida,'2000' as ser_estado 
        FROM `gastos` inner join usuarios on gas_idusuario=idusuarios inner join sedes on idsedes=gas_idciudaddes
         WHERE idgastos='$idservicio'";   
          
    }elseif($dataDrag_Drop['ord_tipo']=='diligencia'){  
       
        $sql6="SELECT iddiligencias,`dil_ruta`, `dil_user`, `dil_fecha`, `dil_estado`,'2001' as ser_estado from diligencias where  iddiligencias=$idservicio";

    }

   
        $orden1++;
        $DB_m2->Execute($sql6); 
        $datosfinales=mysqli_fetch_assoc($DB_m2->Consulta_ID);

      $estados=$datosfinales['ser_estado'];
     if($estados!=''){

        if($dataDrag_Drop['ord_tipo']=='Recogida'){
            $oriidciudad=$datosfinales['cli_idciudad'];
             $sqls1="SELECT ciu_nombre FROM ciudades WHERE idciudades=$oriidciudad";
                $DB1->Execute($sqls1);
                $ciudad=$DB1->recogedato(0);

        }else{
            $ciudad=$datosfinales['ciu_nombre'];
        }


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
        }elseif($estados=='2000'){
            $hora='';
            $dir="Empresa TR: ".$datosfinales['gas_empresa']." -
                    # BUS:".$datosfinales['gas_bus']."-
                    Tel Conductor:".$datosfinales['gas_telconductor'];
        }elseif($estados=='2001'){
            $hora='';
            $dir="Ruta: ".$datosfinales['dil_ruta'];
        }
  
        if($dataDrag_Drop['ord_estado']=='Sin Ordenar'){
            
            $clasesse='alertper alert-danger';
        }else{
            $clasesse='alertper alert-success';
        }
        

    ?>



    <div  id="<?php echo $dataDrag_Drop['orden_id']; ?>" class="<?php echo $clasesse;?>" data-index="<?php echo $dataDrag_Drop['orden_id']; ?>" data-position="<?php echo $orden1; ?>">
            <li class="ui-state-default"><?php echo "<span class='numeros'>$orden1</span>"; echo "<span class='hora'>".$dataDrag_Drop['ord_tipo'].$hora."</span>"; echo "<span class='orden'> ".$dataDrag_Drop['ord_estado']."</span>";  echo $dir;  echo "<span class='mapa'><a href='https://www.google.com/maps/place/$dir2+$ciudad+colombia'  target='_blank'><img src='img/mapa.png'></a> </span>"  ?></li>
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
 

  
  <script type="text/javascript" charset="utf-8"  src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery.ui.touch-punch.min.js"></script>
<script>
  $( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  } );
  </script>
<script type="text/javascript">
    $(document).ready(function () {
        
       $('.sortable').sortable({
         
           update: function (event, ui) {
              var  idx=0;
              var end_pos = ui.item.index();
 
               $(this).children().each(function (index) {

                    if (index == end_pos) {
                        console.log($(this).attr('data-index'));
                        idx =$(this).attr('data-index');
                        var elemento = document.getElementById(idx);
                        elemento.className  = "alertper alert-success";
                    }

                    if ($(this).attr('data-position') != (index+1)) {
                        //console.log($(this).attr('data-index'));
                        $(this).attr('data-position', (index+1)).addClass('updated');
                    }
               });

               guardandoPosiciones(idx);
           }
       });
    });

    function guardandoPosiciones(pos) {
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
               posinicial:pos,
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