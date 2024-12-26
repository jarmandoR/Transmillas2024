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
$FB->titulo_azul1("Afiliaciones a seguridad social y demas",9,0,7);  
echo "</tr>";

$FB->llena_texto("Vinculado A:", 2, 82, $DB, $afiliacionsalud, "", "", 17, 0);
$FB->llena_texto("Entidad:",3, 1, $DB, "", "", "", 4, 0);
$FB->llena_texto("Fecha Afiliacion:",4, 10, $DB, "", "", "", 1, 0);
$FB->llena_texto("Tipo Documento:",5, 1, $DB, "", "", "", 4, 0);
$FB->llena_texto("Documento:", 112, 6, $DB, "", "", "",4, 0);
echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';
echo '<input type="hidden" name="param8" id="param8" value="1">';

//echo "<tr><td><button type='submit' class='btn btn-success' formaction='newhojadevidaok.php?condecion=datosfamiliares2&idhojadevida=$idhojadevida'>Gurdar</button></td></tr>";
echo "<tr><td><button type='submit' class='btn btn-success' onclick='enviar_formulario()' >Gurdar</button></td></tr>";

$FB->titulo_azul1("Vinculado A",1,0,7); 
$FB->titulo_azul1("Entidad",1,0,0); 
$FB->titulo_azul1("Fecha Afiliacion",1,0,0); 
$FB->titulo_azul1("Tipo Documento",1,0,0); 
$FB->titulo_azul1("Documento",1,0,0); 
$FB->titulo_azul1("Eliminar",1,0,0); 

 $sql="SELECT `idseguridadsocial`, `seg_nombre`,`seg_entidad`,seg_fechaentrega,`seg_tipodocumento`, `seg_idhojavida`, `seg_useringresa`, `seg_fechaingreso` FROM `seguridadsocial` WHERE seg_idhojavida=$idhojadevida";

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

				echo $LT->llenadocs3($DB1, "seguridadsocial",$id_p, 1, 35, 'Ver');
				$DB->edites($id_p, "seguridadsocial", 2,"$idhojadevida");
	}
	


	$FB->titulo_azul1(" ------ ",1,0,10); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 



?> 
</body>
</html>
