<?php 
require("login_autentica.php"); 
include("layout.php");
$DB1 = new DB_mssql;
$DB1->conectar();
if($param35!=''){ $id_sedes=$param35;  } 
if($param36!=''){ $id_sedesvuelta=$param36;  } 

if($nivel_acceso==1 OR $nivel_acceso==10){ $conde2=""; 	 } else { $conde2=" and idsedes=$id_sedes";  }


echo$id_sedes;
?>
<script language="javascript">


// $(function () {
//     $(document).on('change', function (event) {
		
		function cambioestado(valor,item){


			// var input = document.getElementById("miInput");
            // var idservicio = input.value;
		// var valor = $(this).val();
		// var descripcion=document.getElementById("des_"+$(this).attr('name')).value;
		var idservicio=document.getElementById("servicio_"+item).value;
		var piezasg=document.getElementById("piezasg_"+item).value;
		var guia=document.getElementById("guia_"+item).value;

		// event.preventDefault();
		// $(this).closest('tr').remove();
      	datos = {"tipoguia":"validardevuelta","servicio":idservicio,"llego":valor,"piezasg":piezasg,"guia":guia};
		$.ajax({
				url: "guiasok.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){
				
			});

		alert("hola"+valor);
		}
//     });
// });



















function cambionuevo(nombre1,nombre2,destino,nombre3)
{
	var valor=document.getElementById(nombre1).value;
	var valor2=document.getElementById(nombre2).value;
	var valor3=document.getElementById(nombre3).value;
	destino=destino+"?"+nombre1+"="+valor+"&"+nombre2+"="+valor2+"&"+nombre3+"="+valor3;
	document.location.href=destino;
}
function buscarsede()
{

	p1=document.getElementById('param31').value;
	p3=document.getElementById('param33').value;
	p5=document.getElementById('param35').value;
	p2=document.getElementById('param32').value;
	p6=document.getElementById('param36').value;
	destino="guiasinfin.php?param31="+p1+"&param33="+p3+"&param32="+p2+"&param35="+p5+"&param36="+p6;
	
	
	window.location=destino;
	
}
function validarllegada(des)
{

var valorguia= document.getElementById("codigoEscaneado").value;
var operador= document.getElementById("param31").value;
var param1= operador;
var ciudado= document.getElementById("param35").value;
if(ciudado==0){

	alert('Seleccione la ciudad de Destino');

}
if(operador==0){

alert('Seleccione el operario');

}else{

	var guia="";
	var trueorfalse = false;	
		datos = {"valores":valorguia,"operador":operador,"ciudado":ciudado};
		$.ajax({
				url: "asignaoper.php",
				type: "POST",
				data: datos,
				async: false,
				success: function(result) {
/* 					guia= result.resultado;
					if(guia==1){
						
						 alert('EL NUMERO DE GUIA NO EXISTE ,  VERIFIQUE');

					}else if(guia==2){
						$("#mensaje").modal("show"); 
							var divvalor= document.getElementById("mensajevalor3");
							divvalor.innerHTML="<strong>OK!</strong>  GUIA ASIGNADA CON EXITO</a>";


					}else if(guia==3) {

							alert('LA GUIA NO ESTA EN ESTADO  DE ASIGNAR,  VERIFIQUE LA GUIA!');
					}else if(guia==4) {
							$("#mensaje").modal("show"); 
							var divvalor= document.getElementById("mensajevalor3");
							divvalor.innerHTML="<strong>YA FUE ASIGNADA!</strong> LA GUIA YA FUE ASIGNADA,  VERIFIQUE LA GUIA</a>";						
						
					} */
					
				}
			});
			

	}		
	
}
</script>

<?php
$FB->nuevo("", "$id_sedes", "asignar_planillas.php");
$FB->abre_form("form1","guiasok.php","post");

// $conde="and usu_idsede = $id_sedes"; 
$conde="and usu_idsede=$id_sedesvuelta"; 
// $conde="and cli_idciudad = $id_sedes"; 
$conde1=" and inner_sedes=$id_sedes"; 
// $conde1=" and cli_idciudad = $id_sedes";

$FB->titulo_azul1("Asignar Guias A Los Operadores para devolver ",10,0, 5);  

//echo "SELECT `idusuarios`,`usu_nombre`,zon_nombre FROM  seguimiento_user inner join zonatrabajo on seg_idzona=idzonatrabajo  inner join  `usuarios` on idusuarios=seg_idusuario  WHERE `roles_idroles` in (2,3,5) and seg_fechaalcohol='$fechaactual' and (usu_estado=1 or usu_filtro=1) $conde";
//$FB->llena_texto("Mensajero:",1,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `roles_idroles` in (2,3,5)", "cambio2(this.value,\"guias.php\",\"Usuario\")", $rw[1], 1, 1);
$FB->llena_texto("Sede:",35,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde2 )", "cambio4(param36,\"param35\",\"guiasinfin.php\")", "$id_sedes", 1, 1);

//$FB->llena_texto("Operario:",1,2, $DB, "SELECT `idusuarios`,`usu_nombre` FROM `usuarios` WHERE `roles_idroles` in (2,3,5) and  (usu_estado=1 or usu_filtro=1) $conde", "", $param1, 4, 1);
$FB->llena_texto("Sede de vuelta:",36,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 $conde2 )", "cambionuevo(\"param31\",\"param36\",\"guiasinfin.php\",\"param35\")", "$id_sedesvuelta", 1, 1);

$FB->llena_texto("Operario:",31,2, $DB, "SELECT `idusuarios`,concat_ws(' / ',usu_nombre,zon_nombre) as nombre FROM  seguimiento_user inner join zonatrabajo on seg_idzona=idzonatrabajo  inner join  `usuarios` on idusuarios=seg_idusuario  WHERE `roles_idroles` in (2,3,5) and seg_fechaalcohol='$fechaactual' and (usu_estado=1 or usu_filtro=1) $conde", "", $param31, 4, 1);

// $FB->llena_texto("Operario:",31,2, $DB, "SELECT `idusuarios`,concat_ws(' / ',usu_nombre,zon_nombre) as nombre FROM  seguimiento_user inner join zonatrabajo on seg_idzona=idzonatrabajo  inner join  `usuarios` on idusuarios=seg_idusuario  WHERE `roles_idroles` in (2,3,5) and seg_fechaalcohol='$fechaactual' and (usu_estado=1 or usu_filtro=1) $conde", "", $param31, 4, 1);
$FB->llena_texto("Busqueda por:",33,82,$DB,$busqueda1,"",$param33,17,0);
$FB->llena_texto("Dato:", 32, 1, $DB, "", "","$param32",4,0);
// echo"SELECT `idusuarios`,concat_ws(' / ',usu_nombre,zon_nombre) as nombre FROM  seguimiento_user inner join zonatrabajo on seg_idzona=idzonatrabajo  inner join  `usuarios` on idusuarios=seg_idusuario  WHERE `roles_idroles` in (2,3,5) and seg_fechaalcohol='$fechaactual' and (usu_estado=1 or usu_filtro=1) $conde";

echo '<tr><td class="text">Escanear Código: </td><td align="right" ><div class="form-group">
<div class="input-group">
	<div class="input-group-addon"><i class="fa fa-barcode"></i></div>
	<input autofocus type="text" class="form-control producto" name="codigoEscaneado" id="codigoEscaneado" autocomplete="off" onchange="validarllegada(this);">
</div>
</div></td>';

$sql0="SELECT count(idservicios) as total FROM serviciosdia where ser_estado in (8,11) and ser_llego='SI' $conde1 $conde3  ";
$DB1->Execute($sql0);
$total=mysqli_fetch_row($DB1->Consulta_ID);
$FB->llena_texto("Total Registros:", 7, 1, $DB, "", "","$total[0]",4,0);


$conde3=""; 

if($param32!="" and $param33!=""){ 
 $conde3="and $param33 like '%$param32%' "; 
  }else { $conde3="  "; } 

echo "<tr><td><button type='button' class='btn btn-primary btn-lg' onclick='buscarsede();'>Buscar</button></td><td></td>";
echo "<td><button type='submit' class='btn btn-danger btn-lg' >Enviar</button></td><td></td><tr>";


$FB->titulo_azul1("IDguia",1,0,7); 
$FB->titulo_azul1("Guias",1,0,0); 
$FB->titulo_azul1("Vr Flete",1,0,0); 
$FB->titulo_azul1("Piezas",1,0,0); 
$FB->titulo_azul1("Tipo PQ",1,0,0); 
$FB->titulo_azul1("Descripcion",1,0,0); 
$FB->titulo_azul1("Destinatario",1,0,0); 
$FB->titulo_azul1("Ciudad",1,0,0); 
$FB->titulo_azul1("Direcci&oacute;n",1,0,0); 
$FB->titulo_azul1("NO Entregada",1,0,0); 
$FB->titulo_azul1("Estado :",1,0,0); 
$FB->titulo_azul1("Asignar :",1,0,0); 
// $FB->titulo_azul1("Nota",1,0,0); 
$FB->titulo_azul1("Editar :",1,0,0); 



  $sql="SELECT `idservicios`, `ser_consecutivo`,`ser_tipopaquete`,`ser_paquetedescripcion`, `ser_destinatario`, `ciu_nombre`,`ser_direccioncontacto`,`ser_guiare`,ser_estado,ser_descentrega,ser_pendientecobrar,ser_valor,ser_piezas,ser_llego
 FROM serviciosdia where ser_estado in (201,202,11) and  (ser_llego='SI' or ser_llego='devueltaremitente' or ser_llego='devueltaBodega') $conde1 $conde3   ORDER BY ser_estado,ser_fechafinal DESC ";

$DB->Execute($sql); $va=0; 
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$id_p=$rw1[0];
		
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		if($rw1[10]==1){
			$color="#ff4242";
		}else if($rw1[8]==11){ $color="#F39C12";  }
		echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
		$rw1[6]=str_replace("&"," ", $rw1[6]);
				echo "<td align='center' ><a  onclick='pop_dis5($id_p,\"Recogidas\")';  style='cursor: pointer;' title='Detalle Guia' >$id_p</td>";

		echo "
		<td>".$rw1[1]."</td>
		<td>".$rw1[11]."</td>
		<td>".$rw1[12]."</td>
		<td>".$rw1[2]."</td>
		<td>".$rw1[3]."</td>
		<td>".$rw1[4]."</td>
		<td>".$rw1[5]."</td>
		<td>".$rw1[6]."</td>
		<td>".$rw1[9]."</td>
		
		";
		$llegoestado=$rw1[13];



		// echo "<td><textarea name='des_$va' id='des_$va' value='' style='width:195px; class='text' ></textarea></td>";
		// echo "<td><div id='campo$va'>";
		// echo "<select  style='width:120px;border:1px solid #f9f9f9;background-color:#074f91;color:#f9f9f9;font-size:15px'  name='$va' id='$va'   class='borrar' required>";
		// $LT->llenaselect_ar("Selecccione...",$estadosguia);
		// echo "</select></div><input name='servicio_$va' id='servicio_$va' type='hidden'  value='$rw1[0]'></td>";
		echo "<td><div id='campo$va'>";
		echo "<select  style='width:120px;border:1px solid #f9f9f9;background-color:#074f91;color:#f9f9f9;font-size:15px'  name='$va' id='$va' onchange='cambioestado(this.value,\"$va\")' class='borrar' required>";
		// $LT->llenaselect_ar("Selecccione...",$estadosguiasinfin);
		echo"<option value='0'>Seleccione....</option>";
		if ($llegoestado=="devueltaremitente") {
			echo"<option value='devueltaremitente' selected >Devolver a ciudad de origen </option>";
			echo"<option value='devueltaBodega'>Enviar a bodega en Bogota</option>";
		}elseif ($llegoestado=="devueltaBodega") {
			echo"<option value='devueltaremitente'>Devolver a ciudad de origen </option>";
			echo"<option value='devueltaBodega' selected>Enviar a bodega en Bogota</option>";
		}else {
			echo"<option value='devueltaremitente'>Devolver a ciudad de origen </option>";
		echo"<option value='devueltaBodega' >Enviar a bodega en Bogota</option>";
		}
		
		
		// echo"<option value='devueltaremitente'>Devolver a ciudad de origen </option>";
		// echo"<option value='devueltaBodega'>Enviar a bodega en Bogota</option>";
		

		echo "</select></div><input name='servicio_$va' id='servicio_$va' type='hidden'  value='$rw1[0]'></td>";
		echo "<input name='piezasg_$va' id='piezasg_$va' type='hidden'  value='$rw1[11]'>";
		echo "<input name='guia_$va' id='guia_$va' type='hidden'  value='$rw1[1]'>";




		
		if($rw1[10]!=1){	
			echo "<td><input type='checkbox' name='asignar_$va' id='asignar_$va' value='1' style='width:95px; class='trans' >
			<input name='servicio_$va' id='servicio_$va' type='hidden'  value='$rw1[0]'>
			<input name='direccion_$va' id='direccion_$va' type='hidden'  value='$rw1[6]'>
			<input name='guia_$va' id='guia_$va' type='hidden'  value='$rw1[1]'>
			</td>";
		}else{
			echo "<input name='asignar_$va' id='asignar_$va' type='hidden'  value='0'>";
			echo "<td>Pendiente por Cobrar, Debe pagarse Antes.</td>";
		}
		echo "<td align='center'>";
		echo "<a  onclick='pop_dis11($id_p,\"Editar datos\",\"guias.php\",\"recogerok.php\",0)';  style='cursor: pointer;' title='Editardatos' ><img src='img/informacion.jpg'></a></td></tr>";

		
		
	}
echo "<input name='registros' id='registros' type='hidden'  value='$va'>";
$FB->llena_texto("tipoguia", 1, 13, $DB, "", "","operador", 5, 0);
	
include("footer.php");

?>