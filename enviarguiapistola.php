<?php 
require("login_autentica.php"); 
include("layout.php");
//include("cabezote4.php"); 
?>
<head>
<script>
function validarllegada(des)
{

var valorguia= document.getElementById("codigoEscaneado").value;
var ciudaddes= document.getElementById("param6").value;
var ciudado= document.getElementById("param5").value;
if(ciudaddes==0){

alert('Seleccione la ciudad de Destino');
return;
}else{
//alert(des);
//alert(valorguia);

	var guia="";
	var trueorfalse = false;	
		datos = {"valores":valorguia,"ciudaddes":ciudaddes,"ciudado":ciudado};
		$.ajax({
				url: "validaenviada.php",
				type: "POST",
				data: datos,
				async: false,
				success: function(result) {
					guia= result.resultado;
					if(guia==1){
						
						/* $("#enviarmensaje").modal("show"); 
							var divvalor= document.getElementById("mensajevalor2");
							divvalor.innerHTML="<strong>Atencion!</strong> EL NUMERO DE GUIA NO EXISTE O NO ES SU DESTINO,  VERIFIQUE!</a>";
						 */	
						 alert('EL NUMERO DE GUIA NO EXISTE O NO ES SU DESTINO,  VERIFIQUE');

					}else if(guia==2) {
						$("#mensaje").modal("show"); 
							var divvalor= document.getElementById("mensajevalor3");
							divvalor.innerHTML="<strong>OK!</strong>  GUIA ENVIADA CON EXITO</a>";


					}else if(guia==3) {
					/* 	$("#enviarmensaje").modal("show"); 
							var divvalor= document.getElementById("mensajevalor2");
							divvalor.innerHTML="<strong>Atencion!</strong> LA GUIA NO ESTA EN ESTADO VALIDAR LLEGADA,  VERIFIQUE LA GUIA!</a>"; */

							alert('LA GUIA NO ESTA EN ESTADO  DE ENVIO,  VERIFIQUE LA GUIA!');
					}else if(guia==4) {
							$("#mensaje").modal("show"); 
							var divvalor= document.getElementById("mensajevalor3");
							divvalor.innerHTML="<strong>YA FUE ENVIADA!</strong> LA GUIA YA FUE ENVIADA,  VERIFIQUE LA GUIA</a>";						
						
					}
					return false;
					
					
				}
			});
			
	}
			
}

</script>
</head>

<body onload="">

<?php 

if($nivel_acceso==1){ $conde2="";  } else { $conde2=" and inner_sedes=$id_sedes";  }
if($param5!=''){ 
			//$id_sedes=$param6; 
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
  if($param5!=''){ 
	$id_sedes=$param5; 
}
  $idcidades2=ciudadesedes($param6,$DB);
  $conde1.=" and ser_ciudadentrega in $idcidades2 "; 	

$FB->abre_form("form1","","post");
$FB->titulo_azul1("Enviar las Guias a las Ciudades",9,0,5);  
$FB->abre_form("form1","","post");

$conde="and ser_fechaguia like '$fechaactual%'"; 

if($param4!=''){ $conde="and ser_fechaguia like '$param4%' ";  $fechaactual=$param4;  }
$FB->llena_texto("Fecha de Busqueda:", 4, 10, $DB, "", "", "$fechaactual", 1, 0);

$FB->llena_texto("Sede Origen:",5,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "", "$id_sedes", 1, 1);
$FB->llena_texto("Sede Destino:",6,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "", "$param6", 4, 0);

$FB->llena_texto("Busqueda por:",1,82,$DB,$busqueda1,"",$param1,17,0);
$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2", 4,0);
echo '<tr><td class="text">Escanear Código: </td><td align="right" ><div class="form-group">
<div class="input-group">
	<div class="input-group-addon"><i class="fa fa-barcode"></i></div>
	<input autofocus type="text" class="form-control producto" name="codigoEscaneado" id="codigoEscaneado" autocomplete="off" onchange="validarllegada(this);">
</div>
</div></td></tr>';

$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

$FB->cierra_form(); 



$conde3=""; 

if($param2!="" and $param1!=""){ 
	$conde3="and $param1 like '%$param2%' "; 
  }else { $conde3="  "; } 


echo '</table>
	<div id="contenedor" style="display:flex;">

     
	 <div id="segundo" style="width: 33%; float:left;">';
	 echo '<table class="table table-hover"><tr bgcolor="#868A08" class="tittle3"><td>Guias X Enviar</td></tr><tr><td>';
	 	$FB->titulo_azul1("Guia",1,0,7); 
		 $FB->titulo_azul1("Paquete",1,0,0); 
		 $FB->titulo_azul1("Descripcion",1,0,0); 
		$FB->titulo_azul1("Piezas",1,0,0); 


		 $sql="SELECT `idservicios`, `ser_consecutivo`,`ser_tipopaquete`, ser_piezas,ser_paquetedescripcion,cli_idciudad
		FROM serviciosdia  where ser_estado='6' and  ser_idverificadopeso=1  $conde1   $conde3 ORDER BY ser_fechafinal desc ";
	   
	   $DB->Execute($sql); $va=0; 
		   while($rw1=mysqli_fetch_row($DB->Consulta_ID))
		   {
			   $id_p=$rw1[0];
			   if($rw1[3]>1){
				$piezaenviada=array();
				$sqll1="SELECT `idpiezasguia`, `numeroguia`, `numeropieza` FROM `piezasguia` WHERE numeroguia='$rw1[1]'";
				$DB1->Execute($sqll1);
				while($datos=mysqli_fetch_row($DB1->Consulta_ID))
				{
					$piezaenviada[]=$datos[2];

				}
				
					for($a=1;$a<=$rw1[3];$a++){

						if (in_array($a, $piezaenviada)) {
							
						}else{

				/* 			$sqs="SELECT idciudades, ciu_nombre FROM ciudades WHERE idciudades='$rw1[5]'";
							$DB->Execute($sqs); 
							$ciudadn=$DB->recogedato(0); */
						$va++; $p=$va%2;
						if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
						echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
						echo "
						<td>".$rw1[1]."</td>
						<td>".$rw1[2]."</td>
						<td>".$rw1[4]."</td>
						<td>".$a."</td>
					
						";

						}
				    }
			   }else{
				/* $sqs="SELECT idciudades, ciu_nombre FROM ciudades WHERE idciudades='$rw1[5]'";
				$DB->Execute($sqs); 
				$ciudadn=$DB->recogedato(0); */
				$va++; $p=$va%2;
				if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
				echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "
				<td>".$rw1[1]."</td>
				<td>".$rw1[2]."</td>
				<td>".$rw1[4]."</td>
				<td>".$rw1[3]."</td>

				";
			   }
			
		   }

echo '</table></td></tr></table></div>
 
     <div id="tercero" style="width: 33%; float:left;">';
	 echo '<table class="table table-hover"><tr bgcolor="#04B404" class="tittle3"><td>Guias Enviadas</td></tr><tr><td>';
		 $FB->titulo_azul1("Guia",1,0,7); 
		 $FB->titulo_azul1("Paquete",1,0,0); 
		$FB->titulo_azul1("Piezas",1,0,0); 
		
	


	 	$sql="SELECT `idservicios`, `ser_consecutivo`,`ser_tipopaquete`, ser_piezas,numeropieza
				FROM serviciosdia inner join piezasguia on ser_consecutivo=numeroguia  where ser_estado in ('6','7')  $conde1 $conde  $conde3 ORDER BY ser_fechaguia desc ";
	   
	   $DB->Execute($sql); $va=0; 
		   while($rw1=mysqli_fetch_row($DB->Consulta_ID))
		   {
			   $id_p=$rw1[0];
			   
			   $va++; $p=$va%2;
			   if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			   echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			   echo "
			   <td>".$rw1[1]."</td>
			   <td>".$rw1[2]."</td>
			   <td>".$rw1[4]."</td>
			   ";

		   }
	 echo '</table></td></tr></table></div>
 
     <div id="cuarto" style="width: 33%; float:left;">';

	 echo '<table class="table table-hover"><tr bgcolor="#FF4000" class="tittle3"><td>Guias mal Enviadas</td></tr><tr><td>';
	 	$FB->titulo_azul1("Guia",1,0,7); 
		 $sql="SELECT idmalpisto,`numeroguiamal`  FROM malpistoleada  where mal_fecha='$param4'  and mal_idsedeori='$param5' and mal_idciudaddes='$param6' ORDER BY mal_fecha desc ";
		
		$DB->Execute($sql); $va=0; 
			while($rw1=mysqli_fetch_row($DB->Consulta_ID))
			{
				$id_p=$rw1[0];
				
				$va++; $p=$va%2;
				if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
				echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
				echo "
				<td>".$rw1[1]."</td>
				";
 
			}
echo '</table></td></tr></table></div>
</div>';

include("footer.php");

?>