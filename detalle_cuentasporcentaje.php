<?php 
require("login_autentica.php"); 
include("cabezote3.php"); 

$FB->titulo_azul1("Cruce de cuentas sedes",9,0,5);  


$conde=" ";
$conde2=" ";
$conde3=" ";
if($param32!=''){ $fechaactual=$param32." 00:00:00";  }
if($param33!=''){ $fechainicial=$param33." 23:59:59";  }
if($param31!=''){ 
	$id_sedes=$param31; 
	$idcidades=ciudadesedes($param31,$DB);
	if($idcidades=='0'){
		$conde1="";

	}else {
	  $ciudades=$idcidades; 	
	}
} else {  

	$idcidades=ciudadesedes($id_sedes,$DB);
	if($idcidades=='0'){
		$ciudades="";

	}else {
	$ciudades=$idcidades; 	
	}

}


if($nivel_acceso==3) {
	
$conde3="and ser_idresponsable='$id_usuario'";	
	
}


$FB->cierra_form(); 


$FB->titulo_azul1("Sede",1,0,7); 
$FB->titulo_azul1("Entregas Contado",1,0,0); 
$FB->titulo_azul1("total ",1,0,0); 
$FB->titulo_azul1("total %",1,0,0); 
$FB->titulo_azul1("Entregas  Alcobro",1,0,0); 
$FB->titulo_azul1("total ",1,0,0); 
$FB->titulo_azul1("total %",1,0,0); 
$FB->titulo_azul1("Debe %",1,0,0); 
$FB->titulo_azul1("Entregas Credito ",1,0,0); 
$FB->titulo_azul1("total ",1,0,0); 
$FB->titulo_azul1("total %",1,0,0); 
 
$FB->titulo_azul1("Enviadas Contado",1,0,0); 
$FB->titulo_azul1("total ",1,0,0); 
$FB->titulo_azul1("total %",1,0,0); 
$FB->titulo_azul1("% Empresa",1,0,0);
$FB->titulo_azul1("Enviadas Alcobro",1,0,0); 
$FB->titulo_azul1("total ",1,0,0); 
$FB->titulo_azul1("total %",1,0,0); 
$FB->titulo_azul1("Saldo %",1,0,0); 
$FB->titulo_azul1("% Empresa",1,0,0);
$FB->titulo_azul1("Enviadas Credito ",1,0,0); 
$FB->titulo_azul1("total ",1,0,0); 
$FB->titulo_azul1("total %",1,0,0); 
$FB->titulo_azul1("% Empresa",1,0,0);

$FB->titulo_azul1("Cruce",1,0,0); 
$FB->titulo_azul1("Total",1,0,0); 

$conde1=""; 

$html="";

/*  echo '</table>
  <div id="contenedor" style="display:flex;height:415px; overflow: scroll;">
   <div id="segundo" style="width: 50%; float:left;">';

echo '<table class="table table-hover"><tr bgcolor="#868A08" class="tittle3"><td>Guias Entregadas en Sede</td></tr><tr><td>';
echo '</table></td></tr></table></div>
   <div id="tercero" style="width: 50%; float:left;">';

echo '<table class="table table-hover"><tr bgcolor="#04B404" class="tittle3"><td>Guias Enviadas a otras Sedes</td></tr><tr><td>';
echo '</table></td></tr></table></div>'; */

//guias enviadas a otras sedes para ser entregadas Enviadas Contado
 $sql1="SELECT inner_sedes,cue_tipoevento,count(idcuentaspromotor) as entregas,sum(cue_valorflete) as total,sum(cue_valorporcantaje) as porcentaje,sum(cue_valorporempresa) as porempresa FROM cuentaspromotor inner join ciudades on idciudades=cue_idciudadori where cue_estado in (10) and cue_fecha >= '$fechaactual' and  cue_fecha <= '$fechainicial' and cue_idciudaddes in  $ciudades  GROUP BY inner_sedes,cue_tipoevento ORDER BY cue_tipoevento,inner_sedes asc;";
$DB1->Execute($sql1); 
$entregadascontado=array();
while($rw=mysqli_fetch_row($DB1->Consulta_ID))
   {

	   $entregadascontado[$rw[0]][$rw[1]]['entregas']=$rw[2];
	   $entregadascontado[$rw[0]][$rw[1]]['total']=$rw[3];
	   $entregadascontado[$rw[0]][$rw[1]]['porcentaje']=$rw[4];
	   $entregadascontado[$rw[0]][$rw[1]]['porempresa']=$rw[5];

   }

//guias entregadas de otras sedes 
 $sql2="SELECT inner_sedes,cue_tipoevento,count(idcuentaspromotor) as enviadas,sum(cue_valorflete) as total,sum(cue_valorporcantaje) as porcentaje,sum(cue_valorporempresa) as porempresa  FROM cuentaspromotor inner join ciudades on idciudades=cue_idciudaddes where cue_estado in (10) and cue_fecha >= '$fechaactual' and  cue_fecha <= '$fechainicial' and cue_idciudadori  in $ciudades  GROUP BY inner_sedes,cue_tipoevento ORDER BY cue_tipoevento,inner_sedes asc ";
$DB1->Execute($sql2); 
$enviadas=array();
while($rw2=mysqli_fetch_row($DB1->Consulta_ID))
   {

	$enviadas[$rw2[0]][$rw2[1]]['enviadas']=$rw2[2];
	$enviadas[$rw2[0]][$rw2[1]]['total']=$rw2[3];
	$enviadas[$rw2[0]][$rw2[1]]['porcentaje']=$rw2[4];
	$enviadas[$rw2[0]][$rw2[1]]['porempresa']=$rw2[5];

   }

	$sql="SELECT idsedes,sed_nombre FROM  sedes where sed_principal='si' ";
	$DB->Execute($sql); 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
	
		$estado="";
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}	
		if($rw1[0]==$param31){ 
			$color="#b8ff88";
			
		}		
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		
		$debeentregas=$entregadascontado[$id_p]['3']['total']-$guiasxpagar[$id_p]['3']['porcentaje'];
		$cobrarenviadas=$enviadas[$id_p]['3']['total']-$enviadas[$id_p]['3']['porcentaje'];
		
		echo "<td>".$rw1[1]."</td>
		<td>".$entregadascontado[$id_p][1]['entregas']."</td>
		<td>".$entregadascontado[$id_p][1]['total']."</td>	
		<td>".$entregadascontado[$id_p][1]['porcentaje']."</td>	

		<td>".$entregadascontado[$id_p][3]['entregas']."</td>
		<td>".$entregadascontado[$id_p][3]['total']."</td>	
		<td>".$entregadascontado[$id_p][3]['porcentaje']."</td>	
		<td>".$debeentregas."</td>	

		<td>".$entregadascontado[$id_p][2]['entregas']."</td>
		<td>".$entregadascontado[$id_p][2]['total']."</td>	
		<td>".$entregadascontado[$id_p][2]['porcentaje']."</td>	
		<td>".$entregadascontado[$id_p][2]['porempresa']."</td>	

		<td>".$enviadas[$id_p][1]['entregas']."</td>
		<td>".$enviadas[$id_p][1]['total']."</td>	
		<td>".$enviadas[$id_p][1]['porcentaje']."</td>	

		<td>".$enviadas[$id_p][3]['entregas']."</td>
		<td>".$enviadas[$id_p][3]['total']."</td>	
		<td>".$enviadas[$id_p][3]['porcentaje']."</td>	
		<td>".$cobrarenviadas."</td>	

		<td>".$enviadas[$id_p][2]['entregas']."</td>
		<td>".$enviadas[$id_p][2]['total']."</td>	
		<td>".$enviadas[$id_p][2]['porcentaje']."</td>	
		";		
		echo "</tr>"; 

	}


include("footer.php");
?>