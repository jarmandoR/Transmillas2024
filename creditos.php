<?php 
require("login_autentica.php"); 
include("layout.php");
include("cabezote4.php"); 
$fechainicial=date('Y-m-01');
?>
<head>

	</head>
<body onload="<?php 
switch ($tabla)
{
	case "Factura":
	//echo "pop_dis4($id_param,'Factura');";
	break;
	
	default:
	break;
}
?>

">

<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
$FB->titulo_azul1("Creditos",9,0,5);  
$FB->abre_form("form1","","post");

if($param4!=''){  $fechainicial=$param4;}
if($param6!=''){  $fechaactual=$param6;}
	
$conde="and ser_fechaasignacion like '$fechaactual%'"; 

if($param4!=''){ $conde="and ser_fechaasignacion like '$param4%'";  $fechaactual=$param4;  }

	$FB->llena_texto("Fecha de Inicial:", 4, 10, $DB, "", "", "$fechainicial", 17, 0);
	$FB->llena_texto("Fecha de Final:", 6, 10, $DB, "", "", "$fechaactual", 4, 0);

if($nivel_acceso==1){
	if($param5!=''){   $conde2="and cli_idciudad=$id_ciudad"; }  
$FB->llena_texto("Ciudad :",5,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM ciudades where inner_estados=1 )", "", "$param5",4, 0);
 
}
else {
	
	$idcidades=ciudadesedes($id_sedes,$DB);
	if($idcidades=='0'){
		$conde2.="";

	}else {
	  $conde2.=" and cli_idciudad in $idcidades "; 	
	}
}


$FB->llena_texto("Busqueda por:",1,82,$DB,$busqueda,"",$param1,1,0);
$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2", 4,0);
$FB->llena_texto("Cliente Credito:",9, 2, $DB, "(SELECT `idclientes`,`cli_nombre` FROM `clientes` inner join clientesdir on idclientes=cli_idclientes WHERE `cli_clasificacion`=1)", "", "$param9",4,0);


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
$FB->titulo_azul1("Planilla",1,0,0); 

$FB->titulo_azul1("Datos",1,0,0); 
//$FB->titulo_azul3("Validar",2,0,2,$param_edicion);

$conde1=""; 

if($param2!="" and $param1!=""){ 
 $conde1="and $param1 like '%$param2%' "; 
  }else { $conde1="  "; } 

if($param1==""){ $param1="ser_prioridad"; } 

  

 $sql="SELECT `idservicios`,`cli_nombre`,`cli_direccion`,`ser_destinatario`,`ciu_nombre`,  `ser_direccioncontacto`, `ser_paquetedescripcion`, `ser_piezas`,`usu_nombre`,`ser_clasificacion`,`ser_consecutivo`,`ser_resolucion`
 FROM serviciosdia
 inner join usuarios on idusuarios=ser_idresponsable  where ser_estado>='6' $conde1 $conde2 $conde ORDER BY $param1 $asc ";

$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		$rw1[9]=$tipopago[$rw1[9]];
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
		
		";
		echo "<td align='center' >";
		echo "<a  onclick='pop_dis5($id_p,\"Recogidas\")';  style='cursor: pointer;' title='Recogidas' ><img src='img/recogidas.png'></a></td>";
		echo "</tr>"; 
	}


include("footer.php");
?>