<?php 
require("login_autentica.php"); 
include("layout.php");
include("cabezote4.php"); 

//if($nivel_acceso==1){ $conde2="";  	 } else {  $conde2=" and idsedes='$id_sedes'"; }

?>
<script language="javascript">
function imprimirreporte(dato)
{

 	p1=document.getElementById('param1').value;
	p2=document.getElementById('param2').value;
	//p3=document.getElementById('param3').value;
	p4=document.getElementById('param4').value;
	p5=document.getElementById('param5').value;
	p6=document.getElementById('param6').value;

	if(dato==3){

		destino="reporteenvidaspdf.php?param1="+p1+"&param2="+p2+"&param4="+p4+"&param5="+p5+"&param6="+p6;
	}

	window.location=destino; 
	
}
</script>

<?php 
  if($param5!=''){ 
	$id_sedes=$param5; 
	$idcidades=ciudadesedes($param5,$DB);
	if($idcidades=='0'){
		$conde1="";

	}else {
	  $conde1=" and cli_idciudad in $idcidades "; 	
	}
} else {  

$idcidades=ciudadesedes($id_sedes,$DB);
if($idcidades=='0'){
	$conde1="";

}else {
  $conde1=" and cli_idciudad in $idcidades "; 	
}
}

if($param6!=''){ 
	
	$idcidades=ciudadesedes($param6,$DB);
	if($idcidades=='0'){
		$conde1="";

	}else {
	  $conde1.=" and ser_ciudadentrega in $idcidades "; 	
	}
}

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
$FB->titulo_azul1("Reporte de Guias Enviadas",9,0,5);  

$conde="and gui_fechaensede like '$fechaactual%'"; 

if($param4!=''){ $conde="and gui_fechaensede like '$param4%'";  $fechaactual=$param4;  }
$FB->llena_texto("Fecha de Busqueda:", 4, 10, $DB, "", "", "$fechaactual", 1, 0);
//echo "SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0  $conde2";
$FB->llena_texto("Sede Envio:",5,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "", "$id_sedes", 1, 1);
$FB->llena_texto("Sede Entrega:",6,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0  )", "", "$param6", 4, 0);
$FB->llena_texto("Busqueda por:",1,82,$DB,$busqueda1,"",$param1,1,0);
$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2", 4,0);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
echo "<tr><td><button type='button' class='btn btn-primary btn-lg' onclick='imprimirreporte(3);'>Imprimir</button></td>";
echo "</tr>";
$FB->cierra_form(); 



//$FB->titulo_azul3("Validar",2,0,2,$param_edicion);

$conde3=""; 

if($param2!="" and $param1!=""){ 
 $conde2="and $param1 like '%$param2%' "; 
  }else { $conde2="  "; } 


  $sql="SELECT `idservicios`, `ser_consecutivo`,ser_guiare,ser_piezas, `ser_destinatario`, `ciu_nombre`,`ser_direccioncontacto`, `ser_telefonocontacto`
 FROM serviciosdia inner join guias on gui_idservicio=idservicios
 where ser_estado>='7' and ser_estado!='100' $conde3 $conde1 $conde2 $conde ORDER BY gui_fechaensede $asc ";
$html= "";
$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		$html.= "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		$rw1[6]=str_replace("&"," ", $rw1[6]);
		$html.=  "
		<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		<td>".$rw1[7]."</td>
		";
		$html.=  "</tr>"; 
	}
	$FB->titulo_azul1("Total Guias: $va",9,0,5);  
	//echo "<tr><td colspan=5>Total Guias</td><td colspan=2>$va</td></tr>"; 
	$FB->titulo_azul1("Guia",1,0,7); 
	$FB->titulo_azul1("Pre-Guia",1,0,0); 
	$FB->titulo_azul1("# de Piezas",1,0,0); 
	$FB->titulo_azul1("Destinatario",1,0,0); 
	$FB->titulo_azul1("Ciudad",1,0,0); 
	$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
	$FB->titulo_azul1("T&eacute;lefono",1,0,0); 
	echo $html;
	echo "<tr><td >Total Guias</td><td>$va</td></tr>"; 


include("footer.php");
?>