<?php
require("login_autentica.php"); 
include("layout.php");
$id_usuario=$_SESSION['usuario_id'];
$id_sedes=$_SESSION['usu_idsede'];
if($nivel_acceso==1 ){
if($param1!=""){  $conde1="and usu_idsede='$param1'";  $id_sedes =$param1; }  else {$param1=""; $conde1="and usu_idsede=$id_sedes ";  }
if(isset($_REQUEST["param2"])){  if($param2!=""){ $conde1.="and (asi_idpromotor='$param2' or asi_idautoriza='$param2')"; } } else {$param2="";  }
if($param4!=''){ $conde1.="and asi_fecha like '$param4%'";  $fechaactual=$param4;  }

$FB->titulo_azul1("Transpaso de Dinero ",9,0,7);  
$FB->abre_form("form1","","post");

$conde1.=" and asi_fecha like '$fechaactual%'"; 
$conde="";
$conde="asi_fecha";
$conde2="and usu_idsede=$id_sedes "; 



	$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "cambio4(\"param2\",\"param1\",\"asignardinero.php\")", "$id_sedes", 1, 1);
	$FB->llena_texto("Fecha de Busqueda:", 4, 10, $DB, "", "", "$fechaactual", 4, 0);
	$FB->llena_texto("Operario:",2,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `roles_idroles` in (2,3,5) and  (usu_estado=1 or usu_filtro=1) $conde2", "", $param2, 1, 1);
	$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
	$FB->cierra_form(); 

}else{
	$conde1="and usu_idsede=$id_sedes "; 
	$conde1.="and (asi_idpromotor='$id_usuario' or asi_idautoriza='$id_usuario')";	
	$conde1.=" and asi_fechaingreso like '$fechaactual%'"; 
}



if($rcrear==1) { $FB->nuevo("transpasodinero", $condecion, ""); } 

//$FB->titulo_azul1("Fecha",1,0,5); 
if($nivel_acceso==1 ){
$FB->titulo_azul1("Tipo",1,0,5); 
}else{
	$FB->titulo_azul1("Confirmar",1,0,5); 
	$FB->titulo_azul1("Fecha",1,0,0); 

}
$FB->titulo_azul1("Operador",1,0,0); 
$FB->titulo_azul1("Valor ",1,0,0); 

if($nivel_acceso==1){
	$FB->titulo_azul1("Descripcion ",1,0,0); 
	$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
}

  $sql="SELECT `idasignaciondinero`,`asi_fecha`,  `asi_tipo`,usu_nombre, `asi_valor`,  `asi_descripcion`, `asi_idautoriza`, `asi_idpromotor`,asi_usercom FROM `asignaciondinero` inner join usuarios on asi_idpromotor=idusuarios WHERE idasignaciondinero>0 and asi_tipo in ('Transpaso Dinero','Asignar Dinero')  $conde1 ORDER BY asi_fecha desc";
$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

	
	if(($rw1[2]=='Transpaso Dinero' or $rw1[2]=='Asignar Dinero') and $rw1[7]==$id_usuario and $rw1[8]!=''){

		echo "<td>CONFIRMADO</td>";
		echo "<td>".$rw1[1]."</td>";

	}else if(($rw1[2]=='Transpaso Dinero' or $rw1[2]=='Asignar Dinero') and $rw1[7]==$id_usuario){
		if($rw1[8]!=''){ $st="1"; $colorfondo="#074f91"; }  else {  $st="0"; $colorfondo="#941727"; }
					
		echo "<td><div id='campo$va'>"; 
		echo "<select  style='width:100px;border:1px solid #f9f9f9;background-color:$colorfondo;color:#f9f9f9;font-size:12px'  name='param$va' id='param$va'  onChange='cambio_ajax2(this.value, 77, \"campo$va\", \"$va\", 1, $id_p)'  required>";
		$LT->llenaselect_ar($st,$confirmar);
		echo "</select>";
		echo "</div></td>";
		echo "<td>".$rw1[1]."</td>";
	}
	else{
		echo "<td>".$rw1[2]."</td>";
	}
		$valor=number_format($rw1[4],0,".",".");
		echo "
			<td>".$rw1[3]."</td>
			<td>".$valor."</td>		
		";
		if($nivel_acceso==1){
			echo "<td>".$rw1[5]."</td>";
			$DB->edites($id_p, "transpasodinero", 2, $condecion);
		//	$DB->edites($id_p, "asignardinero", 1, $condecion);
		}
	echo "</tr>";
}
include("footer.php"); ?>