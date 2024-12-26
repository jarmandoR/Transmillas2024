<?php
require("login_autentica.php"); 
include("layout.php");
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$id_sedes=$_SESSION['usu_idsede'];
$conde3="";
$conde1="";
$DB1 = new DB_mssql;
$DB1->conectar();

if($param1!=''){ 
	//$id_sedes=$param6; 
	$idcidades=ciudadesedes($param1,$DB);
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
if($param1!=''){ 
$id_sedes=$param1; 
}

if(isset($_REQUEST["param2"])){  if($param2!=""){ $conde1.=" and gui_ensede like '%$param2%'"; } } 


$conde="and gui_fechaensede like '$fechaactual%'"; 
if($param4!=''){ $conde="and gui_fechaensede like '$param4%' ";  $fechaactual=$param4;  }

$FB->titulo_azul1("Guias Enviadas X Operador ",9,0,7);  
$FB->abre_form("form1","","post");

if($nivel_acceso==1){ $conde2=""; $conde4=""; 	 } else { $conde2=" and idusuarios=$id_usuario";  $conde4=" and idsedes='$id_sedes'"; $param2=$id_nombre;  }

$FB->llena_texto("Fecha de Busqueda:", 4, 10, $DB, "", "", "$fechaactual", 1, 0);
$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde4 )", "cambio4(\"param2\",\"param1\",\"guiasopereviadas.php\")", "$id_sedes", 1, 1);

$FB->llena_texto("Operario:",2,2, $DB, "SELECT `usu_nombre`,`usu_nombre` FROM `usuarios` WHERE `roles_idroles` in (1,2,3,5) and  (usu_estado=1 or usu_filtro=1) $conde2", "", "$param2", 4, 0);
$FB->llena_texto("Busqueda por:",3,82,$DB,$busqueda1,"",$param3,17,0);
$FB->llena_texto("Dato:", 5, 1, $DB, "", "","$param5", 4,0);

$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
$FB->cierra_form(); 


   
$conde5=""; 

if($param5!="" and $param3!=""){ 
	$conde5="and $param3 like '%$param5%' "; 
  }else { $conde5="  "; } 


	 $sql="SELECT `idservicios`, `ser_consecutivo`,`ser_tipopaquete`, ser_piezas,numeropieza,gui_ensede,gui_fechaensede,ser_ciudadentrega
		   FROM servicios inner join rel_sercli  on idservicios=ser_idservicio 
		   inner join clientesservicios on idclientesdir=ser_idclientes inner join ciudades on idciudades=cli_idciudad  
		   inner join piezasguia on ser_consecutivo=numeroguia inner join guias on gui_idservicio=idservicios
		    where ser_estado>=6  $conde1 $conde  $conde3 $conde5 ORDER BY gui_fechaensede desc ";
  
  $DB1->Execute($sql); 
  $va=0; 
  $html=""; 
	  while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
	  {
		  $id_p=$rw1[0];
		  
		  $va++; $p=$va%2;
		  if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

		  $sqs="SELECT ciu_nombre FROM ciudades WHERE idciudades='$rw1[7]'";
		  $DB->Execute($sqs); 
		  $ciudadn=$DB->recogedato(0);
		 
		  $html.= "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		  $html.="
		  <td>".$rw1[1]."</td>
		  <td>".$rw1[4]."</td>
		  <td>".$ciudadn."</td>
		  <td>".$rw1[5]."</td>
		  <td>".$rw1[6]."</td>
		  ";

	  }
	  $html.= '</table></td></tr></table></div>';

	  echo '<div id="tercero" style="width: 95%; float:left;">';
		echo '<table class="table table-hover"><tr bgcolor="#04B404" class="tittle3"><td>TOTAL PIEZAS ENVIADAS: '.$va.'</td></tr><tr><td>';
		$FB->titulo_azul1("GUIA",1,0,7); 
		$FB->titulo_azul1("PIEZA",1,0,0); 
		$FB->titulo_azul1("DESTINO",1,0,0); 
		$FB->titulo_azul1("OPERADOR",1,0,0); 
		$FB->titulo_azul1("FECHA",1,0,0); 
		echo $html;
include("footer.php"); ?>