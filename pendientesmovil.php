<?php 
require("login_autentica.php"); 
include("layout.php");
if($param2=='') { $param2=0;  }
?>

<body>

<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
$FB->titulo_azul1(" Pendientes X Cobrar",1,0,5);  

$conde3="";	
$conde3="and cue_idoperpendiente='$id_usuario'";	

$conde1=""; 


$sql="SELECT `idservicios`,`cue_fecharecogida`,`ser_consecutivo`,`cli_nombre`,`cli_telefono`,`cli_direccion`, `ser_peso`,`ser_valor`,`ser_pendientecobrar`,ser_estado,ser_visto,usu_nombre,cli_idciudad,ser_guiare,cue_idoperpendiente
FROM `clientes` inner join clientesservicios on cli_idclientes=idclientes  
inner join rel_sercli on idclientesdir=ser_idclientes 
inner join servicios on  ser_idservicio=idservicios
inner join ciudades on ser_ciudadentrega=idciudades 
inner join cuentaspromotor on cue_idservicio=idservicios 
left join usuarios on cue_idoperpendiente=idusuarios  where  ser_pendientecobrar=1 and ser_estado!=100 $conde3 ORDER BY ser_fechaentrega $asc ";

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
		echo "<h4><span class='label label-warning'># GUIA $rw1[2]</span></h4>";

		echo "<p  align='left'>CLIENTE: $rw1[3]<br>";
		echo "DIRECCIÓN: $rw1[5]<br>";
		echo "TELEFONO: $rw1[4]<br>";
		echo "PESO Kg: $rw1[6]<br>";
		echo "VALOR A COBRAR: $rw1[7]<br>";

		
	/* 	
		echo "<div id='campo$va'>"; if($rw1[8]==1){ $st="NO"; $colorfondo="#074f91"; } else { $st="SI"; $colorfondo="#941727"; } 
		echo "¿CANCELADO?: <select  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:18px'
		name='param14' id='param14'  onChange='cambio_ajax2(this.value, 68, \"campo$va\", \"$va\", 1, $id_p)'  required>";
			$LT->llenaselect_ar($st,$estado_pen);
		echo "</select></div>";
		 */	

		echo "<a  onclick='pop_dis13($id_p,\"Entregar Guias\",1)';  style='cursor: pointer;' class='btn btn-primary btn-lg' title='Cobrar Guias' role='button' >Cobrar</a>";



		echo "</p></div></td>";
		
		
	echo "</tr>"; 
	}


include("footer.php");
?>