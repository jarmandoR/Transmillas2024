<!DOCTYPE html>
<html>

<head>
<script>
function enviar_formulario(){
	var otros=document. getElementById("param9").value;
	var otrosdos=document. getElementById("param1").value;
	
	if(otros==0 && otrosdos=='Otros Cursos'){
	/* 	var form = document.getElementById("form");
		form.onsubmit = function(e){
			alert('Por favor Ingrese Otros Cursos');
			e.preventDefault();
		} */
		alert('Por favor Ingrese Otros Cursos');

	}else{
		document. getElementById("param8").value='2';
		document.form.submit();
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
$FB->titulo_azul1("Referencias De Estudio",9,0,7);  
echo "</tr>";

$FB->llena_texto("Tipo de Estudio:", 1, 82, $DB, $nivelaca, "", "", 17, 1);
$FB->llena_texto("Otros:",9, 1, $DB, "", "", "", 4, 0);
$FB->llena_texto("Institucion:",2, 1, $DB, "", "", "", 1, 0);
$FB->llena_texto("Ciudad:",3, 1, $DB, "", "", "", 4, 0);
$FB->llena_texto("Fecha de inicio:", 4, 10, $DB, "", "", "", 1, 0);
$FB->llena_texto("Fecha de Terminacion:",5, 10, $DB, "", "", "", 4, 0);
$FB->llena_texto("Documentos:",110, 6, $DB, "", "", "",1, 0);
echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';
echo '<input type="hidden" name="param8" id="param8" value="1">';

//echo "<tr><td><button type='submit' class='btn btn-success' formaction='newhojadevidaok.php?condecion=datosfamiliares2&idhojadevida=$idhojadevida'>Gurdar</button></td></tr>";
echo "<tr><td><button type='button' class='btn btn-success' onclick='enviar_formulario()' >Gurdar</button></td></tr>";

$FB->titulo_azul1("Tipo de Estudio",1,0,7); 
$FB->titulo_azul1("Institucion",1,0,0); 
$FB->titulo_azul1("Ciudad",1,0,0); 
$FB->titulo_azul1("Fecha de inicio",1,0,0); 
$FB->titulo_azul1("Fecha de Terminacion:",1,0,0); 
$FB->titulo_azul1("Documentos",1,0,0); 
$FB->titulo_azul1("Eliminar",1,0,0); 

$sql="SELECT `idreferenciasestudio`, `ref_grado`, `ref_institucion`, `ref_ciudad`, `ref_fehcainicio`, `ref_fechaterminacion`, `ref_userregistra`, `ref_fechaingreso`, `ref_idhojavida` FROM `referenciasestudio` WHERE  ref_idhojavida=$idhojadevida";

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
				<td>".$rw1[4]."</td>
				<td>".$rw1[5]."</td>
				";		

				echo $LT->llenadocs3($DB1, "referenciasestudio",$id_p, 1, 35, 'Ver');
				$DB->edites($id_p, "referenciasestudio", 2,"$idhojadevida");
	}
	


	$FB->titulo_azul1(" ------ ",1,0,10); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 


?> 
</body>
</html>
