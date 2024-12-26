<?php 
require("login_autentica.php");
//require_once("expdf/lib/pdf/mpdf.php");  
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$DB2 = new DB_mssql;
$DB2->conectar();

header('Content-type: application/vnd.ms-word');
header("Content-Disposition: attachment; filename=cetificado".".doc");
header("Pragma: no-cache");
header("Expires: 0"); 

//echo 'body { font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;}';
function sinp($valor){

if($valor==1) { return "SI"; } else { return "NO"; }
	
}

function elegido($valor){

if($valor==1) { return "elegido.png"; } else { return "noelegido.png"; }
	
}

 	 $sql="SELECT `idsaludocupacional`, `sal_fecha`, sal_fn, `tip_nombre`, `sal_iddocumento`,
	`sal_nombre`, `sal_telefono`, `sal_empresa`,`sal_cargo`, `sal_actitudlaboral`,sal_idusuario,`sal_ingreso`,
	`sal_retiro`, `sal_periodico`, `sal_espconfinados`, `sal_traalturas`, `sal_manalimentos`
	From saludocupacional INNER JOIN tipodocumento ON iddocumento=sal_idtipodocumento  WHERE idsaludocupacional='$id_param' ";
	$DB->Execute($sql); 
		
	$rw=mysqli_fetch_row($DB->Consulta_ID);  
	
 	 $sql="SELECT `cer_idsaludocupacional`, `cer_examenmedico`, `cer_audiometria`, `cer_visiometria`, 
	`cer_espirometria`, `cer_laboratorio`, `cer_vistibular`, `cer_resexamenes`, `cer_observaciones`, `cer_tiprestricciones`,
	`cer_comentarios`, `cer_egreso`, `cer_recomendaciones` FROM `certificadoaptitud` WHERE cer_idsaludocupacional='$id_param' ";
	
	
	$DB->Execute($sql); 
	$rw1=mysqli_fetch_row($DB->Consulta_ID); 

$html="<header>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
 <link href='css/style.css' rel='stylesheet'>
    </header>
    <main>
	
	<div id='saludocupacional'>
	";

	$sql3="SELECT `doc_ruta` FROM `documentos` WHERE doc_tabla='saludocupacional' and doc_version='2' and doc_idviene=$id_param ";
	$DB->Execute($sql3); 
	$rw3=mysqli_fetch_row($DB->Consulta_ID); 
		
	$html.="<table border=1 width='80%'  align='center' >";	
	$html.="<tr class='text'>";
	$html.="<td width='80%' style='font-size:12px' >IMPORTANTE: no confie en su salud a tramitadores en la calle,acuda a los centros medicos autorizados por la secretaria Distrital de Salud.
	</td><td width='20%' align='left' > <img  width=100px;  height='80px' src='$rw3[0]'></td><tr>";
	$html.="</table>";	
	
		$rw[11]=elegido($rw[11]);
		$rw[12]=elegido($rw[12]);
		$rw[13]=elegido($rw[13]);
		$rw[14]=elegido($rw[14]);
		$rw[15]=elegido($rw[15]);
		$rw[16]=elegido($rw[16]);
	
$html.="<table width='100%' border=1 style='font-size:11px' ><tr bgcolor='#074F91' class=''><td colspan='4' width='' align='center'   style='color:#FFFFFF' >CERTIFICADO DE APTITUD MEDICA OCUPACIONAL</td></tr><tr class='text'>
<tr><td colspan='4' align=center>(Segun lo dispuesto en las resoluciones 2346/2007/,1918/2009,1409/2012 y la NTC 4115)</td></tr><tr class='text'>";	
$html.="</table>";	

$html.="<table width='100%' border=1  style='font-size:11px' ><tr bgcolor='#FFFFFF' class=''>
<td colspan='14' width='' align='center'   style='' >MOTIVO DE EVALUACION</td></tr><tr class='text'>";
$html.="<td bgcolor='#FFFFFF' ><b>FECHA:</b></td><td>".utf8_encode($rw[1])."</td>";
$html.="<td bgcolor='#FFFFFF' >INGRESO:</td><td><img src='img/$rw[11]' width=30px; height='30px' ></td>";
$html.="<td bgcolor='#FFFFFF' >RETIRO:</td><td><img src='img/$rw[12]' width=30px; height='30px' ></td>";
$html.="<td bgcolor='#FFFFFF' >PERIÓDICO:</td><td><img src='img/$rw[13]' width=30px; height='30px' ></td>";
$html.="<td bgcolor='#FFFFFF' >ESPACIOS CONFINADOS:</td><td><img src='img/$rw[14]' width=30px; height='30px' ></td>";
$html.="<td bgcolor='#FFFFFF' >TRAB.EN ALTURAS:</td><td><img src='img/$rw[15]' width=30px; height='30px' ></td>";
$html.="<td bgcolor='#FFFFFF' >MAN ALIMENTOS:</td><td><img src='img/$rw[16]' width=30px; height='30px' ></td>";
$html.="</tr><tr >";
$html.="<td bgcolor='#FFFFFF' colspan='4' ><b>NOMBRE:</b></td><td colspan='10' style='font-size:12px'>".utf8_encode($rw[5])."</td>";
$html.="</tr>";
$html.="</tr><tr class='text'>";
$html.="<td bgcolor='#FFFFFF' ><b>TIPO ID:</b></td><td colspan='3'>".utf8_encode($rw[3])."</td>";
$html.="<td bgcolor='#FFFFFF' >CEDULA:</td><td colspan='3'>".utf8_encode($rw[4])."</td>"; 
$html.="<td bgcolor='#FFFFFF' >TELÉFONOS:</td><td colspan='5'>".utf8_encode($rw[10])."</td>";
$html.="</tr>";
$html.="</table>";	

		$rw1[1]=elegido($rw1[1]);
		$rw1[2]=elegido($rw1[2]);
		$rw1[3]=elegido($rw1[3]);
		$rw1[4]=elegido($rw1[4]);
		$rw1[5]=elegido($rw1[5]);
		$rw1[6]=elegido($rw1[6]);

$html.="<table width='100%' border=1 style='font-size:11px'  ><tr bgcolor='#FFFFFF' class=''>
<td colspan='14' width='' align='center'   style='' >EXAMENES REALIZADOS</td></tr>";
$html.="<tr class='text'>";
$html.="<td bgcolor='#FFFFFF' >EXAMEN MEDICO:</td><td><img src='img/$rw1[1]' width=30px; height='30px' ></td>";
$html.="<td bgcolor='#FFFFFF' >AUDIOMETRIA:</td><td><img src='img/$rw1[2]' width=30px; height='30px' ></td>";
$html.="<td bgcolor='#FFFFFF' >VISIOMETRIA:</td><td><img src='img/$rw1[3]' width=30px; height='30px' ></td>";
$html.="<td bgcolor='#FFFFFF' >ESPIROMETRIA:</td><td><img src='img/$rw1[4]' width=30px; height='30px' ></td>";
$html.="<td bgcolor='#FFFFFF' >LABORATORIO CLINICO:</td><td><img src='img/$rw1[5]' width=30px; height='30px' ></td>";
$html.="<td bgcolor='#FFFFFF' >PRUEBA VESTIBULAR:</td><td><img src='img/$rw1[6]' width=30px; height='30px' ></td>";
$html.="</table>";

$html.="<table width='100%' border=1  style='font-size:11px'  ><tr bgcolor='#FFFFFF' class=''>
<td colspan='4' width='' align='center'   style='' >INFORMACION ORGANIZACION</td></tr>";
$html.="<tr align='left'  bgcolor='#FFFFFF'>";
$html.="<td  width='30%' ><b>NOMBRE DE LA EMPRESA:</b></td><td colspan='3'>".utf8_encode($rw[7])."</td>";
$html.="</tr><tr bgcolor='#FFFFFF'>";
$html.="<td width='30%' ><b>CARGO:</b></td><td colspan='3'>".utf8_encode($rw[8])."</td>";
$html.="</tr><tr class='text'>"; 
$html.="<td colspan='4' align=center><b>CONCEPTO DE LA VALORACION MEDICA</b></td>";
$html.="</tr>"; 
$html.="</table>";		
//$html.=$FB->titulo_azul1("",4,0,9);


	$html.="<table width='100%' border=1 style='font-size:11px' ><tr bgcolor='#FFFFFF' class=''>
<td colspan='4' width='' align='center'   style='' >EXAMEN DE INGRESO</td></tr>";

		$html.="<tr class='text' bgcolor='#FFFFFF' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"#FFFFFF\"'>";
		$html.="<tr class='text' >";
		$html.="<td width='40%'><b>APTITUD LABORAL PARA EL CARGO:</b></td><td colspan='3' >".utf8_encode($rw[9])."</td><tr>";
		$html.="<tr class='text' bgcolor='#FFFFFF' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"#FFFFFF\"'>";
		$html.="<td width='40%'><b>RESULTADOS EXAMENES:</b></td><td colspan='3' >".utf8_encode($rw1[7])."</td><tr>";
		$html.="<tr class='text' >";
		$html.="<td width='40%'><b>OBSERVACIONES:</b></td><td colspan='3' >".utf8_encode($rw1[8])."</td><tr>";
		$html.="<tr class='text' bgcolor='#FFFFFF' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"#FFFFFF\"'>";
		$html.="<td width='40%'><b>TIPO DE RESTRICCIONES:</b></td><td colspan='3' >".utf8_encode($rw1[9])."</td><tr>";
		$html.="<tr class='text' bgcolor='' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"#FFFFFF\"'>";
		$html.="<td width='40%'><b>COMENTARIO DE EXAMENES PERIODICOS:</b></td><td colspan='3' >".utf8_encode($rw1[10])."</td><tr>";
		$html.="<tr class='text' bgcolor='#FFFFFF' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"#FFFFFF\"'>";
		$html.="<td width='40%'><b>COMENTARIO DE EXAMENES DE EGRESO:</b></td><td colspan='3' >".utf8_encode($rw1[11])."</td><tr>";
		$html.="</table>
		<table width='100%' border=1  >
		<tr bgcolor='#FFFFFF' class=''><td colspan='4' width='' align='center'   >RECOMENDACIONES GENERALES EXAMENES REALIZADOS</td></tr>";
		
		$html.="<tr><td colspan='4' style='font-size: 11pt;' >Inducción al cargo (Art 13 Dec 2646/08). Pautas de control de estrés laboral (Res. 2646) y pautas para prevenir el uso de sustancias psicoactivas en el trabajo (Res 1075, 1016, 7036, 1956, Dec. 1108 y los que apliquen). Pautas para prevenir el acoso laboral y otros hostigamientos (Ley 1010/06). Capacitar en el uso de los EPP requeridos para el cargo (Ley 9 Título III, arts. 85, 122, 123 y 124), según matriz de peligro (gtc 45). Capacitar en manejo de cargas (Res 2400 art. 390, 392 y las que apliquen). Utilizar protección auditiva cuando se superen los 80 dB (Res 627 y NTC 2272). Gestión peligro biomecánico mediante pausas activas- charlas sobre higiene postural-sillas ajustables (Ley 1355/09, gtc 45). Mantener el lugar de trabajo en orden y aseo.<br />".utf8_encode($rw1[12])."</td><tr>";
		//$html.="<tr><td colspan='4' style='font-size:11px'  >Recomendaciones: ".utf8_encode($rw1[12])."</td><tr>";
		$html.="</table>";	
		
		$sql1="SELECT usu_nombre FROM usuarios where idusuarios='$rw[10]'";
		$DB->Execute($sql1); 
		$rw1=mysqli_fetch_row($DB->Consulta_ID); 
		
		$sql2="SELECT `doc_ruta` FROM `documentos` WHERE doc_tabla='Usuario' and doc_version='2' and doc_idviene='$rw[10]'";
		$DB->Execute($sql2); 
		$rw2=mysqli_fetch_row($DB->Consulta_ID); 

		$sql3="SELECT `doc_ruta` FROM `documentos` WHERE doc_tabla='saludocupacional' and doc_version='1' and doc_idviene=$id_param ";
		$DB->Execute($sql3); 
		$rw3=mysqli_fetch_row($DB->Consulta_ID); 
		
 	if($rw2[0]!=""){$rw2[0]="<img src='$rw2[0]' width=200px; height='80px' >"; } else {  $rw2[0]=""; }
		if($rw3[0]!=""){$rw3[0]="<img src='$rw3[0]' width=200px; height='80px' >"; } else {  $rw3[0]=""; }
		
		$html.='<table border=1 width="100%" style="font-size:9px"  >';	
		$html.="<tr class='text' bgcolor='#FFFFFF' height='70px' >";
		$html.="<td width=200px; height='70px' >FIRMA: $rw2[0]</td><td></td><td> $rw3[0]</td><tr>";
		
		$html.="<tr bgcolor='#FFFFFF'   ><td >MEDICO: $rw1[0]</td>
		<td >FIRMA Y CEDULA DEL ASPIRANTE</td><td >HUELLA INDICE</td>";
		$html.="</table>";
		$pdff="certificadoaptitudmedica-$rw[4].pdf";
 echo  $html.='</div></main><footer> <br/><br/></footer>';
	
/*   	$mpdf=new mPDF('c','A4');
	$css= file_get_contents('expdf\reportes\css\styles.css');
	$mpdf->writeHTML($css,1);
	$mpdf->writeHTML($html);
	$mpdf->Output($pdff,'D');   */   
 ?>