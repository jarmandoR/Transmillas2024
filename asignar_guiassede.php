<?php 
require("login_autentica.php"); 
include("layout.php");
//include("cabezote4.php"); 
 
 
if($param5!=''){ 
			$id_sedes=$param5; 
			$idcidades=ciudadesedes($param5,$DB);
			if($idcidades=='0'){
				$conde1="";

			}else {
			  $conde1=" and cli_idciudad in $idcidades "; 	
			}
  } else {  
  
		$idcidades=ciudadesedes($id_sedes,$DB);
		if($idcidades=='0'){
			$conde1="";

		}else {
		  $conde1=" and cli_idciudad in $idcidades "; 	
		}


  }


if($nivel_acceso==1 or $nivel_acceso==10 ){ $conde2="";  	 } else {  $conde2=" and idsedes=$id_sedes"; }
 $conde3="";

 if($param5!=''){ $id_ciudad=$param5; } else {$id_ciudad=0;  }
$FB->nuevo6("Guias Sedes", "$id_ciudad", "configuracion.php?idmen=181", "guiassede.php");

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
$FB->titulo_azul1("Guias Enviadas A Otras Sedes",9,0,5);  
$FB->abre_form("form1","","post");
$conde="and ser_fechaguia like '$fechaactual%'"; 

if($param4!=''){ $conde="and ser_fechaguia like '$param4%'";  $fechaactual=$param4;  }
if($param3!=''){ $conde3="and inner_sedes= '$param3'";  } else  { $param3=0;  $conde3="";   $conde4=""; }
$FB->llena_texto("Fecha de Busqueda:", 4, 10, $DB, "", "", "$fechaactual", 1, 0);
$FB->llena_texto("Sede Origen:",5,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde2)", "", "$id_sedes", 1, 1);
$FB->llena_texto("Sede Destino:",3,2,$DB,"(SELECT  `idsedes`,`sed_nombre` FROM sedes)", "", "$param3", 4,0);
$FB->llena_texto("Busqueda por:",1,82,$DB,$busqueda1,"",$param1,17,0);
$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2",4,0);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

$FB->cierra_form(); 
$FB->titulo_azul1("Guia",1,0,7); 
$FB->titulo_azul1("Pre-Guia",1,0,0); 
$FB->titulo_azul1("Destinatario",1,0,0); 
$FB->titulo_azul1("Ciudad",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
//$FB->titulo_azul1("Reasignar",1,0,0); 


//$FB->titulo_azul3("Validar",2,0,2,$param_edicion);

$conde2=""; 

if($param2!="" and $param1!=""){ 
 $conde2="and $param1 like '%$param2%' "; 
  }else { $conde2="  "; } 


  $sql="SELECT `idservicios`, `ser_consecutivo`, `ser_destinatario`, `ciu_nombre`,`ser_direccioncontacto`, `ser_telefonocontacto`,`ser_guiare`
 FROM serviciosdia where ser_estado='7'  $conde1 $conde2   $conde3 $conde ORDER BY ser_fechafinal $asc ";

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
		<td>".$rw1[6]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>

		";
/* 		echo "<td align='center' >";
		echo "<a  onclick='pop_dis24($id_p,\"Reasignar\",$id_ciudad)';  style='cursor: pointer;' title='Reasignar' ><img src='img/reasignar.png'></a></td>";
		echo "</tr>";  */
	}


include("footer.php");
?>