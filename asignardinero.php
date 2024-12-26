<?php
require("login_autentica.php"); 
include("layout.php");

if($param1!=""){  $conde1="and usu_idsede='$param1'";  $id_sedes =$param1; }  else {$param1=""; $conde1="and usu_idsede=$id_sedes ";  }
if(isset($_REQUEST["param2"])){  if($param2!=""){ $conde1.="and asi_idpromotor='$param2'"; } } else {$param2="";  }
if($param4!=''){ $conde1.="and asi_fecha like '$param4%'";  $fechaactual=$param4;  }

$FB->titulo_azul1("Asignar Dinero ",9,0,7);  
$FB->abre_form("form1","","post");

$conde1.=" and asi_fecha like '$fechaactual%'"; 
$conde="";
$conde="asi_fecha";
$conde2="and usu_idsede=$id_sedes "; 



$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "cambio4(\"param2\",\"param1\",\"asignardinero.php\")", "$id_sedes", 1, 1);
$FB->llena_texto("Fecha de Busqueda:", 4, 10, $DB, "", "", "$fechaactual", 4, 0);
$FB->llena_texto("Operario:",2,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE  (usu_estado=1 or usu_filtro=1) $conde2", "", $param2, 1, 1);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
$FB->cierra_form(); 

if($rcrear==1) { $FB->nuevo("asignardinero", $condecion, ""); } 

$FB->titulo_azul1("Fecha",1,0,5); 
$FB->titulo_azul1("Operador",1,0,0); 
$FB->titulo_azul1("Tipo",1,0,0); 
$FB->titulo_azul1("Valor ",1,0,0); 
$FB->titulo_azul1("Descripcion ",1,0,0); 
if($nivel_acceso==1 or $nivel_acceso==5){
$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
}else {

}

 $sql="SELECT `idasignaciondinero`,`asi_fecha`, usu_nombre, `asi_tipo`, `asi_valor`,  `asi_descripcion`, `asi_idautoriza`, `asi_idpromotor` FROM `asignaciondinero` inner join usuarios on asi_idpromotor=idusuarios WHERE idasignaciondinero>0  $conde1 ORDER BY $conde, $ord $asc";
$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	
	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>".$rw1[1]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		";
		if($nivel_acceso==1 or $nivel_acceso==5){
		$DB->edites($id_p, "asignardinero", 1, $condecion);
		}
	echo "</tr>";
}
include("footer.php"); ?>