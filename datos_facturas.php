
<?php

// $ver=$_REQUEST["ver"];
// if ($ver=="si") {

// }else {
// 	header('Content-type: application/vnd.ms-excel; charset=utf-8');
// header("Content-Disposition: attachment; filename=reporte_creditos.xls;  charset=utf-8");
// header("Pragma: no-cache");
// header("Expires: 0");    
// }
 
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

     <?php	
$datos = [];
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

        $sqlrecogida="SELECT ima_ruta,ima_tipo,idimagenguias from imagenguias where ima_tipo='Entrega' and  ima_idservicio=$id_p ";
        $DB1->Execute($sqlrecogida); 
        $guiasi=mysqli_fetch_row($DB1->Consulta_ID);
        $foto=$guiasi[0];



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
			if($$valortservicio==''){
				$valortservicio='NORMAL';
			}

			$sql3="SELECT `pre_preciokilo`,`pre_precioadicional` FROM `precios_credito` left join creditos on pre_idcredito=idcreditos WHERE `pre_idciudadori`='$rw1[13]'  and `pre_idciudades`='$rw1[23]' and pre_tiposervicio='$rw3[3]' and cre_nombre='$rw1[21]' ";

			
			$DB1->Execute($sql3);
			$rw2=mysqli_fetch_row($DB1->Consulta_ID); 
		 
			$valortkilo=$rw2[0];
			$valortad=$rw2[1];
			







			

		}

	

		$valortadicional=($rw1[19]+$rw1[18]-5)*$valortad;
		if($valortadicional<=0){
			$valortadicional=0;
		}


		$sql2="SELECT `cli_ac`,`cli_au` FROM `clientesdir` WHERE `cli_idclientes`='$rw1[22]'";
		$DB1->Execute($sql2);
		$rw2=mysqli_fetch_row($DB1->Consulta_ID);

		$datosmc=explode("-",$rw1[24]);

		
		$direc1=str_replace("&"," ", $rw1[4]);
		$direct2=str_replace("&"," ", $rw1[7]);


		
		// if ($ver=="si") {


        //     $linkfoto="https://sistema.transmillas.com/editarImg.php?img=".$foto."";
		// }else{

			
            $linkfoto="https://sistema.transmillas.com/".$foto."";

		// }
		$fechrec = "SELECT `idguias`, `gui_fechaentrega` FROM `guias` WHERE  `gui_idservicio`=$id_p";
		$DB1->Execute($fechrec);
		$fech=mysqli_fetch_row($DB1->Consulta_ID);

        $datos[] = [$rw1[10], $rw1[11], $rw1[12],$rw1[2],$rw1[3],$direc1,$ciudadnombre,$rw1[5],$rw1[6],$direct2,$rw1[8],$rw1[9],$rw1[14],$rw1[17],$rw1[18],$rw1[19],$valortkilo,$valortad,$valortadicional,$rw1[20],$pordeclarado,$totalflete,$rw1[16],$rw2[0],$rw2[1],$valortservicio,$datosmc[0],$datosmc[1],$linkfoto,$fech[1]];
	}
    $retencion=$totalcontado*1/100;
	$reteica=$totalcontado*0.414/100;
	// echo'<tr bgcolor="#F75700">
	// <td width="10%"  class=""><div align="center" class="tittle2">Total Factura</div></td>
	// <td width="10%"  class=""><div align="center" class="tittle2">'.$totalcontado.'</div></td>';
	// echo "</tr>"; 
	// echo'<tr bgcolor="#F75700">
	// <td width="10%"  class=""><div align="center" class="tittle2">Retencion</div></td>

	// <td width="10%"  class=""><div align="center" class="tittle2">'.$retencion.'</div></td>';
	// echo "</tr>"; 
	// echo'<tr bgcolor="#F75700">
	// <td width="10%"  class=""><div align="center" class="tittle2">Reteica</div></td>
	// <td width="10%"  class=""><div align="center" class="tittle2">'.$reteica.'</div></td>';
	// echo "</tr>"; 
    $datos[] = ['Total Factura', $totalcontado];
    $datos[] = ['Retencion', $retencion];
    $datos[] = ['Reteica', $reteica];


    // Retorna los datos en formato JSON
echo json_encode($datos);

// Cierra la conexión

?>


