 <?php 
 
 $fechaactual=date("Y-m-d");
 $nivel_acceso=$_SESSION['usuario_rol'];

echo '<form action="#" method="post" enctype="multipart/form-data" name="form1" id="form1"  >';
$FB->titulo_azul1("Paquete Volumen",9,0,7);  
echo "</tr>";
$FB->llena_texto("Paquetes Volumen:",2,223,$DB,"(SELECT `idpaquetes`,`paq_nombre`,paq_precio  FROM `paquetes` order by paq_nombre )", "", "", 17, 1);
echo "</tr>";
$FB->titulo_azul1("Clientes Prestamosa Autorizados",9,0,7);  
echo "</tr>";
$FB->llena_texto("Clientes Prestamos:",3,223,$DB,"(SELECT idclientes,cli_nombre,FORMAT(cli_valoraprobado,'Currency') as cli_valoraprobado FROM `clientes` inner join clientesdir on idclientes=cli_idclientes where cli_valoraprobado>0 order by cli_nombre)", "", "", 1, 1);
$FB->titulo_azul1("SEDES DE TRABAJO",9,0,7);  
echo "</tr>";
$FB->llena_texto("SEDES:",3,223,$DB,"(SELECT `idsedes`, concat_ws(' : ', sed_nombre, sed_direccion) as sede,sed_telefono FROM `sedes` where sed_principal='si'  order by sed_nombre)", "", "", 1, 1);
if($nivel_acceso==2){

    $FB->titulo_azul1("EMPLEADOS DE RUTA",9,0,7);  
    echo "</tr>";
    $FB->llena_texto("EMPLEADOS:",3,223,$DB,"(SELECT idusuarios,concat_ws(' : ', usu_nombre,'Tel:',usu_celular) as user, veh_placa FROM `usuarios` inner join  seguimiento_user  on idusuarios=seg_idusuario inner join `pre-operacional` on idusuarios=preidusuario left join  vehiculos on idvehiculos=prevehiculo  where seg_motivo='Ingreso' and seg_fechaalcohol='$fechaactual' and prefechaingreso like '$fechaactual%' ORDER BY usu_nombre ASC) ", "", "", 1, 1);     
}elseif($nivel_acceso!=3){

    $FB->titulo_azul1("EMPLEADOS DE RUTA",9,0,7);  
    echo "</tr>";
    $FB->llena_texto("EMPLEADOS:",3,223,$DB,"(SELECT idusuarios,concat_ws(' : ', usu_nombre, usu_identificacion,'Tel:',usu_celular) as user, veh_placa FROM `usuarios` inner join  seguimiento_user  on idusuarios=seg_idusuario inner join `pre-operacional` on idusuarios=preidusuario left join  vehiculos on idvehiculos=prevehiculo  where seg_motivo='Ingreso' and seg_fechaalcohol='$fechaactual' and prefechaingreso like '$fechaactual%' ORDER BY usu_nombre ASC)", "", "", 1, 1); 
}



echo "</tr>";
$FB->titulo_azul1("Cotizar",9,0,7);  
echo "</tr>";


echo"<input  type='hidden' class='form-control'  name='nrespuestas' id='nrespuestas'  size='20' value=''>";
$FB->llena_texto("Ciudad Origen:",4,2,$DB,"(SELECT `idciudades`, `ciu_nombre` FROM `ciudades`  where inner_estados=1)", "calculoo(this.value,param11.value,param8.value, \"cotizar.php\", 1);", "$valor20", 1, 1);
$FB->llena_texto("Ciudad Destino:",11,2,$DB,"(SELECT `idciudades`, `ciu_nombre` FROM `ciudades`  where inner_estados=1 )","calculoo(param4.value,this.value ,param8.value, \"cotizar.php\", 1);","$valor21",1,1);

// $FB->llena_texto("Ciudad Origen:",4,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM `ciudades` where inner_estados=1 )", "", "$param4", 1, 1);
// $FB->llena_texto("Ciudad Destino:",11,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM `ciudades`  where inner_estados=1)", "verificar(this.value)", "$rw[11]", 1, 1);

//echo "<div id='mensaje2'></div>";
$FB->llena_texto("Valor de Prestamo:",16, 118, $DB, "", "", $rw[16],17, 0);
//$FB->llena_texto("Abono:",17, 118, $DB, "", "", $rw[17], 4, 0);
$FB->llena_texto("param17", 1, 13, $DB, "", "", "0", 5, 0); 

$sql12="SELECT seg_nombre FROM `seguro`  order by idseguro desc limit 1";
$DB1->Execute($sql12);
$porcentaje=mysqli_fetch_array($DB1->Consulta_ID);
$seguro=$porcentaje['0'];

$FB->llena_texto("Seguro:",18, 126, $DB, "", "$seguro", $seguro, 17, 0);
$FB->llena_texto("Peso KG:",26,1, $DB, "", "","$rw[24]" ,1, 1);	
$FB->llena_texto("Volumen:",27,1, $DB, "", "","$rw[26]",17, 0);
$valorapagar=0;
//$FB->llena_texto("&iquest;Credito?:",7, 212, $DB, "3", "habilitarcredito(this.value,24,\"llega_sub3\",\"total valor\",1,0)","", 1,0);	
$FB->llena_texto("&iquest;Credito?:", 28, 216, $DB, "3", "habilitarcredito(this.value,85,\"llega_sub3\",\"total valor\",1,0)", "$creditos", 1, 0);

echo "</br>";
//$FB->llena_texto("Credito:",8,2, $DB, "(SELECT `idcreditos`,`cre_nombre` FROM `creditos`)", "", "", 17, 1);
echo "<tr><td colspan=2><div id='llega_sub3' >";
$FB->llena_texto("param8", 1, 13, $DB, "", "", "0", 5, 0);
echo '</div></td></tr>';

echo"<tr><td>Tipo de servicio</td><td id='respuesta'>";

echo"</td></tr>";

echo "<tr><td><button type='button' class='btn btn-success' onclick='cotizarguia(23,\"llega_sub2\")'>Consultar</button></td></tr>";

$FB->div_valores("mensaje2",6); 
$FB->div_valores("destino_vesr",6); 

?> 
 <script>

</script>