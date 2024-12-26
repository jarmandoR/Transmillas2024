<?php 
require("login_autentica.php");
include("cabezote1.php"); 
include("cabezote4.php"); 
?>

<?php 

$FB->titulo_azul1("Fecha Ingreso",1,0,5); 
$FB->titulo_azul1("Nombre Del Paciente",1,0,0); 
$FB->titulo_azul1("Documento",1,0,0); 
 $FB->titulo_azul1("Telefono",1,0,0); 
$FB->titulo_azul1("Consecutivo",1,0,0);
$FB->titulo_azul1("Estado de Servicio",1,0,0); 

$conde1=""; 

if($param26!=""){ 


 $conde1="and fac_iddocumento like '%$param26%' "; 
 
  }else { $conde1="  "; } 
  
 $sql="SELECT `idfactura`, `fac_fecha`, `fac_nombre`, `fac_iddocumento`, `fac_telefono`, `fac_cosec`,ser_estado FROM
 `facturacion` inner join servicio on `idfactura`=ser_idviene 
 where ser_idexamen not in (55,56,57,78,79,80,81,82,123,151,154,155,156,157,158,159,160,161,162,165,166,167,168,169,170,171,172,173,174,175) $conde1 group by fac_cosec ORDER BY fac_fecha DESC limit 100  ";

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
		
		$cond="certificado";

		if($rw1[6]=="FACTURADO"){
		echo "<td align='center' >
				<a href='matriz.php?id_param=$id_p&condecion=0&consecutivo=".$rw1[5]."'  style='cursor: pointer;' title='matriz' >
				SIN ATENDER </a> </td>";
		} else if($rw1[6]=="TERMINADO") {
			
		echo "<td align='center' >
				<a href='matriz.php?id_param=$id_p&condecion=2&consecutivo=".$rw1[5]."'  style='cursor: pointer;' title='matriz' >
				TERMINADO </a> </td>";	
			
		}		
	//	 $DB1->editar("saludocupacional.php",$id_p, "saludocupacional", 1, "datospersonales");

		echo "</tr>";
	}


$FB->cierra_tabla(); 
			
$FB->cierra_form(); 
?>