<?php 
require("login_autentica.php"); 
include("layout.php");
include("cabezote4.php"); 
$DB2 = new DB_mssql;
$DB2->conectar();

if($param5==""){ $param5=$id_sedes;}
if($param34!=''){ $fechaactual=$param34;  }
?>
<body onLoad="
 cambio_ajax2(<?php echo $param5;?>, 16, 'llega_sub1', 'param33', 1, <?php echo $param33;?>);
">
<?php 
$FB->abre_form("form1","guiasok.php","post");
?>
<script language="javascript">
function buscarsede(dato)
{

	p1=document.getElementById('param1').value;
	p2=document.getElementById('param2').value;
	p3=document.getElementById('param33').value;
	p6=document.getElementById('param34').value;
	p5=document.getElementById('param5').value;
	p4=document.getElementById('param4').value;
	if(dato==1){
		destino="imprimirguias.php?param1="+p1+"&param2="+p2+"&param4="+p4+"&param5="+p5+"&param33="+p3+"&param34="+p6;
	
	}else if(dato==3){
		destino="ticketfacturatodos2.php?param1="+p1+"&param2="+p2+"&param4="+p4+"&param5="+p5+"&param33="+p3+"&param34="+p6;
	
	}
	else if(dato==4){
		destino="phpqrcode/ticket3.php?param1="+p1+"&param2="+p2+"&param4="+p4+"&param5="+p5+"&param33="+p3+"&param34="+p6+"&modulo=1";
	}
	else{
		destino="ticket2.php?param1="+p1+"&param2="+p2+"&param4="+p4+"&param5="+p5+"&param33="+p3+"&param34="+p6;
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

if($param4!=''){ 
	
	$idcidades=ciudadesedes($param4,$DB);
	if($idcidades=='0'){
		$conde1="";

	}else {
	  $conde1.=" and ser_ciudadentrega in $idcidades "; 	
	}
}


$conde4="and ser_fechaguia like '$fechaactual%'"; 

if($param34!=''){ $conde4="and ser_fechaguia like '$param34%'";  $fechaactual=$param34;  }

if($param2!="" and $param1!=""){ 
	$conde2="and $param1 like '%$param2%' "; 
	   }else { $conde2="  "; } 
	
if($param33!=''){ $conde3 ="and ((ser_idresponsable='$param33' and ser_fechaasignacion like '$fechaactual%') or (ser_idusuarioguia='$param33' and ser_fechaguia like '$fechaactual%' )) ";  $conde4=""; } 


$FB->titulo_azul1("Imprimir Guias ",10,0, 5);  

//$FB->llena_texto("Mensajero:",1,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `roles_idroles` in (2,3,5)", "cambio2(this.value,\"guias.php\",\"Usuario\")", $rw[1], 1, 1);
$FB->llena_texto("Fecha de Busqueda:", 34, 10, $DB, "", "", "$fechaactual", 1, 0);
$FB->llena_texto("Sede Origen:",5,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde2 )", "cambio4(\"param4\",\"param5\",\"imprimirguias.php\")", "$id_sedes", 4, 1);
$FB->llena_texto("Sede Destino:",4,2,$DB,"(SELECT  `idsedes`,`sed_nombre` FROM sedes )", "cambio4(\"param4\",\"param5\",\"imprimirguias.php\")", "$param4", 1, 1);
$FB->llena_texto("Operario:", 33, 444, $DB, "llega_sub1", "", "",4,0);
$FB->llena_texto("Busqueda por:",1,82,$DB,$busqueda1,"",$param1,17,0);
$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2",4,0);


 //$FB->llena_texto("Buscar", 1, 142, $DB, "Buscar", "onclick=form3.submit();", 0, 12, 0);
 echo "<tr><td><button type='button' class='btn btn-primary btn-lg' onclick='buscarsede(1);'>Buscar</button></td>";
 echo "<td><button type='button' class='btn btn-primary btn-lg' onclick='buscarsede(2);'>Imprimir stiker</button></td>";
 echo "<td><button type='button' class='btn btn-primary btn-lg' onclick='buscarsede(4);'>Imprimir Codigos</button></td>";
 echo "<td><button type='button' class='btn btn-primary btn-lg' onclick='buscarsede(3);' target='_blank' >Imprimir todas</button></td>";
//echo "<td><button type='submit' class='btn btn-danger btn-lg' >Enviar</button></td><td></td>";
echo "<tr>";
//$FB->llena_texto("", 3, 133, $DB, "Guardar", "onclick=form1.submit();","", 4, 0);

$FB->titulo_azul1("Imprimir",1,0,7); 
$FB->titulo_azul1("Guia",1,0,0); 
$FB->titulo_azul1("#",1,0,0); 

//$FB->titulo_azul1("Seleccione",1,0,0); 
$FB->titulo_azul1("Remitente",1,'5%',0); 

$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("Destinatario",1,'2%',0); 

$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("Ciudad",1,0,0); 
$FB->titulo_azul1("Servicio",1,0,0); 
$FB->titulo_azul1("Operarios	",1,0,0); 
$FB->titulo_azul1("Estado	",1,0,0); 

  
  //if($param33!=''){ $conde4 ="and (ser_idresponsable='$param33' and ser_fechaasignacion like '$fechaactual%') "; $conde5="";  } 

  $sql="SELECT `idservicios`,`cli_nombre`,`cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,
  `ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_estado,ser_fechaguia,ser_visto,`ser_fechaasignacion`,`ser_consecutivo`,ser_guiare,ser_idresponsable,ser_idusuarioguia,ser_visto
  FROM serviciosdia  where  ser_estado>='7'  and ser_estado!='100'  $conde1 $conde2  $conde3  $conde4  ORDER BY ser_fechafinal desc ";
 
  
 $DB->Execute($sql);
  $va=0; 
	 while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	 {
		 $estado="";
		 $id_p=$rw1[0];
		 $va++; $p=$va%2;
		 if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		 echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		 //$rw1[9]=$tipopago[$rw1[9]];
		 $rw1[3]=str_replace("&"," ", $rw1[3]);
		 $rw1[6]=str_replace("&"," ", $rw1[6]);
		 echo "<td align='center' >";
		 //echo "<a class='btnPrint' href='imprimir.php?id_param=$id_p&condicion=2'><img src='img/imprimir.png'></a>";
		 echo "<a href='ticketfacturatodos.php?id_param=$id_p' target='_blank'><img src='img/imprimir.png'></a></td>";
		 //echo "<td></td>";
		 echo "<td>".$rw1[13]."</td>
		 <td>".$rw1[14]."</td>

		 <td>".$rw1[1]."</td>
		 
		 <td>".$rw1[3]."</td>
		 <td>".$rw1[4]."</td>
		 
		 <td>".$rw1[6]."</td>
		 <td>".$rw1[7]."</td>
		 <td>".$rw1[8]."</td>";
		 $operario ="";
		 $nompromotor =" ";
		 
		 if($rw1[16]==$rw1[15]){
			 
			 $estado.="Encomiendas / Recogidas";
			 $sql2="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$rw1[16]' and  (usu_estado=1 or usu_filtro=1) ";
			 $DB2->Execute($sql2);
			 $rw2=mysqli_fetch_row($DB2->Consulta_ID);
			 $operario ="$rw2[1]"; 
 
		 }else if($rw1[16]!='0'){
			 
			 $estado.="Encomiendas ";
			 $sql2="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$rw1[16]' and  (usu_estado=1 or usu_filtro=1)";
			 $DB2->Execute($sql2);
			  $rw2=mysqli_fetch_row($DB2->Consulta_ID);
			  $operario ="$rw2[1]";
 
		 }else if($rw1[15]!='0'){
			 
			 $estado.="Recogidas ";
			  $sql2="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$rw1[15]' and  (usu_estado=1 or usu_filtro=1)";
			 $DB2->Execute($sql2);
			 $rw2=mysqli_fetch_row($DB2->Consulta_ID);
			 $operario ="$rw2[1]"; 
		 }
		 
		 $visto="";
		 $proceso =" ";
		 
		
				 
   echo "<td>".$operario."</td><td>".$estado."</td>";

	echo "</tr>"; 
	 }
 
echo  "<tr><td >Total Guias</td><td>$va</td></tr>";
 
echo "<input name='registros' id='registros' type='hidden'  value='$va'>";
$FB->llena_texto("tipoguia", 1, 13, $DB, "", "","sedes", 5, 0);
include("footer.php");
?>