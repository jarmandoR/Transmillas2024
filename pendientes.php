<?php 
require("login_autentica.php"); 
include("layout.php");
$fechainicial=date('Y-m-01');
//require("imprimir.php"); 
?>
<head>
<!-- 	<script language="JavaScript" type="text/javascript" src="js/jquery-1.4.4.min"></script> 
 --><!--     <script src="js/jquery.printPage.js" type="text/javascript"></script> -->
  <script>  
/*   var version2 = jQuery.noConflict(); 
   version2(document).ready(function() {
    version2(".btnPrint").printPage();
  });   */ 
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
$FB->titulo_azul1("Pendientes X Cobrar",9,0,5);  
$FB->abre_form("form1","","post");

if($param1!='' and $param1!='0'){  

	$conde1=" and inner_sedes='$param1'";  $id_sedes=$param1; 
 }


 if(isset($_REQUEST["param33"])){ 
	$fechainicial=$_REQUEST["param33"];
 }
 
 if(isset($_REQUEST["param34"])){ 
	$fechaactual=$_REQUEST["param34"];
 }
 
if(isset($_REQUEST["param2"])){  if($param2!=""){ $conde1.=" and cue_idoperpendiente='$param2'"; } } else {$param2="";  }
$conde2="and usu_idsede=$id_sedes";
$FB->llena_texto("Fecha de inicio:", 33, 10, $DB, "", "", "$fechainicial", 17, 0);
$FB->llena_texto("Fecha de Final:", 34, 10, $DB, "", "", "$fechaactual", 4, 0);
if($nivel_acceso==2 or $nivel_acceso==3){ $conde2.=" and idusuarios=$id_usuario"; $conde1.=" and cue_idoperpendiente='$id_usuario'"; }
if(($nivel_acceso==1 or $nivel_acceso==10) and ($param1==0 or $param1=='')){ $id_sedes=0;  $conde3="";  }
else{  $conde3=" and  date(cue_fecharecogida) >= '$param33' and  date(cue_fecharecogida) <= '$param34'";  }
$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "cambio4(\"param2\",\"param1\",\"pendientes.php\")", "$id_sedes", 1, 0);
$FB->llena_texto("Operario:",2,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `roles_idroles` in (2,3,5) and  (usu_estado=1 or usu_filtro=1) $conde2", "", $param2, 4, 0);
//echo "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `roles_idroles` in (2,3,5) $conde2";
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);


$FB->cierra_form(); 
$FB->titulo_azul1("Fecha Recogida",1,0,7); 
$FB->titulo_azul1("Guia",1,0,0); 
$FB->titulo_azul1("Guia Relacionada",1,0,0); 
$FB->titulo_azul1("Cliente",1,0,0); 
$FB->titulo_azul1("Tel&eacute;fono",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("Peso Kg",1,0,0); 
$FB->titulo_azul1("Valor a Cobrar",1,0,0); 


$FB->titulo_azul1("Operario",1,0,0); 	
$FB->titulo_azul1("Asignar Origen",1,0,0); 
$FB->titulo_azul1("Asignar Destino",1,0,0); 


$FB->titulo_azul1("Imprimir",1,0,0); 
$FB->titulo_azul1("Pagado?",1,0,0); 

//$FB->titulo_azul3("Validar",2,0,2,$param_edicion);
if($param34==""){ $param34=$fechaactual; } 
if($param33==""){ $param33=$fechainicial; } 

 $sql="SELECT `idservicios`,`cue_fecharecogida`,`ser_consecutivo`,`cli_nombre`,`cli_telefono`,`cli_direccion`, `ser_peso`,`ser_valor`,`ser_pendientecobrar`,ser_estado,ser_visto,usu_nombre,cli_idciudad,ser_guiare,cue_idoperpendiente,ser_ciudadentrega
 FROM `clientes` inner join clientesservicios on cli_idclientes=idclientes  
 inner join rel_sercli on idclientesdir=ser_idclientes 
 inner join servicios on  ser_idservicio=idservicios
 inner join ciudades on cli_idciudad=idciudades 
 inner join cuentaspromotor on cue_idservicio=idservicios 
 left join usuarios on cue_idoperpendiente=idusuarios 
  where  ser_pendientecobrar=1 and ser_estado!=100 
  $conde3 $conde1 ORDER BY ser_fechaentrega $asc ";

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
		<td>".$rw1[13]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		<td>$".$rw1[7]."</td>

		";
		//if($nivel_acceso==1 or $nivel_acceso==2 or $nivel_acceso==5){
		echo "<td>".$rw1[11]."</td>";	
		echo "<td align='center' >";
		echo "<a  onclick='pop_dis24($id_p,\"Reaccionar\",$rw1[12])';  style='cursor: pointer;' title='Reaccionar' ><img src='img/paquete.png'></a></td>";
		//}
		echo "<td align='center' >";
		echo "<a  onclick='pop_dis24($id_p,\"Reaccionar\",$rw1[15])';  style='cursor: pointer;' title='Reaccionar' ><img src='img/paquete.png'></a></td>";
			
		echo "<td align='center' >";
	//	echo "<a class='btnPrint' href='imprimir.php?id_param=$id_p'><img src='img/imprimir.png'></a></td>";
		echo "<a href='ticketfactura.php?id_param=$id_p&pagina2=pendientes.php' target='_blank'><img src='img/imprimir.png'></a></td>";	

		
		echo "<td>";

		/* <div id='campo$va'>"; if($rw1[8]==1){ $st="NO"; $colorfondo="#074f91"; } else { $st="SI"; $colorfondo="#941727"; } 
		echo "<select  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'
		name='param14' id='param14'  onChange='cambio_ajax2(this.value, 68, \"campo$va\", \"$va\", 1, $id_p)'  required>";
			$LT->llenaselect_ar($st,$estado_pen); 
		echo "</select></div>*/
		echo "<a  onclick='pop_dis13($id_p,\"Entregar Guias\",1)';  style='cursor: pointer;' class='btn btn-primary btn-lg' title='Cobrar Guias' role='button' >Cobrar</a>";

		echo "</td>";
		
		
	echo "</tr>"; 
	}


include("footer.php");
?>