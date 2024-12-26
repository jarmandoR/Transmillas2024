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
$FB->titulo_azul1(" Pesar Recogidas/Encomiendas",1,0,5);  

$conde3="";	
$conde3="and ser_idresponsable='$id_usuario'";	
$fechainicial=date("Y-m-d",strtotime($fechaactual."- 1 days")); 
$conde1=""; 
$conde2="and  ser_fechafinal>='$fechainicial' ";

     $sql="SELECT `idservicios`,`cli_nombre`,`cli_direccion`,`ser_destinatario`,`ciu_nombre`,  `ser_direccioncontacto`, `ser_paquetedescripcion`, `ser_piezas`,`usu_nombre`,`ser_clasificacion`,`ser_consecutivo`,`ser_pendientecobrar`,cli_idciudad
 FROM serviciosdia 
 inner join usuarios on idusuarios=ser_idresponsable  where ser_estado='4' $conde2  $conde3 ORDER BY ser_fechafinal DESC ";

$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		@$rw1[9]=$tipopago[$rw1[9]];
		$planillas=explode("/",$rw1[10]);
		$rw1[2]=str_replace("&"," ", $rw1[2]);
		$rw1[5]=str_replace("&"," ", $rw1[5]);
		echo "<tr style='font-size:12px;text-align:left;' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>";
		echo "<div class='alert alert-success'>";
		echo "<h4><span class='label label-warning'># GUIA $rw1[10]</span></h4>";

		echo "<p  align='left'>REMITENTE: $rw1[1]<br>";
		echo "DIRECCIÓN: $rw1[2]<br>";
		echo "DESTINATARIO: $rw1[3]<br>";
		echo "CIUDAD: $rw1[4]<br>";
		echo "DIRECCIÓN DES: $rw1[5]<br>";
		echo "DESCRIPCIÓN: $rw1[6]<br>";
		echo "PIEZAS: $rw1[7]<br>";
		echo "PAGO: $rw1[9]<br>";
			
			echo "<a  onclick='pop_general($id_p,\"Peso\",$rw1[12])';  style='cursor: pointer;' title='Peso' ><img src='img/peso.png'></a></td>";

		echo "</p></div></td>";
		
		
	echo "</tr>"; 
	}


include("footer.php");
?>