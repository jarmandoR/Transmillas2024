<script>
    function aviso(){
        alert("Debe Seleccionar un operador para hacer esta consulta");
    }
</script>


<?php 
require("login_autentica.php");
include("cabezote3.php"); 

$asc="ASC";
$conde=" ";
$conde2=" ";
$conde3=" ";
$conde4=" ";
$conde5=" ";

if($param34!=''){ $fechaactual=$param34; }

if($param35!=''){ $id_sedes=$param35; 

	$conde4=" and usu_idsede=$id_sedes "; 	
}
if($param33!=''){ $conde="and `idusuarios`= '$param33' "; 

$muestra2=true;
}
if($param32!='' and $param32!=0){ $conde1="and `seg_motivo`= '$param33' ";  }
	
$FB->titulo_azul1("Operador",1,0,7); 
$FB->titulo_azul1("Preoperacional",1,0,0); 
$FB->titulo_azul1("Validacion",1,0,0); 
$FB->titulo_azul1("Prueba Alcohol",1,0,0); 
$FB->titulo_azul1("Imagen",1,0,0); 
$FB->titulo_azul1("Ingreso?",1,0,0); 
$FB->titulo_azul1("Descripcion",1,0,0); 
$FB->titulo_azul1("Fecha Ingreso",1,0,0); 
$FB->titulo_azul1("Zona Trabajo",1,'5%',0); 
$FB->titulo_azul1("Hora Almuerzo",1,'5%',0); 
$FB->titulo_azul1("Retorno Almuerzo",1,'5%',0); 
$FB->titulo_azul1("Retorno Oficina",1,'5%',0); 
$FB->titulo_azul1("Hora Salida",1,'5%',0); 
$FB->titulo_azul1("TEM ENTRADA",1,'5%',0); 
$FB->titulo_azul1("TEM SALIDA",1,'5%',0); 
$FB->titulo_azul1("Tipo Contrato",1,'5%',0); 
$FB->titulo_azul1("PLACA",1,'5%',0); 
$FB->titulo_azul1("Fecha Seguro",1,'5%',0); 
$FB->titulo_azul1("Fecha Tecnomecánica",1,'5%',0); 
$FB->titulo_azul1("Fecha licencia de conduccion",1,'5%',0); 
$FB->titulo_azul1("Cambio de aceite",1,'5%',0); 

if($nivel_acceso==1 or $nivel_acceso==12){
$FB->titulo_azul1("Eliminar",1,'5%',0); 
}



$conde3=""; 
if ($param34==$param36) {

	$muestra1 = true;
	// echo"son iguales";
}else{
	$muestra1 = false;
	// echo"son Diferentes";
}
if($param34!=''){ $fechaactual=$param34." 00:00:00"; 

}
if($param36!=''){ $fechafinal=$param36." 23:59:59";  }

if($param37!='0'){ $conde5=" and usu_tipocontrato='$param37'";  }

if ($muestra1) {
	//  $sql="SELECT idusuarios,usu_nombre,preestado,seg_alcohol,`seg_fechaingreso`, `seg_horaalmuerzo`, `seg_horaregreso`, `seg_idzona`,prefechaingreso,idseguimiento_user,seg_motivo,seg_descr,seg_fechafinalizo FROM `pre-operacional` inner join `usuarios` on preidusuario=idusuarios left join seguimiento_user on idusuarios=seg_idusuario and seg_fechaalcohol>='$fechaactual' and  seg_fechaalcohol<='$fechafinal'  where  (usu_estado=1 or usu_filtro=1)  and prefechaingreso>='$fechaactual' and prefechaingreso<='$fechafinal'  $conde  $conde2  $conde4 ORDER BY usu_nombre  asc ";

$sql="SELECT idusuarios,usu_nombre,usu_identificacion,usu_tipocontrato,usu_fechalicencia,usu_idsede FROM usuarios WHERE usu_estado = '1'and usu_filtro='1' $conde  $conde2  $conde4 $conde5 ORDER BY usu_nombre  asc ";

//   $sql="SELECT idusuarios,usu_nombre,preestado,prefechaingreso,idpreoperacinal,usu_tipocontrato,prevehiculo,usu_fechalicencia FROM `pre-operacional` inner join usuarios on idusuarios=preidusuario  where  (usu_estado=1 or usu_filtro=1)  and prefechaingreso>='$fechaactual' and prefechaingreso<='$fechafinal'  $conde  $conde2  $conde4 $conde5 ORDER BY usu_nombre  asc ";

$DB->Execute($sql); 
$va=0; 
$totalasignadas=0;
// $color1='';
// $color2='';

while($rw0=mysqli_fetch_row($DB->Consulta_ID))
{


	$id_p=$rw0[0];

	$sql4="SELECT pre_limpiomaleta,pre_codigoimpresora,preestado,prefechaingreso,idpreoperacinal,pre_kilrecorridos,prevehiculo,predatosvalidados FROM `pre-operacional`   where  preidusuario='$rw0[0]'  and prefechaingreso>='$fechaactual' and prefechaingreso<='$fechafinal' ORDER BY prefechaingreso  asc  ";


		//   $sql4="SELECT idusuarios,usu_nombre,preestado,prefechaingreso,idpreoperacinal,usu_tipocontrato,prevehiculo,usu_fechalicencia FROM `pre-operacional` inner join usuarios on idusuarios=preidusuario  where  (usu_estado=1 or usu_filtro=1)  and prefechaingreso>='$fechaactual' and prefechaingreso<='$fechafinal'  $conde  $conde2  $conde4 $conde5 ORDER BY usu_nombre  asc ";

	$DB1->Execute($sql4); 
		// $va=0; 
		// $totalasignadas=0;
		// $color1='';
		// $color2='';
				
		$rw1=mysqli_fetch_row($DB1->Consulta_ID);

			if (empty($rw1)) {
					$color="#922B21";
					$colorletra='style="color: #FFFFFF;"';
					$fechaHora= "";
					echo "<tr class='text' bgcolor='$color' $colorletra onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
					echo "<td>".$rw0[1]."</td>";
					echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($idingresouser,\"ingresousuario\",\"pendiente\")';  title='Ingreso de Usuario' >$rw2[5]</td>"; //Ingreso?
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
								echo "<td></td>";
			} else {
				// while($rw1)
				// {


							//echo $rw1[3];
							$fechabusqueda=substr("$rw1[3]",0,10);
							$imprimir=1;
							$sql1="SELECT seg_alcohol,`seg_fechaingreso`, `seg_horaalmuerzo`, `seg_horaregreso`, `seg_idzona`,seg_motivo,seg_descr,seg_fechafinalizo,idseguimiento_user,seg_horaoficina from seguimiento_user where seg_fechaalcohol like '$fechabusqueda%'  and seg_idusuario='$id_p' $conde1 order by seg_fechaingreso asc";
							$DB1->Execute($sql1); 
							$rw2=mysqli_fetch_row($DB1->Consulta_ID);
								$compara=$rw2[5];
					
							if($param32!=$compara && $param32!='0' && $param32!=null){  $imprimir=0;}
							
							
					
							if($imprimir==1){
								$va++; $p=$va%2;
								if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
								
								if($rw1[2]=="descanso"){ $color="#82E0AA";
									echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
									echo "<td>".$rw0[1]."</td>";
									echo "<td></td>";
									echo "<td></td>";
									echo "<td></td>";
									echo "<td></td>";
									echo "<td colspan='1' width='0' align='center' >$rw2[1]</td>";
									echo "<td>D</td>";
									echo "<td>E</td>";
									echo "<td>S</td>";
									echo "<td>C</td>";
									echo "<td>A</td>";
									echo "<td>N</td>";
									echo "<td>S</td>";
									echo "<td>O</td>";
									echo "<td></td>";
									echo "<td></td>";
									echo "<td></td>";
									echo "<td></td>";
									echo "<td></td>";
								
								}else{
					
					
					
					
					
					
					
					
					
					
								
									if($rw1[2]=='Validado' or $rw1[2]=='Validado Covid19'){}else{ $color="#ff5f42"; }
					
									echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
									echo "<td>".$rw0[1]."</td>";// NOMBRE
									$fecha=substr($rw1[3], 0, -8);
									if($rw2[0]=='' or $rw2[0]==null){ 
										$rw2[0]='Faltante'; 
										$ver="<td colspan='1' width='0' align='center' ></td>";
									}
									else{
										if($rw2[5]=='' or $rw2[5]==null){ $rw2[5]='Sin Ingresar'; 
											
										}
										else{
										if($rw2[2]=='' or $rw2[2]==null){ $rw2[2]='Sin Ingresar'; }
										if($rw2[3]=='' or $rw2[3]==null){ $rw2[3]='Sin Ingresar'; }
										
										}
										$ver=$LT->llenadocs3($DB1, "seguimiento_user", $rw2[8], 1, 35, 'Ver');
									}
									$idingresouser=$rw2[8];
					
									if($rw2[8]==''){
										
										$rw2[8]='insert '.$id_p;
									}else{
										$rw2[8]='update '.$rw2[8];
										
									}
					
									if($rw1[2]!='No aplica'){
											echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='window.open(\"validaoperacional.php?iduser=$id_p&fecha=$fecha&idvehiculo=$rw1[6]&campo=preencuesta\",\"_self\")';  title='Pre operacional' >$rw1[2]</td>";
					
									}else {
										echo	"<td colspan='1' width='0' align='center' >$rw1[2]</td>";
									}
									if($rw1[2]=='Validado' or $rw1[2]=='Validado Covid19'){
										echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='window.open(\"validaoperacional.php?iduser=$id_p&fecha=$fecha&idvehiculo=$rw1[6]&campo=predatosvalidados\")';  title='Pre operacional' >$rw1[2]</td>";
					
									}else {
										echo	"<td colspan='1' width='0' align='center' >Sin Validar</td>";
									}
					
									echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16(\"$rw2[8]\",\"pruebaalcohol\",\"$param34\")';  title='Prueba de alcohol' >$rw2[0]   </td>";
									echo $ver ;
									echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($idingresouser,\"ingresousuario\",\"$rw1[3]\")';  title='Ingreso de Usuario' >$rw2[5]</td>"; //Ingreso?
									echo "<td colspan='1' width='0' align='center' >$rw2[6]</td>"; // DESCRIPCION
									echo "<td colspan='1' width='0' align='center' >$rw2[1]</td>"; //FECHA DE INGRESO
					
					
									$sql2="SELECT `idzonatrabajo`,`zon_nombre` FROM `zonatrabajo` WHERE `idzonatrabajo`='$rw2[4]'";
									$DB2->Execute($sql2);
									$rw3=mysqli_fetch_row($DB2->Consulta_ID);
									$zona ="$rw3[1]"; 
									if($zona=='' or $zona==null){ $zona='Faltante'; }
									echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($idingresouser,\"zonatrabajo\",\"$rw1[3]\")';  title='Zona' >$zona</td>"; //ZONA TRABAJO
									echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($idingresouser,\"horaalmuerzo\",\"$rw1[3]\")';  title='Hora almuerzo' >$rw2[2]</td>"; // HORA DE ALMUERZO
									echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($idingresouser,\"horaretorno\",\"$rw1[3]\")';  title='Retorno almuerzo' >$rw2[3]</td>"; //RETORNO ALMUERZO
									echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($idingresouser,\"horaoficina\",\"$rw1[3]\")';  title='Retorno Oficina' >$rw2[9]</td>"; //RETORNO OFICINA
									echo "<td colspan='1' width='0' align='center'  title='Hora Salida' >$rw2[7]</td>"; //HORA SALIDA
								
									echo $LT->llenadocs3($DB1, "pre-operacional",$rw1[4], 1, 35, 'Ver');// TEM ENTRADA
									echo $LT->llenadocs3($DB1, "pre-operacional", $rw1[4], 2, 35, 'Ver');// TEM SALIDA
					
									echo "<td colspan='1' width='0' align='center'  title='Contrato' >$rw0[3]</td>"; // TIPO CONTRATO
									$color1='';
									$color2='';
					
										$fechaInicial = 0;
										$fechaFinal = 0;
										// Las convertimos a segundos
										$fechaInicialSegundos = 0;
										$fechaFinalSegundos = 0;
										// Hacemos las operaciones para calcular los dias entre las dos fechas y mostramos el resultado
										$dias = 0;
										$diasparasoat=0;
					
					
										$fechaInicial11 = 0;
										$fechaFinal1 = 0;
										// Las convertimos a segundos
										$fechaInicialSegundos1 = 0;
										$fechaFinalSegundos1 = 0;
										// Hacemos las operaciones para calcular los dias entre las dos fechas y mostramos el resultado
										$dias1 =0;
										$diasparatecno=0;
					
					
									if($rw1[6]!=0){
					
											$sql3="SELECT `idvehiculos`,  `veh_fechaseguro`, `veh_fechategnomecanica`, `veh_fechamantenimiento`,veh_placa,veh_kilactual,veh_aceitekil,veh_kmalcambaceite FROM `vehiculos` WHERE idvehiculos='$rw1[6]'";
											$DB2->Execute($sql3);
											$rw4=mysqli_fetch_row($DB2->Consulta_ID);
											$kilactual=$rw4[5];
											$kilparacamaceite=$rw4[6];
											$kmalcambaceite=$rw4[7];
					
					
										$fechaActual = date('Y-m-d');
					
											$fechas=strtotime(date("d-m-Y",strtotime($rw4[1]. "- 3 days")));
											$fechat=strtotime(date("d-m-Y",strtotime($rw4[2]. "- 3 days")));
											$fehcacomparar=strtotime(date($fechaActual));
					
												// Declaramos nuestras fechas inicial y final
												$fechaInicial = date($fechaActual);
												$fechaFinal = date($rw4[1]);
												// Las convertimos a segundos
												$fechaInicialSegundos = strtotime($fechaInicial);
												$fechaFinalSegundos = strtotime($fechaFinal);
												// Hacemos las operaciones para calcular los dias entre las dos fechas y mostramos el resultado
												$dias = ($fechaFinalSegundos - $fechaInicialSegundos) / 86400;
												$diasparasoat=round($dias, 0, PHP_ROUND_HALF_UP);
					
					
												$fechaInicial1 = date($fechaActual);
												$fechaFinal1 = date($rw4[2]);
												// Las convertimos a segundos
												$fechaInicialSegundos1 = strtotime($fechaInicial1);
												$fechaFinalSegundos1 = strtotime($fechaFinal1);
												// Hacemos las operaciones para calcular los dias entre las dos fechas y mostramos el resultado
												$dias1 = ($fechaFinalSegundos1 - $fechaInicialSegundos1) / 86400;
												$diasparatecno=round($dias1, 0, PHP_ROUND_HALF_UP);
					
											//   if ($rw4[4]=="YNA73F") {
											//   	echo"DIAS DE DIFERENCIA soat".$diasparasoat;
													// echo"DIAS DE DIFERENCIA TCNO".$diasparatecno;  
											//   }
					
												$fechaInicial2 = date($fechaActual);
												$fechaFinal2 = date($rw0[4]);
												// Las convertimos a segundos
												$fechaInicialSegundos2 = strtotime($fechaInicial2);
												$fechaFinalSegundos2 = strtotime($fechaFinal2);
												// Hacemos las operaciones para calcular los dias entre las dos fechas y mostramos el resultado
												$dias2 = ($fechaFinalSegundos2 - $fechaInicialSegundos2) / 86400;
												echo $diasparalice=round($dias2, 0, PHP_ROUND_HALF_UP);
					
					
					
											if($diasparasoat<=3 or $diasparasoat<0){
												$color1='#F39C12';
											}
					
					
											if($diasparatecno<=3 or $diasparatecno<0){
												$color2='#F39C12';
											}
					
											echo "<td colspan='1' width='0' align='center' >$rw4[4]</td>"; // PLACA
											echo	$LT->llenadocs4($DB2, "vehiculos", $rw1[6], 3, 35, "$rw4[1]",$color1); 
											echo	$LT->llenadocs4($DB2, "vehiculos", $rw1[6], 4, 35, "$rw4[2]",$color2);	
									}else{
											echo "<td colspan='1' width='0' align='center' ></td>";
											echo "<td colspan='1' width='0' align='center' ></td>";
											echo "<td colspan='1' width='0' align='center' ></td>";
										}
									
					
									//  $sql4="SELECT `usu_licencia`FROM `usiarios` WHERE usu_identificacions='$rw1[6]'";
									// $DB2->Execute($sql4);
									// $rw5=mysqli_fetch_row($DB2->Consulta_ID);
									if($diasparalice<=3 or $diasparalice<0){
										// $color3='#F39C12';
					
										$color3="bgcolor='#F39C12'";
									}else{
										$color3="";
					
									}
					
					
					
					
									$fechacero="0000-00-00";
					
									if ($rw0[4]==$fechacero) {
										echo "<td colspan='1' width='0' align='center' ></td>";
									}else{
					
										echo "<td colspan='1' width='0' align='center' ".$color3." >".$rw0[4]."</td>";
									}
					
					
					
					
					
									if($rw1[6]!=0){
										$kilactual=$rw4[5];
										$kilparacamaceite=$rw4[6];
										$kmalcambaceite=$rw4[7];
					
										$faltaparacamaceite=$kilactual-$kmalcambaceite;
					
										if($kmalcambaceite!=0 or $kmalcambaceite!=""){
											if ($faltaparacamaceite>=$kilparacamaceite) {
												echo "<td colspan='1' width='0' bgcolor='#F39C12'  align='center' >Cambie el aceite, ".$faltaparacamaceite."km exede el limite </td>";
											}elseif($faltaparacamaceite<$kilparacamaceite){
												echo "<td colspan='1' width='0' align='center' > ".$faltaparacamaceite."km de ".$kilparacamaceite."km para cambio aceite</td>";
											}
										}else{
					
											echo "<td colspan='1' width='0' align='center' >-</td>";
										}
									}
									echo "<td colspan='1' width='0' align='center' ></td>";
					
									if($nivel_acceso==1 or $nivel_acceso==12){
										$DB1->edites($rw1[4], "pre-operacional", 2,0);
									}
								
								}
							}
				// }
				

			}
	
}
}elseif ($muestra1 == false or ($muestra1 == false and $muestra2 == true)) {

if (($muestra1 == false and $muestra2 == true)) {
    $fechaini = $param34;
    $fechafin = $param36;
    $fechaCompleta=date("$param6 H:i:s");	
    
    
    
    // Establecer la fecha inicial y final
    $fechaInicial = new DateTime($fechaini);
    $fechaFinal = new DateTime($fechafin);
    
    while ($fechaInicial <= $fechaFinal) {
        // Obtener la fecha actual con hora
        $fechaConHora = $fechaInicial->format('Y-m-d H:i:s');
        echo"Corre fechas".$fechaSola=$fechaInicial->format('Y-m-d');
        // Preparar la consulta SQL e insertar en la base de datos
       
        // Incrementar la fecha para la próxima iteración
        $sql="SELECT idusuarios,usu_nombre,preestado,prefechaingreso,idpreoperacinal,usu_tipocontrato,prevehiculo,usu_fechalicencia FROM `pre-operacional` inner join usuarios on idusuarios=preidusuario  where  (usu_estado=1 or usu_filtro=1)  and prefechaingreso like '%$fechaSola%'   $conde  $conde2  $conde4 $conde5 ORDER BY prefechaingreso  asc ";

	$DB1->Execute($sql); 
	$va=0; 
	$totalasignadas=0;
	// $color1='';
	// $color2='';
	
		$rw1=mysqli_fetch_row($DB1->Consulta_ID);
    if (empty($rw1)) {

        		 echo$sql3="SELECT idusuarios,usu_nombre FROM usuarios WHERE idusuarios >0 $conde   ORDER BY usu_nombre  asc ";
        		$DB1->Execute($sql3); 
        		$rw3=mysqli_fetch_row($DB1->Consulta_ID);
        		 

        $color="#922B21";
        $colorletra='style="color: #FFFFFF;"';
        $fechaHora= "";
        echo "<tr class='text' bgcolor='$color' $colorletra onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
        echo "<td>".$rw3[1]."</td>";
        echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($rw1[0],\"ingresousuario\",\"pendiente\")';  title='Ingreso de Usuario' >Ingreso</td>"; //Ingreso?
                    echo "<td></td>";
                    echo "<td>$fechaConHora</td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
    } else {

        		$id_p=$rw1[0];
        		//echo $rw1[3];
        		 $fechabusqueda=substr("$rw1[3]",0,10);
        		 $imprimir=1;
        		 $sql1="SELECT seg_alcohol,`seg_fechaingreso`, `seg_horaalmuerzo`, `seg_horaregreso`, `seg_idzona`,seg_motivo,seg_descr,seg_fechafinalizo,idseguimiento_user,seg_horaoficina from seguimiento_user where seg_fechaalcohol like '$fechabusqueda%'  and seg_idusuario='$id_p' $conde1 order by seg_fechaingreso asc";
        		$DB->Execute($sql1); 
        		$rw2=mysqli_fetch_row($DB->Consulta_ID);
        		 $compara=$rw2[5];
        
        		// if($param32!=$compara && $param32!='0' && $param32!=null){  $imprimir=0;}
                
                
        
        		// if($imprimir==1){

        			echo"Motivo".$rw1[2];
                        
                        
        				if($rw2[5]=="Vacaciones"){ 
        									$color="#FFC300";
        									echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
        									echo "<td>".$rw1[1]."</td>";
        									echo "<td></td>";
        									echo "<td></td>";
        									echo "<td></td>";
        									echo "<td></td>";
        									echo "<td colspan='1' width='0' align='center' >$rw2[1]</td>";
        									echo "<td>V</td>";
        									echo "<td>A</td>";
        									echo "<td>C</td>";
        									echo "<td>A</td>";
        									echo "<td>C</td>";
        									echo "<td>I</td>";
        									echo "<td>O</td>";
        									echo "<td>N</td>";
        									echo "<td>E</td>";
        									echo "<td>S</td>";
        									echo "<td></td>";
        									echo "<td></td>";
        									echo "<td></td>";
        									echo "<td></td>";
        									echo "<td></td>";
        									echo "<td></td>";
                                        
        				}
                        else{



                            if($rw1[2]=="descanso"){ $color="#82E0AA";
                                echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
                                echo "<td>".$rw1[1]."</td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td colspan='1' width='0' align='center' >$rw1[3]</td>";
                                echo "<td>D</td>";
                                echo "<td>E</td>";
                                echo "<td>S</td>";
                                echo "<td>C</td>";
                                echo "<td>A</td>";
                                echo "<td>N</td>";
                                echo "<td>S</td>";
                                echo "<td>O</td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                            
                            }else{
        					$va++; $p=$va%2;
        					if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
        					if($rw1[2]=='Validado' or $rw1[2]=='Validado Covid19'){}else{ $color="#ff5f42"; }
        					echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
        					echo "<td>".$rw1[1]."</td>";
        					$fecha=substr($rw1[3], 0, -8);
        					if($rw2[0]=='' or $rw2[0]==null){ 
        						$rw2[0]='Faltante'; 
        						$ver="<td colspan='1' width='0' align='center' ></td>";
        					}
        					else{
        						if($rw2[5]=='' or $rw2[5]==null){ $rw2[5]='Sin Ingresar'; 
                                    
        						}
        						else{
        						if($rw2[2]=='' or $rw2[2]==null){ $rw2[2]='Sin Ingresar'; }
        						if($rw2[3]=='' or $rw2[3]==null){ $rw2[3]='Sin Ingresar'; }
                                
        						}
        						$ver=$LT->llenadocs3($DB, "seguimiento_user", $rw2[8], 1, 35, 'Ver');
        					}
        					$idingresouser=$rw2[8];
        					if($rw2[8]==''){
                                
        						$rw2[8]='insert '.$id_p;
        					}else{
        						$rw2[8]='update '.$rw2[8];
                                
        					}
        					if($rw1[2]!='No aplica'){
        							echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='window.open(\"validaoperacional.php?iduser=$id_p&fecha=$fecha&idvehiculo=$rw1[6]&campo=preencuesta\",\"_self\")';  title='Pre operacional' >$rw1[2]</td>";
                
        					}else {
        						echo	"<td colspan='1' width='0' align='center' >$rw1[2]</td>";
        					}
        					if($rw1[2]=='Validado' or $rw1[2]=='Validado Covid19'){
        						echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='window.open(\"validaoperacional.php?iduser=$id_p&fecha=$fecha&idvehiculo=$rw1[6]&campo=predatosvalidados\")';  title='Pre operacional' >$rw1[2]</td>";
                
        					}else {
        						echo	"<td colspan='1' width='0' align='center' >Sin Validar</td>";
        					}
                
        					echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16(\"$rw2[8]\",\"pruebaalcohol\",\"$param34\")';  title='Prueba de alcohol' >$rw2[0]   </td>";
        					echo $ver ;
        					echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($idingresouser,\"ingresousuario\",\"$rw1[3]\")';  title='Ingreso de Usuario' >$rw2[5]</td>";
        					echo "<td colspan='1' width='0' align='center' >$rw2[6]</td>";
        					echo "<td colspan='1' width='0' align='center' >$rw2[1]</td>";
                
                
        					$sql2="SELECT `idzonatrabajo`,`zon_nombre` FROM `zonatrabajo` WHERE `idzonatrabajo`='$rw2[4]'";
        					$DB2->Execute($sql2);
        					$rw3=mysqli_fetch_row($DB2->Consulta_ID);
        					$zona ="$rw3[1]"; 
        					if($zona=='' or $zona==null){ $zona='Faltante'; }
        					echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($idingresouser,\"zonatrabajo\",\"$rw1[3]\")';  title='Zona' >$zona</td>";
        					echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($idingresouser,\"horaalmuerzo\",\"$rw1[3]\")';  title='Hora almuerzo' >$rw2[2]</td>";
        					echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($idingresouser,\"horaretorno\",\"$rw1[3]\")';  title='Retorno almuerzo' >$rw2[3]</td>";
        					echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($idingresouser,\"horaoficina\",\"$rw1[3]\")';  title='Retorno Oficina' >$rw2[9]</td>";
        					echo "<td colspan='1' width='0' align='center'  title='Hora Salida' >$rw2[7]</td>";
                        
        					echo $LT->llenadocs3($DB, "pre-operacional",$rw1[4], 1, 35, 'Ver');
        					echo $LT->llenadocs3($DB, "pre-operacional", $rw1[4], 2, 35, 'Ver');
                
        					echo "<td colspan='1' width='0' align='center'  title='Contrato' >$rw1[5]</td>";
        					$color1='';
        					$color2='';
                
        						$fechaInicialC = 0;
        						$fechaFinalC = 0;
        						// Las convertimos a segundos
        						$fechaInicialSegundos = 0;
        						$fechaFinalSegundos = 0;
        						// Hacemos las operaciones para calcular los dias entre las dos fechas y mostramos el resultado
        						$dias = 0;
        						$diasparasoat=0;
                
                
        						$fechaInicial11 = 0;
        						$fechaFinal1 = 0;
        						// Las convertimos a segundos
        						$fechaInicialSegundos1 = 0;
        						$fechaFinalSegundos1 = 0;
        						// Hacemos las operaciones para calcular los dias entre las dos fechas y mostramos el resultado
        						$dias1 =0;
        						$diasparatecno=0;
                
                
        					if($rw1[6]!=0){
                
        							$sql3="SELECT `idvehiculos`,  `veh_fechaseguro`, `veh_fechategnomecanica`, `veh_fechamantenimiento`,veh_placa,veh_kilactual,veh_aceitekil,veh_kmalcambaceite FROM `vehiculos` WHERE idvehiculos='$rw1[6]'";
        							$DB2->Execute($sql3);
        							$rw4=mysqli_fetch_row($DB2->Consulta_ID);
        							$kilactual=$rw4[5];
        							$kilparacamaceite=$rw4[6];
        							$kmalcambaceite=$rw4[7];
                
                
        						$fechaActual = date('Y-m-d');
                
        							$fechas=strtotime(date("d-m-Y",strtotime($rw4[1]. "- 3 days")));
        							$fechat=strtotime(date("d-m-Y",strtotime($rw4[2]. "- 3 days")));
        							$fehcacomparar=strtotime(date($fechaActual));
                
        								// Declaramos nuestras fechas inicial y final
        								$fechaInicialC = date($fechaActual);
        								$fechaFinalC = date($rw4[1]);
        								// Las convertimos a segundos
        								$fechaInicialSegundos = strtotime($fechaInicial);
        								$fechaFinalSegundos = strtotime($fechaFinal);
        								// Hacemos las operaciones para calcular los dias entre las dos fechas y mostramos el resultado
        								$dias = ($fechaFinalSegundos - $fechaInicialSegundos) / 86400;
        								$diasparasoat=round($dias, 0, PHP_ROUND_HALF_UP);
                
                
        								$fechaInicial1 = date($fechaActual);
        								$fechaFinal1 = date($rw4[2]);
        								// Las convertimos a segundos
        								$fechaInicialSegundos1 = strtotime($fechaInicial1);
        								$fechaFinalSegundos1 = strtotime($fechaFinal1);
        								// Hacemos las operaciones para calcular los dias entre las dos fechas y mostramos el resultado
        								$dias1 = ($fechaFinalSegundos1 - $fechaInicialSegundos1) / 86400;
        								$diasparatecno=round($dias1, 0, PHP_ROUND_HALF_UP);
                
        							//   if ($rw4[4]=="YNA73F") {
        							//   	echo"DIAS DE DIFERENCIA soat".$diasparasoat;
        									// echo"DIAS DE DIFERENCIA TCNO".$diasparatecno;  
        							//   }
                
        								$fechaInicial2 = date($fechaActual);
        								$fechaFinal2 = date($rw1[7]);
        								// Las convertimos a segundos
        								$fechaInicialSegundos2 = strtotime($fechaInicial2);
        								$fechaFinalSegundos2 = strtotime($fechaFinal2);
        								// Hacemos las operaciones para calcular los dias entre las dos fechas y mostramos el resultado
        								$dias2 = ($fechaFinalSegundos2 - $fechaInicialSegundos2) / 86400;
        								echo $diasparalice=round($dias2, 0, PHP_ROUND_HALF_UP);
                
                
                
        							if($diasparasoat<=3 or $diasparasoat<0){
        								$color1='#F39C12';
        							}
                
                
        							if($diasparatecno<=3 or $diasparatecno<0){
        								$color2='#F39C12';
        							}
                
        							echo "<td colspan='1' width='0' align='center' >$rw4[4]</td>";
        							echo	$LT->llenadocs4($DB2, "vehiculos", $rw1[6], 3, 35, "$rw4[1]",$color1);
        							echo	$LT->llenadocs4($DB2, "vehiculos", $rw1[6], 4, 35, "$rw4[2]",$color2);	
        					}else{
        							echo "<td colspan='1' width='0' align='center' ></td>";
        							echo "<td colspan='1' width='0' align='center' ></td>";
        							echo "<td colspan='1' width='0' align='center' ></td>";
        						}
                            
                
        					//  $sql4="SELECT `usu_licencia`FROM `usiarios` WHERE usu_identificacions='$rw1[6]'";
        					// $DB2->Execute($sql4);
        					// $rw5=mysqli_fetch_row($DB2->Consulta_ID);
        					if($diasparalice<=3 or $diasparalice<0){
        						// $color3='#F39C12';
                
        						$color3="bgcolor='#F39C12'";
        					}else{
        						$color3="";
                
        					}
                
                
                
                
        					$fechacero="0000-00-00";
                
        					if ($rw1[7]==$fechacero) {
        						echo "<td colspan='1' width='0' align='center' ></td>";
        					}else{
                
        						echo "<td colspan='1' width='0' align='center' ".$color3." >".$rw1[7]."</td>";
        					}
                
                
                
                
                
        					if($rw1[6]!=0){
        						$kilactual=$rw4[5];
        						$kilparacamaceite=$rw4[6];
        						$kmalcambaceite=$rw4[7];
                
        						$faltaparacamaceite=$kilactual-$kmalcambaceite;
                
        						if($kmalcambaceite!=0 or $kmalcambaceite!=""){
        							if ($faltaparacamaceite>=$kilparacamaceite) {
        								echo "<td colspan='1' width='0' bgcolor='#F39C12'  align='center' >Cambie el aceite, ".$faltaparacamaceite."km exede el limite </td>";
        							}elseif($faltaparacamaceite<$kilparacamaceite){
        								echo "<td colspan='1' width='0' align='center' > ".$faltaparacamaceite."km de ".$kilparacamaceite."km para cambio aceite</td>";
        							}
        						}else{
                
        							echo "<td colspan='1' width='0' align='center' >-</td>";
        						}
        					}
        					echo "<td colspan='1' width='0' align='center' ></td>";
                
        					if($nivel_acceso==1 or $nivel_acceso==12){
        						$DB->edites($rw1[4], "pre-operacional", 2,0);
        					}
        		// 		}
                    }
        		}
    }

        $fechaInicial->modify('+1 day');
    }
}else{

    echo"<script> aviso(); </script>";
	// $sql="SELECT idusuarios,usu_nombre,preestado,prefechaingreso,idpreoperacinal,usu_tipocontrato,prevehiculo,usu_fechalicencia FROM `pre-operacional` inner join usuarios on idusuarios=preidusuario  where  (usu_estado=1 or usu_filtro=1)  and prefechaingreso>='$fechaactual' and prefechaingreso<='$fechafinal'  $conde  $conde2  $conde4 $conde5 ORDER BY prefechaingreso  asc ";

	// $DB1->Execute($sql); 
	// $va=0; 
	// $totalasignadas=0;
	// // $color1='';
	// // $color2='';
	
	// 	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	// 	{
	
			
	// 		$id_p=$rw1[0];
	// 		//echo $rw1[3];
	// 		 $fechabusqueda=substr("$rw1[3]",0,10);
	// 		 $imprimir=1;
	// 		 $sql1="SELECT seg_alcohol,`seg_fechaingreso`, `seg_horaalmuerzo`, `seg_horaregreso`, `seg_idzona`,seg_motivo,seg_descr,seg_fechafinalizo,idseguimiento_user,seg_horaoficina from seguimiento_user where seg_fechaalcohol like '$fechabusqueda%'  and seg_idusuario='$id_p' $conde1 order by seg_fechaingreso asc";
	// 		$DB->Execute($sql1); 
	// 		$rw2=mysqli_fetch_row($DB->Consulta_ID);
	// 		 $compara=$rw2[5];
	
	// 		if($param32!=$compara && $param32!='0' && $param32!=null){  $imprimir=0;}
			
			
	
	// 		if($imprimir==1){

	// 			// echo"Motivo".$rw1[2];
					
					
	// 				if($rw2[5]=="Vacaciones"){ 
	// 									$color="#FFC300";
	// 									echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	// 									echo "<td>".$rw1[1]."</td>";
	// 									echo "<td></td>";
	// 									echo "<td></td>";
	// 									echo "<td></td>";
	// 									echo "<td></td>";
	// 									echo "<td colspan='1' width='0' align='center' >$rw2[1]</td>";
	// 									echo "<td>V</td>";
	// 									echo "<td>A</td>";
	// 									echo "<td>C</td>";
	// 									echo "<td>A</td>";
	// 									echo "<td>C</td>";
	// 									echo "<td>I</td>";
	// 									echo "<td>O</td>";
	// 									echo "<td>N</td>";
	// 									echo "<td>E</td>";
	// 									echo "<td>S</td>";
	// 									echo "<td></td>";
	// 									echo "<td></td>";
	// 									echo "<td></td>";
	// 									echo "<td></td>";
	// 									echo "<td></td>";
	// 									echo "<td></td>";
									
	// 				}else{
	// 					$va++; $p=$va%2;
	// 					if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	// 					if($rw1[2]=='Validado' or $rw1[2]=='Validado Covid19'){}else{ $color="#ff5f42"; }
	// 					echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	// 					echo "<td>".$rw1[1]."</td>";
	// 					$fecha=substr($rw1[3], 0, -8);
	// 					if($rw2[0]=='' or $rw2[0]==null){ 
	// 						$rw2[0]='Faltante'; 
	// 						$ver="<td colspan='1' width='0' align='center' ></td>";
	// 					}
	// 					else{
	// 						if($rw2[5]=='' or $rw2[5]==null){ $rw2[5]='Sin Ingresar'; 
								
	// 						}
	// 						else{
	// 						if($rw2[2]=='' or $rw2[2]==null){ $rw2[2]='Sin Ingresar'; }
	// 						if($rw2[3]=='' or $rw2[3]==null){ $rw2[3]='Sin Ingresar'; }
							
	// 						}
	// 						$ver=$LT->llenadocs3($DB, "seguimiento_user", $rw2[8], 1, 35, 'Ver');
	// 					}
	// 					$idingresouser=$rw2[8];
	// 					if($rw2[8]==''){
							
	// 						$rw2[8]='insert '.$id_p;
	// 					}else{
	// 						$rw2[8]='update '.$rw2[8];
							
	// 					}
	// 					if($rw1[2]!='No aplica'){
	// 							echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='window.open(\"validaoperacional.php?iduser=$id_p&fecha=$fecha&idvehiculo=$rw1[6]&campo=preencuesta\",\"_self\")';  title='Pre operacional' >$rw1[2]</td>";
			
	// 					}else {
	// 						echo	"<td colspan='1' width='0' align='center' >$rw1[2]</td>";
	// 					}
	// 					if($rw1[2]=='Validado' or $rw1[2]=='Validado Covid19'){
	// 						echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='window.open(\"validaoperacional.php?iduser=$id_p&fecha=$fecha&idvehiculo=$rw1[6]&campo=predatosvalidados\")';  title='Pre operacional' >$rw1[2]</td>";
			
	// 					}else {
	// 						echo	"<td colspan='1' width='0' align='center' >Sin Validar</td>";
	// 					}
			
	// 					echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16(\"$rw2[8]\",\"pruebaalcohol\",\"$param34\")';  title='Prueba de alcohol' >$rw2[0]   </td>";
	// 					echo $ver ;
	// 					echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($idingresouser,\"ingresousuario\",\"$rw1[3]\")';  title='Ingreso de Usuario' >$rw2[5]</td>";
	// 					echo "<td colspan='1' width='0' align='center' >$rw2[6]</td>";
	// 					echo "<td colspan='1' width='0' align='center' >$rw2[1]</td>";
			
			
	// 					$sql2="SELECT `idzonatrabajo`,`zon_nombre` FROM `zonatrabajo` WHERE `idzonatrabajo`='$rw2[4]'";
	// 					$DB2->Execute($sql2);
	// 					$rw3=mysqli_fetch_row($DB2->Consulta_ID);
	// 					$zona ="$rw3[1]"; 
	// 					if($zona=='' or $zona==null){ $zona='Faltante'; }
	// 					echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($idingresouser,\"zonatrabajo\",\"$rw1[3]\")';  title='Zona' >$zona</td>";
	// 					echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($idingresouser,\"horaalmuerzo\",\"$rw1[3]\")';  title='Hora almuerzo' >$rw2[2]</td>";
	// 					echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($idingresouser,\"horaretorno\",\"$rw1[3]\")';  title='Retorno almuerzo' >$rw2[3]</td>";
	// 					echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($idingresouser,\"horaoficina\",\"$rw1[3]\")';  title='Retorno Oficina' >$rw2[9]</td>";
	// 					echo "<td colspan='1' width='0' align='center'  title='Hora Salida' >$rw2[7]</td>";
					
	// 					echo $LT->llenadocs3($DB, "pre-operacional",$rw1[4], 1, 35, 'Ver');
	// 					echo $LT->llenadocs3($DB, "pre-operacional", $rw1[4], 2, 35, 'Ver');
			
	// 					echo "<td colspan='1' width='0' align='center'  title='Contrato' >$rw1[5]</td>";
	// 					$color1='';
	// 					$color2='';
			
	// 						$fechaInicial = 0;
	// 						$fechaFinal = 0;
	// 						// Las convertimos a segundos
	// 						$fechaInicialSegundos = 0;
	// 						$fechaFinalSegundos = 0;
	// 						// Hacemos las operaciones para calcular los dias entre las dos fechas y mostramos el resultado
	// 						$dias = 0;
	// 						$diasparasoat=0;
			
			
	// 						$fechaInicial11 = 0;
	// 						$fechaFinal1 = 0;
	// 						// Las convertimos a segundos
	// 						$fechaInicialSegundos1 = 0;
	// 						$fechaFinalSegundos1 = 0;
	// 						// Hacemos las operaciones para calcular los dias entre las dos fechas y mostramos el resultado
	// 						$dias1 =0;
	// 						$diasparatecno=0;
			
			
	// 					if($rw1[6]!=0){
			
	// 							$sql3="SELECT `idvehiculos`,  `veh_fechaseguro`, `veh_fechategnomecanica`, `veh_fechamantenimiento`,veh_placa,veh_kilactual,veh_aceitekil,veh_kmalcambaceite FROM `vehiculos` WHERE idvehiculos='$rw1[6]'";
	// 							$DB2->Execute($sql3);
	// 							$rw4=mysqli_fetch_row($DB2->Consulta_ID);
	// 							$kilactual=$rw4[5];
	// 							$kilparacamaceite=$rw4[6];
	// 							$kmalcambaceite=$rw4[7];
			
			
	// 						$fechaActual = date('Y-m-d');
			
	// 							$fechas=strtotime(date("d-m-Y",strtotime($rw4[1]. "- 3 days")));
	// 							$fechat=strtotime(date("d-m-Y",strtotime($rw4[2]. "- 3 days")));
	// 							$fehcacomparar=strtotime(date($fechaActual));
			
	// 								// Declaramos nuestras fechas inicial y final
	// 								$fechaInicial = date($fechaActual);
	// 								$fechaFinal = date($rw4[1]);
	// 								// Las convertimos a segundos
	// 								$fechaInicialSegundos = strtotime($fechaInicial);
	// 								$fechaFinalSegundos = strtotime($fechaFinal);
	// 								// Hacemos las operaciones para calcular los dias entre las dos fechas y mostramos el resultado
	// 								$dias = ($fechaFinalSegundos - $fechaInicialSegundos) / 86400;
	// 								$diasparasoat=round($dias, 0, PHP_ROUND_HALF_UP);
			
			
	// 								$fechaInicial1 = date($fechaActual);
	// 								$fechaFinal1 = date($rw4[2]);
	// 								// Las convertimos a segundos
	// 								$fechaInicialSegundos1 = strtotime($fechaInicial1);
	// 								$fechaFinalSegundos1 = strtotime($fechaFinal1);
	// 								// Hacemos las operaciones para calcular los dias entre las dos fechas y mostramos el resultado
	// 								$dias1 = ($fechaFinalSegundos1 - $fechaInicialSegundos1) / 86400;
	// 								$diasparatecno=round($dias1, 0, PHP_ROUND_HALF_UP);
			
	// 							//   if ($rw4[4]=="YNA73F") {
	// 							//   	echo"DIAS DE DIFERENCIA soat".$diasparasoat;
	// 									// echo"DIAS DE DIFERENCIA TCNO".$diasparatecno;  
	// 							//   }
			
	// 								$fechaInicial2 = date($fechaActual);
	// 								$fechaFinal2 = date($rw1[7]);
	// 								// Las convertimos a segundos
	// 								$fechaInicialSegundos2 = strtotime($fechaInicial2);
	// 								$fechaFinalSegundos2 = strtotime($fechaFinal2);
	// 								// Hacemos las operaciones para calcular los dias entre las dos fechas y mostramos el resultado
	// 								$dias2 = ($fechaFinalSegundos2 - $fechaInicialSegundos2) / 86400;
	// 								echo $diasparalice=round($dias2, 0, PHP_ROUND_HALF_UP);
			
			
			
	// 							if($diasparasoat<=3 or $diasparasoat<0){
	// 								$color1='#F39C12';
	// 							}
			
			
	// 							if($diasparatecno<=3 or $diasparatecno<0){
	// 								$color2='#F39C12';
	// 							}
			
	// 							echo "<td colspan='1' width='0' align='center' >$rw4[4]</td>";
	// 							echo	$LT->llenadocs4($DB2, "vehiculos", $rw1[6], 3, 35, "$rw4[1]",$color1);
	// 							echo	$LT->llenadocs4($DB2, "vehiculos", $rw1[6], 4, 35, "$rw4[2]",$color2);	
	// 					}else{
	// 							echo "<td colspan='1' width='0' align='center' ></td>";
	// 							echo "<td colspan='1' width='0' align='center' ></td>";
	// 							echo "<td colspan='1' width='0' align='center' ></td>";
	// 						}
						
			
	// 					//  $sql4="SELECT `usu_licencia`FROM `usiarios` WHERE usu_identificacions='$rw1[6]'";
	// 					// $DB2->Execute($sql4);
	// 					// $rw5=mysqli_fetch_row($DB2->Consulta_ID);
	// 					if($diasparalice<=3 or $diasparalice<0){
	// 						// $color3='#F39C12';
			
	// 						$color3="bgcolor='#F39C12'";
	// 					}else{
	// 						$color3="";
			
	// 					}
			
			
			
			
	// 					$fechacero="0000-00-00";
			
	// 					if ($rw1[7]==$fechacero) {
	// 						echo "<td colspan='1' width='0' align='center' ></td>";
	// 					}else{
			
	// 						echo "<td colspan='1' width='0' align='center' ".$color3." >".$rw1[7]."</td>";
	// 					}
			
			
			
			
			
	// 					if($rw1[6]!=0){
	// 						$kilactual=$rw4[5];
	// 						$kilparacamaceite=$rw4[6];
	// 						$kmalcambaceite=$rw4[7];
			
	// 						$faltaparacamaceite=$kilactual-$kmalcambaceite;
			
	// 						if($kmalcambaceite!=0 or $kmalcambaceite!=""){
	// 							if ($faltaparacamaceite>=$kilparacamaceite) {
	// 								echo "<td colspan='1' width='0' bgcolor='#F39C12'  align='center' >Cambie el aceite, ".$faltaparacamaceite."km exede el limite </td>";
	// 							}elseif($faltaparacamaceite<$kilparacamaceite){
	// 								echo "<td colspan='1' width='0' align='center' > ".$faltaparacamaceite."km de ".$kilparacamaceite."km para cambio aceite</td>";
	// 							}
	// 						}else{
			
	// 							echo "<td colspan='1' width='0' align='center' >-</td>";
	// 						}
	// 					}
	// 					echo "<td colspan='1' width='0' align='center' ></td>";
			
	// 					if($nivel_acceso==1 or $nivel_acceso==12){
	// 						$DB->edites($rw1[4], "pre-operacional", 2,0);
	// 					}
	// 				}
	// 		}
	// 	}


        
}




		
}



	$FB->titulo_azul1(" Totales :",1,0,10); 
	$FB->titulo_azul1(" $va",1,0,0); 

	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	/* $FB->titulo_azul1("$ $totalalcobro",1,0,0); 
	$FB->titulo_azul1("$ $totalprestamos",1,0,0);  */

include("footer.php");
?>