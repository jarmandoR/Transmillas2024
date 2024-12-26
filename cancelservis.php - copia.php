<?php 
require("login_autentica.php"); 
include("layout.php");

//require("imprimir.php"); 
?>
<head>
<!-- 	<script language="JavaScript" type="text/javascript" src="js/jquery-1.4.4.min"></script> 
 --><!--     <script src="js/jquery.printPage.js" type="text/javascript"></script> -->
  <script>  
/*   var version2 = jQuery.noConflict(); 
   version2(document).ready(function() {
    version2(".btnPrint").printPage();
  });   
 */
  

</script>
  

</head>
<body onload="<?php 
 switch ($tabla)
{
	case "Factura":
	echo "pop_dis4($id_param,'Factura');";
	break;
	
	default:
	
	break;
} 

?>

">

<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
$FB->titulo_azul1("Recoger Paquete",9,0,5);  
$FB->abre_form("form1","","post");
$conde3="";	

 $conde="and ser_fechaasignacion like '$fechaactual%'"; 
 
if($param4!=''){ $conde="and ser_fechaasignacion like '$param4%'";  $fechaactual=$param4;  }
$FB->llena_texto("Fecha de Busqueda:", 4, 10, $DB, "", "", "$fechaactual", 17, 0);

if($nivel_acceso==1){
	
	if($param5!=''){ $id_ciudad=$param5; }  
	$FB->llena_texto("Ciudad Origen:",5,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM ciudades where inner_estados=1 )", "cambio_ajax2(this.value, 16, \"llega_sub1\", \"param2\", 0, 0)", "$id_ciudad", 4, 0);
	$FB->llena_texto("Operario:", 2, 4, $DB, "llega_sub1", "", "",1,0);
	if($param2!=''){ $conde.="and ser_idresponsable='$param2'"; }
	
}
else if($nivel_acceso==3) {
	
	$conde3="and ser_idresponsable='$id_usuario'";	
	
}

$conde2="and cli_idciudad=$id_ciudad";

$conde4="";

$FB->llena_texto("Estado:",7,82,$DB,$estadorecogido,"","$param7",4,0);

if($param7!=''){ 
				if($param7=='Verificado'){ 
				
						$conde4="and ser_visto='1'";
						
				} elseif($param7=='Sin Verificar'){ 
				
					$conde4="and ser_visto='0'";
				
				} elseif($param7=='Sin Recoger'){ 
				
						$conde4="and ser_estado='3'";
				}
	}
$FB->llena_texto("Busqueda por:",1,82,$DB,$busqueda,"",$param1,1,0);
$FB->llena_texto("Dato:", 6, 1, $DB, "", "","$param2", 4,0);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

$FB->cierra_form(); 
$FB->titulo_azul1("Fecha Ingreso",1,0,7); 
$FB->titulo_azul1("Fecha Recogida",1,0,0); 
$FB->titulo_azul1("Cliente",1,0,0); 
$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("Destinatario",1,0,0); 
$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 

$FB->titulo_azul1("Ciudad",1,0,0); 
$FB->titulo_azul1("Servicio",1,0,0); 

if($nivel_acceso==1){
$FB->titulo_azul1("Operador",1,0,0); 	
}
$FB->titulo_azul1("Recoger Imprimir",1,0,0); 
$FB->titulo_azul1("VERIFICADO",1,0,0); 

//$FB->titulo_azul3("Validar",2,0,2,$param_edicion);

$conde1=""; 

if($param2!="" and $param1!=""){ 
 $conde1="and $param1 like '%$param6%' "; 
  }else { $conde1="  "; } 

  if($param1==""){ $param1="ser_prioridad"; } 

  $sql="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`,`cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,`ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_estado,ser_visto,usu_nombre,`ser_fechaasignacion`
 FROM serviciosdia inner join usuarios on ser_idresponsable=idusuarios   where ser_estado in (3,4) $conde $conde1 $conde2 $conde3 $conde4 ORDER BY $param1 $asc ";

$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		$rw1[4]=str_replace("&"," ", $rw1[4]);
		$rw1[7]=str_replace("&"," ", $rw1[7]);
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>".$rw1[13]."</td>
		<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>

		<td>".$rw1[8]."</td>
		<td>".$rw1[9]."</td>
		";
		if($nivel_acceso==1){
			
			echo "<td>".$rw1[12]."</td>"; 	
		}
		if($rw1[10]==3){
		echo "<td align='center' >";
		echo "<a  onclick='pop_dis3($id_p,\"Recoger Paquete\")';  style='cursor: pointer;' title='Recoger Paquete' ><img src='img/caja.png'></a></td>";
		}else if($rw1[10]==4) {		
		echo "<td align='center' >";
		echo "<a class='btnPrint' href='imprimir.php?id_param=$id_p'><img src='img/imprimir.png'></a></td>";
		}
		
		echo "<td><div id='campo$va'>"; if($rw1[11]==1){ $st="SI"; $colorfondo="#074f91"; } else { $st="NO"; $colorfondo="#941727"; } 
		echo "<select  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'  name='param14' id='param14'  onChange='cambio_ajax2(this.value, 66, \"campo$va\", \"$va\", 1, $id_p)'  required>";
			$LT->llenaselect_ar($st,$estado_rec);
		echo "</select></div></td>";
		
		
	echo "</tr>"; 
	}


include("footer.php");
?>