<?php 
require("login_autentica.php"); 
include("layout.php");
if($param2=='') { $param2=0;  }
?>
<head>

</head>
<body>

<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
$FB->titulo_azul1(" Imprimir Recogidas/Encomiendas",1,0,5);  

$conde3="";	
$conde3="and ((ser_idresponsable='$id_usuario' and ser_fechaasignacion like '$fechaactual%'  and ser_estado=4) or ( ser_idusuarioguia='$id_usuario' and ser_fechaguia like '$fechaactual%' and ser_estado=10))";	


$conde1=""; 

$sql="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`,`cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,
 `ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_estado,ser_visto,usu_nombre,`ser_fechaasignacion`,`ser_consecutivo`
 FROM serviciosdia inner join usuarios on ser_idresponsable=idusuarios   
 where ser_estado!=100 $conde3  ORDER BY ser_fechaentrega $asc ";

$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		$rw1[4]=str_replace("&"," ", $rw1[4]);
		$rw1[7]=str_replace("&"," ", $rw1[7]);
		echo "<tr style='font-size:12px;text-align:left;' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>";
		
		echo "<div class='alert alert-success'>";
		if($rw1[10]==4){
		echo "<h4><span class='label label-warning'> $rw1[9]</span></h4>";

		
	//	echo "FECHA: $rw1[13]<br>";
		echo "<p  align='left'>RECOGIDA: $rw1[1]<br>";
		echo "CLIENTE: $rw1[2]<br>";
		echo "TELÉFONO: *********<br>";
		echo "GUIA: $rw1[14]<br></p>";
	
	echo "<div class='alert alert-info'>DIRECCIÓN: $rw1[4]</div>";
		echo "<p  align='left'>DESTINATARIO: $rw1[5]<br>";
		//echo "TELÉFONO: $rw1[6]<br>";
		echo "CIUDAD: $rw1[8]<br></p>";
	
		
	
			echo "<a href='ticketfactura1.php?id_param=$id_p&pagina2=imprimirasignar.php' ><img src='img/imprimir.png'></a>";
			echo "<a  onclick='pop_dis13($id_p,\"Recoger Paquete\",1)';  style='cursor: pointer;' class='btn btn-primary btn-lg' title='Recoger Paquete' role='button' >Recoger</a>";
		}else  if($rw1[10]==10){
			
				echo "<h4><span class='label label-warning'>ENCOMIENDA</span></h4>";
				echo "<div class='alert alert-info'>DIRECCIÓN: $rw1[4]</div>";
				echo "<p  align='left'>DESTINATARIO: $rw1[5]<br>";
				echo "TELÉFONO: *********<br>";
				echo "CIUDAD: $rw1[8]<br>";
				echo "GUIA: $rw1[14]<br></p>";
				echo "<a href='ticketfactura1.php?id_param=$id_p&pagina2=imprimirasignar.php' ><img src='img/imprimir.png'></a>";		
				echo "<a  onclick='pop_dis13($id_p,\"Entregar Guias\")';  style='cursor: pointer;' class='btn btn-primary btn-lg' title='Entregar Guias' role='button' >Entregar</a>";
							
		}
		echo "</p></div></td>";
		
		
	echo "</tr>"; 
	}


include("footer.php");
?>