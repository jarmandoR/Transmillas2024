<?php
header('Content-type: application/vnd.ms-excel; charset=utf-8');
header("Content-Disposition: attachment; filename=reporte_creditos.xls;  charset=utf-8");
header("Pragma: no-cache");
header("Expires: 0");     
require("login_autentica.php");

//include("layout.php");
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();

$asc="ASC";
$conde1=""; 
$conde3=""; 
$opcion=$_REQUEST["preguia"];
$idfactura=$_REQUEST["idfactura"];

if($param4!=''){  $fechainicio=$param4;}
if($param5!=''){  $fechaactual=$param5;}



if($param1==""){ $param1="ser_prioridad"; } 
if($param3!=''){ $conde3 =" and rel_nom_credito like '%$param3%'";  }
	
 ?>
    <table width="99%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="">
     <tr bgcolor="#F75700">
     <td width="10%"  class=""><div align="center" class="tittle2">Fecha Ingreso</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">#Guia</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">#Relacionado</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Remitente</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Telefono</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Direccion</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Ciudad O</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Destinatario</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Telefono</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Direccion</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Ciudad D</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Servicio</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Prestamo</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Piezas</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Peso</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Volumen</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Precio 5 KIlos</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Kilos Adicional</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Valor Adicionales</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Seguro</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">%Seguro</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Flete+%Seguro</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Credito</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">AC</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">AU</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Tipo Servicio</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Manifiesto </div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">Carga</div></td>
	
       </tr>
     <?php	

if($param6=='Sin Facturar'){
	$conde4=' and ser_numerofactura is null';
}elseif($param6=='Facturados'){
	$conde4=' and ser_numerofactura>=1';
}else{
	$conde4='';	
}

if($opcion==4){

	$sql1="Select fac_idservicios,fac_credito,fac_idfacturados,fac_estado from facturascreditos where idfacturascreditos=$idfactura ";
	$DB->Execute($sql1); 
	$resul=mysqli_fetch_row($DB->Consulta_ID);
	$prefac=$resul[0]; 
	 $credito=$resul[1]; 
	 $prefac2=$resul[2]; 
	 $estado=$resul[3]; 

	if($estado!='Pre-Facturado'){

		$prefac=$prefac2;
	 }

	 if($credito=='EXTERNOS'){

		$conde0=''; 
	}else{
		$conde0=' and ser_clasificacion=2'; 
	}

	 $sql="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`, `cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,
	`ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_fecharegistro,ser_consecutivo,ser_guiare,cli_idciudad,ser_valorprestamo,ser_valor,rel_nom_credito,ser_piezas,ser_peso,ser_volumen,ser_valorseguro,rel_nom_credito,cli_idclientes,ser_ciudadentrega,ser_manifiesto
	 FROM serviciosdia  s inner join rel_sercre rs on rs.idservicio=idservicios   where idservicios in ($prefac) and ser_estado>=3 and ser_estado!=100 $conde0 $conde1 $conde2 $conde3 $conde4 ORDER BY idrelsercre $asc ";
}else{

	$conde0=' and ser_clasificacion=2'; 

	$sql="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`, `cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,
	`ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_fecharegistro,ser_consecutivo,ser_guiare,cli_idciudad,ser_valorprestamo,ser_valor,rel_nom_credito,ser_piezas,ser_peso,ser_volumen,ser_valorseguro,rel_nom_credito,cli_idclientes,ser_ciudadentrega,ser_manifiesto
	FROM serviciosdia  s inner join rel_sercre rs on rs.idservicio=idservicios  where date(ser_fecharegistro)>='$fechainicio' and  date(ser_fecharegistro)<='$fechaactual'  and ser_estado>=3 and ser_estado!=100 $conde0 $conde1 $conde2 $conde3 $conde4 ORDER BY idrelsercre $asc ";
}
$DB->Execute($sql); $va=0; 
$totalcontado=0;

	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		$sel="SELECT ciu_nombre FROM ciudades where idciudades=$rw1[13]"; //CIUDAD ORIGEN
		$DB1->Execute($sel);		
		$ciudadnombre=$DB1->recogedato(0);	
		$rw1[20]=str_replace(".","", $rw1[20]);
		$pordeclarado=(intval($rw1[20])*1)/100;
		$totalflete=$rw1[15]+$pordeclarado;
		$totalcontado=$totalflete+$totalcontado;
		 $sql21="select tip_nom,tip_preciokilo,tip_precioadicional,idtiposervicio from guias inner join tiposervicio on idtiposervicio=gui_tiposervicio where gui_idservicio=$id_p";
		$DB1->Execute($sql21);
		$rw3=mysqli_fetch_row($DB1->Consulta_ID);
		$valortservicio=$rw3[0];
		$valortkilo=$rw3[1];
		$valortad=$rw3[2];

		if($valortkilo>0 or $valortkilo==''){
			if($rw3[3]=='' or $rw3[3]=='0'){
				$rw3[3]=0;
				
			}
			$param1=0;
			if($valortservicio==''){
				$valortservicio='NORMAL';

			}else{

				$param1=1;
			}

			$sql3="SELECT `pre_preciokilo`,`pre_precioadicional`,pre_idcredito FROM `precios_credito` left join creditos on pre_idcredito=idcreditos WHERE `pre_idciudadori`='$rw1[13]'  and `pre_idciudades`='$rw1[23]' and pre_tiposervicio='$rw3[3]' and cre_nombre='$rw1[21]' ";
			// if($nivel_acceso==1){
				
			// }
			
			$DB1->Execute($sql3);
			$rw2=mysqli_fetch_row($DB1->Consulta_ID); 
		 
			$valortkilo=$rw2[0];
			// $valortad=$rw2[1];
			

















			$kilos=$rw1[19]+$rw1[18];
			$sqlprecios="SELECT idprecioskilos FROM `precioskilos` where '$kilos' BETWEEN pre_inicial and prec_final;"; 
			$DB1->Execute($sqlprecios);
			$confipre=mysqli_fetch_row($DB1->Consulta_ID); 
			$idprecios=$confipre[0];
			if($idprecios==0 or $idprecios==''){
				$idprecios=1;
			}
			
			// echo$sql4="SELECT `idprecios`, `pre_kilo`, `con_precios` FROM `precios` inner join `configuracionkilos` on con_idprecioskilos=idprecios  WHERE con_tipo='normal'  and `pre_idciudadori`='$rw1[13]'  and `pre_idciudaddes`='$rw1[23]'  and pre_tiposervicio='$rw3[3]' and con_idprecios='$idprecios'";
			// 		$DB1->Execute($sql4);
			// 		$rw4=mysqli_fetch_row($DB1->Consulta_ID); 
		
			// // Crear un array con los valores de respuesta
			// // $valoresRespuesta = array(
			// // 	"prekilo" => $rw2[1],
			// // 	"adicional" => $rw2[2]
			// // );
		
			// $valortad=$rw4[1];

			if($param1==1){ // credito diferente a tipo servicio normal
	
	
				$sql4="SELECT `pre_preciokilo`,`con_precios` FROM `precios_credito`  inner join `configuracionkilos` on con_idprecioskilos=idprecioscredito  WHERE   con_tipo='Credito'  and   `pre_idciudadori`='$rw1[13]'  and `pre_idciudades`='$rw1[23]' and pre_tiposervicio='$rw3[3]' and pre_idcredito='$rw2[0]' and con_idprecios='$idprecios' cre_nombre='$rw1[21]' ";
				$DB1->Execute($sql4);
				$rw4=mysqli_fetch_row($DB1->Consulta_ID);  
			 
				// $preciokilo=$rw2[0];
				$valortad=$rw4[1];
					
			 }else{
				  $sql5="SELECT `idprecios`, `pre_kilo`, `con_precios` FROM `precios` inner join `configuracionkilos` on con_idprecioskilos=idprecios 
				 where con_tipo='normal' and  pre_idciudadori='$rw1[13]' and pre_idciudaddes='$rw1[23]' and pre_tiposervicio='$rw3[3]'  and con_idprecios='$idprecios'";
				 $DB1->Execute($sql5);
				$rw5 = mysqli_fetch_row($DB1->Consulta_ID); 
				
				// @$preciokilo=$rw5[1];
				// @$precioadicional=$rw5[2];
				$valortad=$rw5[2];

			 }





		}

		$valortadicional=($rw1[19]+$rw1[18]-5)*$valortad;
		if($valortadicional<=0){
			$valortadicional=0;
		}

		// $valortkilo=$rw1[15]-$valortadicional;
		$sql2="SELECT `cli_ac`,`cli_au` FROM `clientesdir` WHERE `cli_idclientes`='$rw1[22]'";
		$DB1->Execute($sql2);
		$rw2=mysqli_fetch_row($DB1->Consulta_ID);

		$datosmc=explode("-",$rw1[24]);

		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		$direc1=str_replace("&"," ", $rw1[4]);
		$direct2=str_replace("&"," ", $rw1[7]);
		echo "<td>".$rw1[10]."</td>
		<td>".$rw1[11]."</td>
		<td>".$rw1[12]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$direc1."</td>
		<td>".$ciudadnombre."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		<td>".$direct2."</td>
		<td>".$rw1[8]."</td>
		<td>".$rw1[9]."</td>
		<td>$ ".$rw1[14]."</td>
		<td> ".$rw1[17]."</td>
		<td> ".$rw1[18]."</td>
		<td> ".$rw1[19]."</td>
		<td>$ ".$valortkilo."</td>
		<td>$ ".$valortad."</td>
		<td>$ ".$valortadicional."</td>
		<td>$ ".$rw1[20]."</td>
		<td>$ ".$pordeclarado."</td>
		<td>$ ".$totalflete."</td>
		<td> ".$rw1[16]."</td>
		<td> ".$rw2[0]."</td>
		<td> ".$rw2[1]."</td>
		<td> ".$valortservicio."</td>
		<td> ".$datosmc[0]."</td>
		<td> ".$datosmc[1]."</td>
		";

		echo "</tr>"; 
	}
	$retencion=$totalcontado*1/100;
	$reteica=$totalcontado*0.414/100;

	echo'<tr bgcolor="#F75700">
	<td width="10%"  class=""><div align="center" class="tittle2">Total Factura</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">'.$totalcontado.'</div></td>';
	echo "</tr>"; 
	echo'<tr bgcolor="#F75700">
	<td width="10%"  class=""><div align="center" class="tittle2">Retencion</div></td>

	<td width="10%"  class=""><div align="center" class="tittle2">'.$retencion.'</div></td>';
	echo "</tr>"; 
	echo'<tr bgcolor="#F75700">
	<td width="10%"  class=""><div align="center" class="tittle2">Reteica</div></td>
	<td width="10%"  class=""><div align="center" class="tittle2">'.$reteica.'</div></td>';
	echo "</tr>"; 
?>


</table>
