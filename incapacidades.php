<!DOCTYPE html>
<html>

<head>
<script>
function enviar_formulario(){
   document. getElementById("param8").value='2';
   document.form1.submit()
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
$FB->titulo_azul1("Incapacidades",9,0,7);  
echo "</tr>";

$FB->llena_texto("Fecha de inicio:",1, 10, $DB, "", "", "", 1, 0);
$FB->llena_texto("Fecha de Terminacion:",2, 10, $DB, "", "", "", 4, 0);
$FB->llena_texto("Dias:",3, 1, $DB, "", "", "", 17, 0);
$FB->llena_texto("Tipo Incapacidad:", 4, 82, $DB, $tipoincapacidad, "", "", 4, 0);
$FB->llena_texto("Foto:", 5, 6, $DB, "", "", "",4, 0);


echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';
echo '<input type="hidden" name="param8" id="param8" value="1">';

//echo "<tr><td><button type='submit' class='btn btn-success' formaction='newhojadevidaok.php?condecion=datosfamiliares2&idhojadevida=$idhojadevida'>Gurdar</button></td></tr>";
echo "<tr><td><button type='submit' class='btn btn-success' onclick='enviar_formulario()' >Gurdar</button></td></tr>";

$FB->titulo_azul1("Fecha de inicio",1,0,7); 
$FB->titulo_azul1("Fecha de Terminacion:",1,0,0); 
$FB->titulo_azul1("Dias",1,0,0); 
$FB->titulo_azul1("Tipo Incapacidad",1,0,0); 
$FB->titulo_azul1("Foto",1,0,0); 
$FB->titulo_azul1("Registrar Pago",1,0,0); 
$FB->titulo_azul1("Fecha de Pago",1,0,0); 
$FB->titulo_azul1("Documento de Pago",1,0,0); 

$FB->titulo_azul1("Valor Pagado",1,0,0); 
$FB->titulo_azul1("Valido Pago",1,0,0); 
$FB->titulo_azul1("Fecha Validacion",1,0,0); 
$FB->titulo_azul1("Eliminar",1,0,0); 

$sql="SELECT `idincapacidades`, `ref_fehcainicio`, `ref_fechaterminacion`, `ref_dias`, `ref_tipodeincapacidad`, `ref_userregistra`, `ref_fechaingreso`, `ref_idhojavida`, `ref_fechapagoincapacidad`, `ref_valorpagado`, `ref_validadopago`, `ref_fechavalidacion` FROM `incapacidades` WHERE ref_idhojavida=$idhojadevida";

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
				echo "<td>".$rw1[3]."</td>";		
				echo "<td>".$rw1[4]."</td>";	
				echo $LT->llenadocs3($DB1, "Incapacidades",$id_p, 1, 35, 'Ver');
				echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis17($rw1[0],\"RegistrarPago\",\"$idhojadevida\")';  title='Registrar Pago' >Registrar Pago</td>";
					
				echo "<td>".$rw1[8]."</td>";
				echo $LT->llenadocs3($DB1, "RegistrarPago",$id_p, 1, 35, 'Ver');		
				echo "<td>".$rw1[9]."</td>";		
				echo "<td>".$rw1[10]."</td>";		
				echo "<td>".$rw1[11]."</td>";		

				$DB->edites($id_p, "Incapacidades", 2,"$idhojadevida");
	}
	


	$FB->titulo_azul1(" ------ ",1,0,10); 
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



?> 
</body>
</html>
