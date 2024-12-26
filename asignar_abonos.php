<?php 
require("login_autentica.php"); 
include("layout.php");
//include("cabezote4.php"); 
$fechainicial=date('Y-m-01');

if($param5!=''){ $id_sedes=$param5; }
if($nivel_acceso==1 or $nivel_acceso==10  or $nivel_acceso==9){ $conde3="";  	 } else {  $conde3=" and idsedes='$id_sedes'"; }

if($param7!='0'){ 
	if($param7=='abono'){
		$conde4="and abo_estado='abono'"; 
	}elseif($param7=='devoluciones'){
		$conde4="and abo_estado='devolucion'"; 
	}elseif($param7=='abonose'){
		$conde4="and abo_estado='abono' and ser_estado>=4"; 
	}elseif($param7=='abonosf'){
		$conde4="and abo_estado='abono' and ser_estado<=3"; 
	}
	//$conde4="a"; 

}else{ $conde4=""; }

$FB->nuevo5("Abonos", "$id_sedes", "1","0");
//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
$FB->titulo_azul1("Asignar Abonos",9,0,5);  

if($param4!=''){ $fechaactual=$param4; }
if($param6!=''){ $fechainicial=$param6; }
$conde="and  date(abo_fecha)>='$fechainicial' and  date(abo_fecha)<='$fechaactual'";  
$conde1=" and abo_idsede='$id_sedes'";

//if($param4!=''){ $conde="and abo_fecha like '$param4%'";  $fechaactual=$param4;  }

$FB->llena_texto("Fecha de inicio:",6 , 10, $DB, "", "", "$fechainicial", 17, 0);
$FB->llena_texto("Fecha de Final:", 4, 10, $DB, "", "", "$fechaactual", 4, 0);
$FB->llena_texto("Sede :",5,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0  $conde3)", "", "$id_sedes", 1, 1);
$FB->llena_texto("Estado:",7,82,$DB,$abonosdevu,"",$param7,4,0);
$FB->llena_texto("Busqueda por:",1,82,$DB,$busqueda2,"",$param1,1,0);
$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2", 4,0);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

$FB->cierra_form(); 
$FB->titulo_azul1("Fecha",1,0,7); 
$FB->titulo_azul1("Tipo",1,0,0); 
$FB->titulo_azul1("Sede",1,0,0); 
$FB->titulo_azul1("Valor",1,0,0); 
$FB->titulo_azul1("Idservicio",1,0,0); 
$FB->titulo_azul1("Guia",1,0,0); 
$FB->titulo_azul1("Abono",1,0,0); 
$FB->titulo_azul1("Devolucion",1,0,0); 
$FB->titulo_azul1("Imprimir",1,0,0); 
if($nivel_acceso==1){
	$FB->titulo_azul1("Eliminar",1,0,0); 
}

//$FB->titulo_azul3("Validar",2,0,2,$param_edicion);


if($param2!="" and $param1!=""){ 
 $conde2="and $param1 like '%$param2%' "; 
  }else { $conde2="  "; } 


  $sql="SELECT `idabono`, `abo_fecha`, `abo_valor`, `abo_idservicio`, `abo_iduser`, `abo_idsede`, `abo_estado`,ser_guiare,ser_estado,ser_valorabono FROM `abonosguias`
 inner join usuarios on abo_iduser=idusuarios inner join servicios on idservicios= abo_idservicio where idabono>0  $conde1 $conde2 $conde $conde4 ORDER BY abo_fecha $asc ";

	$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	

/* 		$sql2="SELECT ser_guiare,ser_estado,ser_valorabono FROM `servicios` WHERE `idservicios`='$rw1[3]'";
		$DB1->Execute($sql2);
		$rw3=mysqli_fetch_row($DB1->Consulta_ID); */
		$guia ="$rw1[7]";  
		$estado=$rw1[8];

 		$sql2="SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes='$rw1[5]'";
		$DB1->Execute($sql2);
		$rw2=mysqli_fetch_row($DB1->Consulta_ID);
		$sede=$rw2[1]; 
		echo "
		<td>".$rw1[1]."</td>
		<td>".$rw1[6]."</td>
		<td>".$sede."</td>
		<td>".$rw1[2]."</td>
		<td align='center' ><a  onclick='pop_dis5($rw1[3],\"Recogidas\")';  style='cursor: pointer;' title='Detalle Guia' >$rw1[3]</td>
		<td>".$guia."</td>
		";
		if($rw1[8]==100){
			echo "<td>Cancelada</td>";
			$estadod='Cancelada';
		}elseif($rw1[8]==10){
		echo "<td>Entregada</td>";
		$estadod='Entregada';
		}else{
			echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($id_p,\"Abonos\",\"$rw1[3]\")';  title='Abono' >Abonar</td>";
		}
		if($rw1[9]<=0){
			$estadod='Sin Abono';
		}
/* 		if(($rw1[8]<=3 and $rw1[9]>0) or $nivel_acceso==1){
			echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($rw1[9],\"devolucion\",\"$rw1[3]\")';  title='Devolucion' >Devolver</td>";
		}else{
			echo "<td>$estadod</td>";
		} */
		echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($rw1[9],\"devolucion\",\"$rw1[3]\")';  title='Devolucion' >Devolver</td>";

		echo "<td><a href='ticketabono.php?id_param=$id_p' target='_blank'><img src='img/imprimir.png'></a></td>";
		if($estado!=10 or $nivel_acceso==1){
			$DB->edites($id_p, "Abonos", 2,0);
		}
		

		echo "</tr>"; 
	}


include("footer.php");
?>