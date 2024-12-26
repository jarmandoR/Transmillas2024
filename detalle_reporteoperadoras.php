<?php 
require("login_autentica.php");
include("cabezote3.php"); 

$asc="ASC";
$conde=" ";
$conde2=" ";
$conde3=" ";
$conde4=" ";
if($param34!=''){ $fechaactual=$param34." 00:00:00";  }
if($param36!=''){ $fechainicial=$param36." 23:59:59";  }
if($param33!=''){ $conde="and `idusuarios`= '$param33' ";  
}
if($param35!=''){ $id_sedes=$param35; 

	$conde4=" and usu_idsede=$id_sedes "; 	
}


if($param38!='' and $param38!='0' ){
	if($param38=='Oficina'){

		$conde2="and roles_idroles in (2,5) ";
	} elseif($param38=='Moto'){
		$conde2="and roles_idroles in (3)  and usu_tipovehiculo='Moto'";
	} elseif($param38=='Carro'){
		$conde2="and roles_idroles in (3)  and usu_tipovehiculo='Carro'";
	}
	
	
}else{
	$conde2="and roles_idroles in (2,3,5) ";
}
	
$FB->titulo_azul1("Operador ",1,0,7); 
$FB->titulo_azul1("LLamadas Recibidas",1,0,0); 
$FB->titulo_azul1("LLamadas Confirmadas",1,0,0); 
$FB->titulo_azul1("LLamadas Validadas",1,0,0); 
$FB->titulo_azul1("Servicios Existosos",1,0,0); 
$FB->titulo_azul1("Servicios Faltantes",1,0,0); 
$FB->titulo_azul1("Total Evaluacion",1,0,0); 


$conde1=""; 
$conde3=""; 


 $sql2="SELECT COUNT(gui_idservicio),gui_idusuario FROM `guias` where gui_fechacreacion BETWEEN '$fechaactual' and '$fechainicial' group by gui_idusuario";
$DB->Execute($sql2);
$llamadas=array();
//$llamadas=$DB1->recogedato(0);
while($rw=mysqli_fetch_row($DB->Consulta_ID))
{
	$llamadas[$rw[1]]=$rw[0];
}

//echo $sql4="SELECT `llam_numero`,`llam_idusuario` FROM `llamadasvalidadas` where llam_fecha BETWEEN '$fechaactual' and '$fechainicial' group by llam_idusuario ";
$sql4="SELECT llam_numero,llam_idusuario FROM `llamadasvalidadas` WHERE  llam_fecha BETWEEN '$fechaactual' and '$fechainicial'  ";

$DB->Execute($sql4);
//$llamadasver=$DB1->recogedato(0);
$llamadasver=array();
while($rw3=mysqli_fetch_row($DB->Consulta_ID))
{
	$llamadasver[$rw3[1]]=$rw3[0];
}

// $sql5="SELECT llam_numero,llam_idusuario FROM `llamadasvalidadas` WHERE gui_usurecogida!='' and  llam_fecha BETWEEN '$fechaactual' and '$fechainicial'  ";
 $sql5="SELECT COUNT(gui_idservicio),gui_idusuario FROM `guias` where gui_recogio!='' and gui_fechacreacion BETWEEN '$fechaactual' and '$fechainicial' group by gui_idusuario";

$DB->Execute($sql5);
$llamadasexitosas=array();
while($rw5=mysqli_fetch_row($DB->Consulta_ID))
{
	$llamadasexitosas[$rw5[1]]=$rw5[0];
}

 $sql3="SELECT COUNT(gui_idservicio),idusuarios FROM `guias`  inner join usuarios on usu_nombre=gui_usuvalida where gui_fechavalidacion  BETWEEN '$fechaactual' and '$fechainicial' $conde2  $conde4 group by idusuarios ";
$DB->Execute($sql3);
$llamadascon=array();
//$llamadascon=$DB1->recogedato(0);
while($rw2=mysqli_fetch_row($DB->Consulta_ID))
{
	$llamadascon[$rw2[1]]=$rw2[0];
}

  $sql="SELECT idusuarios,usu_nombre FROM `usuarios` where  (usu_estado=1 or usu_filtro=1) $conde  $conde2  $conde4 ORDER BY usu_nombre  asc ";

$DB->Execute($sql); 
$va=0; 
$totalllamadas=0;
$totalllamadascon=0;
$totalllamadasver=0;
$totalllamadasexistosas=0;
$totalllamadasfallidas=0;
$llamadas1=0;
$llamadascon1=0;
$llamadasver1=0;
$llamadasexitosas1=0;

	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		//$direc1=str_replace("&"," ", $rw1[4]);
		//$direct2=str_replace("&"," ", $rw1[7]);
		$rw1[1]=utf8_encode($rw1[1]);
/* 		 $sql2="SELECT COUNT(gui_idservicio) FROM `guias` where gui_fechacreacion BETWEEN '$fechaactual' and '$fechainicial' and gui_idusuario='$rw1[0]' ";
		$DB1->Execute($sql2);
		$llamadas=$DB1->recogedato(0);

		 $sql3="SELECT COUNT(gui_idservicio) FROM `guias`  inner join usuarios on usu_nombre=gui_usuvalida where idusuarios='$rw1[0]' and gui_fechacreacion  BETWEEN '$fechaactual' and '$fechainicial' ";
		$DB1->Execute($sql3);
		$llamadascon=$DB1->recogedato(0); 

	 	$sql4="SELECT llam_numero FROM `llamadasvalidadas` where llam_idusuario='$rw1[0]' and llam_fecha BETWEEN '$fechaactual' and '$fechainicial' ";
		$DB1->Execute($sql4);
		$llamadasver=$DB1->recogedato(0); */


		$llamadasexistosas=0;
		$llamadasfallidas=0;
		@$llamadas1=$llamadas[$id_p];
		@$llamadascon1=$llamadascon[$id_p];
		@$llamadasver1=$llamadasver[$id_p];
		@$llamadasexitosas1=$llamadasexitosas[$id_p];
		$llamadasfallidas=$llamadascon1-$llamadasexitosas1;
		$totalevaluacion=$llamadas1+$llamadascon1+$llamadasver1+$llamadasexistosas;
		echo "<td>".$rw1[1]."</td>
		<td>".$llamadas1."</td>
		<td>".$llamadascon1."</td>
		<td>".$llamadasver1."</td>
		<td>".$llamadasexitosas1."</td>
		<td>".$llamadasfallidas."</td>
		<td>".$totalevaluacion."</td>
		";


		$totalllamadas=$llamadas1+$totalllamadas;
		$totalllamadascon=$llamadascon1+$totalllamadascon;
		$totalllamadasver=$llamadasver1+$totalllamadasver;
		$totalllamadasexistosas=$llamadasexistosas+$totalllamadasexistosas;
		$totalllamadasfallidas=$llamadasfallidas+$totalllamadasfallidas;


	}
	


	$FB->titulo_azul1(" Totales :",1,0,10); 
	$FB->titulo_azul1(" $totalllamadas",1,0,0); 
	$FB->titulo_azul1(" $totalllamadascon",1,0,0); 
	$FB->titulo_azul1(" $totalllamadasver",1,0,0); 
	$FB->titulo_azul1(" $totalllamadasexistosas",1,0,0); 
	$FB->titulo_azul1(" $totalllamadasfallidas",1,0,0); 
	$FB->titulo_azul1(" ------",1,0,0); 
	/* $FB->titulo_azul1("$ $totalalcobro",1,0,0); 
	$FB->titulo_azul1("$ $totalprestamos",1,0,0);  */

	//echo "<tr><td align='center' > </td>"; echo "</tr>"; 

include("footer.php");
?>