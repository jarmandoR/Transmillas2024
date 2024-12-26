<?php 
require("login_autentica.php"); 
include("layout.php");
 
?>
<head>

	</head>
<body onload="">

<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
//$FB->nuevo("Planillas", "$id_ciudad", "nuevo_admin.php");
$FB->titulo_azul1("Pesar Paquetes",9,0,5);  



 $conde="and ser_fechafinal like '$fechaactual%'"; 
 $conde2="";
if($param4!=''){ $conde="and ser_fechafinal like '$param4%'";  $fechaactual=$param4;  }
//$FB->llena_texto("Fecha de Busqueda:", 4, 10, $DB, "", "", "$fechaactual", 1, 0);
$conde3="";	
if($nivel_acceso==1){
	if($param5!=''){ $id_ciudad=$param5;  $conde2=" and cli_idciudad=$id_ciudad"; }   else {  $id_ciudad=""; }
$FB->llena_texto("Ciudad Origen:",5,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM ciudades where inner_estados=1 )", "", "$id_ciudad", 1, 0);
}
else {
	
	$idcidades=ciudadesedes($id_sedes,$DB);
	if($idcidades=='0'){
		$conde2.="";

	}else {
	  $conde2.=" and cli_idciudad in $idcidades "; 	
	}
}
	
if($nivel_acceso==1 or $nivel_acceso==10) {
	
	$conde3="";
	
}else{

	$conde3=" and ser_idresponsable='$id_usuario'";	
}


$FB->llena_texto("Busqueda por:",1,82,$DB,$busqueda,"",$param1,1,0);
$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2", 4,0);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

$FB->cierra_form(); 
$FB->titulo_azul1("Fecha",1,0,7); 
$FB->titulo_azul1("Remitente",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("Destinatario",1,0,0); 
$FB->titulo_azul1("Ciudad",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("Descripci&oacute;n PQ",1,0,0); 
$FB->titulo_azul1("Piezas",1,0,0); 
$FB->titulo_azul1("Mensajero",1,0,0); 
$FB->titulo_azul1("Pago	",1,0,0); 
$FB->titulo_azul1("# Guia",1,0,0); 
$FB->titulo_azul1("Guia R",1,0,0); 

$FB->titulo_azul1("Pesar",1,0,0); 
 
//$FB->titulo_azul3("Validar",2,0,2,$param_edicion);

$conde1=""; 

if($param2!="" and $param1!=""){ 
 $conde1="and $param1 like '%$param2%' "; 
  }else { $conde1="  "; } 
  
if($param1==""){ $param1="ser_prioridad"; } 

  $sql="SELECT `idservicios`,`cli_nombre`,`cli_direccion`,`ser_destinatario`,`ciu_nombre`,  `ser_direccioncontacto`, `ser_paquetedescripcion`, `ser_piezas`,`usu_nombre`,`ser_clasificacion`,`ser_consecutivo`,`ser_pendientecobrar`,cli_idciudad,ser_guiare,ser_fecharegistro
 FROM serviciosdia 
 inner join usuarios on idusuarios=ser_idresponsable  where ser_estado='4'  $conde1  $conde2 $conde3 ORDER BY ser_fecharegistro $asc ";

$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
	
		//if($rw1[9]!==1 or $rw1[11]==1){
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		$rw1[9]=$tipopago[$rw1[9]];
		$planillas=explode("/",$rw1[10]);
		$rw1[2]=str_replace("&"," ", $rw1[2]);
		$rw1[5]=str_replace("&"," ", $rw1[5]);
		echo "<td>".$rw1[14]."</td>
		<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		<td>".$rw1[7]."</td>
		<td>".$rw1[8]."</td>
		<td>".$rw1[9]."</td>
		<td>".$rw1[10]."</td>
		<td>".$rw1[13]."</td>
		";
		echo "<td align='center' >";
		echo "<a  onclick='pop_general($id_p,\"Peso\",$rw1[12])';  style='cursor: pointer;' title='Peso' ><img src='img/peso.png'></a></td>";
		

		
		
		echo "</tr>"; 
		//}
	}


include("footer.php");
?>