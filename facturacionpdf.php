<?php 
require("login_autentica.php");
require("connection/numletras.php");
require_once("expdf/lib/pdf/mpdf.php");  
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$DB2 = new DB_mssql;
$DB2->conectar();
$campos=$_REQUEST['campos']+1;

  $enviar=$_REQUEST['enviar'];

 $html2="";
$totales=0;


	
 $sql2="Delete servicio FROM `servicio` inner join facturacion on `idfactura`=ser_idviene where `fac_cosec`='$consecutivo'";
$DB1->Execute($sql2);

 $sql1="DELETE FROM facturacion WHERE `fac_cosec`='$consecutivo'";
$DB1->Execute($sql1);

 $sql3="Delete pacientes FROM `pacientes` inner join historiaclinica on `idpaciente`=his_idpaciente where `his_codfactura`='$consecutivo'";
$DB2->Execute($sql3);

 $sql4="DELETE FROM historiaclinica WHERE `his_codfactura`='$consecutivo'";
$DB2->Execute($sql4);

 $sql5="DELETE FROM saludocupacional WHERE `sal_cosfactura`='$consecutivo'";
$DB2->Execute($sql5);

if($consecutivo=="" or $sede!=$param22){
	 $sql="SELECT `idconfac`, `idconsecutivo`, `idresolucion` FROM `conf_fac` WHERE idsede=$param22";
	$DB->Execute($sql); 
	$rw2=mysqli_fetch_row($DB->Consulta_ID); 
	
	 $consecutivo=$rw2[1];
	 $resolucion=$rw2[2];
} 
if($_SESSION['usuario_rol']!=2){
	

	 $sql="INSERT INTO `facturacion`(`idfactura`, `fac_fecha`, `tipodocumento_idtipodocumento`, `fac_iddocumento`, `fac_nombre`, `fac_cosec`, `fac_edad`, `fac_sexo`,
	 `fac_domicilio`,  `fac_telefono`, `fac_entidad`, `fac_municipio`, `fac_barrio`, `fac_profesion`, `fac_departamento`, 	`fac_zona`, `fac_esp`, `fac_cajero`, `fac_abono`, `fac_resolucion`,fac_sede) 
	VALUES ('','$param1','$param2','$param3','$param4','$consecutivo','$param6','$param7','$param9','$param11','$param12','$param13','$param14',
	'$param15','$param16','$param17','$param18','$param20','$param25','$resolucion','$param22')";
	$DB->Execute($sql); 

	 $sql1="SELECT max(idfactura) FROM facturacion WHERE fac_iddocumento='$param3'";
	$DB1->Execute($sql1);
	$ser_idviene=$DB1->recogedato(0);
}


	$sql11="SELECT max(idservicio) FROM servicio ";
	$DB1->Execute($sql11);
	$idservicio=$DB1->recogedato(0);
	

	
 if($param90!=''){
	 if($_SESSION['usuario_rol']!=2){
	$idservicio=$idservicio+1;	 
	 $sql2="INSERT INTO `servicio`(`idservicio`, `ser_idviene`, `ser_codigo`, `ser_idexamen`, `ser_catidad`, `ser_valor`,`ser_estado`)
VALUES ('$idservicio','$ser_idviene','$param30','$param50','$param70','$param90','FACTURADO')";
$iddpac1=$DB->Execute($sql2); 


 		$sqlinser="SELECT exa_nombre,exa_codigo,exa_tipo FROM examenes where exa_idexamen='$param50'";
		$DB->Execute($sqlinser);	
		//$rw3=mysqli_fetch_row($DB->Consulta_ID); 
		while($rw4=mysqli_fetch_row($DB->Consulta_ID))
		{
		$examen=$rw4[0];
		$exacodi=$rw4[1];		
		$tiopoexamen=$rw4[2];		 
		}
	if($tiopoexamen=='historiaclinica'){ //citas medicas


 		$sel="SELECT idpaciente FROM pacientes where pac_iddocumento='$param3'";
		$DB->Execute($sel);		
		$iddpac=$DB->recogedato(0);	 		

		
 if($iddpac==""){
	$sql4="INSERT INTO `pacientes`(`idpaciente`, `tipodocumento_idtipodocumento`, `pac_iddocumento`, `pac_nombre`,  `pac_fechanacimiento`, `pac_sexo`, `pac_procedentede`, `pac_barrio`,`pac_profesion`, `pac_telefonocasa`)
 VALUES ('','$param2','$param3','$param4','$param6','$param7','$param9','$param14','$param15','$param11')";
$DB2->Execute($sql4);

		$sel="SELECT idpaciente FROM pacientes where pac_iddocumento='$param3'";
		$DB->Execute($sel);		
		$iddpac=$DB->recogedato(0);		
 }else {
	
 $sql4="UPDATE `pacientes` SET `tipodocumento_idtipodocumento`='$param2', `pac_iddocumento`='$param3', `pac_nombre`='$param4',  `pac_fechanacimiento`='$param6',
 `pac_sexo`='$param7', `pac_procedentede`='$param9', `pac_barrio`='$param14',`pac_profesion`='$param15', `pac_telefonocasa`='$param11' where pac_iddocumento='$param3'";
$DB2->Execute($sql4);	
 }
		
		
		
 $sql5="INSERT INTO historiaclinica (idhistoria, his_idpaciente,his_fecha,his_hora,his_idusuario,his_idsede,his_estado,his_codfactura,his_idservicio)
VALUES ('','$iddpac','$param1','00:00','1','1','FACTURADO',$consecutivo,$idservicio);";
$DB1->Execute($sql5);



} elseif($tiopoexamen=='Saludocupacional') { //salud ocupacional
	
	
 $sql6="INSERT INTO saludocupacional (idsaludocupacional, sal_fecha, sal_idtipodocumento, sal_iddocumento, sal_nombre, sal_fechanacimiento,  sal_procedentede, sal_telefono, sal_profesion, sal_estado,sal_cosfactura,sal_idservicio) 
VALUES ('','$param1','$param2','$param3','$param4','$param6','$param8','$param9','$param13','FACTURADO',$consecutivo,$idservicio)";	 
$DB2->Execute($sql6);
	
}
	 }
$totalvalor=$param70*$param90;
$totales=$totales+$totalvalor;
$totalvalor=number_format($totalvalor,0,".",".");
$valor=number_format($param90,0,".",".");


$html2.="<tr class='text' bgcolor='#F3F3F3'><td colspan='2' >".$exacodi."</td><td colspan='2' >".$examen."</td><td colspan='2' >".$param70."</td><td colspan='2' >$".$valor."</td><td colspan='2' >$".$totalvalor."</td></tr>";
}
$i=1;

for($a=1;$a<$campos;$a++){
	
if(@$_REQUEST['param9'.$a]!=""){
	if($_SESSION['usuario_rol']!=2){
	$idservicio=$idservicio+1;		
	$sql3="INSERT INTO `servicio`(`idservicio`, `ser_idviene`,  `ser_idexamen`, `ser_catidad`, `ser_valor`,`ser_estado`)
	VALUES ('$idservicio','$ser_idviene','".$_REQUEST['param5'.$a]."','".$_REQUEST['param7'.$a]."','".$_REQUEST['param9'.$a]."','FACTURADO')";
 	$DB->Execute($sql3); 
	
		 $sel2="SELECT exa_nombre,exa_codigo,exa_tipo FROM examenes where exa_idexamen='".$_REQUEST['param5'.$a]."'";
		$DB->Execute($sel2);		
		//$rw3=mysqli_fetch_row($DB2->Consulta_ID); 
	while($rw3=mysqli_fetch_row($DB->Consulta_ID))
	{
		$examen=$rw3[0];
		$exacodi=$rw3[1];		
		$tiopoexamen=$rw3[2];		
	}
	if($tiopoexamen=='historiaclinica'){ //citas medicas

	$iddpac=$paciente;	

 if($iddpac==""){
   $sql4="INSERT INTO `pacientes`(`idpaciente`, `tipodocumento_idtipodocumento`, `pac_iddocumento`, `pac_nombre`,  `pac_fechanacimiento`, `pac_sexo`, `pac_procedentede`, `pac_barrio`,`pac_profesion`, `pac_telefonocasa`,pac_entidad)
 VALUES ('','$param2','$param3','$param4','$param6','$param7','$param9','$param14','$param15','$param11','$param12')";
$DB2->Execute($sql4);

		$sel="SELECT idpaciente FROM pacientes where pac_iddocumento='$param3'";
		$DB->Execute($sel);		
		$iddpac=$DB->recogedato(0);	
 }else {
	
  $sql4="UPDATE `pacientes` SET `tipodocumento_idtipodocumento`='$param2', `pac_iddocumento`='$param3', `pac_nombre`='$param4',  `pac_fechanacimiento`='$param6',
 `pac_sexo`='$param7', `pac_procedentede`='$param9', `pac_barrio`='$param14',`pac_profesion`='$param15', `pac_telefonocasa`='$param11', `pac_entidad`='$param12' where pac_iddocumento='$param3'";
$DB2->Execute($sql4);	
 }
	

 $sql5="INSERT INTO historiaclinica (idhistoria, his_idpaciente,his_fecha,his_hora,his_idusuario,his_idsede,his_estado,his_codfactura)
VALUES ('','$iddpac','$param1','00:00','1','1','FACTURADO',$consecutivo);";
$DB1->Execute($sql5);

} elseif($tiopoexamen=='Saludocupacional') { //salud ocupacional
	
 $sql6="INSERT INTO saludocupacional (idsaludocupacional, sal_fecha, sal_idtipodocumento, sal_iddocumento, sal_nombre, sal_fechanacimiento,  sal_procedentede, sal_telefono, sal_profesion, sal_estado,sal_cosfactura) 
VALUES ('','$param1','$param2','$param3','$param4','$param6','$param8','$param9','$param13','FACTURADO',$consecutivo)";	 
$DB2->Execute($sql6);
	
}
	}	
	$p=$i%2;
	if($p==1){$color="#FFFFFF";} else{ $color="#F3F3F3"; }
	
	$totalvalor=$_REQUEST['param7'.$a]*$_REQUEST['param9'.$a];

	$totales=$totales+$totalvalor;
	$totalvalor=number_format($totalvalor,0,".",".");
	$valor=number_format($_REQUEST['param9'.$a],0,".",".");
	

	
	$html2.="<tr class='text' bgcolor='$color'><td colspan='2' >".$exacodi."</td><td colspan='2' >".$examen."</td><td colspan='2' >".$_REQUEST['param7'.$a]."</td><td colspan='2' >$".$valor."</td><td colspan='2' >$".$totalvalor."</td></tr>";
	
	$i++;
	}
}

$saldo=$totales-$param25;
$totales=number_format($totales,0,".",".");
$valorletras=num2letras($saldo);
$saldo=number_format($saldo,0,".",".");
 //echo $html2;

$param6=edades($param6);

//$html=$FB->titulo_azul1("Datos Personales",4,0,5);  

$html="<header>
      <div id='logo'>
      </div>
    </header>
    <main>
	<div id='saludocupacional'>
	";
$param2=$tipoid[$param2];
$html.="<table width='100%'  border=1 >
<tr  class=''>
<td colspan='1' width=''  style='color:#FFFFFF' ><img src='img/fondopdf2.png' style='width: 70%;'></td>
<td colspan='1' width='' align='center' style='color:#'  ><B> PRINCIPAL:</B> Carrera 21 No 26-52 sur Tel: 2783189<br><B>SEDE $param22:</B> Carrera 21 No 23-38 sur Tel: 2397687
<br>FAX:4092917-Bogota-D.C.<br><B>RESOLUCION DIAN No $resolucion</B>
</td>
<td colspan='1' width='' align='center'   style='color:#' ><H3>FACTURA DE VENTA</H3> <BR> <FONT FACE='arial' SIZE=5 COLOR=red >$consecutivo</FONT> <BR><B>EXCLUSIVO IVA ART 476 E.T</B></td>
</tr>
</table>
";

$html.="<table width='100%' bgcolor='#FFFFFF' ><tr bgcolor='#074F91' class=''><td colspan='14' width='' align='center'   style='color:#FFFFFF' >FACTURA</td></tr><tr class='text'>";

$html.="<td>FECHA:</td><td>".utf8_encode($param1)."</td>";
$html.="<td>TIPO DOC:</td><td>".utf8_encode($param2)."</td>";
$html.="<td>DOCUMENTO:</td><td>".utf8_encode($param3)."</td>"; 
$html.="</tr><tr class='text' bgcolor='#EFEFEF'>";

$html.="<td  >NOMBRE:</td><td>".utf8_encode($param4)."</td>";
$html.="<td  >EDAD:</td><td>".utf8_encode($param6)."</td>";
$html.="<td>SEXO:</td><td>".utf8_encode($param7)."</td>";
$html.="</tr><tr class='text' bgcolor='#FFFFFF'>";
$html.="<td>DOMICILIO:</td><td>".utf8_encode($param9)."</td>";
$html.="<td  >TELEFONO:</td><td>".utf8_encode($param11)."</td>"; 
$html.="<td >ENTIDAD:</td><td>".utf8_encode($param12)."</td>";
$html.="</tr><tr class='text' bgcolor='#EFEFEF'>";
$html.="<td  >MUN/VEREDA:</td><td>".utf8_encode($param13)."</td>";
$html.="<td  >BARRIO:</td><td>".utf8_encode($param14)."</td>";
$html.="<td  >PROFESION:</td><td>".utf8_encode($param15)."</td>"; 
$html.="</tr><tr class='text' bgcolor=''>";
$html.="<td >DEPARTAMENTO:</td><td>".utf8_encode($param16)."</td>";
$html.="<td >ZONA:</td><td>".utf8_encode($param17)."</td>";
$html.="<td  >ESP:</td><td>".utf8_encode($param18)."</td>";
$html.="</tr></table>"; 

		$html.="<table width='100%' bgcolor='#FFFFFF' border='1' ><tr  bgcolor='#074F91' class='tittle3' style='color:#FFFFFF' >
		<td colspan='2'  style='color:#FFFFFF' >CODIGO</td>
		<td colspan='2'  style='color:#FFFFFF' >SERVICIOS</td>
		<td colspan='2'  style='color:#FFFFFF' >CANTIDAD</td>
		<td colspan='2'  style='color:#FFFFFF' >VR.UNITARIO</td>
		<td colspan='2'  style='color:#FFFFFF' >VR.TOTAL</td>
		</tr>";	
		$html.=$html2;
		
		$html.="<tr class='text' >
		
		<td colspan='2'>CAJERO:</td><td colspan='3'>".utf8_encode($param20)."</td>
		<td colspan='2' bgcolor='#074F91' class='tittle3' style='color:#FFFFFF'>TOTAL:</td><td colspan='3' bgcolor='#074F91' class='tittle3' style='color:#FFFFFF' align=right>$".utf8_encode($totales)."</td>
		</tr>";		
		$html.="<tr class='text'  bgcolor='#EFEFEF' >
		<td ></td><td colspan='3'></td>
		<td></td><td colspan='2'></td>
		<td bgcolor='#074F91' class='tittle3' style='color:#FFFFFF'>ABONO:</td><td colspan='2' bgcolor='#074F91' class='tittle3' style='color:#FFFFFF'>$".utf8_encode($param25)."</td>
		</tr>";
		
		$html.="<tr class='text' >
		<td ></td><td colspan='3'></td>
		<td></td><td colspan='2'></td>
		<td bgcolor='#074F91' class='tittle3' style='color:#FFFFFF'>SALDO:</td><td colspan='2' bgcolor='#074F91' class='tittle3' style='color:#FFFFFF'>$".utf8_encode($saldo)."</td>
		</tr>";
		
		$html.="<tr  bgcolor='#074F91' class='tittle3' style='color:#FFFFFF' >
		<td  colspan='2' style='color:#FFFFFF' >VALOR EN LETRAS:</td>
		<td  colspan='8' style='color:#FFFFFF' >".utf8_encode($valorletras)."</td>
		</tr>";
		
		$html.="<tr  bgcolor='#074F91' class='tittle3' style='color:#FFFFFF' >
		<td  colspan='10' style='color:#FFFFFF' >ESTA FACTURA SE ASIMILIA A UNA LETRA DE CAMBIO SEGUN ART.774 DEL CODIGO DE COMERCIO:</td>
		</tr>";
	
		$html.="</table>"; 
		
		if($consecutivo=="" or $sede!=$param22){
		$consecutivo=$consecutivo+1;
		$sql2="UPDATE `conf_fac` SET `idconsecutivo`=$consecutivo where idsede=$param22";
		$DB->Execute($sql2); 
		} 
		
if($enviar=="IMPRIMIR"){
 	 $html.='</div></main><footer></footer>';
     $mpdf=new mPDF('c','A4');
	$css= file_get_contents('css/style.css');
	$mpdf->writeHTML($css,1);
	$mpdf->writeHTML($html);
	$mpdf->Output("factura-$param3.pdf",'D');  

}
else {
	header ("Location: adm_facturacion.php");
}
	?>