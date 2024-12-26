<?php
require("login_autentica.php"); 
include("layout.php");
 $conde="";
$conde="idsedes";

if(isset($_REQUEST["param1"])){ if($param1!=""){  $conde="idsedes"; $conde1="and idsedes='$param1'"; } } else {$param1=""; $conde1=""; }

$FB->titulo_azul1("Configuraci&oacute;n de Porcentajes Sedes",9,0,7);  
$FB->abre_form("form1","","post");

//$FB->llena_texto("Sede:",1,2,$DB,"SELECT `idciudades`, `ciu_nombre` FROM `ciudades`  where inner_estados=1","cambio1(this.value, param2.value, \"precios_creditos.php\", 1);",$param1,1,0);
$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde4)", "cambio1(this.value, 0, \"porcentaje_sedes.php\", 1);", "$param1", 1, 1);

$FB->cierra_form(); 

if($rcrear==1) { $FB->nuevo("Porcentajes Sedes", $condecion, ""); } 

$FB->titulo_azul1("Sede Origen",1,0,5); 
$FB->titulo_azul1("Sede Destino",1,0,0); 
$FB->titulo_azul1("Tipo Servicio",1,0,0); 
$FB->titulo_azul1("Tipo Pago",1,0,0); 
$FB->titulo_azul1("Estado Servicio",1,0,0); 
$FB->titulo_azul1("Kg Inicial",1,0,0); 
$FB->titulo_azul1("Kg Final",1,0,0); 
$FB->titulo_azul1("% Sedes",1,0,0); 
$FB->titulo_azul1("% Empresa",1,0,0); 
$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);

 $sql="SELECT idporcentajespaquetes,sed_nombre,tip_nom,por_tiposervicio,por_estadoservicio,por_kilosgramosmin,por_kilogramosmaximo,por_porcentaje,por_porcentajeempresa,por_idsededestino FROM `porcentajespaquetes` inner join sedes on por_idsede=idsedes left join tiposervicio on idtiposervicio=por_idpaquete where idsedes>0 $conde1 ORDER BY idsedes,por_kilosgramosmin  $asc";
$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	
	if($rw1[1]==$rw1[2]){ $valor[2]=$valor[1];  }
	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	if(is_null($rw1[2]) or $rw1[2]==''){
		$rw1[2] ='Carga via terrestre';
	}
	if(is_null($rw1[4]) or $rw1[4]==''){
		$rw1[4] ='Todos';
	}

	$sql2="SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes='$rw1[9]'";
	$DB->Execute($sql2);
	$sededes=$DB->recogedato(1); 

	echo "<td>".$rw1[1]."</td><td>".$sededes."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."Kg</td>
		<td>".$rw1[6]."Kg</td>
		<td>".$rw1[7]."%</td>
		<td>".$rw1[8]."%</td>
		";
	$DB->edites($id_p, "Porcentajes Sedes", 1, $condecion);
	echo "</tr>";
}
include("footer.php"); ?>