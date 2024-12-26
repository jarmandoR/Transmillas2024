<!DOCTYPE html>
<html>

<head>
<script>
/* function enviar_formulario1(id){
  
	var inputFile = document.getElementById("param82");
	let formData = new FormData();
        formData.append("param82", inputFile.files[0]);
  
	if(param80.value=='' || param81.value=='' || param81.value=='0' ){
		alert('Ingrese la fecha de revision y el Vehiculo');
	}else{
	
		destino="detalle_entregavehiculo.php?condecion=tecnopreventiva"+"&idhojadevida="+id+"&param80="+param80.value+"&param81="+param81.value+"&param82="+archivo;
		MostrarConsulta4(destino, "tecnopreventa");
	
	}

} */

function enviar_formulario1(id){

	var formData = new FormData();
        
		var inputFile = document.getElementById("param82");
        formData.append('param82',inputFile.files[0]);
        formData.append('condecion','tecnopreventiva');
        formData.append('idhojadevida',id);
        formData.append('param80',param80.value);
        formData.append('param81',param81.value);
        formData.append('param11',param11.value);
        formData.append('param12',param12.value);
        formData.append('param13',param13.value);

		$.ajax({
				url: "detalle_entregavehiculo.php",
				type: "POST",
				data: formData,
				contentType: false,
          	    processData: false,
				success: function(result) {
					console.log(result); 
					document.getElementById("preventiva").innerHTML +=result;
				}
			}); 

}
</script>
</head>
<body>

 <?php 

 $fechaactual=date("Y-m-d");
 $nivel_acceso=$_SESSION['usuario_rol'];
 $id_sedes=$_SESSION['usu_idsede'];

  $param80=$_POST["param80"];
 $param81=$_POST["param81"];
 $param82=$_POST["param82"];

    
$sql2="SELECT  `hoj_cedula` FROM `hojadevida` WHERE idhojadevida='$idhojadevida'";		
	$DB->Execute($sql2);
	
$identificacion=$DB->recogedato(0);

$FB->titulo_azul1("Registrar Revision ",9,0,7);  


$FB->llena_texto("Fecha de Revision :", 80, 10, $DB, "", "", "", 1, 0);
$FB->llena_texto("Vehiculo:",81,2,$DB,"(SELECT concat_ws(' ',`veh_tipo`,' ',`veh_placa`,' ',`veh_marca`,' ',`veh_modelo`) as id_vehiculo, concat_ws(' ',`veh_tipo`,' ',`veh_placa`,' ',`veh_marca`,' ',`veh_modelo`) as vehiculo FROM vehiculos where veh_estado=1)", "", "", 4, 0);
		// $FB->llena_texto("Nombre:", 8, 1, $DB, $tiporeclamo, "", "", 2, 1);
		// $FB->llena_texto("Valor:", 9, 1, $DB, $tiporeclamo, "", "", 2, 1);
		
		$FB->llena_texto("Foto", 82, 6, $DB, "", "", "",1,0);

		echo '<input type="hidden" name="param11" id="param11" value="'.$id_nombre.'">';
        echo '<input type="hidden" name="param12" id="param12" value="'.$fechaactual.'">';
        echo '<input type="hidden" name="param13" id="param13" value="'.$identificacion.'">';

	echo "<td><button type='button' class='btn btn-success' onclick='enviar_formulario1(".$idhojadevida.")' >Agregar</button></td></tr>";

echo "<tr><td colspan='5'><div id='tecnopreventa'>";

echo '<table  id="preventiva" class="table table-hover"><tr bgcolor="#074F91" class="tittle3">';
$FB->titulo_azul1("Fecha",1,0,0);  
$FB->titulo_azul1("Vehiculo",1,0,0);  
$FB->titulo_azul1("Usuario Registro",1,0,0);  
$FB->titulo_azul1("Fecha Registro",1,0,0); 
$FB->titulo_azul1("Foto",1,0,0); 


if($nivel_acceso==1 or $nivel_acceso==12){
	$FB->titulo_azul1("Eliminar",1,0,0); 
}

$sql="SELECT `idrevisionvehiculo`,`rev_fecha`,`rev_idvehiculo`,`rev_usuregistra`,`rev_usuvehiculo`, `rev_ingreso`, `rev_foto`FROM `revisionvehiculo` WHERE  rev_usuvehiculo=$idhojadevida";

$DB->Execute($sql); 
$va=0; 

	while($rw2=mysqli_fetch_row($DB->Consulta_ID))
	{
				$id_p=$rw2[0];
				$va++; $p=$va%2;
				if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
				echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw2[1]."</td>
				<td>".$rw2[2]."</td>
				<td>".$rw2[3]."</td>		
				<td>".$rw2[5]."</td>	
				<td><a href='imagenrevision/".$rw2[6]."' target='_blank'><img src='imagenrevision/".$rw2[6]."' width='20'>ver</a></td>";

				
	
				
				
			if($nivel_acceso==1 or $nivel_acceso==12){
				$DB->edites($id_p, "revisionvehiculo", 2,"$idhojadevida");
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
	$FB->titulo_azul1(" ------",1,0,0); 

	echo "</div></td></tr>";

?> 
</body>
</html>