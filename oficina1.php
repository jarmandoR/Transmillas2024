<script>
function validarguia()
{

var valorguia= document.getElementById("param16").value;
	var guia="";
	var trueorfalse = false;	
		datos = {"vlores":valorguia,"tipo":"1","idguia":"0"};
		$.ajax({
				url: "validarguia.php",
				type: "POST",
				data: datos,
				async: false,
				success: function(result) {
					guia= result.ser_guiare;
					//alert("EL NUMERO DE GUIA "+guia+" YA EXISTE");
					if(guia!=''){
					trueorfalse=false;
					}else {
						trueorfalse=true;
					}
				}
			});
			
			if(trueorfalse==false){
				$("#enviarmensaje").modal("show"); 
				var divvalor= document.getElementById("mensajevalor2");
				divvalor.innerHTML="<strong>Atencion!</strong> EL NUMERO DE GUIA YA EXISTE: "+guia+" VERIFIQUE!</a>";
				return false;
		
			}else {
				return trueorfalse;
			}
}


timer =0;
function testtimeout(nombres){
clearTimeout(timer);
imer =setTimeout(buscar(nombres),2000);
}

 function cambiar() {
	// alert(document.getElementById("param16").value);
	  if(document.getElementById("param16").value==''){
		 document.getElementById("param17").required=false; 
	  }
	 else {
		 document.getElementById("param17").required=true;
	 } 

 }

 function buscar(nombre) {

 if(nombre=='param1'){
	var documento = $("input#param1").val();
	variable = documento.length; 
	var telefono = $("input#param2").val();
	variable2 = telefono.length; 

	if (variable >= 7) {
		datos = {"vlores":documento,"tipo":"documento"};

		$.ajax({
				url: "buscarclientes.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){

				if (respuesta === null) {

					//console.log(JSON.stringify(respuesta));
					//document. getElementById("param1").value='';
					cambio_ajax2(1, 14, 'clientesdir', 'telefono', 1, '');
					document. getElementById("id_param1").value=0;
					document. getElementById("param2").value='';
					document. getElementById("param3").value='';
					document. getElementById("param4").value='';
					document.getElementById("param5").value='0';
					document.getElementById("param51").value='';
					document.getElementById("param19").value='0';
					document.getElementById("param20").value='';
					document.getElementById("param23").value='';
					document.getElementById("param6").value='';
					document.getElementById("0").checked = true;
					
					document. getElementById("id_param").value='0';		
				}
				else {
					cambio_ajax2(documento, 14, 'clientesdir', 'documento', 1, respuesta.cli_nombre);	
					//document. getElementById("param1").value=respuesta.cli_iddocumento;
					document. getElementById("param2").value=respuesta.cli_telefono;
					document. getElementById("param3").value=respuesta.cli_email;
					document. getElementById("param4").value=respuesta.cli_idciudad
					//document. getElementById("param4").value='';
					var res = respuesta.cli_direccion.split("&");
					if (typeof res[4] === 'undefined') { res[4]=''; }
					document.getElementById("param5").value=res[0];
					document.getElementById("param51").value=res[1];
					document.getElementById("param19").value=res[2];
					document.getElementById("param20").value=res[3];
					document.getElementById("param23").value=res[4];					
					document. getElementById("param6").value=respuesta.cli_nombre;
					//document. getElementById(respuesta.cli_clasificacion).checked = true;
					document. getElementById("id_param2").value=respuesta.idclientesdir;					
					document. getElementById("id_param").value=respuesta.idclientes;
					document. getElementById("id_param1").value=1;
					 //document.getElementById('id_del_input').checked  document.form1.param7[7].value

				}

			});			

	}	

 } else  if(nombre=='param2'){

	 var telefono = $("input#param2").val();
	 variable2 = telefono.length; 

	if (variable2 >= 7) {
		datos = {"vlores":telefono,"tipo":"telefono"};
		$.ajax({
				url: "buscarclientes.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){

				if (respuesta === null) {				
					if(document. getElementById("id_param1").value!=1){
					cambio_ajax2(1, 14, 'clientesdir', 'telefono', 1,'');
					}

					document.getElementById("id_param").value='0';
					document.getElementById("param3").value='';
					document.getElementById("param6").value='';
					document.getElementById("param4").value='';
					document.getElementById("param5").value=0;
					document.getElementById("param51").value='';
					document.getElementById("0").checked = true;
					//document.getElementById("param7").checked = false; 
					document.getElementById("param19").value=0; 
					document.getElementById("param20").value=''; 
					document.getElementById("param23").value=''; 
				}

				else {
					//document. getElementById("param1").value=respuesta.cli_iddocumento;
					//document. getElementById("param2").value=respuesta.cli_telefono;
					cambio_ajax2(documento, 14, 'clientesdir', 'telefono', 1, respuesta.cli_nombre);
					document. getElementById("param3").value=respuesta.cli_email;
					document. getElementById("param4").value=respuesta.cli_idciudad;
					//document. getElementById("param4").value='';
					 var res = respuesta.cli_direccion.split("&");
					 if (typeof res[4] === 'undefined') { res[4]=''; }
					document. getElementById("param5").value=res[0];
					document. getElementById("param51").value=res[1];
					document. getElementById("param19").value=res[2];
					document. getElementById("param20").value=res[3];
					document. getElementById("param23").value=res[4]; 

					document. getElementById("id_param2").value=respuesta.idclientesdir;
					document. getElementById("id_param").value=respuesta.idclientes;
					if(respuesta.cli_clasificacion!=null){
					//	document. getElementById(respuesta.cli_clasificacion).checked = true;
					}	

				}

			});	

	}
 } else  if(nombre=='param6'){	

		var idclinte = document.getElementById("param61").value;
		datos = {"vlores":idclinte,"tipo":"cliente"};
		$.ajax({

				url: "buscarclientes.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){

					document. getElementById("param4").value=respuesta.cli_idciudad;
					//document. getElementById("param4").value='';
	 				var res = respuesta.cli_direccion.split("&");
					if (typeof res[4] === 'undefined') { res[4]=''; }
					document. getElementById("param5").value=res[0];
					document. getElementById("param51").value=res[1];
					document. getElementById("param19").value=res[2];
					document. getElementById("param20").value=res[3];
					document. getElementById("param23").value=res[4]; 
					document. getElementById("param6").value=respuesta.cli_nombre;
					document. getElementById("id_param2").value=respuesta.idclientesdir;
			});

 } else  if(nombre=='param8'){
 
	var telefono = $("input#param8").val();
	variable2 = telefono.length; 

	if (variable2 >= 7) {

		datos = {"vlores":telefono,"tipo":"telefono"};
		$.ajax({

				url: "buscarclientes.php",
				type: "POST",
				data: datos

			}).done(function(respuesta){

				if (respuesta === null) {
					
					document. getElementById("param9").value='';
					
					document. getElementById("param10").value=0;
					document. getElementById("param101").value='';
					document. getElementById("param21").value=0;
					document. getElementById("param22").value='';
					document. getElementById("param24").value='';
					document. getElementById("param11").value='';
					document. getElementById("id_param0").value=0;
					}

				else {
					document. getElementById("param9").value=respuesta.cli_nombre;
					var res = respuesta.cli_direccion.split("&");
					if (typeof res[4] === 'undefined') { res[4]=''; }
					document. getElementById("param10").value=res[0];
					document. getElementById("param101").value=res[1];
					document. getElementById("param21").value=res[2];
					document. getElementById("param22").value=res[3];
					document. getElementById("param24").value=res[4];
					document. getElementById("param11").value=respuesta.cli_idciudad;
					//document. getElementById("param11").value='';

					document. getElementById("id_param0").value=respuesta.idclientesdir;
				}

			});

	}

 } else  if(nombre=='param9'){	

var idclinte = document.getElementById("param71").value;
datos = {"vlores":idclinte,"tipo":"cliente"};
$.ajax({

		url: "buscarclientes.php",
		type: "POST",
		data: datos
	}).done(function(respuesta){

					cambio_ajax2(documento, 19, 'clientesdir2', 'documento', 1, respuesta.cli_nombre);
					var res = respuesta.cli_direccion.split("&");
					if (typeof res[4] === 'undefined') { res[4]=''; }
					document. getElementById("param10").value=res[0];
					document. getElementById("param101").value=res[1];
					document. getElementById("param21").value=res[2];
					document. getElementById("param22").value=res[3];
					document. getElementById("param24").value=res[4];
					document. getElementById("param11").value=respuesta.cli_idciudad;
					//document. getElementById("param11").value='';

					document. getElementById("id_param0").value=respuesta.idclientesdir;
				
	});

} 
 else  if(nombre=='param7'){

	var documento = $("input#param7").val();
	variable = documento.length; 
	var telefono = $("input#param8").val();
	variable2 = telefono.length; 

	if (variable >= 7) {
		datos = {"vlores":documento,"tipo":"documento"};

	 $.ajax({

			 url: "buscarclientes.php",
			 type: "POST",
			 data: datos

		 }).done(function(respuesta){

			 if (respuesta === null) {
				//cambio_ajax2(1, 19, 'clientesdir2', 'telefono', 1, '');
				 document. getElementById("param9").value='';
				 document. getElementById("param10").value=0;
				 document. getElementById("param101").value='';
				 document. getElementById("param21").value=0;
				 document. getElementById("param22").value='';
				 document. getElementById("param24").value='';
				 document. getElementById("param11").value='';
				 document. getElementById("id_param0").value=0;
			 }
			 else {
				cambio_ajax2(documento, 19, 'clientesdir2', 'documento', 1, respuesta.cli_nombre);
				document. getElementById("param8").value=respuesta.cli_telefono;
				 document. getElementById("param9").value=respuesta.cli_nombre;
				 var res = respuesta.cli_direccion.split("&");
				 if (typeof res[4] === 'undefined') { res[4]=''; }
				 document. getElementById("param10").value=res[0];
				 document. getElementById("param101").value=res[1];
				 document. getElementById("param21").value=res[2];
				 document. getElementById("param22").value=res[3];
				 document. getElementById("param24").value=res[4];
				 document. getElementById("param11").value=respuesta.cli_idciudad;
				 //document. getElementById("param11").value='';

				 document. getElementById("id_param0").value=respuesta.idclientesdir;
			 }

		 });

 }

}

}; 

//`idclientes`, `cli_iddocumento`, `cli_nombre`, `cli_email`, `cli_direccion`, `cli_idciudad`, `cli_telefono`, `cli_clasificacion`, `cli_tipo`, `cli_fecharegistro`

</script>
<?php 
//include("cabezote1.php"); 
$tcampod=1;
$tcampot=121;

if($estadofactura=='verificacion'){
	$tcampod=1;
	$tcampot=121;	
}

else if($estadofactura=='recoleccion'){
	$tcampod=117;
	$tcampot=120;	
}

@$param4=$rw[4];
// echo $id_usuario;
//if($param4==''){  $param4=$id_ciudad; }  
if($nivel_acceso!=1){  $cond6=" WHERE inner_sedes='$id_sedes' and inner_estados=1"; }  else { $cond6=" where inner_estados=1"; }
//$FB->abre_form("form1","recolecciondatosok.php","post");
echo '<form action="recolecciondatosok1.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return validarguia();" >';

$FB->titulo_azul1("Remitente",10,0, 5);  

$FB->llena_texto("CC / Nit:",1, $tcampod, $DB, "", "", $rw[1], 1, 0);
$FB->llena_texto("Tel&eacute;fonos :",2, $tcampot, $DB, "", "", $rw[2], 4, 1);
//$FB->llena_texto("Nombre Del Cliente:", 6, 1, $DB, "", "", $rw[6], 1, 0);
	echo  "<tr bgcolor='#F3F3F3' ><td>Remitente:</td><td colspan=1><div id='clientesdir'>";
	echo ' <select class="trans"  name="param61"  id="param61" ><option  value=0>--Clientes--</option></select>';
	echo " <input name='param6' id='param6' class='trans'  type='text' value='$rw[6]' onkeypress='return noenter();'>
	</div></td>";

$FB->llena_texto("Ciudad:",4,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM `ciudades` $cond6)", "", "$param4", 4, 1);
//$FB->llena_texto("Direccion:",5, 1, $DB, "", "", $rw[5], 1, 0);

@$direcc=explode("&",$rw[5]);
@$param5=$direcc[0];
@$param51=$direcc[1];
@$param19=$direcc[2];
@$param20=$direcc[3];
@$param23=$direcc[4];
	echo "<tr bgcolor='#FFFFFF' ><td>Lugar de Recogida:</td>
	<td align='left' ><select class='trans'  name='param5' id='param5' >";
	echo "<option  value=''>Seleccione...</option>";
    $sql="SELECT `iddireccion`, `dir_nombre` FROM `direccion` ";
    $LT->llenaselect($sql,1,1, $param5, $DB);
    echo "</select>
	<input name='param51' id='param51' class='trans'  type='text' value='$param51' onkeypress='return noenter();'>
	</td>";

	echo "<td></td>
	<td align='left' ><select class='trans'  name='param19' id='param19' >";
	echo "<option  value='0'>Seleccione...</option>";
    $sql="SELECT `idlugar`, `lug_nombre` FROM `lugar`  ";
    $LT->llenaselect($sql,1,1, $param19, $DB);
    echo "</select>
	<input name='param20' id='param20' class='trans'  type='text' value='$param20' onkeypress='return noenter();'>
	</td>
	
	</tr>";

$FB->llena_texto("Barrio:", 23, 1, $DB, "", "", $param23, 17, 0);	
$FB->llena_texto("Email:", 3, 111, $DB, "", "", $rw[3], 4, 0);	
//$FB->llena_texto("&iquest;Credito?:", 7, 212, $DB, "", "3",$rw[7], 4, 2);	

$FB->titulo_azul1("Destinatario",9,0,5); 

$FB->llena_texto("CC / Nit:",7, $tcampod, $DB, "", "", $rw[7], 1, 0);
$FB->llena_texto("Tel&eacute;fono De Contacto:",8, $tcampot, $DB, "", "", $rw[8], 4, 1);
//$FB->llena_texto("Nombre Destinatario:",9, 1, $DB, "", "", $rw[9], 4, 1);

echo  "<tr bgcolor='#F3F3F3' ><td>Nombre:</td><td colspan=1><div id='clientesdir2'>";
echo ' <select class="trans"  name="param71"  id="param71" ><option  value=0>--Clientes--</option></select>';
echo " <input name='param9' id='param9' class='trans'  type='text' value='$rw[9]' onkeypress='return noenter();'>
</div></td>";

$FB->llena_texto("Ciudad:",11,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM `ciudades`  where inner_estados=1)", "", "$rw[11]", 4, 1);

//$FB->llena_texto("Direccion del Contacto:",10, 1, $DB, "", "", $rw[10], 4, 1);

@$direcc2=explode("&",$rw[10]);
@$param10=$direcc2[0];
@$param101=$direcc2[1];
@$param21=$direcc2[2];
@$param22=$direcc2[3];
@$param24=$direcc2[4];

	echo "<tr bgcolor='#FFFFFF' ><td>Direcci&oacute;n del Contacto:</td>
	<td align='left' ><select class='trans'  name='param10' id='param10' >";
	echo "<option  value=''>Seleccione...</option>";
    $sql="SELECT `iddireccion`, `dir_nombre` FROM `direccion` ";
    $LT->llenaselect($sql,1,1, $param10, $DB);

    echo "</select>
	<input name='param101' id='param101' class='trans'  type='text' value='$param101' onkeypress='return noenter();'>
	</td>";

	echo "<td>Lugar de Entrega:</td>
	<td align='left' ><select class='trans'  name='param21' id='param21' >";
	echo "<option  value='0'>Seleccione...</option>";
    $sql="SELECT `idlugar`, `lug_nombre` FROM `lugar`  ";
    $LT->llenaselect($sql,1,1, $param21, $DB);
    echo "</select>
	<input name='param22' id='param22' class='trans'  type='text' value='$param22' onkeypress='return noenter();'>
	</td></tr>
	";

$FB->llena_texto("Barrio:", 24, 1, $DB, "", "", $param24, 1, 0);	
$FB->titulo_azul1("Servicio",9,0,5); 
$FB->llena_texto("Tipo de paquete:",12,82, $DB, $paquete, "",@$rw[12], 1, 0);
$FB->llena_texto("Dice contener:",13, 1, $DB, "", "", $rw[13], 4, 0);
//$FB->llena_texto("Servicio:",15,82, $DB, $Servicio, "",@$rw[15],1, 1);

//$FB->llena_texto("Valor de Prestamo:",16, 118, $DB, "", "", $rw[16],17, 0);
$FB->llena_texto("# de GUIA:",16, 1, $DB, "", "", $rw[16],17, 1);
$FB->llena_texto("Abono:",17, 118, $DB, "", "", $rw[17], 4, 0);
if(@$rw[18]==''){
	$sql12="SELECT seg_nombre FROM `seguro`  order by idseguro desc limit 1";
	$DB1->Execute($sql12);
	$porcentaje=mysqli_fetch_array($DB1->Consulta_ID);
	$seguro=$porcentaje['0'];
} else{
	$seguro=$rw[18];
}

$FB->llena_texto("Seguro:",18, 126, $DB, "", "$seguro", $seguro, 1, 0);

$FB->llena_texto("Peso KG:",26,1, $DB, "", "","" ,4, 1);	
$FB->llena_texto("Volumen:",27,1, $DB, "", "","",1, 0);	
$FB->llena_texto("# Piezas:",30, 123, $DB, "", "", "", 4, 'min=1');
$FB->llena_texto("Estado Paquete:",31,9, $DB, "", "","" ,17, 1);
$FB->llena_texto("&iquest;Verificado?:",32, 214, $DB, "", "","", 4, 1);	
$FB->llena_texto("Tipo:",33,2, $DB, "(SELECT `tip_nombre`,`tip_nombre` FROM `tipo`)", "","", 1, 1);
$FB->llena_texto("Giros $:",29,118, $DB, "", "","",4, 0);	
$FB->llena_texto("&iquest;Servicio con Retorno?:", 25, 212, $DB, "", "3","",17, 0);	
$FB->llena_texto("Tipo de Servicio:",34,279, $DB, "(SELECT `idtiposervicio`,`tip_nom` FROM `tiposervicio`)", "","", 4, 1);

$FB->llena_texto("Tipo Pago:", 28, 213, $DB, "3", "valorpagar(this.value,17,\"llega_sub2\",\"total valor\",1,$id_usuario)","",1, 0);


$FB->llena_texto("", 2, 4, $DB, "llega_sub2", "", "",1,0);

$FB->llena_texto("param15", 1, 13, $DB, "", "", "$param15", 5, 0); 
//$FB->llena_texto("param16", 1, 13, $DB, "", "", "0", 5, 0); 
$FB->llena_texto("id_param", 1, 13, $DB, "", "", "$rw[0]", 5, 0); // idcliente
$FB->llena_texto("id_param0", 1, 13, $DB, "", "", "$rw[21]", 5, 0);
$FB->llena_texto("id_param1", 1, 13, $DB, "", "", "0", 5, 0);
$FB->llena_texto("id_param2", 1, 13, $DB, "", "", "$rw[19]", 5, 0);  // clientesdir
$FB->llena_texto("id_usuario", 1, 13, $DB, "", "", "$id_usuario", 5, 0);

?> 