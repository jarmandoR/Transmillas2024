<?php 
require("login_autentica.php"); 
include("layout.php");
/* include("cabezote1.php"); 
include("cabezote4.php");  */
?>
<script src="js/jquery-2.1.0.min.js"></script>

	<script type="text/javascript">
	
 var version3 = jQuery.noConflict(); 	
 
 version3(document).ready(function(){
	//alert('joseee');

    var maxField = 10; //Input fields increment limitation
    var addButton = version3('.add_button'); //Add button selector
    var wrapper = version3('.field_wrapper'); //Input field wrapper
	var x = document.getElementById("campos").value;
	//alert(x);
    version3(addButton).click(function(){ //Once add button is clicked

	p=x%2;
	if(p==1){ color="#FFFFFF";  } else{  color="#F3F3F3"; }
	
	
	
	var field$html  = '<table width=100% ><tr bgcolor='+color+' class="trans">';
	var field$html  = field$html  + '<td>Ciudad:<select  name="param3'+x+'"  id="param3'+x+'" aling="right" ><option  value=0>Seleccione...</option>';
	var field$html  = field$html  + "<?php $sql="SELECT `idciudades`,`ciu_nombre` FROM `ciudades`  where inner_estados=1"; $LT->llenaselect($sql,0,1, $para, $DB);?>";  	
	var field$html  = field$html  + '</select></td><td>Direcci&oacute;n:<select  name="param4'+x+'"  id="param4'+x+'"  ><option  value=0>Seleccione...</option>';
	var field$html  = field$html  + "<?php $sql="SELECT `iddireccion`, `dir_nombre` FROM `direccion` "; $LT->llenaselect($sql,1,1, $para, $DB);?>";  	
	var field$html  = field$html  + '</select><input  type="text" name="param5'+x+'" id="param5'+x+'" value=""/></td>';
	var field$html  = field$html  +'<td>Lugar de Recogida:<select  name="param6'+x+'"  id="param6'+x+'"  ><option  value=0>Seleccione...</option>';
	var field$html  = field$html  + "<?php $sql="SELECT `idlugar`, `lug_nombre` FROM `lugar` "; $LT->llenaselect($sql,1,1, $para, $DB);?>";  	
	var field$html  = field$html  + '</select><input type="text" name="param7'+x+'" id="param7'+x+'" value=""/></td>';
	var field$html  = field$html  +'</tr><tr bgcolor='+color+' class="trans2"><td>Barrio:<input type="text" name="param8'+x+'" id="param8'+x+'" value="" aling="right"/></td>';
	var field$html  = field$html  +'<td>Tel&eacutefono:<input type="text" name="param9'+x+'" id="param9'+x+'" value=""aling="right" /></td>'
	+'<td>Cliente:<input type="text" name="param10'+x+'" id="param10'+x+'" aling="right" value=""/></td>'
	+'</tr><tr bgcolor='+color+' class="trans2"><td>AU:<input type="text" name="param11'+x+'" id="param11'+x+'" value=""/></td>'
	+'<td>AC:<input type="text" name="param12'+x+'" id="param12'+x+'" value=""/></td>'
	+'</tr></table>'; //New input field $html  
       
	   if(x < maxField){ //Check maximum number of input fields
		    x++;  //Increment field counter
			document.getElementById("campos").value=x;//envia el numero de campos
            $(wrapper).append(field$html ); // Add field $html 
        }
    });


});


	
timer =0;
function testtimeout(nombres){
clearTimeout(timer);
imer =setTimeout(buscar(nombres),3000);
}

 function buscar(nombre) {
			
			var telefono = $("input#param2").val();
			variable = telefono.length; 

			if (variable >= 7) {
				//alert('holaaaa');
				datos = {"vlores":telefono,"tipo":"telefono"};

				$.ajax({
					url: "buscarclientes.php",
					type: "POST",
					data: datos
				}).done(function(respuesta){

					if (respuesta === null) {
						
						
					}	else {
						
						// var idcliente=respuesta.idclientes;
						 var idcliente=respuesta.idclientesdir;

						
						
						var mensaje="EL Cliente con el telefono: "+telefono+" ya Existe";
						alert(mensaje);	
						
						location.href="new_cliente.php?id_param="+idcliente+"&tabla=Clientes&condecion=2";
						
					}				
				});			
			}	
		
	}
</script>

<?php 

if($condecion==2){
	//  $sql="SELECT `idclientesdir`, `cli_iddocumento`, `cli_telefono`, `cli_email`, `cli_idciudad`, `cli_direccion`,  `cli_nombre`,`cli_clasificacion`, `cli_tipo`,cli_principal, `cli_valoraprobado`, `cli_fecharegistro`,cli_au,cli_ac,`cli_whatsap`,`cli_actividade`,`cli_CIIU`,`cli_tipoempresa`,`cli_regimen`,`cli_comercializadora`,`cli_prodoservicio`,`cli_apellidonombre`,`cli_identificacion`,`cli_fechaexp`,`cli_telefijo`,`cli_direcc`,`cli_correo`,`cli_verilistas`,`cli_personcont`,`cli_cargo`,`cli_certificadoen`,`cli_sistemagestion`,`cli_entecertifi`,`cli_normarelaciona`,`cli_fechavencicer`,`cli_ingresosdeactividad`,`cli_ingresosmensu`,`cli_otrosingresos`,`cli_especifiingresos`,`cli_totalactivos`,`cli_totalpasivos`,`cli_bancof`,`cli_producfina`,`cli_numeroref`,`cli_sucursalf`,`cli_nombrecom`,`cli_actividadcom`,`cli_direcciocom`,`cli_ciudadcom`,`cli_telefonocom`,`cli_herrcontrolavado`,`cli_siplaft`,`cli_sarlaft`,`cli_codigoet`,`cli_procedimientos`,`cli_recprovacti`,`cli_personexpue`,`cli_vincpersoexpue`,`cli_nombrepep`,`cli_identipep`,`cli_cargopep`,`cli_entidpep`,`cli_nomrepapo`,`cli_idenrepapo`,`cli_firmahuella`,`cli_autoreprede`,`cli_autonit`,`cli_autofirmarep` FROM `clientes` inner join clientesdir on cli_idclientes=idclientes WHERE  idclientes=$id_param  $cond ";		
	
	 $sql="SELECT `idclientesdir`, `cli_iddocumento`, `cli_telefono`, `cli_email`, `cli_idciudad`, `cli_direccion`,  `cli_nombre`,`cli_clasificacion`, `cli_tipo`,cli_principal, `cli_valoraprobado`, `cli_fecharegistro`,cli_au,cli_ac,`cli_whatsap`,`cli_actividade`,`cli_CIIU`,`cli_tipoempresa`,`cli_regimen`,`cli_comercializadora`,`cli_prodoservicio`,`cli_apellidonombre`,`cli_identificacion`,`cli_fechaexp`,`cli_telefijo`,`cli_direcc`,`cli_correo`,`cli_verilistas`,`cli_personcont`,`cli_cargo`,`cli_certificadoen`,`cli_sistemagestion`,`cli_entecertifi`,`cli_normarelaciona`,`cli_fechavencicer`,`cli_ingresosdeactividad`,`cli_ingresosmensu`,`cli_otrosingresos`,`cli_especifiingresos`,`cli_totalactivos`,`cli_totalpasivos`,`cli_bancof`,`cli_producfina`,`cli_numeroref`,`cli_sucursalf`,`cli_nombrecom`,`cli_actividadcom`,`cli_direcciocom`,`cli_ciudadcom`,`cli_telefonocom`,`cli_herrcontrolavado`,`cli_siplaft`,`cli_sarlaft`,`cli_codigoet`,`cli_procedimientos`,`cli_recprovacti`,`cli_personexpue`,`cli_vincpersoexpue`,`cli_nombrepep`,`cli_identipep`,`cli_cargopep`,`cli_entidpep`,`cli_nomrepapo`,`cli_idenrepapo`,`cli_firmahuella`,`cli_autoreprede`,`cli_autonit`,`cli_autofirmarep`,idclientes FROM `clientes` inner join clientesdir on cli_idclientes=idclientes WHERE  idclientesdir=$id_param  $cond ";		
	
	$DB1->Execute($sql);
	$rw=mysqli_fetch_row($DB1->Consulta_ID);
} else {
	$condecion=1;
}
//echo "wwwwwwwwwwwww".$rw[2];
$FB->abre_form("form1","newclienteok.php","post");
$FB->titulo_azul1("Destinatario",10,0, 5);  

$FB->llena_texto("CC / Nit:",1, 1, $DB, "", "", $rw[1], 1, 0);
$FB->llena_texto("Tel&eacute;fonos :",2, 120, $DB, "", "", $rw[2], 4, 1);
$FB->llena_texto("Whatsapp:",14, 121, $DB, "", "",$rw[14], 1, 1);
$FB->llena_texto("Nombre Del Cliente:", 6, 1, $DB, "", "", $rw[6], 1, 0);
$FB->llena_texto("Ciudad:",4,2,$DB,"(SELECT `idciudades`,`ciu_nombre` FROM `ciudades`  where inner_estados=1)", "", "$rw[4]", 4, 1);
//$FB->llena_texto("Direccion:",5, 1, $DB, "", "", $rw[5], 1, 0);
 

@$direcc=explode("&",$rw[5]);
@$param5=$direcc[0];
@$param51=$direcc[1];
@$param19=$direcc[2];
@$param20=$direcc[3];
@$param23=$direcc[4];

	echo "<tr bgcolor='#FFFFFF' ><td>Direcci&oacute;n:</td>
	<td align='right' ><select class='trans'  name='param5' id='param5'  class='form-control' type='number' style='line-height:10px;' required>";
	echo "<option  value=''>Seleccione...</option>";
    $sql="SELECT `iddireccion`, `dir_nombre` FROM `direccion` ";
    $LT->llenaselect($sql,1,1, $param5, $DB);
    echo "</select>
	<input name='param51' id='param51' class='trans'  type='text' value='$param51' onkeypress='return noenter();'>
	</td>";

	echo "<td>Lugar de Recogida:</td>
	<td align='right' ><select class='trans'  name='param19' id='param19' >";
	echo "<option  value=''>Seleccione...</option>";
    $sql="SELECT `idlugar`, `lug_nombre` FROM `lugar`  ";
    $LT->llenaselect($sql,1,1, $param19, $DB);
    echo "</select>
	<input name='param20' id='param20' class='trans'  type='text' value='$param20' onkeypress='return noenter();'>
	</td>
	</tr>";

$FB->llena_texto("Barrio:", 23, 1, $DB, "", "",$param23, 17, 0);	
$FB->llena_texto("Email:", 3, 111, $DB, "", "", $rw[3], 4, 0);	
if($nivel_acceso==1){
$FB->llena_texto("Valor Autorizado:",25, 118, $DB, "", "", $rw[10], 1, 0);
}else{
	$FB->llena_texto("param25",1, 13, $DB, "", "", $rw[10],2,0);
}

$FB->llena_texto("&#191;Credito?:", 7, 212, $DB, "", "3",$rw[7], 4, 0);	
$FB->llena_texto("AU:",26, 1, $DB, "", "", $rw[12], 17, 0);
$FB->llena_texto("AC:",27, 1, $DB, "", "", $rw[13], 4, 0);


$FB->llena_texto("Actividad economica:",28, 1, $DB, "", "", $rw[15], 17, 0);
$FB->llena_texto("CIIU:",29, 1, $DB, "", "", $rw[16], 4, 0);
$FB->llena_texto("Tipo de empresa:",30, 82, $DB, $tipoempre, "", $rw[17], 17, 0);
// $FB->llena_texto("Tipo de empresa:",26, 1, $DB, "", "", $rw[12], 17, 0);
// $FB->llena_texto("Regimen:",27, 1, $DB, "", "", $rw[13], 4, 0);
$FB->llena_texto("Regimen:",31, 82, $DB, $tiporegimen, "", $rw[18], 4, 0);

// $FB->llena_texto("Comercializadora:",26, 1, $DB, "", "", $rw[13], 4, 0);
$FB->llena_texto("Comercializadora:",32, 82, $DB, $tipocomercializ, "", $rw[19], 17, 0);

$FB->llena_texto("Producto o servicio que suministra",33, 1, $DB, "", "", $rw[20], 4, 0);

$FB->titulo_azul1("Información del Representante Legal o Apoderado",10,0, 5);
$FB->llena_texto("Apellidos y Nombres:",34, 1, $DB, "", "", $rw[21], 1, 0);
$FB->llena_texto("Identificacion:",35, 1, $DB, "", "", $rw[22], 4, 0);
$FB->llena_texto("Lugar y fecha de expedici&oacute;n:",36, 10, $DB, "", "", $rw[23], 1, 0);
$FB->llena_texto("Tel&eacute;fono fijo / celular:",37, 1, $DB, "", "", $rw[24], 4, 0);
$FB->llena_texto("Direcci&oacute;n:",38, 1, $DB, "", "", $rw[25], 1, 0);
$FB->llena_texto("Correo electr&oacute;nico:",39, 1, $DB, "", "", $rw[26], 4, 0);

$FB->titulo_azul1("VERIFICACION DE LISTAS ",10,0, 5);
$FB->llena_texto("Cargo:",40, 1, $DB, "", "", $rw[27], 1, 0);
$FB->llena_texto("Persona de contacto:",41, 1, $DB, "", "", $rw[28], 1, 0);
$FB->llena_texto("Cargo:",42, 1, $DB, "", "", $rw[29], 1, 0);

$FB->titulo_azul1("2.SISTEMA DE GESTION&Oacute",10,0, 5);
$FB->llena_texto("Certificado en:",43, 1, $DB, "", "", $rw[30], 1, 0);
$FB->llena_texto("&#191;sistema de gestion:?:", 44, 82, $DB, $estados, "", $rw[31], 4, 0);	
// $FB->llena_texto("sistema de gestion:",35, 82, $DB, $tipocuentaP, "", "", 4, 0);
$FB->llena_texto("Ente certificador:",45, 1, $DB, "", "", $rw[32], 17, 0);
$FB->llena_texto("Norma con la cual se  relaciona la certificaci&oacute;n: ",46, 1, $DB, "", "", $rw[33], 4, 0);
$FB->llena_texto("Fecha Vencimiento: ",47, 10, $DB, "", "", $rw[34], 1, 0);
//$FB->llena_texto("¿Servicio con Retorno?:", 24, 212, $DB, "", "3",$rw[7],4, 0);	

$FB->titulo_azul1("3. INFORMACION FINANCIERA&Oacute",10,0, 5);
$FB->llena_texto("Ingresos mensuales derivados de su actividad principal : ",48, 1, $DB, "", "", $rw[35], 1, 0);
$FB->llena_texto("Egresos mensuales: ",49, 1, $DB, "", "", $rw[36], 4, 0);
$FB->llena_texto("Otros ingresos: ",50, 1, $DB, "", "", $rw[37], 1, 0);
$FB->llena_texto("Especificar: : ",51, 1, $DB, "", "", $rw[38], 4, 0);
$FB->llena_texto("Total activos : ",52, 1, $DB, "", "", $rw[39], 1, 0);
$FB->llena_texto("Total pasivos : ",53, 1, $DB, "", "", $rw[40], 4, 0);


$FB->titulo_azul1("4. REFERENCIAS FINANCIERAS&Oacute",10,0, 5);
$FB->llena_texto("Banco: ",54, 1, $DB, "", "", $rw[41], 1, 0);
$FB->llena_texto("Producto financiero: ",55, 1, $DB, "", "", $rw[42], 4, 0);
$FB->llena_texto("No. Referencia: ",56, 1, $DB, "", "", $rw[43], 1, 0);
$FB->llena_texto("Sucursal: ",57, 1, $DB, "", "", $rw[44], 4, 0);

$FB->titulo_azul1("5. REFERENCIAS COMERCIALES",10,0, 5);
$FB->llena_texto("Nombre: ",58, 1, $DB, "", "", $rw[45], 1, 0);
$FB->llena_texto("Actividad: ",59, 1, $DB, "", "", $rw[46], 4, 0);
$FB->llena_texto("Direccion: ",60, 1, $DB, "", "", $rw[47], 1, 0);
$FB->llena_texto("Ciudad: ",61, 1, $DB, "", "", $rw[48], 4, 0);
$FB->llena_texto("telefono: ",62, 1, $DB, "", "", $rw[49], 1, 0);


$FB->titulo_azul1("6. PREVENCION DE LAVADO DE ACTIVOS",10,0, 5);
// $FB->llena_texto("Dispone de medios o herramientas para prevenir y controlar el lavado de activos?:",35, 82, $DB, $tipocuentaP, "", "", 1, 0);
$FB->llena_texto("&#191;Dispone de medios o herramientas para prevenir y controlar el lavado de activos?:", 63,  82, $DB, $estados, "", $rw[50], 1, 0);
$FB->llena_texto("Siplaft:",64,82, $DB, $estados, "", $rw[51], 1, 0);
$FB->llena_texto("Sarlaft:",65,82, $DB, $estados, "", $rw[52], 1, 0);
$FB->llena_texto("C&oacute;digo &eacute;tica:",66,82, $DB, $estados, "", $rw[53], 1, 0);
$FB->llena_texto("Procedimientos:",67,82, $DB, $estados, "", $rw[54], 1, 0);

/////////////////
$FB->titulo_azul1("6.1 Declaro y hago constar que:",10,0, 5);
$FB->llena_texto("1. Los recursos para el desarrollo de este contrato no provienen de ninguna actividad considerada ilicita por la ley nacional y provienen de la actividad:",68, 1, $DB, "", "", $rw[55], 1, 0);

$FB->llena_texto("tengo la condicion de persona publicamente expuesta:",69,82, $DB, $estados, "", $rw[56], 4, 0);
$FB->llena_texto("tengo vinculos con una persona publicamente expuesta (sociedad vinculo familiar hasta segundo grado de consanguinidad, segundo de afinidad primero civil):",70,82, $DB, $estados, "", $rw[57], 1, 0);
$FB->llena_texto("En caso de ser afirmativo, indique los datos P.E.P. Nombre:",71, 1, $DB, "", "", $rw[58], 4, 0);
$FB->llena_texto("Identificasion:",72, 1, $DB, "", "", $rw[59], 1, 0);
$FB->llena_texto("Cargo:",73, 1, $DB, "", "", $rw[60], 4, 0);
$FB->llena_texto("Entidad:",74, 1, $DB, "", "", $rw[61], 1, 0);

$FB->titulo_azul1("6.2 autorizacion:",10,0, 5);

$FB->llena_texto("<a id='link'  onclick='pop_dis16(\"$id_p\",\"autorizacion\",\"$rw1[15]\")';  title='Leer autorizacion' > Leer autorizacion: ","", "", $DB, "", "", "", 1, 0);


$FB->titulo_azul1("7. Prevención de lavado de activos y financiacion del terrorismo:",10,0, 5);

// echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16(\"$id_p\",\"autorizacion\",\"$rw1[15]\")';  title='Leer autorizacion' > Leer autorizacion</td>";


$FB->llena_texto("<a id='link'  onclick='pop_dis16(\"$id_p\",\"prevencion\",\"$rw1[15]\")';  title='Leer autorizacion' > Leer prevencion de lavado de activos y financiacion del terrorismo: ","", "", $DB, "", "", "", 1, 0);

$FB->llena_texto("Nombre del representante o apoderado  ",75, 1, $DB, "", "", $rw[62], 1, 0);
$FB->llena_texto("Identificacion: ",76, 1, $DB, "", "", $rw[63], 4, 0);
$FB->llena_texto("Foto de firma y huella:", 77, 6, $DB, "", "","./imgclientdoc/".$rw[64],1, 0);
echo $rw[64];
$FB->titulo_azul1("8. AUTORIZACION TRATAMIENTO DE DATOS PERSONALES",10,0, 5);
$FB->llena_texto("AUTORIZACION: Por medio del presente el Representante legal de: ",78, 1, $DB, "", "", $rw[65], 1, 0);
$FB->llena_texto(" Identificado con Nit. No.: ",79, 1, $DB, "", "",$rw[66], 4, 0);
echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16(\"$id_p\",\"autorizacion1\",\"$rw1[15]\")';  title='Leer autorizacion1' > Leer autorizacion</td>";
$FB->llena_texto("Firma del Representante Legal:", 80, 6, $DB, "", "", "./imgclientdoc/".$rw[67],1, 0);

$FB->cierra_tabla(); 	
	
echo '<div class="field_wrapper">
	<a href="javascript:void(0);" class="add_button" title="Add field"><img src="img/agregar.jpg"/>AGREGAR</a>';
	echo"<table width='100%'  ><tr bgcolor='#074F91' class=''><td colspan='8' width='' align='center'   style='color:#FFFFFF' >AGREGAR DIRECCI&Oacute;N</td></tr>";
	
	$campos=1;
	if($condecion==2){
	 
		// $sql="SELECT `idclientesdir`,`cli_idciudad`,  `cli_direccion`,  `cli_telefono`,  `cli_nombre`,  `cli_au`,  `cli_ac` FROM  clientesdir  WHERE  cli_idclientes=$id_param and cli_principal=0 ";		
		$sql="SELECT `idclientesdir`,`cli_idciudad`,  `cli_direccion`,  `cli_telefono`,  `cli_nombre`,  `cli_au`,  `cli_ac` FROM  clientesdir  WHERE  idclientesdir=$id_param and cli_principal=0 ";		
	
		$DB1->Execute($sql);
	$va=0;
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
		{
		 $id_p=$rw1[0];
		$va++; $p=$va%2;
		if($p==0){$color="#EFEFEF";} else{$color="#FFFFFF";}
		
		@$direcc=explode("&",$rw1[2]);
		@$param4=$direcc[0];
		@$param5=$direcc[1];
		@$param6=$direcc[2];
		@$param7=$direcc[3];
		@$param8=$direcc[4];
		
		echo  '<tr bgcolor='.$color.' class="trans">';
		echo "<td>Ciudad:<select name='param3$va'  id='param3$va'  ><option  value=0>Seleccione...</option>";
		$sql="SELECT `idciudades`,`ciu_nombre` FROM `ciudades`  where inner_estados=1"; 
		$LT->llenaselect($sql,0,1, $rw1[1], $DB);  	
		echo '</select></td><td>Direcci&oacute;n:<select  name="param4'.$va.'"  id="param4'.$va.'"  ><option  value=0>Seleccione...</option>';
		$sql="SELECT `iddireccion`, `dir_nombre` FROM `direccion` "; 
		$LT->llenaselect($sql,1,1, $param4, $DB); 	
		echo '</select><input  type="text" name="param5'.$va.'" id="param5'.$va.'" value="'.$param5.'"/></td>';
		echo '<td>Lugar de Recogida:<select  name="param6'.$va.'"  id="param6'.$va.'"  ><option  value=0>Seleccione...</option>';
		$sql="SELECT `idlugar`, `lug_nombre` FROM `lugar` "; 
		$LT->llenaselect($sql,1,1, $param6, $DB);  	
		echo '</select><input type="text" name="param7'.$va.'" id="param7'.$va.'" value="'.$param7.'"/></td>';
		echo '</tr><tr bgcolor='.$color.' class="trans2"><td>Barrio:<input type="text" name="param8'.$va.'" id="param8'.$va.'" value="'.$param8.'"/></td>';
		echo '<td>Tel&eacutefono:<input type="text" name="param9'.$va.'" id="param9'.$va.'" value="'.$rw1[3].'"/></td>
		<td>Cliente:<input type="text" name="param10'.$va.'" id="param10'.$va.'" value="'.$rw1[4].'"/></td>
		</tr><tr bgcolor='.$color.' class="trans"><td>AU:<input type="text" name="param11'.$va.'" id="param11'.$va.'" value="'.$rw1[5].'"/></td>
		<td>AC:<input type="text" name="param12'.$va.'" id="param12'.$va.'" value="'.$rw1[6].'"/></td>
		<input type="hidden" name="paramid'.$va.'" id="paramid" value="'.$id_p.'">
		</tr>'; //New input field $html  
		
		}
	
	$campos=$va;
	$campos++;
	}
	
	echo '<input type="hidden" name="campos" id="campos" value="'.$campos.'">
			<input type="hidden" name="inserta" id="inserta" value="'.$va.'">
		 <input type="hidden" name="id_param" id="id_param" value="'.$rw[68].'">
		 <input type="hidden" name="id_param0" id="id_param0" value="'.$rw[0].'">
		<input type="hidden" name="condecion" id="condecion" value="'.$condecion.'">
		</table>';
	echo '</div>';

echo "<tr bgcolor='#F5F5F5'><td align='center' colspan='4'>
	<input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip'  onClick='javascript:history.back();' value='Cerrar' style='width:190px;' > 
	<input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip' type='submit' id='enviar' name='enviar' value='GUARDAR' style='width:190px;' >
	</td>
	</tr>";

	
include("footer.php");
?>