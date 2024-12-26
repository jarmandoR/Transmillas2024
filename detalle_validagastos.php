<?php 
require("login_autentica.php");
include("cabezote3.php"); 
$nivel_acceso=$_SESSION['usuario_rol'];
$id_usuario=$_SESSION['usuario_id'];
$id_sedes=$_SESSION['usu_idsede'];

$conde1="";
$conde11="";
$conde10="";
$conde20="";
$conde30='';
//echo "jose".$param1;


if($param4!=''){ 
		$conde10.="and date(caj_feccom)>='$param5' and date(caj_feccom)<='$param4'";  
		$conde20.="and date(asi_fechaconf)>='$param5' and date(asi_fechaconf)<='$param4'";  
		$fechaactual=$param4;  
		$fechainicio=$param5;   
	 } 
else { 
		$conde10.=" and date(caj_feccom)>='$fechainicio' and date(caj_feccom)<='$fechaactual'"; 
		$conde20.="and date(asi_fechaconf)>='$fechainicio' and date(asi_fechaconf)<='$fechaactual'";  
	}	

	$cond50="and ( gas_pagar='Sede Origen' and  (date(gas_feccom)>='$fechainicio' and date(gas_feccom)<='$fechaactual'))  or ( gas_pagar='Sede Destino' and gas_nomvalida!='' and  (date(gas_fechavalida)>='$fechainicio' and date(gas_fechavalida)<='$fechaactual') ) ";

	if(isset($_REQUEST["param1"])){ if($param1!=""){  
		$id_sedes =$param1;
		$conde1 ="and (caj_idciudadori='$param1' or caj_idciudaddes='$param1') ";   
		$conde11="and usu_idsede='$param1'"; 
		$cond50="and (gas_idciudadori='$param1' and gas_pagar='Sede Origen' and  (date(gas_feccom)>='$fechainicio' and date(gas_feccom)<='$fechaactual'))  or (gas_idciudaddes='$param1' and gas_pagar='Sede Destino' and gas_nomvalida!='' and  (date(gas_fechavalida)>='$fechainicio' and date(gas_fechavalida)<='$fechaactual') ) ";
	
		} 
	} 
	else {
		$param1="";  $conde1 =" ";
		 $conde11=""; 

		 }
		 //echo $param3;
			 if($param3=='1'){
				$cond3=" and asi_idvalidaf!=''";
				$cond31=" and caj_idvalidaf!=''";
				$cond41=" and gas_idvalidaf!=''";
			 }elseif($param3=='2'){
				$cond3=" and asi_idvalidaf<='0'";
				$cond31=" and caj_idvalidaf<='0'";
				$cond41=" and gas_idvalidaf<='0'";
			 }else{
				$cond3='';
				$cond31='';
				$cond41=''; 
			 }


$sql1="SELECT `idasignaciondinero`,asi_idciudad as idciudad,`asi_fechaconf`,'Operador'  as tipgasto,usu_nombre, cla_nombre, tipo_nombre,`asi_valorcom`,asi_descripcion as descripcion, 'asignaciondinero' as tabla, asi_idvalidaf as valida   FROM `asignaciondinero` inner join usuarios on asi_idpromotor=idusuarios inner join tipo_gastos on idtipo_gastos=asi_idgastos inner join clasificacion_gastos on idclasificacion_gastos=inner_clasificacion_gastos WHERE idasignaciondinero>0 and asi_valorcom>0 and asi_tipo in ('Gastos') and asi_usercom IS NOT NULL $conde20 $conde11 $cond3  ";
$sql2="SELECT `idcajamenor`,caj_idciudadori as idciudad, `caj_feccom`,'Sede'  as tipgasto, usu_nombre,cla_nombre, tipo_nombre, `caj_cantcom`,caj_descripcion as descripcion, 'cajamenor' as tabla, caj_idvalidaf as valida  FROM `cajamenor` inner join usuarios on caj_idusuario=idusuarios inner join sedes on idsedes=caj_idciudaddes inner join tipo_gastos on idtipo_gastos=caj_idgastos inner join clasificacion_gastos on idclasificacion_gastos=inner_clasificacion_gastos WHERE idcajamenor>0 and caj_cantcom>0 and  caj_tipotransacion in ('Gastos') and  caj_usucom!='' $conde10 $conde1 $cond31 ";


$sql=$sql1." UNION ".$sql2;


 //	echo $sql;
 $html='';
$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		$valor=number_format($rw1[7],0,".",".");
		$sql2="SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes='$rw1[1]'";
		$DB->Execute($sql2);
		$rw2=mysqli_fetch_row($DB->Consulta_ID);

		$html.= "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		$html.= "<td>".$rw2[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		<td>".$rw1[8]."</td>
		";
		if($rw1[3]=='Operador'){
			$html.=$LT->llenadocs3($DB, "asignaciondinero", $id_p, 1, 35, $valor);

		}else if($rw1[3]=='Sede'){
			$html.=$LT->llenadocs3($DB, "cajamenor", $id_p, 1, 35, $valor);

		}

		$descrip=$id_p."_$rw1[9]";
		$html.= "<td><div id='campo$va'>";
		if($rw1[10]!=""){ $st="SI"; $colorfondo="#074f91";  } else { $st="Selecccione..."; $colorfondo="#941727"; } 
		$html.= " <select  style='width:120px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:15px'  name='$va' id='$va'   onChange='cambio_ajax2(this.value,78, \"campo$va\", \"$va\", 1, \"$descrip\")'    class='borrar' required>";
		$html.=$LT->llenaselect_re($st,$estados);
		$html.="</select></div></td>";

	$total=$rw1[7]+$total;
	$html.= "</tr>";
}

 $sql="SELECT idgastos,`gas_fecharegistro`,gas_feccom ,`gas_fecrecogida`,`gas_idciudadori`,`sed_nombre`,`gas_bus`,`gas_pagar`,`gas_nomremesa`,gas_iduserrecoge,gas_cantcom,gas_idvalidaf FROM `gastos` inner join usuarios on gas_idusuario=idusuarios and gas_cantcom>0 inner join sedes on idsedes=gas_idciudaddes
WHERE idgastos>0 $cond50 $cond41 ORDER BY idgastos";
$html3="";
$DB1->Execute($sql); 
$sumatotal=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	
	$html3.="<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	$html3.="<td>".$rw1[0]."</td>";
	if($rw1[7]=='Sede Origen'){
		$html3.="<td>".$rw1[2]."</td>";
	}elseif($rw1[7]=='Sede Destino'){
		$html3.="<td>".$rw1[3]."</td>";
	}
	$sql2="SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes='$rw1[4]'";
	$DB->Execute($sql2);
	$rw=mysqli_fetch_row($DB->Consulta_ID);

	$sql5="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$rw1[9]' ";
	$DB->Execute($sql5);
	$nombreuser=$DB->recogedato(1);

	$html3.= "	<td>".$rw[1]."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[7]."</td>
		<td>".$rw1[8]." /
		".$nombreuser."</td>
		";

		$html3.=$LT->llenadocs3($DB, "gastos", $id_p, 1, 35, $rw1[10]);

		$descrip=$id_p."_gastos";
		$html3.= "<td><div id='campo$va'>";
		if($rw1[11]!=""){ $st="SI"; $colorfondo="#074f91";  } else { $st="Selecccione..."; $colorfondo="#941727"; } 
		$html3.= "<select  style='width:120px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:15px'  name='$va' id='$va'   onChange='cambio_ajax2(this.value,78, \"campo$va\", \"$va\", 1, \"$descrip\")'    class='borrar' required>";
		$html3.=$LT->llenaselect_re($st,$estados);
		$html3.="</select></div></td>";

		$rw1[10]=str_replace(".","", $rw1[10]);
		$sumatotal=$rw1[10]+$sumatotal;
		$html3.="</tr>";
}

$total=number_format($total,0,".",".");
$total=$total+$sumatotal;
?>

<?php
$FB->titulo_azul1("Sede",1,0,5); 
$FB->titulo_azul1("Fecha",1,0,0); 
$FB->titulo_azul1("Tipo Gasto",1,0,0); 
$FB->titulo_azul1("Operador",1,0,0); 
$FB->titulo_azul1("Clasificacion",1,0,0); 
$FB->titulo_azul1("Gasto",1,0,0); 
$FB->titulo_azul1("Descripcion",1,0,0); 
$FB->titulo_azul1("Valor",1,0,0); 
$FB->titulo_azul1("Validar",1,0,0); 
echo $html;

$FB->titulo_azul1("ID",1,0,5); 
$FB->titulo_azul1("Fecha",1,0,0); 
$FB->titulo_azul1("Sede Origen",1,0,0); 
$FB->titulo_azul1("Sede Destino",1,0,0); 
$FB->titulo_azul1("Pago en?",1,0,0); 
$FB->titulo_azul1("Operario Remesa / Recoge ",1,0,0); 
$FB->titulo_azul1("Valor Aprobado",1,0,0); 
$FB->titulo_azul1("Validar",1,0,0); 
echo $html3;
?>

<table class="table table-hover">
<tr bgcolor="#074F91" class="tittle3">
<td width="10%"  class=""><div align="center" class="tittle2">Total:</div></td>
<td width="10%"  class=""><div align="center" class="tittle2">$ <?php echo $total;?></div></td>
</tr>
</table>
