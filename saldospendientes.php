<?php 
require("login_autentica.php"); 
include("layout.php");

?>
<head>
<!-- 	<script language="JavaScript" type="text/javascript" src="js/jquery-1.4.4.min"></script> 
 --><!--     <script src="js/jquery.printPage.js" type="text/javascript"></script> -->

</head>
<body onload="">

<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
$FB->titulo_azul1("Saldos Pendientes Por Cancelar",9,0,5);  
$FB->abre_form("form1","","post");
$conde3="";	
if(isset($_REQUEST["param1"])){ 

	$idcidades=ciudadesedes($param1,$DB);
	if($idcidades=='0'){
		$conde1="";

	}else {
	  $conde1=" and cli_idciudad in $idcidades "; 	$id_sedes=$param1;
	}

}else {
 $param1=""; 

	 $idcidades=ciudadesedes($id_sedes,$DB);
	if($idcidades=='0'){
		$conde1="";

	}else {
	  $conde1=" and cli_idciudad in $idcidades "; 	
	}

}

if($nivel_acceso==1){ $conde3="";  	 } else {  $conde3=" and idsedes=$id_sedes"; }

// echo "SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde3 ";
if(isset($_REQUEST["param2"])){  if($param2!=""){ $conde1.=" and ser_idresponsable='$param2'"; } } else {$param2="";  }
$conde2="and usu_idsede=$id_sedes";
if($nivel_acceso==2 or $nivel_acceso==3){ $conde2.=" and idusuarios=$id_usuario"; $conde1.=" and ser_idresponsable='$id_usuario'"; }
$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde3 )", "cambio4(\"param2\",\"param1\",\"pendientes.php\")", "$id_sedes", 1, 1);
$FB->llena_texto("Operario:",2,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `roles_idroles` in (2,3,5) and  (usu_estado=1 or usu_filtro=1) $conde2", "", $param2, 1, 0);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

$FB->cierra_form(); 
$FB->titulo_azul1("Fecha Recogida",1,0,7); 
$FB->titulo_azul1("Guia",1,0,0); 
$FB->titulo_azul1("Cliente",1,0,0); 
$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("Valor a Pagar",1,0,0); 
if($nivel_acceso==1 or $nivel_acceso==2 or $nivel_acceso==5){
$FB->titulo_azul1("Operario",1,0,0); 
$FB->titulo_azul1("Reaccinar",1,0,0); 
}
$FB->titulo_azul1("Pagado?",1,0,0); 

//$FB->titulo_azul3("Validar",2,0,2,$param_edicion);


$sql="SELECT `idservicios`,`ser_fechaentrega`,`ser_consecutivo`,`cli_nombre`,`cli_telefono`,`cli_direccion`, `ser_valorpendiente`,`ser_valor`,`ser_pendientecobrar`,ser_estado,ser_visto,usu_nombre,inner_sedes,cli_idciudad
FROM serviciosdia inner join usuarios on ser_idresponsable=idusuarios  where ser_valorpendiente>0 and ser_pendientecobrar>=4 $conde1 ORDER BY ser_fechaentrega $asc ";

$DB->Execute($sql); $va=0; 
while($rw1=mysqli_fetch_row($DB->Consulta_ID))
{
	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	$rw1[5]=str_replace("&"," ", $rw1[5]);
	$rw1[7]=number_format($rw1[7],0,".",".");
	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	echo "<td>".$rw1[1]."</td>
	<td>".$rw1[2]."</td>
	<td>".$rw1[3]."</td>
	<td>".$rw1[4]."</td>
	<td>".$rw1[5]."</td>
	<td>$".$rw1[6]."</td>
	";
	
	if($nivel_acceso==1 or $nivel_acceso==2 or $nivel_acceso==5){
	
		$sqls1="SELECT inner_sedes FROM ciudades WHERE idciudades='$rw1[13]' ";
		$DB1->Execute($sqls1);
		$idciu=$DB1->recogedato(0);

	echo "<td>".$rw1[11]."</td>";
	echo "<td align='center' >";
	echo "<a  onclick='pop_dis24($id_p,\"Reaccionarsaldos\",$idciu)';  style='cursor: pointer;' title='Reaccionarsaldos' ><img src='img/paquete.png'></a></td>";
	}
		
	
	echo "<td><div id='campo$va'>"; if($rw1[8]>=4){ $st="NO"; $colorfondo="#074f91"; } else { $st="SI"; $colorfondo="#941727"; } 
	echo "<select  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'
	name='param14' id='param14'  onChange='cambio_ajax2(this.value, 69, \"campo$va\", \"$va\", 1, $id_p)'  required>";
		$LT->llenaselect_ar($st,$estado_rec);
	echo "</select></div></td>";
	
	
echo "</tr>"; 
}


include("footer.php");

?>