<?php
require("login_autentica.php"); 
require_once("expdf/lib/pdf/mpdf.php"); 

$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$id_sedes=$_SESSION['usu_idsede'];

$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$DB2 = new DB_mssql;
$DB2->conectar();

$param1=$_REQUEST["param1"];
$param2=$_REQUEST["param2"];
$param4=$_REQUEST["param4"];
$param5=$_REQUEST["param5"];
$param6=$_REQUEST["param6"];

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

if($param6!=''){ 
	
	$idcidades=ciudadesedes($param6,$DB);
	if($idcidades=='0'){
		$conde1="";

	}else {
	  $conde1.=" and ser_ciudadentrega in $idcidades "; 	
	}
}



//echo $_SESSION['usuario_rol'];


 $conde="and gui_fechaensede like '$fechaactual%'"; 

if($param4!=''){ $conde="and gui_fechaensede like '$param4%'";  $fechaactual=$param4;  }
$conde3=""; 

if($param2!="" and $param1!=""){ 
 $conde2="and $param1 like '%$param2%' "; 
	}else { $conde2="  "; } 
	

	$html="<header>
	<br/>
	<br/>
			</header>
			<main>
		<div id='Enviadas'>
		";

		$html.="<table border=0 width='90%'  align='center' >";	
		$html.="<tr>";
		$html.="<td width='100%' align='left' colspan=3 > <img  width='90%';  height='80px' src='images/logoticket.png'></td><tr>";
		$html.="<tr class='text'>";
		$html.="<td width='40%' style='font-size:12px' >Transmillas logistica y transportadora S.A.S.
		</td><td width='40%' style='font-size:12px' >RELACION DE GUIAS ENVIADAS
		</td>
		<td width='20%' align='left' > Fecha: $fechaactual </td><tr>";
		$html.="</table>";	

		$html.="	<table width='100%' border=1  style='font-size:11px' ><tr bgcolor='#FFFFFF' class=''>";
		$html.=  '<tr class="tittle3">
		<td colspan="1" width="0" align="center">Guia</td>
		<td colspan="1" width="0" align="center">Pre-Guia</td>
		<td colspan="1" width="0" align="center"> # de Piezas</td>
		<td colspan="1" width="0" align="center">Destinatario</td>
		<td colspan="1" width="0" align="center">Ciudad</td>
		<td colspan="1" width="0" align="center">Dirección</td>
		<td colspan="1" width="0" align="center">Télefono</td></tr>';

  $sql="SELECT `idservicios`, `ser_consecutivo`,ser_guiare,ser_piezas, `ser_destinatario`, `ciu_nombre`,`ser_direccioncontacto`, `ser_telefonocontacto`
 FROM serviciosdia inner join guias on gui_idservicio=idservicios
 where ser_estado>='7' and ser_estado!='100' $conde3 $conde1 $conde2 $conde ORDER BY gui_fechaensede $asc ";

$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		$html.= "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		$rw1[6]=str_replace("&"," ", $rw1[6]);
		$html.=  "
		<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		<td>".$rw1[7]."</td>
		";
		$html.=  "</tr>"; 
	}
	
	$html.= "<tr><td >Total Guias</td><td>$va</td></tr>"; 
 	$html.="</tbody>
		</table>
		
		 </div>";

		  

		 $mpdf=new mPDF('c','A4');
		 $css= file_get_contents('css\styles.css');
		 $mpdf->writeHTML($css,1);
		 $mpdf->writeHTML($html);
		 $mpdf->Output($pdff,'D');  
  ?>
  <body>

</body>


 