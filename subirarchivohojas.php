<!DOCTYPE html>
<html>

<head>
<script>
function enviar_formulario(imagen){
   document. getElementById("param8").value='2';
   document. getElementById("foto").value=imagen;
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
	
}

echo "</tr>";
$FB->titulo_azul1("Imagenes de Documentos",9,0,7);  
echo "</tr>";

$FB->llena_texto("CAMARA DE COMERCIO:", 101, 6, $DB, "", "", "",1, 0);
echo $LT->llenadocs3($DB1, "hojadevidacliente",$id_p, 1, 35, 'Ver Imagen');
echo "<td><button type='submit' class='btn btn-success' onclick='enviar_formulario(param101)' >Subir</button></td>";
echo "</tr>"; 
$FB->llena_texto("Rut:", 102, 6, $DB, "", "", "",1, 0);
echo $LT->llenadocs3($DB1, "hojadevidacliente",$id_p, 2, 35, 'Ver Imagen');
echo "<td><button type='submit' class='btn btn-success' onclick='enviar_formulario(param102)' >Subir</button></td>";
echo "</tr>"; 
$FB->llena_texto("Poliza:", 103, 6, $DB, "", "", "",1, 0);
echo $LT->llenadocs3($DB1, "hojadevidacliente",$id_p, 3, 35, 'Ver Imagen');
echo "<td><button type='submit' class='btn btn-success' onclick='enviar_formulario(param103)' >Subir</button></td>";
echo "</tr>"; 
$FB->llena_texto("Contrato:", 104, 6, $DB, "", "", "",1, 0);
echo $LT->llenadocs3($DB1, "hojadevidacliente",$id_p, 4, 35, 'Ver Imagen');
echo "<td><button type='submit' class='btn btn-success' onclick='enviar_formulario(param104)' >Subir</button></td>";
echo "</tr>"; 
$FB->llena_texto("Certificacion cuenta bancaria:", 105, 6, $DB, "", "", "",1, 0);
echo $LT->llenadocs3($DB1, "hojadevidacliente",$id_p, 5, 35, 'Ver Imagen');
echo "<td><button type='submit' class='btn btn-success' onclick='enviar_formulario(param105)' >Subir</button></td>";
echo "</tr>"; 
$FB->llena_texto("Cedula representante legal:", 106, 6, $DB, "", "", "",1, 0);
echo $LT->llenadocs3($DB1, "hojadevidacliente",$id_p, 6, 35, 'Ver Imagen');
echo "<td><button type='submit' class='btn btn-success' onclick='enviar_formulario(param106)' >Subir</button></td>";
echo "</tr>"; 

echo '<input type="hidden" name="param7" id="param7" value="'.$idhojadevida.'">';
echo '<input type="hidden" name="param8" id="param8" value="1">';
echo '<input type="hidden" name="param8" id="foto" value="">';

/* 
$FB->titulo_azul1("Nombre del Contacto",1,0,7); 
$FB->titulo_azul1("Telefono 1",1,0,0); 
$FB->titulo_azul1("Ext 1",1,0,0); 
$FB->titulo_azul1("Telefono 2",1,0,0); 
$FB->titulo_azul1("Ext 2",1,0,0); 
$FB->titulo_azul1("Celular ",1,0,0); 
$FB->titulo_azul1("Correo",1,0,0); 
$FB->titulo_azul1("Eliminar",1,0,0); 

$sql="SELECT `idcontactofacturacion`, `con_nombre`, `cont_telefono1`, `cont_ext1`, `cont_telefono2`, `cont_ext2`, `cont_celular`, `cont_correo`, `cont_fecharegistra` FROM `contactofacturacion` WHERE  cont_idhojavida=$idhojadevida";

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
				<td>".$rw1[6]."</td>
				<td>".$rw1[7]."</td>";		
				$DB->edites($id_p, "contactofacturacion", 2,"$idhojadevida");
	}
	


	$FB->titulo_azul1(" ------ ",1,0,10); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0);  */

?> 
</body>
</html>
