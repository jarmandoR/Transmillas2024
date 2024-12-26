<?php 
require("login_autentica.php"); 
include("layout.php");
$FB->titulo_azul1("FACTURACION",9,0,5);  
$FB->abre_form("form1","","post");
$fecainicial=date('Y-m-01');
?>
<script language="javascript">
function llena_datos2(n1, condecion)
{
	param1=document.getElementById('param1').value;
	param2=document.getElementById('param2').value;
	destino="facturacion_excel.php?param1="+param1+"&param2="+param2;
	document.location.href=destino;
}
</script>
<?php 
//$FB->llena_texto("Busqueda por:",1,82,$DB,$busqueda2,"",$param1,1,17);
$FB->llena_texto("Fecha Inicial:", 1, 10, $DB, "", "", @$fecainicial, 1,1);
$FB->llena_texto("Fecha Final:", 2, 10, $DB, "", "", @$fechaactual, 1,1);
$FB->llena_texto("", 2, 150, $DB, "Exportar", "","llena_datos2(1,2);", 4, 0);
$FB->llena_texto("", 2, 142, $DB, "BUSCAR", "","", 4, 0);
$FB->cierra_form(); 
if($rcrear==1) { $FB->nuevo2("facturacion", "factura", "facturacion.php"); } //NUEVO



$FB->titulo_azul1("Fecha Ingreso",1,0,5); 
$FB->titulo_azul1("Nombre Del Paciente",1,0,0); 
$FB->titulo_azul1("Documento",1,0,0); 
$FB->titulo_azul1("Telefono",1,0,0); 
$FB->titulo_azul1("# Factura",1,0,0); 
$FB->titulo_azul1("Facturar",1,0,0); 
//$FB->titulo_azul1("Imprimir",1,0,0); 

$conde1=""; 


if($param1==""){ 

$cond1="";

}else {
	
$cond1="Where fac_fecha>='$param1' and  fac_fecha<='$param2'";	
}

 $sql="SELECT `idfactura`, `fac_fecha`,`fac_nombre`,`fac_iddocumento`,`fac_telefono`,`fac_cosec` FROM `facturacion` $cond1 ORDER BY  fac_fecha DESC LIMIT 100";	

$DB->Execute($sql); $va=0; 
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
		echo "<td align='center' >
				<a href='facturacion.php?id_param=$id_p'  style='cursor: pointer;' title='Factura' >
			 <img src='img/encuesta.jpg'></a></td>";

/* 		echo "<td align='center' >
				<a href='facturacionpdf.php?id_param=$id_p&condecion=0'  style='cursor: pointer;' title='Factura' >
			 <img src='img/imprimir.png'></a></td>";
		echo "</tr>"; */
	}


include("footer.php");
?>