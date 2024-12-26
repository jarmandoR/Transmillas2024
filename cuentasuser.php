<?php 
require("login_autentica.php");
include("cabezote3.php"); 

$asc="ASC";
$conde=" ";
$conde2=" ";
$conde3=" ";
$conde4=" ";
$conde41=" ";

$fechaactual=$param34; 

if($param35!=''){ $id_sedes=$param35; 

	$conde4=" and usu_idsede=$id_sedes "; 	
	$conde41=" and abo_idsede=$id_sedes "; 	
	$conde42=" and asi_idciudad=$id_sedes "; 
	$conde43=" and gas_idciudadori=$id_sedes "; 
	$conde44=" and gas_idciudaddes=$id_sedes "; 

}


$FB->titulo_azul1("USUARIO",1,0,7); 
$FB->titulo_azul1("GUIAS",1,0,0); 
$FB->titulo_azul1("ABONOS",1,0,0); 
$FB->titulo_azul1("DINERO ASIGNADO",1,0,0); 
$FB->titulo_azul1("REMESAS",1,0,0); 
$FB->titulo_azul1("TRASPASOS",1,0,0); 
$FB->titulo_azul1("GASTOS",1,0,0); 
$FB->titulo_azul1("ENTREGO",1,0,0); 

$conde1=""; 
$conde3=""; 



/*  $sql1="SELECT COUNT(idservicios),ser_idresponsable FROM `servicios`  inner join usuarios on idusuarios=ser_idresponsable where ser_estado>=2 and ser_estado<=11 and ser_fechaasignacion like '$fechaactual%' $conde4  group by ser_idresponsable";
$DB->Execute($sql1);
$recogidas=array();  //
while($rw=mysqli_fetch_row($DB->Consulta_ID))
{
	$recogidas[$rw[1]]=$rw[0];
} */

 $sql2="SELECT COUNT(gui_idservicio),idusuarios FROM `guias`  inner join usuarios on usu_nombre=gui_recogio inner join servicios on idservicios=gui_idservicio where gui_fecharecogio   like  '$fechaactual%' and ser_estado!=100 $conde4 group by idusuarios ";
$DB->Execute($sql2);
$efectivasre=array();
$fechaultima=array();
//efectivas regogidas
while($rw2=mysqli_fetch_row($DB->Consulta_ID))
{
	$efectivasre[$rw2[1]]=$rw2[0];
}

/*  $sql3="SELECT COUNT(idservicios),ser_idusuarioguia FROM `servicios`  where ser_estado>=9 and ser_estado<=11 and ser_fechaguia like '$fechaactual%'  group by ser_idusuarioguia";
$DB->Execute($sql3);
$entregas=array();
//$llamadas=$DB1->recogedato(0);
while($rw3=mysqli_fetch_row($DB->Consulta_ID))
{
	$entregas[$rw3[1]]=$rw3[0];
} */


 $sql4="SELECT COUNT(gui_idservicio),idusuarios FROM `guias`  inner join usuarios on usu_nombre=gui_userecomienda where gui_fechaentrega  like  '$fechaactual%'  $conde4 group by idusuarios ";
$DB->Execute($sql4);
$efectivasent=array();
//entregasss
while($rw4=mysqli_fetch_row($DB->Consulta_ID))
{
	$efectivasent[$rw4[1]]=$rw4[0];
}

$sql5="SELECT COUNT(idabono),idusuarios FROM `abonosguias`  inner join usuarios on idusuarios=abo_iduser where abo_fecha  like  '$fechaactual%' and abo_estado='abono' $conde41 group by idusuarios ";
$DB->Execute($sql5);
$abonosuser=array();
//abonos
while($rw5=mysqli_fetch_row($DB->Consulta_ID))
{
	$abonosuser[$rw5[1]]=$rw5[0];
}

 $sql6="SELECT COUNT(idasignaciondinero),idusuarios,asi_tipo FROM `asignaciondinero`  inner join usuarios on idusuarios=asi_idpromotor where asi_fecha  like  '$fechaactual%'  $conde42 group by idusuarios,asi_tipo";
$DB->Execute($sql6);
$asignardinero=array();
$gastos=array();
$transpaso=array();
$entregado=array();
//abonos
while($rw6=mysqli_fetch_row($DB->Consulta_ID))
{
	$asignardinero[$rw6[1]][$rw6[2]]=$rw6[0];

}

$sql7="SELECT COUNT(idgastos),idusuarios FROM `gastos` inner join usuarios on gas_iduserremesa=idusuarios inner join sedes on idsedes=gas_idciudadori
WHERE idgastos>0 and gas_pagar='Sede Origen'  and   gas_fecharegistro  like  '$fechaactual%'  $conde43 group by idusuarios";
$DB->Execute($sql7);
$remesas=array();
//remesas entrega
while($rw7=mysqli_fetch_row($DB->Consulta_ID))
{
	$remesasori[$rw7[1]]=$rw7[0];
}

 $sql7="SELECT COUNT(idgastos),idusuarios FROM `gastos` inner join usuarios on gas_iduserrecoge=idusuarios inner join sedes on idsedes=gas_idciudaddes
WHERE idgastos>0 and gas_pagar='Sede Destino'  and   gas_fecrecogida  like  '$fechaactual%'  $conde44 group by idusuarios";
$DB->Execute($sql7);
$remesas=array();
//remesas sede recogida
while($rw7=mysqli_fetch_row($DB->Consulta_ID))
{
	$remesasentre[$rw7[1]]=$rw7[0];
}

 $sql="SELECT idusuarios,usu_nombre FROM `usuarios` inner join seguimiento_user on seg_idusuario=idusuarios where   (usu_estado=1 or usu_filtro=1) and seg_motivo='Ingreso' and seg_fechaalcohol='$fechaactual'  $conde  $conde2  $conde4 ORDER BY usu_nombre  asc ";

$DB->Execute($sql); 
$va=0; 
$totalasignadas=0;
$totalrecogidas=0;
$totalefectivasr=0;
$totalfaltantesr=0;
$totalentregas=0;
$totalefectivase=0;
$totalfaltantese=0;
$totalefectivas=0;
$asignadas1=0;
$recogidas1=0;
$efectivasr1=0;
$entregas1=0;
$efectivase1=0;

	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		
			
			//$direc1=str_replace("&"," ", $rw1[4]);
			@$efectivasr1=$efectivasre[$id_p];
			@$efectivase1=$efectivasent[$id_p];
			$guias=$efectivasr1+$efectivase1;
			@$abonos=$abonosuser[$id_p];
			 @$asignar=$asignardinero[$id_p]['Asignar Dinero'];
			@$gastos=$asignardinero[$id_p]['Gastos'];
			@$transpasodinero=$asignardinero[$id_p]['Transpaso Dinero'];
			@$entregado=$asignardinero[$id_p]['entregado'];
			@$remesa2=$remesasentre[$id_p];
			@$remesa1=$remesasori[$id_p];
			@$remesas=$remesa1+$remesa2;
			if($entregado!=''){
				$entregadoestado="SI";
				$color2="#FFFF33";
			}else{
				$entregadoestado="NO";
				$color2="#FF3C33";
			}

			if($guias>=1 or $abonos>=1 or $asignar>=1 or $transpasodinero>=1 or $gastos>=1){
				$va++; $p=$va%2;
				if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
				echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "<td>".$rw1[1]."</td>
				<td>".$guias."</td>
				<td>".$abonos."</td>
				<td>".$asignar."</td>
				<td>".$remesas."</td>
				<td>".$transpasodinero."</td>
				<td>".$gastos."</td>
				<td  bgcolor='$color2'>".$entregadoestado."</td>";
			}

	}
	


	$FB->titulo_azul1(" ------ ",1,0,10); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	/* $FB->titulo_azul1("$ $totalalcobro",1,0,0); 
	$FB->titulo_azul1("$ $totalprestamos",1,0,0);  */

include("footer.php");
?>