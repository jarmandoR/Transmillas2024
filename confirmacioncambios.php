<?php
require("login_autentica.php"); 
include("layout.php");
$nivel_acceso=$_SESSION['usuario_rol'];


$conde1="";
$conde2="";

$FB->titulo_azul1("Verificacion de Cambios guias",9,0,7);  
$FB->abre_form("form1","","post");

//if($nivel_acceso==1 or $nivel_acceso==10){ $conde4=""; 	 } else { $conde4=" and idsedes=$id_sedes";  }

$FB->llena_texto("Fecha de inicio:", 5, 10, $DB, "", "", "$fechainicio", 1, 0);
$FB->llena_texto("Fecha fin:", 4, 10, $DB, "", "", "$fechaactual", 4, 0);

$FB->llena_texto("Operario:",1,2,$DB,"SELECT `usu_nombre`,`usu_nombre` FROM `usuarios` WHERE  (usu_estado=1 or usu_filtro=1)", "", "$param1", 1, 0);
//$FB->llena_texto("Tipo de transaccion:",3,2, $DB, "SELECT idtipospagos,pag_nombre FROM `tipospagos` WHERE pag_estado like '%Activo%' and idtipospagos!=1 order by idtipospagos", "", "$param3", 4, 0);
$FB->llena_texto("confirmar:", 2, 82, $DB, $confirmar, "", "$param6", 4, 1);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);
$FB->cierra_form(); 



$FB->titulo_azul1("Fecha",1,0,5); 
$FB->titulo_azul1("Guia",1,0,0); 
$FB->titulo_azul1("Idservicio",1,0,0); 
$FB->titulo_azul1("Operario",1,0,0); 
$FB->titulo_azul1("Valor Guia Anterior",1,0,0); 
$FB->titulo_azul1("Valor Guia Anterior",1,0,0); 
$FB->titulo_azul1("Tipo Cambio",1,0,0); 
$FB->titulo_azul1("confirmar",1,0,0); 
$FB->titulo_azul1("Confirmo",1,0,0); 
$FB->titulo_azul1("Fecha Confirmacion",1,0,0); 
$FB->titulo_azul1("Descrpcion",1,0,0); 



if($nivel_acceso==1){
$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
}
if($param5!=''){
$conde1.=" and date(mod_fecha)>='$param5' and date(mod_fecha)<='$param4'";
}else{
	$conde1.=" and date(mod_fecha)>='$fechainicio' and date(mod_fecha)<='$fechaactual'"; 	
}
if($param1!=''){
	$conde2.="and mod_usermodificado='$param1'";
}

/* if($param3!='' and $param3!='0'){
	$conde2.="and mod_tipoevento='$param3'";
} */


if($param2=="" or $param2=="0"){
	$conde2.=" and mod_userverificado=''";
}else{
	$conde2.=" and mod_userverificado!=''";
}


 $sql="SELECT `idmodificaciones`,`mod_fecha`,`mod_guia`, `mod_idservicio`,`mod_usermodificado`,  `mod_valor`, `mod_datos`, `mod_tipoevento`,  `mod_userverificado`, `mod_fechaverificado`, `mod_descripciones` FROM `modificaciones` 
  WHERE idmodificaciones>0 $conde1 $conde2  ORDER BY idmodificaciones  ASC ";


$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$id_p=$rw1[0];
	$va++; $p=$va%2;
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}

	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		echo "<td>".$rw1[1]."</td>
		<td align='center' ><a  onclick='pop_dis5($rw1[3],\"Recogidas\")';  style='cursor: pointer;' title='Detalle Guia' >$rw1[2]</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		<td>".$rw1[7]."</td>
		";
				
		if(($nivel_acceso==1 or $nivel_acceso==5 or $nivel_acceso==11) and $rw1[8]!=''){
			echo "<td align='center' >
			<a  onclick='pop_dis10($id_p,\"Confirmarcambios\",\"$rw1[4]\")';  style='cursor: pointer;' title='Confirmar' ><img src='img/Confirmar1.png'></a></td>";
		}
		else {
			if($nivel_acceso==1){
				echo "<td align='center' >
				<a  onclick='pop_dis10($id_p,\"Confirmarcambios\",\"$rw1[4]\")';  style='cursor: pointer;' title='Confirmar' ><img src='img/Confirmar1.png'></a></td>";	
			}else{
			echo "	<td><img src='img/Confirmar.png'></a></td>";
			}
		}	

		echo "	
		<td>".$rw1[8]."</td>
		<td>".$rw1[9]."</td>
		<td>".$rw1[10]."</td>
		
		";
	

	if($nivel_acceso==1){
		$DB->edites($id_p, "modificaciones", 2,"delete");
	}
	echo "</tr>";
}
include("footer.php"); ?>