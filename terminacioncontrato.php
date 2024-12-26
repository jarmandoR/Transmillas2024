<!DOCTYPE html>
<html>

<head>
<script>
function enviar_formulario(){
   document. getElementById("param8").value='2';
   document.form1.submit()
}

$(function () {
    $(document).on('change', '.borrar', function (event) {
		
		var valor = $(this).val();
		
		if(valor!='0'){
		var descripcion=document.getElementById("des_"+$(this).attr('name')).value;
		var idservicio=document.getElementById("servicio_"+$(this).attr('name')).value;

		event.preventDefault();
		//$(this).closest('tr').remove();
		//$(this).style.backgroundColor="#008000";
		console.log(valor);
      	datos = {"tipoguia":"elementos","servicio":idservicio,"descripcion":descripcion,"llego":valor};
		$.ajax({
				url: "guiasok.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){
				
			});
		}

		
    });
});
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
$FB->titulo_azul1("Referencias Laborales",9,0,7);  
echo "</tr>";
if ($nivel_acceso==1) {
	$FB->llena_texto("Fecha Terminacion:",1, 10, $DB, "", "", "$rw[31]", 1, 0);
}else {
$FB->llena_texto("Fecha Terminacion:",1, 10, $DB, "", "", "$rw[31]", 1, 1);

}

$FB->llena_texto("Entrega Puesto:",2, 1, $DB, "", "", "$rw[32]", 4, 0);
$FB->llena_texto("Paz y Salvo Pagos?:",3, 1, $DB, "", "", "$rw[33]", 1, 0);
$FB->llena_texto("Foto Paz y Salvo:", 111, 6, $DB, "", "", "",4, 0);

$sql0="SELECT hoj_retiroEps, hoj_liquidacion, hoj_retiroarl,hoj_retiroarl  FROM `hojadevida` where idhojadevida='$idhojadevida'";		
$DB1->Execute($sql0);
$rw0=mysqli_fetch_row($DB1->Consulta_ID);

if ($rw0[0]!="") {
	$eps="<a href='imgHojasDeVida/$rw0[0]' target='_blank'>Ver Foto</a>";
}

if ($rw0[1]!="") {
	
	$liquidacion="<a href='imgHojasDeVida/$rw0[1]' target='_blank'>Ver Foto</a>";
}
if ($rw0[2]!="") {
	
	$arl="<a href='imgHojasDeVida/$rw0[2]' target='_blank'>Ver Foto</a>";
}

$FB->llena_texto("Estado:",4,82,$DB,$estadosac,"",$rw[34],1,0);
echo "<td>Foto Paz y Salvo</td>".$LT->llenadocs3($DB1, "hojadevida",$id_p, 11, 35, 'Ver')."</tr>";


$FB->llena_texto("Foto retiro EPS:", 12, 6, $DB, "", "", "",4, 0);
echo "<td></td><td> $eps</td></tr>";

$FB->llena_texto("Foto retiro ARL:", 14, 6, $DB, "", "", "",4, 0);
echo "<td></td><td> $arl</td></tr>";

$FB->llena_texto("Foto liquidacion:", 13, 6, $DB, "", "", "",4, 0);
echo "<td></td><td>$liquidacion</td></tr>";

echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';
echo '<input type="hidden" name="param8" id="param8" value="1">';

//echo "<tr><td><button type='submit' class='btn btn-success' formaction='newhojadevidaok.php?condecion=datosfamiliares2&idhojadevida=$idhojadevida'>Gurdar</button></td></tr>";
//echo "<tr><td><button type='submit' class='btn btn-success' onclick='enviar_formulario()' >Gurdar</button></td></tr>";

$FB->titulo_azul1("Elemento",1,0,7); 
$FB->titulo_azul1("Serie",1,0,0); 
$FB->titulo_azul1("Foto",1,0,0); 
$FB->titulo_azul1("Descripcion",1,0,0); 
$FB->titulo_azul1("Validar",1,0,0); 

$sql="SELECT `idelementostrabajo`, `ele_nombre`,`ele_serie`, `ele_idhojavida`, `ele_useringresa`, `ele_fechaingreso`,ele_etregadescripcion,ele_entregado,ele_userverifico FROM `elementostrabajo` WHERE ele_idhojavida=$idhojadevida";

$DB->Execute($sql); 
$va=0; 

	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
				$id_p=$rw1[0];
				$va++; $p=$va%2;
				if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
				echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[1]."</td>";		
				echo "<td>".$rw1[2]."</td>";		

				echo $LT->llenadocs3($DB1, "elementostrabajo",$id_p, 1, 35, 'Ver');
				$descrip="des_$va";
		//$FB->llena_texto("Descripcion:",$descrip,9, $DB, "", "",@$rw[1] ,1, 0);	
		echo "<td><textarea name='des_$va' id='des_$va' value='' style='width:195px; class='text' >$rw1[6]</textarea></td>";
	
		echo "<td><div id='campo$va'>";
		echo "<select  style='width:120px;border:1px solid #f9f9f9;background-color:#074f91;color:#f9f9f9;font-size:15px'  name='$va' id='$va'   class='borrar' required>";
		$LT->llenaselect_ar22($rw1[7],$estadoselemento);
		echo "</select></div><input name='servicio_$va' id='servicio_$va' type='hidden'  value='$rw1[0]'></td>";
	}
	


	$FB->titulo_azul1(" ------ ",1,0,10); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 



?> 
</body>
</html>
