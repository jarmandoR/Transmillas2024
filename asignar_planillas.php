<?php 
require("login_autentica.php"); 
include("layout.php");
 


//if($nivel_acceso==1){ $conde2="";  	 } else {  $conde2=" and idsedes='$id_sedes'"; }

if($param5!=''){ 
			$id_sedes=$param5; 
			$idcidades=ciudadesedes($param5,$DB);
			if($idcidades=='0'){
				$conde1="";

			}else {
			  $conde1=" and ser_ciudadentrega in $idcidades "; 	
			}
  } else {  
  
		$idcidades=ciudadesedes($id_sedes,$DB);
		if($idcidades=='0'){
			$conde1="";

		}else {
		  $conde1=" and ser_ciudadentrega in $idcidades "; 	
		}


  }
 

$FB->nuevo6("Guias Operadores", "$id_sedes", "configuracion.php?idmen=181", "guias.php");
//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
$FB->titulo_azul1("Asignar Guias a Los Operadores",9,0,5);  

$conde="and ser_fechaguia like '$fechaactual%'"; 

if($param4!=''){ $conde="and ser_fechaguia like '$param4%'";  $fechaactual=$param4;  }
$FB->llena_texto("Fecha de Busqueda:", 4, 10, $DB, "", "", "$fechaactual", 1, 0);
//echo "SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0  $conde2";
$FB->llena_texto("Sede Entrega:",5,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0  $conde2)", "", "$id_sedes", 4, 1);
$FB->llena_texto("Busqueda por:",1,82,$DB,$busqueda1,"",$param1,1,0);
$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2", 4,0);
$FB->llena_texto("Asignado a:",6,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE  (usu_estado=1 or usu_filtro=1) $conde2 	AND roles_idroles IN (2,3,5,8)", "", "$param6", 1, 0);

$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

$FB->cierra_form(); 
$FB->titulo_azul1("Guia",1,0,7); 
$FB->titulo_azul1("Pre-Guia",1,0,0); 
$FB->titulo_azul1("Destinatario",1,0,0); 
$FB->titulo_azul1("Ciudad",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("T&eacute;lefono",1,0,0); 
$FB->titulo_azul1("Asignado A",1,0,0); 
$FB->titulo_azul1("Reasignar",1,0,0); 

//$FB->titulo_azul3("Validar",2,0,2,$param_edicion);

$conde3=""; 

if($param2!="" and $param1!=""){ 
 $conde2="and $param1 like '%$param2%' "; 
  }else { $conde2="  "; } 

if ($param6!="") {
	$user="SELECT `usu_nombre` FROM `usuarios` WHERE `idusuarios`='$param6' ";
	$DB1->Execute($user); 
	$nomusuario=$DB1->recogedato(0);
	$conde4="and usu_nombre='$nomusuario'";
}

  $sql="SELECT `idservicios`, `ser_consecutivo`, `ser_destinatario`, `ciu_nombre`,`ser_direccioncontacto`, `ser_telefonocontacto`,`usu_nombre`,inner_sedes,`ser_guiare`
 FROM serviciosdia
  left join usuarios on ser_idusuarioguia=idusuarios where ser_estado='9'  $conde3 $conde1 $conde2 $conde $conde4 ORDER BY ser_fechafinal $asc ";

$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		$rw1[4]=str_replace("&"," ", $rw1[4]);
		echo "
		<td>".$rw1[1]."</td>
		<td>".$rw1[8]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		";
		echo "<td align='center' >";
		echo "<a  onclick='pop_dis8($id_p,\"Reasignar\",$rw1[7])';  style='cursor: pointer;' title='Reasignar' ><img src='img/reasignar.png'></a></td>";
		echo "</tr>"; 
	}


include("footer.php");
?>