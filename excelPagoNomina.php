<?php
require("login_autentica.php");
include("cabezote3.php"); 

$descargar=$_GET['variable'];

$param33 = $_GET['param33'];

$param34 = $_GET['param34'];

$param35 = $_GET['param35'];

$param36 = $_GET['param36'];

$param37 = $_GET['param37'];
?>
<style>
    /* Estilos básicos para la barra superior */
    .topbar {
        background-color: #333;
        color: #fff;
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Estilos para el menú desplegable */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }


    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    /* Estilos para la tabla */
    .tabla {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd; /* Borde delgado de un solo color */
    }

    .tabla th,
    .tabla td {
        padding: 12px 15px;
        text-align: center;
        border: 1px solid #ddd; /* Borde delgado de un solo color */
        text-align: center;
    }


    .tabla th {
        background-color: #367fa9;
        color: #fff;
        font-weight: bold;
    }

    .tabla tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .tabla tbody tr:hover {
        background-color: #ddd;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

function descargar(p3,p4,p5,p6,p7){

var variable = "descargar"; // Variable que deseas enviar

// Codificar la variable
var variableCodificada = encodeURIComponent(variable);

// Abrir el enlace en una nueva página
window.open("excelPagoNomina.php?variable=" + variableCodificada+"&param33="+p3+"&param34="+p4+"&param35="+p5+"&param36="+p6+"&param37="+p7, "_blank");


    

}
</script>

<div class="topbar">


    <button onclick="descargar('<?echo$param33;?>','<?echo$param34;?>','<?echo$param35;?>','<?echo$param36;?>','<?echo$param37;?>')">Descargar</button>
</div>
<?php 
error_reporting(0);







$año=date('Y');

$NombreExcel = "Pago de Primas".$param36." del mes ".$param34." del  Año ".$año."";

if ($descargar=="descargar") {
    header('Content-type:application/xls');
// header('Content-Disposition: attachment; filename='.$nombre.'.xls');
header('Content-Disposition: attachment; filename='.$NombreExcel.'.xls');
}



$asc="ASC";



echo'<table  class="tabla">';
echo'<tr bgcolor="#074F91" style="color:#FFFFFF;">';
echo'<th>Tipo de identificacion</th>';
echo'<th>Numero de identificacion</th>';
echo'<th>Nombre </th>';
// echo'<th>No Cuenta</th>';
echo'<th>Apellido</th>';
echo'<th>Codigo del Banco</th>';
echo'<th>Tipo de producto o servicio</th>';
// echo'<th>Aux. Transporte</th>';
echo'<th>Numero del Producto o Servicio</th>';
echo'<th>Valor del Pago o de la Recarga</th>';

echo'</tr>';






// if($nivel_acceso==1 or $nivel_acceso==12){
// $FB->titulo_azul1("Eliminar",1,'5%',0); 
// }
$asc="ASC";
$conde=" ";
$conde2=" ";
$conde3=" ";
$conde4=" ";
$conde5=" ";

if($param34!=''){ $fechaactual=$param34; }

if($param35!=''){ $id_sedes=$param35; 

	$conde4=" and hoj_sede=$id_sedes "; 	
}
if($param33!=''){ 
    $cedula="SELECT `usu_identificacion` FROM `usuarios` WHERE `idusuarios`='$param33' ";
    $DB1->Execute($cedula); 
    $CedulaUser=$DB1->recogedato(0);

$conde="and `hoj_cedula`= '$CedulaUser' "; }


$conde3=""; 
$ano=date('Y');
if($param34!=''){ $fechaactual=$param34." 00:00:00";  }
if($param36!=''){ $fechafinal=$param36." 23:59:59";  }


if($param36=='Primera'){
	$fechaactual=date($ano.'-'.$param34.'-01'.' 00:00:00');
	$fechafinal=date($ano.'-'.$param34.'-15'.' 23:59:59');
	$diasDeLaQuincena=15;
	$fechaactualSinTiempo=date($ano.'-'.$param34.'-01');
	$fechafinalSinTiempo=date($ano.'-'.$param34.'-15');

}elseif($param36=='Segunda'){
	// $fin = date("t");

	$fecha_aux = date('Y-'.$param34.'-d'); // Obtener la fecha actual en formato 'YYYY-MM-DD'
	$fin = date('t', strtotime($fecha_aux));

	$fechaactual=date($ano.'-'.$param34.'-16'.' 00:00:00');
	$fechafinal=date($ano.'-'.$param34.'-'.$fin.' 23:59:59');
	$diasDeLaQuincena=$fin-15;
	// echo "Aquincena   tiene $diasDeLaQuincena días.";

	$fechaactualSinTiempo=date($ano.'-'.$param34.'-16');
	$fechafinalSinTiempo=date($ano.'-'.$param34.'-'.$fin);
}elseif($param36=='Completo'){

	// $fin = date("t");

	$fecha_aux = date('Y-'.$param34.'-d'); // Obtener la fecha actual en formato 'YYYY-MM-DD'
	$fin = date('t', strtotime($fecha_aux));

	$fechaactual=date($ano.'-'.$param34.'-01'.' 00:00:00');
	$fechafinal=date($ano.'-'.$param34.'-'.$fin.' 23:59:59');
	$diasDeLaQuincena=$fin-15;
	// echo "Aquincena   tiene $diasDeLaQuincena días.";

	$fechaactualSinTiempo=date($ano.'-'.$param34.'-16');
	$fechafinalSinTiempo=date($ano.'-'.$param34.'-'.$fin);



}


echo'<input id="fechaini" type="hidden" value="'.$fechaactual.'">';
echo'<input id="fechafin" type="hidden" value="'.$fechafinal.'">';
echo'<input id="usuConfirma" type="hidden" value="'.$fechaactual.'">';

//cuantos dias tiene la quincena








// echo$fechas=$fechaactual."/".$fechafinal;
// echo $fechafinal;
// echo $fechaactual;

if($param37!=''){  
	if($param37=='0') {
		$conde5="";
	}else{
		$conde5=" and hoj_tipocontrato='$param37'";
	}
}else{$conde5="";}
function diasSegundaQuince($year, $month) {
    // Obtener el último día del mes
    $ultimoDiaMes = date("t", strtotime("$year-$month-01"));
    
    // La segunda quincena empieza el día 16
    $inicioSegundaQuincena = 16;
    
    // Calcular el número de días en la segunda quincena
    $diasSegundaQuincena = $ultimoDiaMes - $inicioSegundaQuincena + 1;
    
    return $diasSegundaQuincena;
}
    

      //echo$sql="SELECT  `idhojadevida`,  `hoj_nombre`, `hoj_apellido`,hoj_cargo, `hoj_tipocontrato`,`hoj_cedula`,`hoj_fechaingreso`, `sed_nombre`,`hoj_fechanacimiento`, `hoj_cedula`,`hoj_direccion`, `hoj_celular`, `hoj_estado` FROM `hojadevida`  inner join sedes on hoj_sede=idsedes   where idhojadevida>0  and hoj_estado='Activo'   order by hoj_nombre asc ";
    $sql="SELECT `idhojadevida`,  `hoj_nombre`, `hoj_apellido`,hoj_cargo, `hoj_tipocontrato`,`hoj_cedula`,`hoj_fechaingreso`, `sed_nombre`,`hoj_fechanacimiento`, `hoj_cedula`,`hoj_direccion`, `hoj_celular`, `hoj_estado`,hoj_sede,hoj_fechatermino,hoj_cuen,hoj_tcuenta,hoj_banco,hoj_valorRetegarantia,hoj_retegarantia FROM hojadevida
    INNER JOIN sedes ON hoj_sede = idsedes
    WHERE idhojadevida > 0  and(hoj_fechatermino IS NULL OR hoj_fechatermino = '' OR ('$fechaactualSinTiempo' BETWEEN hoj_fechaingreso AND hoj_fechatermino ) OR (hoj_fechaingreso BETWEEN '$fechaactualSinTiempo' AND '$fechafinalSinTiempo'AND hoj_fechatermino BETWEEN '$fechaactualSinTiempo' AND '$fechafinalSinTiempo')) $conde5 $conde4 $conde
    ORDER BY hoj_nombre ASC";
    $DB->Execute($sql); $va=(($compag-1)*$CantidadMostrar); 
    while($rw1=mysqli_fetch_row($DB->Consulta_ID))
            {
    
                $totalQuincena=0; 

        if($rw1[4]=="Prestacion de Servicios"){
            $sql="SELECT `idhojadevida`,  `hoj_nombre`, `hoj_apellido`,hoj_cargo, `hoj_tipocontrato`,`hoj_cedula`,`hoj_fechaingreso`, `sed_nombre`,`hoj_fechanacimiento`, `hoj_cedula`,`hoj_direccion`, `hoj_celular`, `hoj_estado`,hoj_fechatermino,hoj_sede,hoj_retegarantia,hoj_firma,hoj_valorRetegarantia FROM hojadevida
            INNER JOIN sedes ON hoj_sede = idsedes
            WHERE idhojadevida='$rw1[0]' and hoj_estado='Activo'
            ORDER BY hoj_nombre ASC";
              $DB1->Execute($sql); $va=(($compag-1)*$CantidadMostrar); 
                  while($rw11=mysqli_fetch_row($DB1->Consulta_ID))
                  {
          
                    
                      $fechafin=$fechafinal;
                      if($rw11[6]>=$fechaactual and $rw11[6]<=$fechafinal){
                          // echo$rw11[6].$rw11[1];
                          $mesdeingreso=true;
                          $fechaAhora=$rw11[6];
                      }else{
                          $mesdeingreso=false;
                          $fechaAhora=$fechaactual;
                      }
          
          
          
                      $id_p=$rw11[0];
                      $va++; $p=$va%2;
                      
                      $user="SELECT `idusuarios` FROM `usuarios` WHERE `usu_identificacion`='$rw11[5]' and usu_estado = '1'and 	usu_ver_nomina='1'";
                      $DB1->Execute($user); 
                      $idusuario=$DB1->recogedato(0);
            
            
            
                      if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
                    //   echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
                     
                    //   echo "<td><input type='checkbox'  onchange='selecionado($idusuario)' class='checkbox' id='".$idusuario."s' value='$idusuario'></td>";
                    //   echo "
                    //   <td>".$rw11[1]." ".$rw11[2]."</td>";
                    //   echo "<td>".$rw11[4]."</td>";
                    //   echo "<td>".$rw11[5]."</td>";
                      if(empty($idusuario)){
            
            
                      }else{
                      
                      $valordediastrabajados=0;
                      $sql2="SELECT  `idcargo`, `car_Cargo`, `car_Salario`, `car_Auxilio`, `car_otros`,car_Recogida,car_ValorRecogida FROM `cargo` WHERE idcargo='$rw11[3]'";		
                      $DB1->Execute($sql2);
                      $cargosaldo=mysqli_fetch_row($DB1->Consulta_ID);
                      if($idusuario>=1){
                        // echo$slq3="SELECT  sum(`deu_valor`) FROM `duedapromotor` WHERE `deu_fecha`>='$fechaactual' and `deu_fecha`<='$fechafinal' and deu_idpromotor='$idusuario' and deu_tipo in ('Prestamos','Descuadre')";
                        $prestamo=0;
                        $descuadre=0;
                        $pago=0;
                        $slq3="SELECT deu_tipo, deu_valor FROM `duedapromotor` WHERE  deu_idpromotor='$idusuario'  ";
                        $DB1->Execute($slq3); 
                        // $prestamostotal=mysqli_fetch_row($DB1->Consulta_ID);
                        while($prestamostotal=mysqli_fetch_row($DB1->Consulta_ID))
                        {
                            if ($prestamostotal[0]=="Prestamos") {
                                $prestamo =$prestamo+$prestamostotal[1];
                            }elseif ($prestamostotal[0]=="Descuadre") {
                                $descuadre =$descuadre+$prestamostotal[1];
                            }elseif ($prestamostotal[0]=="Pagos") {
                                $pago =$pago+$prestamostotal[1];
                            }
            
                        }
             
                        
                       
          //Prestamos 
          $prestamoTotal=0;
          $prestamo=0;
          $descuadre=0;
          $pago=0;
          $malenviados=0;
          $slq3="SELECT deu_tipo, deu_valor FROM `duedapromotor` WHERE  deu_idpromotor='$idusuario'  ";
          $DB1->Execute($slq3); 
          // $prestamostotal=mysqli_fetch_row($DB1->Consulta_ID);
          while($prestamostotal=mysqli_fetch_row($DB1->Consulta_ID))
          {
              if ($prestamostotal[0]=="Prestamos") {
                  $prestamo =$prestamo+$prestamostotal[1];
              }elseif ($prestamostotal[0]=="Descuadre") {
                  $descuadre =$descuadre+$prestamostotal[1];
              }elseif ($prestamostotal[0]=="Pagos") {
                  $pago =$pago+$prestamostotal[1];
              }elseif ($prestamostotal[0]=="MalEnviados") {
                  $malenviados =$malenviados+$prestamostotal[1];
              }
          
          }
          
          
          // echo"Pagado".$pago;
          $prestamoTotal= $prestamo+$descuadre+$malenviados;
          $TotalDebe = $prestamoTotal-$pago;
          
          //Pagos a la 15na, de prestamos 
          $pago1=0;
          $restaAOtros=0;
          $restaABasico=0;
          $descripcionBasico="";
          $slq7="SELECT deu_tipo, deu_valor,deu_pago_de,due_descripcion  FROM `duedapromotor` WHERE  deu_idpromotor='$idusuario' and deu_fecha>='$fechaAhora' and deu_fecha<='$fechafin' and deu_pago_de in ('Basico','otros') ";
          $DB1->Execute($slq7); 
          // $prestamostotal=mysqli_fetch_row($DB1->Consulta_ID);
          while($prestamostotal7=mysqli_fetch_row($DB1->Consulta_ID))
          {
              if ($prestamostotal7[0]=="Pagos") {
                  $pago1 =$pago1+$prestamostotal7[1];
                  $descripcionBasico=$descripcionBasico.", $prestamostotal7[3]";
                  // if ($prestamostotal7[2]=="Basico") {
                  // 	$restaABasico=$restaABasico+$prestamostotal7[1];
                  // }elseif($prestamostotal7[2]=="Otros"){
          
                  // 	$restaAOtros=$restaAOtros+$prestamostotal7[1];
                  // }
              }
          
          }
          
          
          $diassitrabajo=0;
          $TotalPagoQuincena = $pago1;
          $TotalPagoQuincena_formateado = number_format($TotalPagoQuincena, 0, ',', '.');			
          
                        $sitrabajo="SELECT COUNT(*) FROM `seguimiento_user`  where seg_motivo ='Ingreso' and seg_fechaingreso>='$fechaactual' and seg_fechaingreso<='$fechafinal'  and seg_idusuario='$idusuario' "; 
                        $DB1->Execute($sitrabajo); 
                      //   $rw4=mysqli_fetch_row($DB1->Consulta_ID);
                      //   if(empty($rw4)){
            
                      // 	  $diassitrabajo=0;
                      //   }else{
                      // 	  $diassitrabajo=$rw4[0];
                      //   }
                        while($rw4=mysqli_fetch_row($DB1->Consulta_ID))
                        {
                          // if ($rw4[0]=="") {
                              $diassitrabajo=$rw4[0];
                              // $diassitrabajo=$diassitrabajo+1;
          
                          // }
            
                        }
                        
                        
                        $diasvalor=($cargosaldo[2]/30);
                        $valordediastrabajados=$cargosaldo[2]*$diassitrabajo;
            
          
                        $horasTrabajadas="SELECT SUM(seg_horas_trabajadas) FROM `seguimiento_user`  WHERE  seg_motivo ='IngresoHoras' and seg_fechaingreso>='$fechaAhora' and seg_fechaingreso<='$fechafin'  and seg_idusuario='$idusuario' "; 
                        $DB1->Execute($horasTrabajadas); 
                        $rw6=mysqli_fetch_row($DB1->Consulta_ID);
            
            
                          //Total horas domfest
                          if (strpos($rw6[0], ".") !== false) {
                                      
                              $partes = explode(".", $rw6[0]);
                              $numeroAntesDelPunto = $partes[0];
          
                              $valorHoras=$numeroAntesDelPunto*($cargosaldo[2]/9);
                              $valorMitadDomini=($cargosaldo[2]/9)/2;
          
                              $valorTotalHora=$valorHoras+$valorMitadDomini;
                          } else {
                              
                              $valorHoras=$rw6[0]*($cargosaldo[2]/9);
                              $valorTotalHora=$valorHoras;
                              
                          }	
          
          
                          $valorTotalHora_formateado = number_format($valorTotalHora, 0, ',', '.');	
            
                        
          
          
            
                        $incapacidad="SELECT count(*) FROM `seguimiento_user`  where seg_motivo ='Incapacidad' and seg_fechaingreso>='$fechaactual' and seg_fechaingreso<='$fechafinal'  and seg_idusuario='$idusuario' group by seg_alcohol"; 
                        $DB1->Execute($incapacidad); 
                        $rw5=mysqli_fetch_row($DB1->Consulta_ID);
                        if(empty($rw5)){
            
                            $diasincapacidad=0;
                        }else{
                            $diasincapacidad=$rw5[0];
                        }
            
                        }else{
                            $diasnotrabajo=0;
                            $prestamostotal=0;
                            $diasvalor=0;
                        }
                        $sedess="SELECT `usu_idsede` FROM `usuarios` WHERE `idusuarios`='$idusuario' ";
                        $DB1->Execute($sedess); 
                        $id_sedes=$DB1->recogedato(0);
            
                        $idcidades=ciudadesedes($id_sedes,$DB1);
          
                        $valorRecogidas=0;
                        $cantRecogidas=0;
                        $entregas="SELECT count(*)FROM servicios inner join cuentaspromotor on cue_idservicio=idservicios inner join ciudades on ser_ciudadentrega=idciudades  where date(cue_fecharecogida)>='$fechaactual' and  date(cue_fecharecogida)<='$fechafinal' and (`cue_idoperador`= '$idusuario' or  `cue_idoperentrega`= '$idusuario' ) and (cue_idciudadori in $idcidades )  ORDER BY ser_guiare  $asc ";
                        $DB1->Execute($entregas); 
                        $rw110=mysqli_fetch_row($DB1->Consulta_ID);
                        if ($cargosaldo[5]=="SI" or $cargosaldo[5]=="Si" or $cargosaldo[5]=="si") {
                            $valorRecogidas=$rw110[0]*$cargosaldo[6];
                            $cantRecogidas=$rw110[0];
                          }else {
                            $valorRecogidas=0;
                            $cantRecogidas=0;
                          }
                          // $valorRecogidas=$rw110[0]*$cargosaldo[6];
                          $valorRecogidas_formateado = number_format($valorRecogidas, 0, ',', '.');
          //Otros
                        // $otrosPorDia=$cargosaldo[4]/30;
                      $totalOtromes_formateado = number_format($cargosaldo[4], 0, ',', '.');
          
                      // if ($idusuario== "1733") {
                      // 	$diasparaotros=15;
                      // }else {
                           $diasparaotros=$diassitrabajo;
                      // }
                      $totalOtrosDias=($cargosaldo[4]*($diasparaotros));
          
                      $totalOtrosDias_formateado = number_format($totalOtrosDias, 0, ',', '.');
          
          //SACIONES
          
          $valordiasConSancion=0;
          $sancion="SELECT count(*) FROM `seguimiento_user`  where seg_motivo ='dia con sancion' and seg_fechaingreso>='$fechaactual' and seg_fechaingreso<='$fechafinal'  and seg_idusuario='$idusuario' group by seg_alcohol"; 
          $DB1->Execute($sancion); 
          $rw7=mysqli_fetch_row($DB1->Consulta_ID);
          if(empty($rw7)){
          
              $diasConSancion=0;
          }else{
              $diasConSancion=$rw7[0];
          }
          
          
          $valordiasConSancion=($diasConSancion*$cargosaldo[2]);
          
          
          
          //RETEGARANTIA 
          
          $ReteGarantiaMostrar="";
          $retegarantiaTotal=0;
          $DiasreteGarantia=0;
          $descuentoReteGarantia=0;
          $diasParaCalcular=0;
          if ($rw11[14]==1 and $rw11[15]=="si" and $diassitrabajo >=5 ) {
              $DiasreteGarantia=300000/$cargosaldo[2];
              $diasParaCalcular=$DiasreteGarantia*15;
          
          
          
              
              // $fecha_actual = date("d-m-Y");
          
          
              
              
              // Sumar 1 día
              $ultimafechaReteG=date("Y-m-d", strtotime($rw11[6]."+ ".$diasParaCalcular." days"));
              $findeRetegar = date('t', strtotime($ultimafechaReteG));
          
          
              
              
              $dia_deseado = 01; // Día deseado
              
              $mes = date("m", strtotime($ultimafechaReteG)); // Obtener el mes de la fecha específica
              $año = date("Y", strtotime($ultimafechaReteG)); // Obtener el año de la fecha específica
          
              $mesinicio = date("m", strtotime($rw11[6])); // Obtener el mes de la fecha específica
              $añoinicio = date("Y", strtotime($rw11[6])); // Obtener el año de la fecha específica
              $diainicio = date("d", strtotime($rw11[6])); // Obtener el año de la fecha específica
              
              
              $fecha_resultante = date("$año-$mes-$findeRetegar"); // Crear la fecha resultante
          
              // if ($fechafinalSinTiempo>=$rw11[6]  and  $fechafinalSinTiempo<=$fecha_resultante ) {
              // 	$descuentoReteGarantia=$cargosaldo[2];
          
              $descRete="SELECT nom_retedes from nomina where nom_id_usu='$idusuario'  and nom_tipo_pago='Basico'  and 	nom_fecha_inicio='$fechaactual' ";
              $DB1->Execute($descRete); 
              // $prestamostotal=mysqli_fetch_row($DB1->Consulta_ID);
              $descRete1=mysqli_fetch_row($DB1->Consulta_ID);
              
              // // echo"QUincenas".$total_quincenas."bueno";
              // }else
          
              if($rw11[17]==300000){
          
                  $descuentoReteGarantia=0;
          
              }else{
          
                  $descuentoReteGarantia=$cargosaldo[2];
          
              }
              if ($descRete1!="") {
                  $descuentoReteGarantia=$descRete1[0];
              }else {
                  $descuentoReteGarantia=0;
              }
          
              $fecha_inicio = new DateTime("$añoinicio-$mesinicio-$diainicio"); // Fecha de inicio en formato "YYYY-MM-DD"
              $fecha_fin = new DateTime("$fechafinalSinTiempo"); // Fecha de fin en formato "YYYY-MM-DD"
          
              $intervalo = date_diff($fecha_inicio, $fecha_fin); // Calcula la diferencia entre las dos fechas
          
              $total_dias = $intervalo->days; // Obtiene el total de días entre las dos fechas
          
              $total_quincenas = floor($total_dias / 14); // Calcula el total de quincenas redondeando hacia abajo
          
              $retegarantiaTotal=$total_quincenas*$cargosaldo[2];
          


          

              $descuentoReteGarantia_formateado = number_format($descuentoReteGarantia, 0, ',', '.');
              $ReteGarantiaMostrar=" $descuentoReteGarantia_formateado <br> <button class='btn btn-primary' onclick='pop_Retegarantiaresta($rw11[5],$idusuario,\"$fechaactual\",$rw11[17])' id='enviarIds'>Descontar</button>";
          }

          //TOTAL QUINCENA
                      $totalQuincena=0; 
                      $totalQuincenaParaCuenta=$valordediastrabajados;
                      // echo"Quincena $totalQuincena=($valordediastrabajados+$valorTotalHora+$valorRecogidas+$totalOtrosDias)-($TotalPagoQuincena+$descuentoReteGarantia);";
                          
                      $totalQuincena=($valordediastrabajados+$valorTotalHora+$valorRecogidas+$totalOtrosDias)-($TotalPagoQuincena+$descuentoReteGarantia);
          
          

          
                      $seledevolvioR="SELECT nom_devolRetegara,nom_retedes from nomina where nom_id_usu='$idusuario'  and nom_tipo_pago='Basico'  and nom_devolRetegara>0 ";
                      $DB1->Execute($seledevolvioR); 
                      // $prestamostotal=mysqli_fetch_row($DB1->Consulta_ID);
                      $devuelR=mysqli_fetch_row($DB1->Consulta_ID);
                      if(empty($devuelR)){
          
                          $devolver=false;
                      }else{
                          $devolver=true;
                      }
          
          
                      
          
          
                      // if () {
                      // 	# code...
          
          
                      $colorselect="#8B0000";
                      $si="";
                      $no="";
                      $imagencompr="";
                      $linkbasico="";
                      $textEnviar="Enviar";
                      $colorEnviar="rgb(7, 79, 145)";
                      $validado="";
                      $Observacion="";
                      $cheked1="";
                      $botonEnviar1="none";
                      $confirmado1="";
                      $validadoDesprendible="";
                      $devretegarantia=0;
          
                      $tablaNomina="SELECT nom_confirma,nom_img_compro,nom_cuentaCobro,nom_confirmaUsu,nom_motivoObser,nom_fechaconfirmaUsus,`nom_confiAdmi`,`nom_fechaConfiAdmi`,nom_confirmaAdmin,nom_devolRetegara,nom_valor_ajuste1,nom_tipo_ajuste1,nom_ajuste_descripcion1,nom_id from nomina where nom_id_usu='$idusuario' and nom_fecha_inicio='$fechaactual' and nom_tipo_pago='Basico'  ";
                      $DB1->Execute($tablaNomina); 
                      // $prestamostotal=mysqli_fetch_row($DB1->Consulta_ID);
                      while($Nomina=mysqli_fetch_row($DB1->Consulta_ID))
                      {
                          $Nomina[13];
                          $valorAjusteB=$Nomina[10];
                          $tipoAjusteB=$Nomina[11];
                          $descripcionAjusteB=$Nomina[12];
                          $devretegarantia=$Nomina[9];
                        // echo"AAAAAAAAAAAAAA".$Nomina[0];
                        $imagencompr=$Nomina[1];
                        if ($Nomina[0]=="Si") {
                            $colorselect="#28B463";
                            $si="selected";
                            $no="";
                            $linkbasico="auto";
                        }else if($Nomina[0]=="No"){
                            $si="";
                            $no="selected";
                            $colorselect="#8B0000";
                            $linkbasico="none";
                        }else{
                            $si="";
                            $no="selected";
                            $colorselect="#8B0000";
                            $linkbasico="none";
                        }
                        if($Nomina[2]==""){
          
                          $textEnviar="Enviar";
                          $colorEnviar="rgb(7, 79, 145)";
                      }else{
          
                          $colorEnviar="#28B463";
                          $textEnviar="Reenviar";
                      }
          
                      if ($Nomina[3]=="Si") {
          
                          $validadoDesprendible="Validado el $Nomina[5]  Por ".$rw11[1]." ".$rw11[2]." ";
                          $validado="Validado✅";
                      }else {
                          $validado="Pendiente";
                      }
          
                      if ($Nomina[4]!="") {
                          $Observacion="<textarea readonly name='' rows='' cols=''>$Nomina[4]</textarea>";
                      }else {
                          $Observacion="";
                      }
                      if ($Nomina[8]=="si") {
                          $cheked1="checked";
                          $botonEnviar1="inline-block";
                          $user1="SELECT `usu_nombre` FROM `usuarios` WHERE `idusuarios`='$Nomina[6]' ";
                          $DB1->Execute($user1); 
                          $nombre1=$DB1->recogedato(0);
                          $confirmado1="Por $nombre1 <br> $Nomina[7]";
                      }else {
                          $cheked1="";
                          $botonEnviar1="none";
                          $confirmado1="";
                      }
          
                      }
                      $ajustessumB=0;
                      $ajustesresB=0;
                      if ($tipoAjusteB=="suma") {
                          $ajustessumB=$valorAjusteB;
                          $ajustesresB=0;
                      }else if($tipoAjusteB=="descuento"){
                          $ajustessumB=0;
                          $ajustesresB=$valorAjusteB;
                      }

                                $totalQuincena=($totalQuincena+$devretegarantia+$ajustessumB)-($ajustesresB+$valordiasConSancion);
                                $totalQuincena_formateado = number_format($totalQuincena, 0, ',', '.');	
                                //   echo "<td style='background-color:#F4D03F' >$totalQuincena_formateado</td>";
                                $valorAjusteB=$Nomina[10];
                                $tipoAjusteB=$Nomina[11];
                                $descripcionAjusteB=$Nomina[12];
                      $rutaDeComp="desprendibleOtros.php?cedula=".$rw11[5]."&nombre=".$rw11[1].$rw11[2]."&valor=".$totalQuincenaParaCuenta."&deudas=".$TotalPagoQuincena."&fechaini=".$fechaactualSinTiempo."&fechafin=".$fechafinalSinTiempo."&recogidas=".$cantRecogidas."&valorRecogidas=".$valorRecogidas."&otrosdeve=".$totalOtrosDias."&valorHoras=".$valorTotalHora."&confirmado=".$validadoDesprendible."&reteGarantiaLleva=".$retegarantiaTotal."&reteGarantiaDesc=".$descuentoReteGarantia."&firma=".$rw11[16]."&llevaRetegarantia=".$rw11[17]."&devolretegarantia=".$devretegarantia."&valorAjuste=".$valorAjusteB."&tipoAjuste=".$tipoAjusteB."&descripcionAjuste=".$descripcionAjusteB."&diassancion=".$diasConSancion."&valorSancion=".$valordiasConSancion."&descriprestamos=".$descripcionBasico;

                      $totalDevengPres=$totalDevengPres+$totalQuincena;
                    


                      echo "<tr>";
                    
                      echo "<td>1</td>";//tipo identificacion
                      echo "<td>$rw11[5]</td>";//Numero identificacion
                      echo "<td>$rw11[1]</td>";//Nombre
                      echo "<td>$rw11[2]</td>";//Apellido
  
                      if ($rw1[16]=="DAVIPLATA") {
                          $tipoCuenta="DP";
                      }else if ($rw1[16]=="AHORROS") {
                          $tipoCuenta="CA";
                      }
                      if ($rw1[17]=="DAVIVIENDA" or $rw1[17]=="DAVIPLATA") {
                          $codigoBanco="51";
                      }
                      echo "<td>$codigoBanco</td>";
                      
                      echo "<td>$tipoCuenta</td>";
                      // $numero_formateado = number_format($numero_largo, 0, '.', '');
                      $numeroCuenta_formateado = number_format($rw1[15], 0, '', '');
                      echo "<td>".$rw1[15]."</td>";
                      echo "<td>".$totalQuincena_formateado."\t</td>";
  
  
  
  
  
                      // echo "<td>$rw11[6]</td>";//Codigo del Banco
                      // echo "<td>$rw11[13]</td>";//Tipo de producto o servicio
                      // echo "<td>$rw11[6]</td>";//Numero del Producto o Servicio
                      // echo "<td>$rw11[13]</td>";//Valor del Pago o de la Recarga
                      echo "</tr>";//tipo identificacion





                    }

                    
                }



        }else 
        if($rw1[4]=="Empresa"){
//         // Muestra todos los errores de PHP
// error_reporting(E_ALL);

// // Activa la visualización de errores
// ini_set('display_errors', 1);

// // Activa la visualización de errores durante la carga del script
// ini_set('display_startup_errors', 1);

        

            $sql="SELECT `idhojadevida`,  `hoj_nombre`, `hoj_apellido`,hoj_cargo, `hoj_tipocontrato`,`hoj_cedula`,`hoj_fechaingreso`, `sed_nombre`,`hoj_fechanacimiento`, `hoj_cedula`,`hoj_direccion`, `hoj_celular`, `hoj_estado`,hoj_sede,hoj_fechatermino,hoj_cuen,hoj_tcuenta,hoj_firma,hoj_estado FROM hojadevida
            INNER JOIN sedes ON hoj_sede = idsedes
            WHERE idhojadevida='$rw1[0]'
            ORDER BY hoj_nombre ASC";
              $DB1->Execute($sql); 
            //   $va=(($compag-1)*$CantidadMostrar); 
              $va=0; 
                  while($rw16=mysqli_fetch_row($DB1->Consulta_ID))
                  {
            
            
            
            
                    $totaldevengado=0;
                    $totaldeduccion=0;
                    $fechafin=$fechafinal;
                    if($rw16[6]>=$fechaactual and $rw16[6]<=$fechafinal){
                        // echo$rw16[6].$rw16[1];
                        $mesdeingreso=true;
                        $fechaAhora=$rw16[6];
                    }else{
                        $mesdeingreso=false;
                        $fechaAhora=$fechaactual;
                    }
                    
                      $user="SELECT `idusuarios` FROM `usuarios` WHERE `usu_identificacion`='$rw16[5]' and usu_ver_nomina='1'";
                      $DB1->Execute($user); 
                      $idusuario=$DB1->recogedato(0);
            
                    if ($rw16[14]==null or $rw16[14]=="0000-00-00") {
            
                        $mesiniciocontrato=date("m", strtotime($rw16[6]));
                        $añoiniciocontrato=date("Y", strtotime($rw16[6]));
            
                        // echo"MES ".$sigmesiniciocontrato=date("m", strtotime($mesiniciocontrato. " +1 month"));
            
                        $priemrdiadestemes=date("Y-m-d H:i:s", strtotime($añoiniciocontrato.'-'.$mesiniciocontrato.'-01'.' 00:00:00'."+1 month"));
            
                        if($param36=='Completo'){
                            $diaveinte=date("Y-m-d H:i:s",strtotime($añoiniciocontrato.'-'.$mesiniciocontrato.'-30'.' 23:59:59'."+31 days"));
                        
                        }else{
                        
                            $diaveinte=date("Y-m-d H:i:s",strtotime($añoiniciocontrato.'-'.$mesiniciocontrato.'-15'.' 23:59:59'."+1 month"));
                        }
            
                        if (($fechaactual>=$priemrdiadestemes and $fechafinal<=$diaveinte)) {
                            $color="#00bf19";
                        }else{
            
                            if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
                        }
            
                        
                        $terminaContrato="";
                        $InicioContrato=$rw16[6];
                        if($InicioContrato<=$fechafinal and $rw16[18] == 'Activo') {
                            $activoEnNomina=true;
                        }else{
                            $activoEnNomina=false;
                            
                        }
            
                    }else{
                        
                        $terminaContrato=$rw16[14];
                        $mesterminocontrato=date("m", strtotime($rw16[14]));
                        $añoterminocontrato=date("Y", strtotime($rw16[14]));
                        $diaterminocontrato=date("d", strtotime($rw16[14]));
            
            
                        $priemrDiaQuinceTermina=date("Y-m-d H:i:s", strtotime($añoterminocontrato.'-'.$mesterminocontrato.'-01'.' 00:00:00'));
            
            
                        if ($fechaactual>= $priemrDiaQuinceTermina ) {
                            
                            $color="#D35400";
            
                        }else{
                            
                            if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
            
                        }
            
            
                        $nueva_fechaTerminaContrato = date("Y-m-d", strtotime($terminaContrato . "+30 days"));
            
                        if ( $fechafinal<= $nueva_fechaTerminaContrato ) {
                            $activoEnNomina=true;
                            
            
                        }else{
                            $activoEnNomina=false;
                            
            
                        }
            
                        
                    }
            
            if ($activoEnNomina) {
                
                $id_p=$rw16[0];
            
                      
            
                      if(empty($idusuario)){
                    
            
                      }else{
            
            
                        // echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
                     
                        // echo "<td><input type='checkbox'  onchange='selecionado($idusuario)' class='checkbox' id='".$idusuario."s' value='$idusuario'></td>";
                        // echo "<td>".$rw16[1]." ".$rw16[2]."</td>";
                        // echo "<td>".$rw16[4]."</td>";
                        // echo "<td>".$rw16[5]."</td>";
                        $va++; $p=$va%2;
                      
                        $valordediastrabajados=0;
                        $sql2="SELECT  `idcargo`, `car_Cargo`, `car_Salario`, `car_Auxilio`, `car_otros`,car_Recogida,car_ValorRecogida	 FROM `cargo` WHERE idcargo='$rw16[3]'";		
                        $DB1->Execute($sql2);
                        $cargosaldo=mysqli_fetch_row($DB1->Consulta_ID);
                        if($idusuario>=1){
                        $prestamo=0;
                        $descuadre=0;
                        $pago=0;
                        $malenviados=0;
            //Prestamos 
                        $slq3="SELECT deu_tipo, deu_valor FROM `duedapromotor` WHERE  deu_idpromotor='$idusuario'  ";
                        $DB1->Execute($slq3); 
                        while($prestamostotal=mysqli_fetch_row($DB1->Consulta_ID))
                        {
                            if ($prestamostotal[0]=="Prestamos") {
                                $prestamo =$prestamo+$prestamostotal[1];
                            }elseif ($prestamostotal[0]=="Descuadre") {
                                $descuadre =$descuadre+$prestamostotal[1];
                            }elseif ($prestamostotal[0]=="Pagos") {
                                $pago =$pago+$prestamostotal[1];
                            }elseif ($prestamostotal[0]=="MalEnviados") {
                                $malenviados =$malenviados+$prestamostotal[1];
                            }
            
                        }
             
                        
                        // echo"Pagado".$pago;
                        $prestamoTotal= $prestamo+$descuadre+$malenviados;
                        $TotalDebe = $prestamoTotal-$pago;
            
            //Pagos a la 15na, de prestamos 
                        $pago1=0;
                        $restaAOtros=0;
                        $restaABasico=0;
                        $descripcionBasico="";
                        $descripcionOtros="";
                        $slq7="SELECT deu_tipo, deu_valor,deu_pago_de,due_descripcion  FROM `duedapromotor` WHERE  deu_idpromotor='$idusuario' and deu_fecha>='$fechaAhora' and deu_fecha<='$fechafin' and deu_pago_de in ('Basico','otros') ";
                        $DB1->Execute($slq7); 
                        while($prestamostotal7=mysqli_fetch_row($DB1->Consulta_ID))
                        {
                            if ($prestamostotal7[0]=="Pagos") {
                                $pago1 =$pago1+$prestamostotal7[1];
            
                                if ($prestamostotal7[2]=="Basico") {
                                    $restaABasico=$restaABasico+$prestamostotal7[1];
                                    $descripcionBasico=$descripcionBasico.", $prestamostotal7[3]";
                                }elseif($prestamostotal7[2]=="Otros"){
            
                                    $restaAOtros=$restaAOtros+$prestamostotal7[1];
                                    $descripcionOtros=$descripcionOtros.", $prestamostotal7[3]";
                                }
                            }
            
                        }
            
            
            
                        $TotalPagoQuincena = $pago1;
                        $TotalPagoQuincena_formateado = number_format($TotalPagoQuincena, 0, ',', '.');			
            
            //Dias no trabajados
                        $diasnotrabajo=0;
                        $notrabajo="SELECT seg_fechaingreso FROM `seguimiento_user`  where seg_motivo in ('Se devolvio','Sancionado','No trabajo','descanso no remunerado','Reposicion por falla') and seg_fechaingreso>='$fechaAhora' and seg_fechaingreso<='$fechafin'   and seg_idusuario='$idusuario' ";
                        $DB1->Execute($notrabajo);
            
            
                        while($rw2=mysqli_fetch_row($DB1->Consulta_ID))
                        {
            
                            $diasnotrabajo=$diasnotrabajo+1;
                            
            
                        }
            
                        
            
            
            
            
            //Dias de Descanso
                        $descansopago="SELECT count(*) FROM `seguimiento_user`  where seg_motivo in('descanso','IngresoHoras') and seg_fechaingreso>='$fechaAhora' and seg_fechaingreso<='$fechafin'  and seg_idusuario='$idusuario' "; 
                        $DB1->Execute($descansopago); 
                        $rw6=mysqli_fetch_row($DB1->Consulta_ID);
                        if(empty($rw6)){
            
                            $diasDescanso=0;
                        }else{
            
                            $diasDescanso=$rw6[0];
                        }
                        
                        $valorDeDiasDeDescanso=$diasvalor*$diasDescanso;
                        $valorDeDiasDeDescanso_formateado = number_format($valorDeDiasDeDescanso, 0, ',', '.');
            
                        
            //Dias trabajados	
            
            
                        // Ejemplo de uso
                        $year=date("Y", strtotime($fechaAhora));
                        $month=date("m", strtotime($fechaAhora));
            
                        $diasSegundaQuincena = diasSegundaQuince($year, $month);
            
                        //  echo "La segunda quincena de $year-$month tiene $diasSegundaQuincena días.";
            
            
            
            
            
            
                        $diassitrabajo=0;
                        $sitrabajo="SELECT count(*) FROM `seguimiento_user`  where seg_motivo ='Ingreso' and seg_fechaingreso>='$fechaAhora' and seg_fechaingreso<='$fechafin'  and seg_idusuario='$idusuario' "; 
                        $DB1->Execute($sitrabajo); 
                        $rw4=mysqli_fetch_row($DB1->Consulta_ID);
                        if(empty($rw4)){
            
                            $diassitrabajo=0;
                        }else{
                            
                            
                            if($fin==31 and $param36=='Segunda' or $fin==31 and $param36=='Completo' ){
                                
                                    if ($rw4[0]<=0 ) {
                                        $dia31=0;
                                    }else{
                                        if ($param36=='Segunda') {
                                            if ($diasSegundaQuincena=="16" ) {
                                                $mesiniciocontrato=date("m", strtotime($rw16[6]));
                                                $añoiniciocontrato=date("Y", strtotime($rw16[6]));
                                                $diainiciocontrato=date("d", strtotime($rw16[6]));
            
            
            
                                                // echo"if($mesiniciocontrato==$month and $añoiniciocontrato==$year and $diainiciocontrato>=16 and $diasnotrabajo<=0){";

                                                if(($mesiniciocontrato==$month and $añoiniciocontrato==$year and $diainiciocontrato>=16 and $diasnotrabajo<=0)){
                                                    if ($diainiciocontrato==16) {
                                                        $dia31=1;
                                                    }else {
                                                        $dia31=0;
                                                    }
                                                     
                                                 }else if($rw1[14]!=null or $rw1[14]!="0000-00-00") {
                                                    $mesfincontrato=date("m", strtotime($rw16[14]));
                                                    $añofincontrato=date("Y", strtotime($rw16[14]));
                                                    $diafincontrato=date("d", strtotime($rw16[14]));
            
                                                    // echo"FIN if ($mesfincontrato==$month and $añofincontrato==$year and $diafincontrato>=16 )";
                                                    if ($mesfincontrato==$month and $añofincontrato==$year and $diafincontrato>=16  ) {
                                                        $dia31=0;
                                                    }else {
                                                        $dia31=1;
                                                    }
                                                    
                                                 }else{
                                                    $dia31=1;
                                                 }
                                            }else{
                                                $dia31=0;
                                            }
                                        }else if($param36=='Completo') {
            
                                            if (($rw4[0]+$diasDescanso)==31) {
                                                $dia31=1;
                                            }else{
                                                $dia31=0;
                                            }
                                        }
            
                                    }
                                    if (($rw4[0]+$diasDescanso)==0) {
                                        $diasnotrabajo=0;
                                    }else if (($rw4[0]+$diasDescanso)==0) {
                                    }
                                    $diassitrabajo=$rw4[0]+$diasDescanso-($dia31);
                                    $diassitrabajoParaSumar=$rw4[0]+$diasDescanso-($dia31);
                                    $diassitrabajoConAuxilio=$rw4[0];
                                    $diassitrabajoParaMostrar=$rw4[0]+$diasDescanso-($dia31);
            
                            }elseif($fin==29 and $param36=='Segunda' or $fin==29 and $param36=='Completo' ){
                                
            
                                if ($rw4[0]<=0 or $mesdeingreso==true){
                                    $dia29=0;
                                }else{
                                    $dia29=1;
                                }
                                
                                $diassitrabajo=$rw4[0]+$diasDescanso+$dia29;
                                $diassitrabajoParaSumar=$rw4[0]+$diasDescanso+$dia29;
                                $diassitrabajoConAuxilio=$rw4[0]+$dia29;
                                $diassitrabajoParaMostrar=$rw4[0]+$diasDescanso;
                        }else{
                                $diassitrabajo=$rw4[0]+$diasDescanso;
                                $diassitrabajoParaSumar=$rw4[0]+$diasDescanso;
                                $diassitrabajoConAuxilio=$rw4[0];
                                $diassitrabajoParaMostrar=$rw4[0]+$diasDescanso;
                            }
                    
            
                            
                        }
                        
                        
                        $diasvalor=($cargosaldo[2]/30);
                        $valordediastrabajados=$diasvalor*$diassitrabajoParaSumar;
                        $valordediastrabajados_formateado = number_format($valordediastrabajados, 0, ',', '.');
                        
            //Permisos y licencias
                        $permisosLic=0;
                        $nombreMotivo="";
                        $valorPermisosLicBasico=0;
                        $diasPerLicBas=0;
                        $diasvalorporcentaje=0;
                        $diasPerLicBasValor=0;
                        $valorMitaddiasPerLi=0;
                        $diasPerLicBasValortotal=0;
                        $diasPerLicBasValortotalfinal=0;
                        $valorPermisosLicSalud=0;
                        $valorPermisosLicPension=0;
                        $permisoLicencia="SELECT `seg_motivo`, `seg_descr`, `mot_salud`, `mot_pension`, `mot_auxtransporte`, `mot_porcbasico`, `mot_otrosDevengos`  FROM `seguimiento_user` INNER JOIN motivo_ingreso on mot_nombre=seg_motivo  where seg_motivo in('licencia de maternidad','LICENCIA POR LUTO','PERMISO NO REMUNERADO','PAGO DE INCAPACIDAD AL 66') and seg_fechaingreso>='$fechaAhora' and seg_fechaingreso<='$fechafin'  and seg_idusuario='$idusuario' "; 
                        $DB1->Execute($permisoLicencia); 
                        ;
                        while($rw9=mysqli_fetch_row($DB1->Consulta_ID))
                        {
                            if(empty($rw9)){
            
                                $permisosLic=0;
                            }else{
                            
                                $permisosLic=$permisosLic+1;
                                $nombreMotivo=$rw9[0];
            
                                if ($rw9[2]=="si" or $rw9[2]=="SI" ) {
                                    $valorPermisosLicSalud=$valorPermisosLicSalud+1;
                                }
                                if ($rw9[3]=="si" or $rw9[3]=="SI") {
                                    $valorPermisosLicPension=$valorPermisosLicPension+1;
                                }
                                if($rw9[4]=="si" or $rw9[4]=="SI"){
                                    $valorPermisosLicAux=$valorPermisosLicAux+1;
            
                                }
                                if($rw9[6]=="si" or $rw9[6]=="SI"){
                                    $valorPermisosLicOtros=$valorPermisosLicOtros+1;
                                }
                                
                                if($rw9[5]!="0"){
                                    $diasPerLicBas=$diasPerLicBas+1;
                                    $rw9[5];
                                    $valorporcentaje=($rw9[5]/100)*$diasvalor;		
                                    $diasPerLicBasValortotalfinal=$diasPerLicBasValortotalfinal+$valorporcentaje;
                                }
                            }
                        }
            
            
            
                        $diasPerLicBasValortotalfinal_formateado = number_format($diasPerLicBasValortotalfinal, 0, ',', '.');			
            
            //Incapacidades		
            
                        $incapacidad="SELECT count(*) FROM `seguimiento_user`  where seg_motivo ='Incapacidad' and seg_fechaingreso>='$fechaAhora' and seg_fechaingreso<='$fechafin'  and seg_idusuario='$idusuario' "; 
                        $DB1->Execute($incapacidad); 
                        $rw5=mysqli_fetch_row($DB1->Consulta_ID);
                        if(empty($rw5)){
            
                                $diasincapacidad=0;
            
                        }else{
                            $diasincapacidad=$rw5[0];
                            // excepcion con usuario 423 andres 
                            if ($idusuario=="1718" and $rw5[0]==0 and $fin ==29) {
            
            
                                echo"OKKK";
                                $diasincapacidad=1;
                            }
                        }
            
                        if($diasincapacidad>=2){
                            $valorDiasIncapadidad=($diasvalor)*(2*0.6667);
            
                            $valorDiasIncapadidad_formateado = number_format($valorDiasIncapadidad, 0, ',', '.');
            
                        }else{
            
                            $valorDiasIncapadidad=($diasvalor)*($diasincapacidad*0.6667);
            
                            $valorDiasIncapadidad_formateado = number_format($valorDiasIncapadidad, 0, ',', '.');
                        }
            
            
            
            
            //VACACIONES
            
                        $Vacaciones="SELECT count(*) FROM `seguimiento_user`  where seg_motivo ='Vacaciones' and seg_fechaingreso>='$fechaAhora' and seg_fechaingreso<='$fechafin'  and seg_idusuario='$idusuario' "; 
                        $DB1->Execute($Vacaciones); 
                        $rw8=mysqli_fetch_row($DB1->Consulta_ID);
                        if(empty($rw8)){
            
                            $diasVacaciones=0;
                        }else{
                            $diasVacaciones=$rw8[0];
                        }
            
            
            
                        $valorDiasVacaciones=($diasvalor)*($diasVacaciones);
            
                        $valorDiasVacaciones_formateado = number_format($valorDiasVacaciones, 0, ',', '.');
            
            
                        $horasdominicales="SELECT SUM(seg_horas_trabajadas) FROM `seguimiento_user`  WHERE  seg_motivo ='IngresoHoras' and seg_fechaingreso>='$fechaAhora' and seg_fechaingreso<='$fechafin'  and seg_idusuario='$idusuario' "; 
                        $DB1->Execute($horasdominicales); 
                        $rw6=mysqli_fetch_row($DB1->Consulta_ID);
            
            
            
                        }else{
                            $diasnotrabajo=0;
                            $prestamostotal=0;
                            $diasvalor=0;
                        }
            
            
                        
                
            //SALUD Y PENSION
            
                        $Salud=26000;
                        $Pension=26000;
            
                        $saludPorDia=26000/15;
                        $pensionPorDia=26000/15;
            
                        if ($terminaContrato=="" and $mesdeingreso==false) {
                            if($param36=='Completo'){
            
                                $valorSalud=$saludPorDia*30;	
                                $valorPension=$pensionPorDia*30;
                            }elseif($param36=='Primera' or $param36=='Segunda'){
                                $valorSalud=$saludPorDia*15;	
                                $valorPension=$pensionPorDia*15;
                            }
            
                        }else{
                            if ($diasVacaciones>0) {
                                $valorSalud=$saludPorDia*($diassitrabajoParaSumar+$diasVacaciones+$valorPermisosLicSalud+$diasincapacidad);	
                                $valorPension=$pensionPorDia*($diassitrabajoParaSumar+$diasVacaciones+$valorPermisosLicPension+$diasincapacidad);
                            }else {
                                $valorSalud=$saludPorDia*($diassitrabajoParaSumar+$valorPermisosLicSalud+$diasincapacidad+$diasnotrabajo);	
                                $valorPension=$pensionPorDia*($diassitrabajoParaSumar+$valorPermisosLicPension+$diasincapacidad+$diasnotrabajo);
                            }
            
                            
                        }
            // // excepcion con usuario 423 andres 
            // 			if ($idusuario== "423") {
            // 				$valorSalud=0;	
            // 				$valorPension=0;
            // 			}
            
                        $valorSalud_formateado = number_format($valorSalud, 0, ',', '.');
            
            
                        $valorPension_formateado = number_format($valorPension, 0, ',', '.');
            //Pago por dias
            
                        //auxilio
                        $auxilioPorDia=$cargosaldo[3]/30;
                        //Total auxilio 15na
                        $totalauxilio=$auxilioPorDia*($diassitrabajoParaSumar);
            
            
            //Total horas domfest
                        if (strpos($rw6[0], ".") !== false) {
                            
                            $partes = explode(".", $rw6[0]);
                            $numeroAntesDelPunto = $partes[0];
            
                            $valorHorasDomini=$numeroAntesDelPunto*9681;
                            $valorMitadDomini=9681/2;
            
                            $valorTotalHorasDomini=$valorHorasDomini+$valorMitadDomini;
                        } else {
                            
                            $valorHorasDomini=$rw6[0]*9681;
                            $valorTotalHorasDomini=$valorHorasDomini;
                            
                        }	
            
                        
                        // if($idcidades=='0'){
                        // 	$conde2="";
                    
                        // }else {
                        //   $conde2=" and (cue_idciudadori in $idcidades )"; 	
                        // }	
                        $sedess="SELECT `usu_idsede` FROM `usuarios` WHERE `idusuarios`='$idusuario' ";
                        $DB1->Execute($sedess); 
                        $id_sedes=$DB1->recogedato(0);
            
                        $idcidades=ciudadesedes($id_sedes,$DB1);
                        
                        $cantRecogidas=0;
                        $valorRecogidas=0;
                        $entregas="SELECT count(*)FROM servicios inner join cuentaspromotor on cue_idservicio=idservicios inner join ciudades on ser_ciudadentrega=idciudades  where date(cue_fecharecogida)>='$fechaactual' and  date(cue_fecharecogida)<='$fechafinal' and (`cue_idoperador`= '$idusuario' or  `cue_idoperentrega`= '$idusuario' )and (cue_idciudadori in $idcidades )  ORDER BY ser_guiare  $asc ";
                        $DB1->Execute($entregas); 
                        $rw10=mysqli_fetch_row($DB1->Consulta_ID);
                        if ($cargosaldo[5]=="SI" or $cargosaldo[5]=="Si" or $cargosaldo[5]=="si") {
                            $valorRecogidas=$rw10[0]*$cargosaldo[6];
                            $cantRecogidas=$rw10[0];
                          }else {
                            $valorRecogidas=0;
                            $cantRecogidas=0;
                          }
                          $valorRecogidas=$rw10[0]*$cargosaldo[6];
                          $valorRecogidas_formateado = number_format($valorRecogidas, 0, ',', '.');	
                //otros
                        $otrosPorDia=$cargosaldo[4]/30;
                        //Total auxilio 15na
                        $totalOtrosDias=($otrosPorDia*($diassitrabajoParaSumar));
            
                        $totalOtrosDias_formateado = number_format($totalOtrosDias, 0, ',', '.');
            
            
            
                        $sueldo_formateado = number_format($cargosaldo[2], 0, ',', '.');
                        // echo "<td>".$cargosaldo[1]." </td>";//Nombre del cargo
                        
                        // echo "<td>$".$sueldo_formateado."</td>";//Salario basico por mes
                        // echo "<td>$".$cargosaldo[3]."</td>";//Auxilio por mes
                        
                        
                        $diasvalor_formateado = number_format($diasvalor, 0, ',', '.');
                    //     echo "<td>$".$diasvalor_formateado."</td>";//Valor por dias
                        
                        
                    //     echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($idusuario,\"Resumen_Quincena\",\"$fechas\")';  title='Ingreso de Usuario' >$diassitrabajoParaMostrar Dias  $suamdedias </td>"; //Ingreso?
                    //     echo "<td>".$diasDescanso."</td>";// dias de descanso
                    //     echo "<td>$".$valordediastrabajados_formateado."</td>";//Dias trabajados con dias de descanso
            
            
                     
            
                    //       echo "<td>$".$totalauxilio."</td>";//total auxilio segun dias
                    
                    // echo "<td>".$diasnotrabajo."</td>";
            
                  
                    // echo "<td>".$diasincapacidad."</td>";
                    // echo "<td>$valorDiasIncapadidad_formateado</td>";
                    
                    // // echo "<td>".$incaoacidadporce."</td>";
                    // // echo "<td>$valorDiasIncapadidad_formateado</td>";
            
                    // echo "<td>$diasVacaciones</td>"; //VACACIONES
                     
                    // echo "<td>$valorDiasVacaciones_formateado</td>";//VACACIONES
            
                    // echo "<td>".$nombreMotivo."<br>".$permisosLic." Dias</td>"; 
                    // echo "<td>$diasPerLicBasValortotalfinal_formateado</td>"; 
                    
                    // echo "<td>$valorSalud_formateado</td>"; 
                     
                    // echo "<td>$valorPension_formateado</td>";
                      
                    // echo "<td>$".$TotalDebe."</td>"; //DEUDAS
                    // echo "<td> <a id='link'  onclick='pop_dis16($idusuario,\"Abono_A_Deuda\",\"$rw16[13]\")';  title='Click para agregar un abono' >$$restaABasico +</a></td>";//abonos a deudas
            
            
            
                    
                    
            
                    
                
            
                          $colorselect="#8B0000";
                          $si="";
                          $no="";
                          $imagencompr="";
                          $linkbasico="";
                          $textEnviar="Enviar";
                          $colorEnviar="rgb(7, 79, 145)";
                          $validado="";
                          $Observacion="";
                          $cheked1="";
                          $botonEnviar1="none";
                          $confirmado1="";
                          $validadoDesprendible="";
            
                         
                          $tablaNomina="SELECT  nom_confirma,nom_img_compro,nom_cuentaCobro,nom_confirmaUsu,nom_motivoObser,nom_fechaconfirmaUsus,`nom_confiAdmi`,`nom_fechaConfiAdmi`,nom_confirmaAdmin,nom_valor_ajuste1,nom_tipo_ajuste1,nom_ajuste_descripcion1 from nomina where nom_id_usu='$idusuario' and nom_fecha_inicio='$fechaactual' and nom_tipo_pago='Basico'  ";
                          $DB1->Execute($tablaNomina); 
                          // $prestamostotal=mysqli_fetch_row($DB1->Consulta_ID);
                          while($Nomina=mysqli_fetch_row($DB1->Consulta_ID))
                          {
                            // echo"AAAAAAAAAAAAAA".$Nomina[0];
                            $valorAjusteB=$Nomina[9];
                            $tipoAjusteB=$Nomina[10];
                            $descripcionAjusteB=$Nomina[11];
            
                                $imagencompr=$Nomina[1];
                        
                            
                            if ($Nomina[0]=="Si") {
                                $colorselect="#28B463";
                                $si="selected";
                                $no="";
                                $linkbasico="auto";
                            }else if($Nomina[0]=="No"){
                                $si="";
                                $no="selected";
                                $colorselect="#8B0000";
                                $linkbasico="none";
                            }else{
                                $si="";
                                $no="selected";
                                $colorselect="#8B0000";
                                $linkbasico="none";
                            }
            
                            if($Nomina[2]==""){
            
                                $textEnviar="Enviar";
                                $colorEnviar="rgb(7, 79, 145)";
                            }else{
            
                                $colorEnviar="#28B463";
                                $textEnviar="Reenviar";
                            }
            
                            if ($Nomina[3]=="Si") {
                                // $user0="SELECT `usu_nombre` FROM `usuarios` WHERE `idusuarios`='$Nomina[6]' ";
                                // $DB1->Execute($user0); 
                                // $nombre1=$DB1->recogedato(0);
                                $validadoDesprendible="Validado el $Nomina[5]  Por ".$rw16[1]." ".$rw16[2]." ";
                                $validado="Validado✅ <br> $Nomina[5]";
                            }elseif($Nomina[3]=="no"){
                                $validado="Rechazada❌ <br> $Nomina[5]";
                            }else{
                                $validado="Pendiente";
            
                            }
                            if ($Nomina[4]!="") {
                                $Observacion="<textarea readonly name='' rows='' cols=''>$Nomina[4]</textarea>";
                            }else {
                                $Observacion="";
                            }
            
                            if ($Nomina[8]=="si") {
                                $cheked1="checked";
                                $botonEnviar1="inline-block";
                                $user1="SELECT `usu_nombre` FROM `usuarios` WHERE `idusuarios`='$Nomina[6]' ";
                                $DB1->Execute($user1); 
                                $nombre1=$DB1->recogedato(0);
                                $confirmado1="Por $nombre1 <br> en la fecha: $Nomina[7]";
                            }else {
                                $cheked1="";
                                $botonEnviar1="none";
                                $confirmado1="";
                            }
            
            
            
                            
                          }
                          
                        //   echo "<td><div id='campo'>";
                        //   echo "<select  style='width:120px;border:1px solid #f9f9f9;background-color:".$colorselect.";color:#f9f9f9;font-size:15px'  name='$va' id='".$idusuario."Basico' onchange='confirmarPago($idusuario,\"$fechaactual\",\"$fechafinal\",\"confirmarPago\",this.value,\"Basico\")' class='borrar' required>";
                        //   echo"<option value='no' $no>NO</option>";
                        //   echo"<option value='Si'$si>SI</option>";
                         
                  
                        //   echo"</select>";
                        
                        // 	if ($imagencompr=="") {
                        // 		echo "<td><a id='Basico".$idusuario."' style='pointer-events: ".$linkbasico.";' onclick='pop_dis16($idusuario,\"Comprobante_nomina_basico\",\"$fechaactual\")';  title='Ingreso de Usuario' >Cargar</td>";
                        // 	  }else{  
                        // 		echo "<td><a href='https://sistema.transmillas.com/img_nomina/$imagencompr' style='display: block;' target='_blank' title='Ver comprovante de pago de nomina' >Ver</a>";
                        // 		echo "<a id='Basico".$idusuario."' style=' display: block; pointer-events: ".$linkbasico.";' onclick='pop_dis16($idusuario,\"Comprobante_nomina_basico\",\"$fechaactual\")';  title='Ingreso de Usuario' >Cambiar</a></td>";
            
                        // 	  }
                        // $valorAjusteB=
                        // $tipoAjusteB=
                        // $descripcionAjusteB
            
                        // if ($tipoAjusteB=="suma") {
                        // 	$ajustessumB=$valorAjusteB;
                        // }else if($tipoAjusteB=="descuento"){
                        // 	$ajustesresB=$valorAjusteB;
                        // }
                        $ajustessumB=0;
                        $ajustesresB=0;
                        if ($tipoAjusteB=="suma") {
                            $ajustessumB=$valorAjusteB;
                            $ajustesresB=0;
                        }else if($tipoAjusteB=="descuento"){
                            $ajustessumB=0;
                            $ajustesresB=$valorAjusteB;
                        }
                        $TotalDevengado= ($totalauxilio + $valordediastrabajados+$valorDiasIncapadidad+$valorDiasVacaciones+$diasPerLicBasValortotalfinal+$ajustessumB)-($valorSalud+$valorPension+$restaABasico+$ajustesresB);
                        $TotalDevengado_formateado = number_format($TotalDevengado, 0, ',', '.');
                        // echo "<td style='background-color:#F4D03F'>$TotalDevengado_formateado</td>";//Valor quincena 
                          
                        if ($nombreMotivo="PAGO DE INCAPACIDAD AL 66") {
                            $diasincapacidad=$diasincapacidad+$permisosLic;
                            $valorDiasIncapadidad=$valorDiasIncapadidad+$diasPerLicBasValortotalfinal;
                        }
                        $totaldevengado=$valordediastrabajados+$totalauxilio+$valorDiasIncapadidad+$valorDiasVacaciones;
                        $totaldeduccion=$valorSalud+$valorPension+$restaABasico+$totaldeduccion;
                        $rutaDeComproBas="desprendibleBasico.php?cedula=".$rw16[5]."&nombre=".$rw16[1]." ".$rw16[2]."&cargo=$cargosaldo[1]&fechaini=$fechaactual&fechafin=$fechafinal&cuenta=&diastrabajados=$diassitrabajoParaMostrar&sueldo=$valordediastrabajados&auxilitrans=$totalauxilio&pagdiasinca=$valorDiasIncapadidad&totaldeveng=$totaldevengado&salud=$valorSalud&pension=$valorPension&prestamos=$restaABasico&totaldeduccion=$totaldeduccion&confirmado=$validadoDesprendible&diasIncapacidad=$diasincapacidad&firma=$rw16[17]&vacaciones=$valorDiasVacaciones&diasvacaciones=$diasVacaciones&sede=$rw16[7]&valorAjuste=$valorAjusteB&tipoAjuste=$tipoAjusteB&descripcionAjuste=$descripcionAjusteB&descriprestamos=$descripcionBasico";
                        // echo "<td><a href='$rutaDeComproBas' target='_blank'>ver</a>
                        // <button style='display: $botonEnviar1;  width:120px;border:1px solid #f9f9f9;background-color: ".$colorEnviar.";color:#f9f9f9; font-size:15px' onclick='enviarDesprendible(\"$rutaDeComproBas\",$idusuario,\"$fechaactual\",\"$fechafinal\",\"guardarCuenCobro\",\"Basico\")' id='Basico".$idusuario."guardarCuenCobro'>$textEnviar</button>
                        // <input  type='checkbox' id='Basico".$idusuario."confirmaAdmin1' onchange='confirmaAdmin($idusuario,\"$fechaactual\",\"$fechafinal\",\"confirmaAdmin\",\"Basico\",1)' $cheked1>
                        // <label for='miCheckbox'>			
                        // <details>
                        // <summary>Confirmado</summary>
                        //     <p>$confirmado1<p/>
                        // </details>	
                        // </label></td>";//IMPRIMIR
                        // echo "<td>".$validado.$Observacion."</td>";//Confirmado?
            
            
                        $valorHorasDomini_formateado = number_format($valorTotalHorasDomini, 0, ',', '.');
                        // echo "<td>$rw6[0]</td>";//Horas dominicales
                        // echo "<td>$valorHorasDomini_formateado</td>";//Valor Horas dominicales
            
                        // echo "<td>$".$cargosaldo[4]."</td>";//Otros
                        // echo "<td  >$".$totalOtrosDias_formateado."</td>";//total otros segun dias 
            
                        //   echo "<td  >$rw10[0]</td>";//Recogidas 
            
                        //   echo "<td  >$ $valorRecogidas_formateado</td>";//Valor recogidas
                        //   echo "<td  >$".$restaAOtros."</td>";//Deudas descontadas a otros 
            
                          $colorselect1="#8B0000";
                          $si1="";
                          $no1="";
                          $imagencompr1="";
                          $linkotros="";
                          $textEnviar1="Enviar";
                          $colorEnviar1="rgb(7, 79, 145)";
                          $validado1="";
                          $Observacion1="";
                          $cheked2="";
                          $botonEnviar2="none";
                          $confirmado="";
                          $validadoDesprendible1="";
                         
                          $tablaNomina1="SELECT  nom_confirma,nom_img_compro,nom_cuentaCobro,nom_confirmaUsu,nom_motivoObser, nom_fechaconfirmaUsus,`nom_confiAdmi`,`nom_fechaConfiAdmi`,nom_confirmaAdmin,nom_valor_ajuste1,nom_tipo_ajuste1,nom_ajuste_descripcion1  from nomina where nom_id_usu='$idusuario' and nom_fecha_inicio='$fechaactual' and nom_tipo_pago='Otros'  ";
                          $DB1->Execute($tablaNomina1); 
                        //   echo"<td>$tablaNomina1</td>";
                          // $prestamostotal=mysqli_fetch_row($DB1->Consulta_ID);
                          while($Nomina1=mysqli_fetch_row($DB1->Consulta_ID))
                          {
                            // echo"AAAAAAAAAAAAAA".$Nomina[0];
                            
                            $valorAjusteO=$Nomina1[9];
                            $tipoAjusteO=$Nomina1[10];
                            $descripcionAjusteO=$Nomina1[11];
            
                                $imagencompr1=$Nomina1[1];
            
                            
            
            
                            if ($Nomina1[0]=="Si") {
                                $colorselect1="#28B463";
                                $si1="selected";
                                $no1="";
                                $linkotros="auto";
                            }else if($Nomina1[0]=="No"){
                                $si1="";
                                $no1="selected";
                                $colorselect1="#8B0000";
                                $linkotros="none";
                            }else{
                                $si1="";
                                $no1="selected";
                                $colorselect1="#8B0000";
                                $linkotros="none";
                            }
            
                            if($Nomina1[2]==""){
            
                                $textEnviar1="Enviar";
                                $colorEnviar1="rgb(7, 79, 145)";
                            }else{
            
                                $colorEnviar1="#28B463";
                                $textEnviar1="Reenviar";
                            }
            
                            if ($Nomina1[3]=="Si") {
            
                                $validadoDesprendible1="Validado el $Nomina1[5]  Por ".$rw16[1]." ".$rw16[2]." ";
                                $validado1="Validado✅<br>  $Nomina1[5]";
                            }elseif($Nomina1[3]=="no"){
                                $validado1="Rechazada❌ <br> $Nomina1[5]";
                            }else{
                                $validado1="Pendiente";
            
                            }
            
                            if ($Nomina1[4]!="") {
                                $Observacion1="<textarea readonly name='' rows='' cols=''>$Nomina1[4]</textarea>";
                            }else {
                                $Observacion1="";
                            }
                            if ($Nomina1[8]=="si") {
            
            
                                $cheked2="checked";
                                $botonEnviar2="inline-block";
                                $user2="SELECT `usu_nombre` FROM `usuarios` WHERE `idusuarios`='$Nomina1[6]' ";
                                $DB1->Execute($user2); 
                                $nombre2=$DB1->recogedato(0);
                                $confirmado="Por $nombre2 <br> $Nomina1[7]";
                            }else {
                                $cheked1="";
                                $botonEnviar2="none";
                                $confirmado="";
                            }
                          }
                          
            
                        //   }else{
                        // 	echo "<td>Cargar</td>";
            
                        //   }
                        $ajustessumO=0;
                        $ajustesresO=0;
                        if ($tipoAjusteO=="suma") {
                            $ajustessumO=$valorAjusteO;
                            $ajustesresO=0;
                        }else if($tipoAjusteO=="descuento"){
                            $ajustessumO=0;
                            $ajustesresO=$valorAjusteO;
                        }
            
                        $totalOtrosAPagar=($totalOtrosDias+$valorTotalHorasDomini+$valorRecogidas+$ajustessumO)-($restaAOtros+$ajustesresO);
            
                        $totalOtrosAPagar_formateado = number_format($totalOtrosAPagar, 0, ',', '.');
                        // echo "<td  style='background-color:#F4D03F'>$".$totalOtrosAPagar_formateado."</td>";//total otros 
                       
                        $totalOtrosConHD=$totalOtrosDias+$valorTotalHorasDomini;
            
                        $totalOtrosConHD_formateado = number_format($totalOtrosConHD, 0, ',', '.');
                        $rutaDeComp="desprendibleOtros.php?cedula=".$rw16[5]."&nombre=".$rw16[1].$rw16[2]."&valor=".$totalOtrosConHD."&deudas=".$restaAOtros."&fechaini=".$fechaactualSinTiempo."&fechafin=".$fechafinalSinTiempo."&recogidas=".$cantRecogidas."&valorRecogidas=".$valorRecogidas."&otrosdeve=0&confirmado=$validadoDesprendible1&firma=$rw16[17]&valorAjuste=$valorAjusteO&tipoAjuste=$tipoAjusteO&descripcionAjuste=$descripcionAjusteO&descripcionOtros=$descripcionOtros";
                        // echo "<td><a  target='_blank' href='desprendibleOtros.php?cedula=".$rw16[5]."&nombre=".$rw16[1].$rw16[2]."&valor=".$totalOtrosConHD."&deudas=".$restaAOtros."&fechaini=".$fechaactualSinTiempo."&fechafin=".$fechafinalSinTiempo."&recogidas=".$cantRecogidas."&valorRecogidas=".$valorRecogidas."&otrosdeve=0&confirmado=$validadoDesprendible1&firma=$rw16[17]&valorAjuste=$valorAjusteO&tipoAjuste=$tipoAjusteO&descripcionAjuste=$descripcionAjusteO&descriprestamos=$descripcionOtros'>ver</a>
                        // <button style='display: $botonEnviar2; width:120px;border:1px solid #f9f9f9;background-color:".$colorEnviar1.";color:#f9f9f9;font-size:15px' id='Otros".$idusuario."guardarCuenCobro' onclick='enviarDesprendible(\"$rutaDeComp\",$idusuario,\"$fechaactual\",\"$fechafinal\",\"guardarCuenCobro\",\"Otros\")'>$textEnviar1</button>
                        // <input  type='checkbox' id='Otros".$idusuario."confirmaAdmin2' onchange='confirmaAdmin($idusuario,\"$fechaactual\",\"$fechafinal\",\"confirmaAdmin\",\"Otros\",2)' $cheked2>
                        // <label for='miCheckbox'>			
                        // <details>
                        // <summary>Confirmado</summary>
                        //     <p>$confirmado<p/>
                        // </details>	
                        // </label><br>
            
                        // </td>";//IMPRIMIR
                        
                        // echo "<td>".$validado1.$Observacion1."</td>";//Confirmado?
                        // echo "<td><a href='desprendibleOtros.php?cedula=".$rw16[5]."&nombre=".$rw16[1].$rw16[2]."&valor=".$totalOtrosConHD."&deudas=".$restaAOtros."&fechaini=".$fechaactualSinTiempo."&fechafin=".$fechafinalSinTiempo."' target='_blank'>Cuenta de cobro</a></td>";//IMPRIMIR
                        
                        $TotalDevengoyOtros=$TotalDevengado+$totalOtrosAPagar;
                        $TotalDevengoyOtros_formateado = number_format($TotalDevengoyOtros, 0, ',', '.');
                        // echo "<td>Agregar</td>";
            
                        // echo "<td>".$TotalDevengoyOtros_formateado."</td>";
                        // echo "<td> <a id='link'  onclick='pop_dis16($idusuario,\"Ajustes_nomina\",\"$fechaactual\")';  title='Click para agregar un abono' >Agregar +</a></td>";//abonos a deudas
            
                        // echo "<td><div id='campo'>";
                        // echo "<select  style='width:120px;border:1px solid #f9f9f9;background-color:".$colorselect.";color:#f9f9f9;font-size:15px'  name='$va' id='".$idusuario."Otros'  onchange='confirmarPago($idusuario,\"$fechaactual\",\"$fechafinal\",\"confirmarPago\",this.value,\"Otros\")' class='borrar' required>";
                        // // $LT->llenaselect_ar("Selecccione...",$estadosguiasinfin);
                        // echo"<option value='no' $no>NO</option>";
                        // echo"<option value='Si'$si>SI</option>";
                       
                
                        // echo"</select>";
            
                        
            
            
            
            
            
            
                      //   if ($si1=="selected") {
                        //   if ($imagencompr1=="" and $imagencompr=="") {
                        //     echo "<td><a id='Otros".$idusuario."' style='pointer-events: ".$linkotros."; color: gray;' onclick='pop_dis16($idusuario,\"Comprobante_nomina_otros\",\"$fechaactual\")';  title='Ingreso de Usuario' >Cargar</td>";
            
            
                          
                        //     }elseif ($imagencompr1!=""){  
                        //       echo "<td><a href='https://sistema.transmillas.com/img_nomina/$imagencompr1' style='display: block;' target='_blank' title='Ver comprovante de pago de nomina' >Ver</a>";
                        //       echo "<a id='Otros".$idusuario."' style='display: block;  pointer-events: ".$linkotros."; ' onclick='pop_dis16($idusuario,\"Comprobante_nomina_otros\",\"$fechaactual\")';  title='Ingreso de Usuario' >Cambiar</a></td>";
            
                        //     }elseif ($imagencompr!=""){  
                        //         echo "<td><a href='https://sistema.transmillas.com/img_nomina/$imagencompr' style='display: block;' target='_blank' title='Ver comprovante de pago de nomina' >Ver</a>";
                        //         echo "<a id='Otros".$idusuario."' style='display: block;  pointer-events: ".$linkotros."; ' onclick='pop_dis16($idusuario,\"Comprobante_nomina_otros\",\"$fechaactual\")';  title='Ingreso de Usuario' >Cambiar</a></td>";
              
                        //       }
                        // echo "<td></td>";
                        // echo "<td></td>";
                        // echo "<td>$rw16[6]</td>";
                        // echo "<td>$terminaContrato</td>";
                        
                        $totalDevengTodos=$totalDevengTodos+$TotalDevengado;
            
                        $valorAPagarotrosTodos= $valorAPagarotrosTodos+$totalOtrosAPagar;
                        $TotalDevengoyOtrosTodos= $TotalDevengoyOtrosTodos+$TotalDevengoyOtros;
            
                                  echo "<tr>";
                    
                      echo "<td>1</td>";//tipo identificacion
                      echo "<td>$rw16[5]</td>";//Numero identificacion
                      echo "<td>$rw16[1]</td>";//Nombre
                      echo "<td>$rw16[2]</td>";//Apellido
  
                      if ($rw1[16]=="DAVIPLATA") {
                          $tipoCuenta="DP";
                      }else if ($rw1[16]=="AHORROS") {
                          $tipoCuenta="CA";
                      }
                      if ($rw1[17]=="DAVIVIENDA" or $rw1[17]=="DAVIPLATA") {
                          $codigoBanco="51";
                      }
                      echo "<td>$codigoBanco</td>";
                      
                      echo "<td>$tipoCuenta</td>";
                      // $numero_formateado = number_format($numero_largo, 0, '.', '');
                      $numeroCuenta_formateado = number_format($rw1[15], 0, '', '');
                      echo "<td>".$rw1[15]."</td>";
                      echo "<td>".$TotalDevengoyOtros_formateado."\t</td>";
  
  
  
  
  
                      // echo "<td>$rw11[6]</td>";//Codigo del Banco
                      // echo "<td>$rw11[13]</td>";//Tipo de producto o servicio
                      // echo "<td>$rw11[6]</td>";//Numero del Producto o Servicio
                      // echo "<td>$rw11[13]</td>";//Valor del Pago o de la Recarga
                      echo "</tr>";//tipo identificacion

            
                     }            
                     
            
                    }	
            
            
                  }
        
        }


              
    }
    

    

    
    
        /* $FB->titulo_azul1("$ $totalalcobro",1,0,0); 
        $FB->titulo_azul1("$ $totalprestamos",1,0,0);  */




      ?>

</table>