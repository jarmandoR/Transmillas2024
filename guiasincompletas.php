<?php 
require("login_autentica.php"); 
include("layout.php");



$FB->abre_form("form1","guiasok.php","post");
?>
<script language="javascript">
function buscarsede()
{

	p1=document.getElementById('param1').value;
	p2=document.getElementById('param2').value;
	p5=document.getElementById('param5').value;
	p6=document.getElementById('param6').value;
	p4=document.getElementById('param4').value;
	destino="guiasincompletas.php?param1="+p1+"&param2="+p2+"&param4="+p4+"&param5="+p5+"&param6="+p6;
	
	
	window.location=destino;
	
}
</script>

<?php


if($param5!=''){ 
			$id_sedes=$param5; 
			$idcidades=ciudadesedes($param5,$DB);
			if($idcidades=='0'){
				$conde1="";

			}else {
			  $conde1=" and cli_idciudad in $idcidades "; 	
			}
  } else {  
  
/* 		$idcidades=ciudadesedes($id_sedes,$DB);
		if($idcidades=='0'){
			$conde1="";

		}else {
		  $conde1=" and cli_idciudad in $idcidades "; 	
		} */
		$conde1="";

  }
if($nivel_acceso==1 or $nivel_acceso==10 or $nivel_acceso==12){ $conde2="";  	 } else {  $conde2=" and idsedes=$id_sedes"; }
 
 
 $conde3="";
if($param4==''){ $param4=0;   } else { $conde3=" and inner_sedes=$param4";   }




$FB->titulo_azul1("Guias Incompletas/No Llegaron",10,0, 5);  

//$FB->llena_texto("Mensajero:",1,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `roles_idroles` in (2,3,5)", "cambio2(this.value,\"guias.php\",\"Usuario\")", $rw[1], 1, 1);
$FB->llena_texto("Sede Origen:",5,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>=0 $conde2 )", "cambio4(\"param4\",\"param5\",\"guiasincompletas.php\")", "$param5", 1, 1);
$FB->llena_texto("Sede Destino:",4,2,$DB,"(SELECT  `idsedes`,`sed_nombre` FROM sedes )", "cambio4(\"param4\",\"param5\",\"guiasincompletas.php\")", "$param4", 4, 1);
$FB->llena_texto("Estado:",6,82,$DB,$estadosguiasmal,"","$param6",1,0);
$FB->llena_texto("Busqueda por:",1,8,$DB,$busqueda1,"",$param1,17,0);
$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2",4,0);


 //$FB->llena_texto("Buscar", 1, 142, $DB, "Buscar", "onclick=form3.submit();", 0, 12, 0);
echo "<tr><td><button type='button' class='btn btn-primary btn-lg' onclick='buscarsede();'>Buscar</button></td><td></td>";
echo "<td><button type='submit' class='btn btn-danger btn-lg' >Renviar</button></td><td></td><tr>";
//$FB->llena_texto("", 3, 133, $DB, "Guardar", "onclick=form1.submit();","", 4, 0);


$FB->titulo_azul1("Guia",1,0,7); 
$FB->titulo_azul1("Pre-Guia",1,0,0); 
$FB->titulo_azul1("Tipo PQ",1,0,0); 
$FB->titulo_azul1("Descripcion",1,0,0); 
$FB->titulo_azul1("Destinatario",1,0,0); 
$FB->titulo_azul1("Ciudad",1,0,0); 
$FB->titulo_azul1("Estado",1,0,0); 
$FB->titulo_azul1("Comentario",1,0,0); 
$FB->titulo_azul1("Renviar",1,0,0); 


$conde=""; 

if($param2!="" and $param1!=""){ 
 $conde="and $param1 like '%$param2%' "; 
  }else { $conde="  "; } 


  if($param6==1){
	$conde4='and ser_estado=7';
}elseif($param6==2){
	$conde4='and ser_estado=12';
}elseif($param6==3){
	$conde4='and ser_estado=13';
}elseif($param6==4){
	$conde4='and ser_estado=16';
}elseif($param6==5){
	$conde4='and ser_estado=17';
}else{
	$conde4='';
}

   $sql="SELECT `idservicios`, `ser_consecutivo`,`ser_tipopaquete`,`ser_paquetedescripcion`, `ser_destinatario`, `ciu_nombre`,`ser_direccioncontacto`,`ser_guiare` ,ser_llego,ser_desvaliguia,ser_estado FROM serviciosdia  where ser_estado in (7,13,12,16,17) and ser_llego!='SI' $conde4  $conde1 $conde  $conde3 ORDER BY ser_fechafinal $asc ";

$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		$rw1[6]=str_replace("&"," ", $rw1[6]);
		if($rw1[10]==7){
			$proceso='Sin validar';
		}elseif($rw1[10]==12){
			$proceso='No Llego a Sede';
		}elseif($rw1[10]==13){
			$proceso='Incompleto';
		}elseif($rw1[10]==16){
			$proceso='Perdida';
		}elseif($rw1[10]==17){
			$proceso='Incautada';
		}
	
		echo "
		<td>".$rw1[1]."</td>
		<td>".$rw1[7]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>		
		<td>".$rw1[5]."</td>
		<td>".$proceso."</td>
		<td>".$rw1[9]."</td>

		";
		echo "<td><input type='checkbox' name='asignar_$va' id='asignar_$va' value='1' style='width:95px; class='trans' >
		<input name='servicio_$va' id='servicio_$va' type='hidden'  value='$rw1[0]'>
		<input name='guia_$va' id='guia_$va' type='hidden'  value='$rw1[7]'>
		</td></tr>";
	}
echo "<input name='registros' id='registros' type='hidden'  value='$va'>";
$FB->llena_texto("tipoguia", 1, 13, $DB, "", "","incompletas", 5, 0);
include("footer.php");
?>