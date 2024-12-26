<?php 
require("login_autentica.php"); 
include("layout.php");
//include("cabezote4.php"); 
?>
<head>
<script>
function buscarsede(dato)
{

	p1=document.getElementById('param1').value;
	p2=document.getElementById('param2').value;

	p6=document.getElementById('param6').value;
	p5=document.getElementById('param5').value;
	p4=document.getElementById('param4').value;
	if(dato==3){
		destino="ticketfacturatodos3.php?param1="+p1+"&param2="+p2+"&param4="+p4+"&param5="+p5+"&param6="+p6;
	
	}

	window.location=destino;
	
}
function validarllegada(des)
{

var valorguia= document.getElementById("codigoEscaneado").value;
var ciudaddes= document.getElementById("param5").value;
var ciudado= document.getElementById("param6").value;

//alert(des);
//alert(valorguia);

	var guia="";
	var trueorfalse = false;	
		datos = {"valores":valorguia,"ciudaddes":ciudaddes,"ciudado":ciudado};
		$.ajax({
				url: "validallegada.php",
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
					//	 alert('EL NUMERO DE GUIA NO EXISTE O NO ES SU DESTINO,  VERIFIQUE');

					}else if(guia==2) {
						$("#mensaje").modal("show"); 
							var divvalor= document.getElementById("mensajevalor3");
							divvalor.innerHTML="<strong>OK!</strong>  GUIA VALIDADA CON EXITO</a>";


					}else if(guia==3) {
					/* 	$("#enviarmensaje").modal("show"); 
							var divvalor= document.getElementById("mensajevalor2");
							divvalor.innerHTML="<strong>Atencion!</strong> LA GUIA NO ESTA EN ESTADO VALIDAR LLEGADA,  VERIFIQUE LA GUIA!</a>"; */

						//	alert('LA GUIA NO ESTA EN ESTADO VALIDAR LLEGADA,  VERIFIQUE LA GUIA!');
					}else if(guia==4) {
					/* 	$("#enviarmensaje").modal("show"); 
							var divvalor= document.getElementById("mensajevalor2");
							divvalor.innerHTML="<strong>Atencion!</strong> LA GUIA NO ESTA EN ESTADO VALIDAR LLEGADA,  VERIFIQUE LA GUIA!</a>"; */
							$("#mensaje").modal("show"); 
					
							var divvalor= document.getElementById("mensajevalor3");
							divvalor.innerHTML="<strong>YA REGISTRADA !</strong> LA GUIA YA FUE PISTOLEADA COMO LLEGADA,  VERIFIQUE LA GUIA</a>";
						
					}
					return false;
					
					
				}
			});
			
	
			
}

</script>
</head>

<body onload="">

<?php 

if($nivel_acceso==1 or $nivel_acceso==10 or $nivel_acceso==9){ $conde2="";  } else { $conde2=" and idsedes=$id_sedes";  }
if($param6!='' ){ 
			//$id_sedes=$param6; 
			$idcidades=ciudadesedes($param6,$DB);
			if($idcidades=='0'){
				$conde1="";

			}else {
			  $conde1=" and cli_idciudad in $idcidades "; 	
			}
  } else {  
  
			$conde1="";

  }
  if($param5!=''){ 
	$id_sedes=$param5; 
}
  $idcidades2=ciudadesedes($param5,$DB);
  $conde1.=" and ser_ciudadentrega in $idcidades2 "; 	


$FB->abre_form("form1","","post");
$FB->titulo_azul1("Validar las Guias Enviadas",9,0,5);  
$FB->abre_form("form1","","post");

$conde="and ser_fechaguia like '$fechaactual%'"; 

if($param4!=''){ $conde="and ser_fechaguia like '$param4%' ";  $fechaactual=$param4;  }
$FB->llena_texto("Fecha de Busqueda:", 4, 10, $DB, "", "", "$fechaactual", 1, 0);

$FB->llena_texto("Sede Destino:",5,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde2  )", "", "$id_sedes", 1, 1);
$FB->llena_texto("Sede De Origen:",6,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes  where idsedes>0 )", "", "$param6", 4, 0);

$FB->llena_texto("Busqueda por:",1,82,$DB,$busqueda1,"",$param1,17,0);
$FB->llena_texto("Dato:", 2, 1, $DB, "", "","$param2", 4,0);
echo '<tr><td class="text">Escanear Código: </td><td align="right" ><div class="form-group">
<div class="input-group">
	<div class="input-group-addon"><i class="fa fa-barcode"></i></div>
	<input autofocus type="text" class="form-control producto" name="codigoEscaneado" id="codigoEscaneado" autocomplete="off" onchange="validarllegada(this);">
</div>
</div></td>';

echo "<td><button type='button' class='btn btn-primary btn-lg' onclick='buscarsede(3);' target='_blank' >Imprimir</button></td></tr>";

$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

//$FB->titulo_azul1("Reasignar",1,0,0); 
//$FB->titulo_azul3("Validar",2,0,2,$param_edicion);

$conde3=""; 

if($param2!="" and $param1!=""){ 
	$conde3="and $param1 like '%$param2%' "; 
  }else { $conde3="  "; } 

  echo '</table>
  <div id="contenedor" style="display:flex;">

   <div id="segundo" style="width: 45%; float:left;">';
   echo '<table class="table table-hover"><tr bgcolor="#868A08" class="tittle3"><td>Guias X Validar</td></tr><tr><td>';
	   $FB->titulo_azul1("Fecha",1,0,7); 
	   $FB->titulo_azul1("Guia",1,0,0); 
	   $FB->titulo_azul1("Paquete",1,0,0); 
	   $FB->titulo_azul1("Descripcion",1,0,0); 
	  $FB->titulo_azul1("Piezas",1,0,0); 

	  $sql="SELECT `idservicios`, `ser_consecutivo`,`ser_tipopaquete`, ser_piezas,numeropieza,ser_fechaguia,ser_paquetedescripcion,cli_idciudad
	  FROM serviciosdia inner join piezasguia on ser_consecutivo=numeroguia  where ser_estado in ('6','7') and guiallega=0  $conde1   $conde3 ORDER BY ser_fechaguia desc ";
	 $DB->Execute($sql); $va=0; 
	 while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	 {
		 $id_p=$rw1[0];
		 
		 $va++; $p=$va%2;
		 if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		 echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		 echo "
		 <td>".$rw1[5]."</td>
		 <td><a  onclick='pop_dis5($id_p,\"Recogidas\")';  style='cursor: pointer;' title='Detalle Guia' >".$rw1[1]."</a></td>
		 

		 <td>".$rw1[2]."</td>
		 <td>".$rw1[6]."</td>
		 <td>".$rw1[4]."</td>
		 ";

	 }

echo '</table></td></tr></table></div>

   <div id="tercero" style="width: 30%; float:left;">';
   echo '<table class="table table-hover"><tr bgcolor="#04B404" class="tittle3"><td>Guias Validadas</td></tr><tr><td>';
	   $FB->titulo_azul1("Guia",1,0,7); 
	   $FB->titulo_azul1("Paquete",1,0,0); 
	  $FB->titulo_azul1("Piezas",1,0,0); 
	  $FB->titulo_azul1("Imprimir",1,0,0); 


	   $sql="SELECT `idservicios`, `ser_consecutivo`,`ser_tipopaquete`, ser_piezas,numeropieza
			  FROM serviciosdia inner join piezasguia on ser_consecutivo=numeroguia  where ser_estado in ('8') and guiallega=1 $conde1 $conde  $conde3 ORDER BY ser_fechaguia desc ";
	 
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
			 echo "<td align='center' >";
			 echo "<a href='ticketfactura.php?id_param=$id_p&pagina2=validarguiapistola.php' target='_blank'><img src='img/imprimir.png'></a></td>";	
	 

		 }
   echo '</table></td></tr></table></div>

   <div id="cuarto" style="width: 20%; float:left;">';

   echo '<table class="table table-hover"><tr bgcolor="#FF4000" class="tittle3"><td>Guias mal Enviadas</td></tr><tr><td>';
	   $FB->titulo_azul1("Guia",1,0,7); 
	   $sql="SELECT idmalpisto,`numeroguiamal`  FROM malpistoleada  where mal_fecha='$param4'  and mal_idsedeori='$param5' and mal_idciudaddes='$param6' and mal_enviada=1 ORDER BY mal_fecha desc ";
	  
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