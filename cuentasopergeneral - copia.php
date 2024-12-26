<?php
require("login_autentica.php"); 
include("layout.php");

$conde3="";
// $conde1="and ciudades_idciudades='$param1'";  $conde1="and ciudades_idciudades=$id_ciudad"; 
if(isset($_REQUEST["param1"])){ if($param1!=""){   $id_ciudad=$param1; } } else {$param1=""; }
if(isset($_REQUEST["param2"])){  if($param2!=""){ $conde1 ="and asi_idpromotor='$param2'";  $conde3="and cue_idoperador='$param2'";  }     } else {$param2="";  }
if($param4!=''){ $conde1.="and asi_fecha like '$param4%'"; $fechaactual=$param4;  }

$FB->titulo_azul1("Cuetas Operador ",9,0,7);  
$FB->abre_form("form1","","post");

$conde1.=" and asi_fecha like '$fechaactual%'"; 
$conde3.=" and cue_fecha like '$fechaactual%'"; 
$conde="";
$conde="asi_fecha";
$conde2="and ciudades_idciudades=$id_ciudad"; 



$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM ciudades where inner_estados=1 )", "cambio4(\"param2\",\"param1\",\"cuentasoper.php\")", "$id_ciudad", 1, 1);
$FB->llena_texto("Fecha de Busqueda:", 4, 10, $DB, "", "", "$fechaactual", 4, 0);
$FB->llena_texto("Operario:",2,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `roles_idroles`=3  and   (usu_estado=1 or usu_filtro=1) $conde2", "", $param2, 1, 1);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
$FB->cierra_form(); 


$FB->titulo_azul1("Fecha",1,0,5); 
$FB->titulo_azul1("Operador",1,0,0); 
$FB->titulo_azul1("Valor Asignado",1,0,0); 
$FB->titulo_azul1("Compras",1,0,0); 
$FB->titulo_azul1("Valor Recogidas",1,0,0); 
$FB->titulo_azul1("Valor Entregas",1,0,0); 

$totalasignacion=0;
$totalacompras=0;
$totalarecogidas=0;
$totalcompras=0;


  $sql="SELECT `idasignaciondinero`,`asi_fecha`,`asi_valor`,  `asi_idautoriza`, `asi_idpromotor` ,asi_tipo
  FROM `asignaciondinero` WHERE idasignaciondinero>0  $conde1 ORDER BY $conde, $ord $asc";
$DB1->Execute($sql); $va=0;
$asignaciones=array();
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	
	
	if($rw1[5]=='asignado'){
	$va++;
	$asignaciones[$va]=number_format($rw1[2],0,".",".");	
	$totalasignacion=$totalasignacion+$rw1[2];
	}else if($rw1[5]=='entregado') {
		$dineroentregado=number_format($rw1[2],0,".",".");
	}
}


  $sql1="SELECT `idcuentaspromotor`, `cue_idservicio`, `cue_idoperador`, `cue_porprestamo`, `cue_prestamo`, `cue_pordeclarado`, `cue_vrdeclarado`, `cue_valorflete`, `cue_abono`, `cue_tipopago`, `cue_fecha`, `cue_pendientecobrar` 
 FROM `cuentaspromotor` WHERE cue_pendientecobrar=0 $conde3";
$DB->Execute($sql1);
$compras=array();
$recogidas=array();
$entregas=array();
$va2=0;
$va3=0;
$va4=0;
while($rw2=mysqli_fetch_row($DB->Consulta_ID))
{
	
	
	if($rw2[9]=='Compra'){
		$va2++;
		$compras[$va2]=number_format($rw2[4],0,".",".");		
		$totalacompras=$totalacompras+$rw2[4];
		
	}else if($rw2[9]=='Recogida'){
		$valorecogidas=$rw2[7]+$rw2[5];
		$va3++;
		$recogidas[$va3]=number_format($valorecogidas,0,".",".");
		$totalarecogidas=$totalarecogidas+$valorecogidas;
	}else if($rw2[9]=='Entrega'){
		$valorentrega=$rw2[7]+$rw2[5]+$rw2[3]+$rw2[4]-$rw2[8];
		$va4++;
		$entregas[$va4]=number_format($valorentrega,0,".",".");
		$totalcompras=$totalcompras+$valorentrega;
	}
	
	
}  

$mayor=max($va, $va2, $va3);
$sql5="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$param2' and  (usu_estado=1 or usu_filtro=1)";
$DB->Execute($sql5);
$nompromotor=$DB->recogedato(1);
$va4=0;

for($a=1;$a<=$mayor;$a++){
	

	$va4++; $p=$va4%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	
	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	
	
	echo "<td>".$fechaactual."</td>
		<td>".$nompromotor."</td>
		<td>$ ".@$asignaciones[$va4]."</td>
		<td>$ ".@$compras[$va4]."</td>
		<td>$ ".@$recogidas[$va4]."</td>
		";


	echo "</tr>";
	

	
}

	$totalaentregar=$totalasignacion+$totalarecogidas-$totalacompras+$totalcompras;
	$totalasignacion=number_format($totalasignacion,0,".",".");
	$totalacompras=number_format($totalacompras,0,".",".");
	$totalarecogidas=number_format($totalarecogidas,0,".",".");
	$totalcompras=number_format($totalcompras,0,".",".");;



	
	
$FB->titulo_azul1("_________",1,0,10); 
$FB->titulo_azul1("TOTALES:",1,0,0); 
$FB->titulo_azul1("$ $totalasignacion",1,0,0); 
$FB->titulo_azul1("$ $totalacompras",1,0,0); 
$FB->titulo_azul1("$ $totalcompras",1,0,0); 
$FB->titulo_azul1("$ $totalarecogidas",1,0,0); 

$slqs="SELECT max(`iddeudapromotor`),`deu_valor` FROM `duedapromotor` WHERE `deu_fecha`<'$param4' and deu_idpromotot='$param2' order by `deu_fecha` ";
$DB1->Execute($slqs); 
$saldopendiente=$DB1->recogedato(1);
$valorenviar=$saldopendiente+$totalaentregar;
$totalaentregar=number_format($totalaentregar,0,".",".");

$FB->titulo_azul1("_________",1,0,10); 
$FB->titulo_azul1("_________",1,0,0); 
$FB->titulo_azul1("TOTAL",1,0,0); 
$FB->titulo_azul1("A",1,0,0); 
$FB->titulo_azul1("ENTREGAR:",1,0,0); 
$FB->titulo_azul1("$ $totalaentregar",1,0,0); 

$FB->titulo_azul1("",1,0,1); 




$FB->titulo_azul1("Entregar",1,0,0); 
$FB->titulo_azul1("saldo",1,0,0); 
$FB->titulo_azul1("dia",1,0,0); 
$FB->titulo_azul1("<a onclick='pop_dis25($param2,\"Entregar valor\",$id_ciudad,$valorenviar)';  style='cursor: pointer;' title='Entregar valor' ><img src='img/usar.png'></a>", 1,0,0); 

$FB->titulo_azul1("_________",1,0,10); 
$FB->titulo_azul1("_________",1,0,0); 
$FB->titulo_azul1("_________",1,0,0); 
$FB->titulo_azul1("SALDO",1,0,0); 
$FB->titulo_azul1("PENDIENTE:",1,0,0); 
$FB->titulo_azul1("$ $saldopendiente",1,0,0); 

$slq22="SELECT asi_valor FROM `asignaciondinero` WHERE `asi_fecha`='$param4' and `asi_idpromotor`='$param2' and asi_tipo='entregado'";
$DB1->Execute($slq22); 
 $dineroentregado=$DB1->recogedato(0);
$totaldeuda=$valorenviar-$dineroentregado;
$dineroentregado=number_format($dineroentregado,0,".",".");
$FB->titulo_azul1("_________",1,0,10); 
$FB->titulo_azul1("_________",1,0,0); 
$FB->titulo_azul1("_________",1,0,0); 
$FB->titulo_azul1("VALOR",1,0,0); 
$FB->titulo_azul1("ENTREGADO:",1,0,0); 
$FB->titulo_azul1("$ $dineroentregado",1,0,0); 


$totaldeuda=number_format($totaldeuda,0,".",".");
$FB->titulo_azul1("_________",1,0,10); 
$FB->titulo_azul1("TOTAL",1,0,0); 
$FB->titulo_azul1("DEUDA ",1,0,0); 
$FB->titulo_azul1("PROMOTOR:",1,0,0); 
$FB->titulo_azul1("",1,0,0); 
$FB->titulo_azul1("$ $totaldeuda",1,0,0); 

include("footer.php"); ?>