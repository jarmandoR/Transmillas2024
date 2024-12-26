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
$FB->titulo_azul1("Cuentas",9,0,7);  
echo "</tr>";

$FB->llena_texto("Fecha de Busqueda:", 34, 10, $DB, "", "", "$fechaactual", 1, 0);
$FB->llena_texto("Sede :",35,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde2 )", "", "$param35",4, 0);
echo "<tr><td><button type='button' class='btn btn-success' onclick='cuentas(23,\"llega_sub2\")'>Consultar</button></td></tr>";

$FB->div_valores("destino_vesr",6); 
echo "<script>cuentas(23,\"llega_sub2\")</script>";
?> 

