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
	p4=document.getElementById('param4').value;
	destino="alertassede.php?param1="+p1+"&param2="+p2+"&param4="+p4+"&param5="+p5;
	
	
	window.location=destino;
	
}

function guardar(valor){ 

	
		var descripcion=document.getElementById("des_"+valor).value;
		var idservicio=document.getElementById("servicio_"+valor).value;

		document.getElementById("tabla1").rows[valor].cells[10].innerHTML=descripcion;
      	datos = {"tipoguia":"validarfaltantes","servicio":idservicio,"descripcion":descripcion};
		$.ajax({
				url: "guiasok.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){
				
			}); 

		
 
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




$FB->titulo_azul1("Guias Faltantes",10,0, 5);  

//$FB->llena_texto("Mensajero:",1,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `roles_idroles` in (2,3,5)", "cambio2(this.value,\"guias.php\",\"Usuario\")", $rw[1], 1, 1);
$FB->llena_texto("Sede Origen:",5,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>=0 $conde2 )", "cambio4(\"param4\",\"param5\",\"faltantes.php\")", "", 1, 1);
$FB->llena_texto("Sede Destino:",4,2,$DB,"(SELECT  `idsedes`,`sed_nombre` FROM sedes )", "cambio4(\"param4\",\"param5\",\"faltantes.php\")", "$param4", 4, 1);
$FB->llena_texto("Busqueda por:",1,8,$DB,$busqueda1,"",$param1,17,0);
$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2",4,0);


 //$FB->llena_texto("Buscar", 1, 142, $DB, "Buscar", "onclick=form3.submit();", 0, 12, 0);
echo "<tr><td><button type='button' class='btn btn-primary btn-lg' onclick='buscarsede();'>Buscar</button></td><td></td>";
echo "<td><button type='submit' class='btn btn-danger btn-lg' >Renviar</button></td><td></td><tr>";
//$FB->llena_texto("", 3, 133, $DB, "Guardar", "onclick=form1.submit();","", 4, 0);


$FB->titulo_azul1("#",1,0,12); 
$FB->titulo_azul1("Fecha",1,0,0); 
$FB->titulo_azul1("idservicio",1,0,0); 
$FB->titulo_azul1("Guia",1,0,0); 
$FB->titulo_azul1("Pre-Guia",1,0,0); 
$FB->titulo_azul1("Tipo PQ",1,0,0); 
$FB->titulo_azul1("Descripcion",1,0,0); 
$FB->titulo_azul1("Destinatario",1,0,0); 
$FB->titulo_azul1("Ciudad",1,0,0); 
$FB->titulo_azul1("Estado",1,0,0); 
$FB->titulo_azul1("Comentario",1,0,0); 
$FB->titulo_azul1("Renviar",1,0,0); 
if($nivel_acceso==1 or $nivel_acceso==9 or $nivel_acceso==10) {
$FB->titulo_azul1("Nuevo Comentario",1,0,0); 
$FB->titulo_azul1("Estado",1,0,0); 
}


$conde=""; 

if($param2!="" and $param1!=""){ 
 $conde="and $param1 like '%$param2%' "; 
  }else { $conde="  "; } 



   $sql="SELECT `idservicios`, `ser_consecutivo`,`ser_tipopaquete`,`ser_paquetedescripcion`, `ser_destinatario`, `ciu_nombre`,`ser_direccioncontacto`,`ser_guiare` ,ser_llego,ser_desvaliguia,ser_estado,ser_fechafinal FROM serviciosdia  where ser_estado in (7) and ser_llego!='SI' and ser_fechafinal<='$fechaactual%' $conde4  $conde1 $conde  $conde3 ORDER BY ser_fechafinal desc ";

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
		}
	
		echo "
		<td>".$va."</td>
		<td>".$rw1[11]."</td>";
		echo "<td align='center' ><a  onclick='pop_dis5($id_p,\"Recogidas\")';  style='cursor: pointer;' title='Detalle Guia' >$id_p</td>";
		echo "<td>".$rw1[1]."</td>
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
		</td>";
	if($nivel_acceso==1 or $nivel_acceso==9 or $nivel_acceso==10) {
		echo "<td><textarea name='des_$va' id='des_$va' value='' style='width:195px; class='text' ></textarea></td>";
		echo "<td><button type='button' class='btn btn-primary' onclick='guardar($va);'>Guardar</button></td>";
		echo "</tr>";
	}

	}
echo "<input name='registros' id='registros' type='hidden'  value='$va'>";
$FB->llena_texto("tipoguia", 1, 13, $DB, "", "","faltantes", 5, 0);
include("footer.php");
?>