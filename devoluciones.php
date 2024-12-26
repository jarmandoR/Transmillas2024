<?php 
require("login_autentica.php"); 
include("layout.php");
include("cabezote4.php"); 
//echo "jose: ".$param5;
if($param5!=''){ $id_sedes=$param5;  $conde2=" "; }  

?>
<script>


function imprimirguia(url)
{
	
	if(url!='' && url!=undefined){
		url='ticketfacturatodos.php?pagina2=devoluciones.php&id_param='+url;
	var a = document.createElement("a");
		a.target = "_blank";
		a.href = url;
		a.click();
	}
}
</script>
<head>

	</head>
<body onload="cambio_ajax2(<?php echo $id_sedes;?>, 16, 'llega_sub1', 'param3', 1, <?php echo $id_sedes;?>); imprimirguia(<?php echo $id_param;?>);">

<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","devoluciones.php","post");
//$FB->nuevo("Planillas", "$id_ciudad", "nuevo_admin.php");
$FB->titulo_azul1("Devoluciones ",9,0,5);  



 $conde="and ser_fechafinal like '$fechaactual%'"; 
 
if($param4!=''){ $conde="and ser_fechafinal like '$param4%'";  $fechaactual=$param4;  }
$FB->llena_texto("Fecha de Busqueda:", 4, 10, $DB, "", "", "$fechaactual", 1, 0);
$conde3="";	
$conde4="";	

if($nivel_acceso==1){
	if($param5==''){ $id_sedes=0;  $conde2=" "; } 
 $conde2.=" and  ser_estado in (4,5,6)";
}
else {
	
	$conde4.=" and idsedes='$id_sedes' ";
	
}


	$idcidades=ciudadesedes($id_sedes,$DB);
	if($idcidades=='0'){
		$conde2.="";

	}else {
		 
		//$conde2.=" and ((cli_idciudad in $idcidades and ser_estado=6) or (inner_sedes=$id_sedes and ser_estado=11)) "; 		  
		$conde2.=" and ((cli_idciudad in $idcidades and ser_estado in (4,5,6))) "; 	
	}



 if($nivel_acceso==3) {
	
$conde3="and ser_idresponsable='$id_usuario'";	
	
}
//echo "SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde4";

$FB->llena_texto("Sede:",5,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde4)", "cambio_ajax2(this.value, 16, \"llega_sub1\", \"param3\", 1, 0)", "$id_sedes", 1, 0);
$FB->llena_texto("Operario:", 3, 444, $DB, "llega_sub1", "", "",4,0);
$FB->llena_texto("Busqueda por:",1,82,$DB,$busqueda,"",$param1,1,0);
$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2", 4,0);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

$FB->cierra_form(); 
$FB->titulo_azul1("Remitente",1,0,7); 
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
$FB->titulo_azul1("Estado",1,0,0); 
$FB->titulo_azul1("Devolver",1,0,0);
//$FB->titulo_azul3("Validar",2,0,2,$param_edicion);

$conde1=""; 

if($param2!="" and $param1!=""){ 
 $conde1="and $param1 like '%$param2%' "; 
  }else { $conde1="  "; } 
  
if($param1==""){ $param1="ser_prioridad"; } 

   $sql="SELECT `idservicios`,`cli_nombre`,`cli_direccion`,`ser_destinatario`,`ciu_nombre`,  `ser_direccioncontacto`, `ser_paquetedescripcion`, `ser_piezas`,`usu_nombre`,`ser_clasificacion`,`ser_consecutivo`,`ser_pendientecobrar`,cli_idciudad,ser_estado,ser_guiare
 FROM serviciosdia 
 inner join usuarios on idusuarios=ser_idresponsable  where   ser_idverificadopeso=0  $conde1 $conde $conde2 $conde3 ORDER BY $param1 $asc ";

$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
	
		//if($rw1[9]!==1 or $rw1[11]==1){
		$estado="";
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		
		if($rw1[13]==11){ $color="#ec7878";  $estado="No Entregada"; }
		else{ $estado='Sin Pesar'; }
		
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		$rw1[9]=$tipopago[$rw1[9]];
		$planillas=explode("/",$rw1[10]);
		$rw1[2]=str_replace("&"," ", $rw1[2]);
		$rw1[5]=str_replace("&"," ", $rw1[5]);
		
		
		echo "<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		<td>".$rw1[7]."</td>
		<td>".$rw1[8]."</td>
		<td>".$rw1[9]."</td>
		<td>".$rw1[10]."</td>
		<td>".$rw1[14]."</td>
		<td>".$estado."</td>
		
		";

	
		echo "<td align='center'  data-toggle='tooltip' data-placement='top'  title='' >
		<a  onclick='pop_dis11($id_p, \"Editar Datos Guia\", \"devoluciones.php\",\"editarguiacompleta.php\",0)';  style='cursor: pointer;' title='Devolver Guia' >
		<img src='img/devolver.png'></a>"; 
		echo '</td>';
		
		echo "</tr>"; 

	}


include("footer.php");
?>