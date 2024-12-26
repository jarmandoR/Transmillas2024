<?php 
require("login_autentica.php");
include("cabezote3.php"); 
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$asc="ASC";
$conde1=""; 
$conde3=""; 
$opcion=$_REQUEST["preguia"];

if($param4!=''){  $fechainicio=$param4;}
if($param5!=''){  $fechaactual=$param5;}

/* if($param2!="" and $param1!=""){ 
 $conde1="and $param1 like '%$param2%' "; 
  }else { $conde1="  "; }  */

if($param1==""){ $param1="ser_prioridad"; } 
//if($param3!=''){ $conde3 =" and (cli_nombre like '%$param3%' or ser_destinatario like '%$param3%')";  }
if($param3!=''){ $conde3 =" and (rel_nom_credito like '%$param3%')";  }

if($param6=='Sin Facturar'){
	$conde4=' and ser_numerofactura is null';
}elseif($param6=='Facturados'){
	$conde4=' and ser_numerofactura>=1';
}else{
	$conde4='';	
}


 $sql2="SELECT `idservicios`,rel_nom_credito,COUNT(idservicios),ser_numerofactura,fac_userradicado,fac_userpago  
FROM  servicios s inner join rel_sercli  on idservicios=ser_idservicio 
inner join clientesservicios on idclientesdir=ser_idclientes inner join ciudades on idciudades=cli_idciudad   inner join rel_sercre rs on rs.idservicio=idservicios  left join facturascreditos on fac_numeroref=ser_numerofactura 
where date(ser_fecharegistro)>='$fechainicio' and  date(ser_fecharegistro)<='$fechaactual' and ser_clasificacion=2 and ser_estado>=3 and ser_estado!=100 and (ser_numerofactura is not null or ser_numerofactura!='' )  $conde1 $conde2 $conde3  $conde4 GROUP BY rel_nom_credito,ser_numerofactura ORDER BY rel_nom_credito $asc ";

$DB1->Execute($sql2); $va=0; 
$sinfacturar=array();
$facturasclientes=array();
$radicado=array();
$pagado=array();

$datos=$fechainicio."|".$fechaactual."|".$param3."|".$param6;

while($rw2=mysqli_fetch_row($DB1->Consulta_ID))
{

	$facturar[$rw2[1]]=$rw2[2]+@$facturar[$rw2[1]];
	$facturasclientes[$rw2[1]][$rw2[3]]=$rw2[2];
	if($rw2[4]!=null and $rw2[4]!=''){
		$radicado[$rw2[1]]=$rw2[2]+@$radicado[$rw2[1]];
	}

	if($rw2[5] != "" and $rw2[5] !=null){
	 	$pagado[$rw2[1]]=$rw2[2]+@$pagado[$rw2[1]];
	}

}

$sql="SELECT `idservicios`,rel_nom_credito,COUNT(idservicios)
 FROM  servicios s inner join rel_sercli  on idservicios=ser_idservicio 
inner join clientesservicios on idclientesdir=ser_idclientes inner join ciudades on idciudades=cli_idciudad   inner join rel_sercre rs on rs.idservicio=idservicios
 where date(ser_fecharegistro)>='$fechainicio' and  date(ser_fecharegistro)<='$fechaactual' and ser_clasificacion=2 and ser_estado>=3 and ser_estado!=100  $conde1 $conde2 $conde3  $conde4 GROUP BY rel_nom_credito ORDER BY idrelsercre $asc ";

$idguias='';
$html1= "";
$totalcontado=0;
$guiafacturadas=0;
$totalguias=0;
$DB->Execute($sql); $va=0; 

	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{

		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		$sinfacturados=$rw1[2]-$facturar[$rw1[1]];
		$facturadas=$facturar[$rw1[1]];
		if($facturadas==''){
			$facturadas=0;
		}
		$radicadas=$radicado[$rw1[1]];
		if($radicadas==''){
			$radicadas=0;
		}
		$sinradicar=$facturadas-$radicadas;
		if($sinradicar==''){
			$sinradicar=0;
		}
		$pagadas=$pagado[$rw1[1]];
		if($pagadas==''){
			$pagadas=0;
		}
		$sinpagar=$radicadas-$pagadas;
		if($sinpagar==''){
			$sinpagar=0;
		}

		
		if($rw1[1]==''){  $color='#E11804'; }
		$html1.="<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	
		$sql="SELECT `idhojadevida`, `hoj_fechanaradicacion`, `hoj_fechanacorte`, `hoj_numerocuenta`, `hoj_plazopago`, `hoj_novedadesfactura` FROM `hojadevidacliente` left join creditos on idcreditos=hoj_clientecredito where cre_nombre='$rw1[1]'";
		$DB1->Execute($sql);
		$rw4=mysqli_fetch_row($DB1->Consulta_ID);
		$html1.="<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>";

		$html1.="<td colspan='1' width='0' align='center' ><a id='link' onclick='pop_dis6(\"$rw1[1]\",\"detallesinfacturados\",\"$datos\")';  style='cursor: pointer;' title='Detalle sin facturar' >$sinfacturados</td>";

		$html1.="<td>".$facturadas."</td>
		
		<td>".$sinradicar."</td>
		<td>".$radicadas."</td>
		<td>".$pagadas."</td>
		<td>".$sinpagar."</td>

		<td>".$rw4[1]."</td>
		<td>".$rw4[2]."</td>
		<td>".$rw4[3]."</td>
		<td>".$rw4[4]."</td>
		";

	//	$html1.="<td align='center' ><a  onclick='pop_dis5($id_p,\"Recogidas\")';  style='cursor: pointer;' title='Recogidas' ><img src='img/recogidas.png'></a></td>";
		$html1.= "</tr>"; 
		$totalguias=$rw1[2]+$totalguias;
	}
	$html1.= "<tr><td align='center' > Total Datos:".$va."</td>"; 
	
	$html1.= "</tr>"; 
	$total=$va-$guiafacturadas;
	
$FB->titulo_azul1("Credito",1,0,7); 
$FB->titulo_azul1("# Guias",1,0,0); 
$FB->titulo_azul1("Sin Facturar",1,0,0); 
$FB->titulo_azul1("Facturadas",1,0,0); 
$FB->titulo_azul1("Sin Radicar",1,0,0); 
$FB->titulo_azul1("Radicadas",1,0,0); 
$FB->titulo_azul1("Pagadas",1,0,0); 
$FB->titulo_azul1("Sin Pagadar",1,0,0); 
$FB->titulo_azul1("Fecha Radicacion",1,0,0); 
$FB->titulo_azul1("Fecha Corte",1,0,0); 
$FB->titulo_azul1("Numero Cuenta",1,0,0); 
$FB->titulo_azul1("Plazo de Pago",1,0,0); 

/* $FB->titulo_azul1("Datos Cliente",1,0,0); 
$FB->titulo_azul1("contacto Facturacion",1,0,0); */
 

echo $html1;

$FB->titulo_azul1("Total Reistros: $va",1,0,7); 
$FB->titulo_azul1("Total Guias: $totalguias",1,0,0); 
$FB->titulo_azul1(":",1,0,0); 


include("footer.php");
?>