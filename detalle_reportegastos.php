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
if(isset($_REQUEST["param1"])){ if($param1!=""){  
	$id_sedes =$param1;
	$conde1 ="and (caj_idciudadori='$param1' or caj_idciudaddes='$param1') ";   
	$conde11="and usu_idsede='$param1'"; 
	} 
} 
else {
	$param1="";  $conde1 =" ";
	 $conde11=""; 
	 }

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

if($param2!=0){
	$conde30='and inner_clasificacion_gastos='.$param2;
}

if($param6=="" or $param6=="0"){
	$conde40='';
}else{
	$conde40='and idtipo_gastos='.$param6;
}

if($param7=="" or $param7=="0"){
	$conde50='';
}else{
	$conde50='and asi_idpromotor='.$param7;
	$conde5='and caj_idusuario='.$param7;
}

$sql1="SELECT `idasignaciondinero`,asi_idciudad as idciudad,`asi_fechaconf`,'Operador'  as tipgasto,usu_nombre, cla_nombre, tipo_nombre,`asi_valorcom`,asi_descripcion as descripcion FROM `asignaciondinero` inner join usuarios on asi_idpromotor=idusuarios inner join tipo_gastos on idtipo_gastos=asi_idgastos inner join clasificacion_gastos on idclasificacion_gastos=inner_clasificacion_gastos WHERE idasignaciondinero>0 and asi_tipo in ('Gastos') and asi_usercom IS NOT NULL $conde20 $conde11 $conde30 $conde40 $conde50";
$sql2="SELECT `idcajamenor`,caj_idciudadori as idciudad, `caj_feccom`,'Sede'  as tipgasto, usu_nombre,cla_nombre, tipo_nombre, `caj_cantcom`,caj_descripcion as descripcion FROM `cajamenor` inner join usuarios on caj_idusuario=idusuarios inner join sedes on idsedes=caj_idciudaddes inner join tipo_gastos on idtipo_gastos=caj_idgastos inner join clasificacion_gastos on idclasificacion_gastos=inner_clasificacion_gastos WHERE idcajamenor>0 and  caj_tipotransacion in ('Gastos') and  caj_usucom!='' $conde10 $conde1 $conde30 $conde40 $conde5";


 if($param3==0){
	$sql=$sql1." UNION ".$sql2;
 }else if($param3==1){
	$sql=$sql1;
 }else if($param3==2){
	$sql=$sql2;
 }

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

	$total=$rw1[7]+$total;
	$html.= "</tr>";
}
$total=number_format($total,0,".",".");
?>
<table class="table table-hover">
<tr bgcolor="#074F91" class="tittle3">
<td width="10%"  class=""><div align="center" class="tittle2">Total:</div></td>
<td width="10%"  class=""><div align="center" class="tittle2">$ <?php echo $total;?></div></td>
</tr>
</table>
<?php
$FB->titulo_azul1("Sede",1,0,5); 
$FB->titulo_azul1("Fecha",1,0,0); 
$FB->titulo_azul1("Tipo Gasto",1,0,0); 
$FB->titulo_azul1("Operador",1,0,0); 
$FB->titulo_azul1("Clasificacion",1,0,0); 
$FB->titulo_azul1("Gasto",1,0,0); 
$FB->titulo_azul1("Descripcion",1,0,0); 
$FB->titulo_azul1("Valor",1,0,0); 
echo $html;
?>

<table class="table table-hover">
<tr bgcolor="#074F91" class="tittle3">
<td width="10%"  class=""><div align="center" class="tittle2">Total:</div></td>
<td width="10%"  class=""><div align="center" class="tittle2">$ <?php echo $total;?></div></td>
</tr>
</table>
