<?php
require("login_autentica.php"); 
include("layout.php");

$conde3="";
// $conde1="and usu_idsede='$param1'";  $conde1="and usu_idsede=$id_ciudad"; 
if(isset($_REQUEST["param1"])){ if($param1!=""){   $id_ciudad=$param1; } } else {$param1=""; }
if(isset($_REQUEST["param2"])){  if($param2!=""){ $conde1 ="and asi_idpromotor='$param2'";  $conde3="and cue_idoperador='$param2'";  }     } else {$param2="";  }
if($param4!=''){ $conde1.="and asi_fecha like '$param4%'"; $fechaactual=$param4;  }

$FB->titulo_azul1("Cuentas X Ciudades ",9,0,7);  
$FB->abre_form("form1","","post");

$conde1.=" and asi_fecha like '$fechaactual%'"; 
$conde3.=" and cue_fecha like '$fechaactual%'"; 
$conde="";
$conde="asi_fecha";
$conde2="and usu_idsede=$id_ciudad"; 

$fechainicio=date('Y-m-01');

$FB->llena_texto("Fecha de Final:", 4, 10, $DB, "", "", "$fechaactual", 1, 0);
$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM ciudades where inner_estados=1 )", "", "$id_ciudad", 4, 1);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
$FB->cierra_form(); 

//$FB->titulo_azul1("Ciudad",1,0,5); 
//$FB->titulo_azul1("Saldo Anteior",1,0,0); 
$FB->titulo_azul1("ENVIADAS",1,0,5); // las guias que ya se asignaron a las ciudades y que estan por cobrar
$FB->titulo_azul1("RECIBIDAS",1,0,0); // abonos hecos en las ciudades.
$FB->titulo_azul1("AL COBRO",1,0,0); //guias de contado.
$FB->titulo_azul1("CANCELADAS",1,0,0); 
$FB->titulo_azul1("PRESTAMOS",1,0,0); 
//$FB->titulo_azul1("Retiro Banco",1,0,0); 
//$FB->titulo_azul1("Gastos",1,0,0); 
//$FB->titulo_azul1("TOTAL",1,0,0); 

$totalasignacion=0;
$totalacompras=0;
$totalarecogidas=0;
$totalcompras=0;


  $sql="SELECT `idasignaciondinero`,`asi_fecha`,`asi_valor`,  `asi_idautoriza`, `asi_idpromotor` 
  FROM `asignaciondinero` WHERE idasignaciondinero>0  $conde1 ORDER BY $conde, $ord $asc";
$DB1->Execute($sql); $va=0;
$asignaciones=array();
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$va++;
	$asignaciones[$va]=number_format($rw1[2],0,".",".");
	$totalasignacion=$totalasignacion+$rw1[2];

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
$sql5="SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `idusuarios`='$param2' and   (usu_estado=1 or usu_filtro=1)";
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
	$totalarecogidas=number_format($totalarecogidas,0,".",".");;
	$totalcompras=number_format($totalcompras,0,".",".");;
	$totalaentregar=number_format($totalaentregar,0,".",".");;

$FB->titulo_azul1("_________",1,0,10); 
$FB->titulo_azul1("TOTALES:",1,0,0); 
$FB->titulo_azul1("$ $totalasignacion",1,0,0); 
$FB->titulo_azul1("$ $totalacompras",1,0,0); 
$FB->titulo_azul1("$ $totalcompras",1,0,0); 
$FB->titulo_azul1("$ $totalarecogidas",1,0,0); 

$FB->titulo_azul1("_________",1,0,10); 
$FB->titulo_azul1("_________",1,0,0); 
$FB->titulo_azul1("TOTAL",1,0,0); 
$FB->titulo_azul1("A",1,0,0); 
$FB->titulo_azul1("ENTREGAR:",1,0,0); 
$FB->titulo_azul1("$ $totalaentregar",1,0,0); 


include("footer.php"); ?>