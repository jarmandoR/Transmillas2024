<!DOCTYPE html>
<html>

<head>
<script>


function enviar_formulario(id){

	if(param1.value=='' || param2.value=='' || param2.value=='0' ){
		alert('Ingrese la fecha y Vehiculo');
	}else{
	
	//	destino="detalle_entregavehiculo.php?condecion=entregadevehiculo"+"&idhojadevida="+id+"&param1="+param1.value+"&param2="+param2.value;
		//MostrarConsulta4(destino, "entregavehiculos");

		datos = {"condecion":"entregadevehiculo","idhojadevida":id,"param1":param1.value,"param2":param2.value};
		$.ajax({
				url: "detalle_entregavehiculo.php",
				type: "POST",
				data: datos,
				async: false,
				success: function(result) {
					//$('#entregavehiculos').load();	
					document.getElementById("entregavehiculos").innerHTML +=result;
				}
			}); 
			
	}


	
}
</script>
</head>
<body>

 <?php 

 $fechaactual=date("Y-m-d");
 $nivel_acceso=$_SESSION['usuario_rol'];
 $id_sedes=$_SESSION['usu_idsede'];

 if($nivel_acceso==1){
	if($param35!=''){   $conde2=""; }  

}
else {	
	$param35=$id_sedes;
	  $conde2.=" and idsedes='$id_sedes' "; 	
	
}

echo "</tr>";
$FB->titulo_azul1("Registrar Entrega de Vehiculo",9,0,7);  
echo "</tr>";


$FB->llena_texto("Fecha de Entrega de Vehiculo:", 1, 10, $DB, "", "", "", 1, 0);
$FB->llena_texto("Vehiculo:",2,2,$DB,"(SELECT concat_ws(' ',`veh_tipo`,' ',`veh_placa`,' ',`veh_marca`,' ',`veh_modelo`) as id_vehiculo, concat_ws(' ',`veh_tipo`,' ',`veh_placa`,' ',`veh_marca`,' ',`veh_modelo`) as vehiculo FROM vehiculos where veh_estado=1)", "", "", 4, 0);

echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';
echo '<input type="hidden" name="param8" id="param8" value="1">';

//echo "<tr><td><button type='submit' class='btn btn-success' formaction='newhojadevidaok.php?condecion=datosfamiliares2&idhojadevida=$idhojadevida'>Gurdar</button></td></tr>";
echo "<td><button type='button' class='btn btn-success' onclick='enviar_formulario(".$idhojadevida.")' >Agregar</button></td></tr>";

echo "<tr><td colspan='5'><div id='vehiculos'>";

echo '<table  id="entregavehiculos" class="table table-hover"><tr bgcolor="#074F91" class="tittle3">';
$FB->titulo_azul1("Fecha de Entrega de Vehiculo",1,0,0); 
$FB->titulo_azul1("Vehiculo",1,0,0);  
$FB->titulo_azul1("Usuario Registro",1,0,0);  
$FB->titulo_azul1("Fecha Registro",1,0,0); 
 
if($nivel_acceso==1 or $nivel_acceso==12){
	$FB->titulo_azul1("Eliminar",1,0,0); 
}

$sql="SELECT `identregavehiculo`, `ent_fechaentrega`, `ent_vehiculo`, `ent_userregistra`, `ent_idhojadevida`, `ent_fecharegistra` FROM `entregavehiculo` WHERE  ent_idhojadevida=$idhojadevida";

$DB->Execute($sql); 
$va=0; 

	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
				$id_p=$rw1[0];
				$va++; $p=$va%2;
				if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
				echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>		
				<td>".$rw1[5]."</td>";		

				//echo $LT->llenadocs3($DB1, "entregavehiculo",$id_p, 1, 35, 'Ver');
			if($nivel_acceso==1 or $nivel_acceso==12){
				$DB->edites($id_p, "entregavehiculo", 2,"$idhojadevida");
			}else{
				//$DB->edites($id_p, "entregavehiculo", 2,"$idhojadevida");

			}
	}
	

	echo "</table><table class='table table-hover'>";
	$FB->titulo_azul1(" ------ ",1,0,10); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 

	echo "</div></td></tr>";

?> 
</body>
</html>
