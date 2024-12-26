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
$FB->titulo_azul1("Referencias Laborales",9,0,7);  
echo "</tr>";

$FB->llena_texto("Empresa:",1, 1, $DB, "", "", "", 17, 0);
$FB->llena_texto("Celular:",2, 1, $DB, "", "", "", 4, 0);
$FB->llena_texto("Fecha de inicio:", 3, 10, $DB, "", "", "", 1, 0);
$FB->llena_texto("Fecha de Terminacion:",4, 10, $DB, "", "", "", 4, 0);
$FB->llena_texto("Persona que Valido:",9, 1, $DB, "", "", "", 1, 0);
$FB->llena_texto("Nombre Referenciado:",10, 1, $DB, "", "", "", 4, 0);
$FB->llena_texto("Fecha Validacion:",11, 10, $DB, "", "", "", 1, 0);
$FB->llena_texto("Documentos:", 111, 6, $DB, "", "", "",4, 0);
echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';
echo '<input type="hidden" name="param8" id="param8" value="1">';

//echo "<tr><td><button type='submit' class='btn btn-success' formaction='newhojadevidaok.php?condecion=datosfamiliares2&idhojadevida=$idhojadevida'>Gurdar</button></td></tr>";
echo "<tr><td><button type='submit' class='btn btn-success' onclick='enviar_formulario()' >Gurdar</button></td></tr>";

$FB->titulo_azul1("Empresa",1,0,7); 
$FB->titulo_azul1("Fecha de inicio",1,0,0); 
$FB->titulo_azul1("Fecha de Terminacion:",1,0,0); 
$FB->titulo_azul1("Meses",1,0,0); 
$FB->titulo_azul1("Celular",1,0,0); 
$FB->titulo_azul1("Persona que Valido",1,0,0); 
$FB->titulo_azul1("Fecha Validacion",1,0,0); 
$FB->titulo_azul1("Nombre Referenciado",1,0,0); 
$FB->titulo_azul1("Documentos",1,0,0); 
$FB->titulo_azul1("Eliminar",1,0,0); 

$sql="SELECT `idreferenciaslaborales`, `ref_empresa`, `ref_fehcainicio`, `ref_fechaterminacion`, `ref_telefono`, `ref_userregistra`, `ref_fechaingreso`,`ref_validado`,`ref_fechavalidacion`,ref_referenciado FROM `referenciaslaborales` WHERE  ref_idhojavida=$idhojadevida";

$DB->Execute($sql); 
$va=0; 
$ano=0;
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
				$id_p=$rw1[0];
				$va++; $p=$va%2;
				if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
				echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[3]."</td>";
					

				$meses=diferenciasfechas($rw1[2],$rw1[3],'meses');
				$ano=$meses+$ano;

				echo "<td>".$meses."</td>";	
				echo "<td>".$rw1[4]."</td>";	
				echo "<td>".$rw1[7]."</td>";	
				echo "<td>".$rw1[8]."</td>";	
				echo "<td>".$rw1[9]."</td>";	
				echo $LT->llenadocs3($DB1, "referenciaslaborales",$id_p, 1, 35, 'Ver');
				$DB->edites($id_p, "referenciaslaborales", 2,"$idhojadevida");
	}
	


	$FB->titulo_azul1(" ------ ",1,0,10); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" $ano ",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 

	 $años= intval($ano/12);
	$FB->titulo_azul1(" Años ",1,0,10); 
	$FB->titulo_azul1(" De",1,0,0); 
	$FB->titulo_azul1(" Experiencia :",1,0,0); 
	$FB->titulo_azul1("  $años",1,0,0); 
?> 
</body>
</html>
