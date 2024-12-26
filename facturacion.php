<?php 
require("login_autentica.php");
include("cabezote1.php"); 
include("cabezote4.php"); 
?>
<script src="js/jquery-2.1.0.min.js"></script>

 <script>
/* $(document).ready(function() {
	
   $.post("buscar.php", {idcodigoname: 'Todos'}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
         });
}); */
timer =0;
function testtimeout(){
clearTimeout(timer);
timer =setTimeout("buscar()",2000);
}

 function buscar() {

	var documento = $("input#param3").val();
	variable = documento.length; 

	if (variable >= 5) {
		datos = {"documento":documento};
		console.log("aquiiivaaaa");			
		$.ajax({
				url: "pacientefacturacion.php",
				type: "POST",
				data: datos
			}).done(function(respuesta){
				
				if (respuesta === null) {
					
					//console.log(JSON.stringify(respuesta));
					document. getElementById("paciente").value='';
					document. getElementById("param4").value='';
					document. getElementById("param6").value='';
					document. getElementById("param7").value='Seleccione...';
					document. getElementById("param9").value='';
					document. getElementById("param14").value='';
					document. getElementById("param15").value='';
					document. getElementById("param11").value='';
					document. getElementById("param12").value='';
					document. getElementById("param13").value='';
					document. getElementById("param16").value='';
					document. getElementById("param18").value='';
					document. getElementById("param22").value=0;
					//$(".respuesta").html("Servidor:<br><pre>"+JSON.stringify(respuesta, null, 2)+"</pre>");
				}
				else {
					
					document. getElementById("paciente").value=respuesta.idpaciente;
					document. getElementById("param4").value=respuesta.pac_nombre;
					document. getElementById("param6").value=respuesta.pac_fechanacimiento;
					document. getElementById("param7").value=respuesta.pac_sexo;
					document. getElementById("param9").value=respuesta.pac_procedentede;
					document. getElementById("param14").value=respuesta.pac_barrio;
					document. getElementById("param15").value=respuesta.pac_profesion;
					document. getElementById("param11").value=respuesta.pac_telefonocasa;
					document. getElementById("param12").value=respuesta.pac_entidad;
				}
			});
					
					
					
					
					
	}	
				
}; 


</script>

	<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper

   //var x = document.form1.fecha1.value; //Initial field counter is 1
   var x = document.getElementById("campos").value; //Initial field counter is 1
   //alert(x);
    $(addButton).click(function(){ //Once add button is clicked
	p=x%2;
	if(p==1){ color="#FFFFFF";  } else{  color="#F3F3F3"; }
	document.getElementById("campos").value=x;
	
	 var fieldHTML = '<table width=100% ><tr bgcolor='+color+' class="text">';
	var fieldHTML = fieldHTML + '<td>SERVICIO:<select  name="param5'+x+'"  id="param5'+x+'"  ><option  value=0>Seleccione...</option>';
     var fieldHTML = fieldHTML + "<?php  $sql="SELECT `exa_idexamen`, CONCAT(`exa_nombre`, '|' , `exa_codigo`) as codname FROM `examenes` order by exa_nombre  "; $LT->llenaselect_ajax($sql,0,1, $para, $DB); ?>";
	 var fieldHTML = fieldHTML + '</select></td><td>CANTIDAD:</td> <td><input type="text" name="param7'+x+'" id="param7'+x+'" value=""/></td><td>VR.UNITARIO:</td> <td><input type="text" name="param9'+x+'" id="param9'+x+'" value=""/></td></tr></table>'; //New input field html 
        if(x < maxField){ //Check maximum number of input fields
		    x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
    });
    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
		//iddd='param3'+(x-1);
		
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
<script type="text/javascript">
function submitform()
{
     var theForm = document.forms['form1'];
     if (!theForm) {
         theForm = document.form1;
     }
    document.form1.enviar.value="IMPRIMIR";
   theForm.submit();

    setTimeout(function(){
  			document.location.href='adm_facturacion.php';
        },12000);
	
}

</script> 


<?php 
$consecutivo=""; 
 $resolucion="";
$rw[2]=1;
if($id_param!=""){
 $sql="SELECT `idfactura`, `fac_fecha`, `tipodocumento_idtipodocumento`, `fac_iddocumento`, `fac_nombre`, `fac_cosec`, `fac_edad`, `fac_sexo`, `fac_regimen`, `fac_domicilio`, `fac_categoria`, `fac_telefono`, `fac_entidad`, `fac_municipio`, `fac_barrio`, `fac_profesion`, `fac_departamento`, `fac_zona`, `fac_esp`, `fac_abono`, `fac_cajero`, `fac_resolucion`,fac_sede FROM `facturacion` WHERE idfactura='$id_param' ";
 $DB->Execute($sql); 
$rw=mysqli_fetch_row($DB->Consulta_ID); 

$consecutivo=$rw[5]; 
 $resolucion=$rw[21];
 
 
}
	
$FB->abre_form("form1","facturacionpdf.php","post");



$FB->titulo_azul1("FACTURACION",12,0, 5); 

//$FB->llena_texto("Tipo Cita:",19,2,$DB,"(SELECT `tip_nombre`, `tip_nombre` FROM `tipomatriz`  ORDER BY idtipomatriz)", "", "", 17, 1);		
$FB->llena_texto("Fecha:", 1, 10, $DB, "", "", @$rw[1], 1, 1);
$FB->llena_texto("Tipo Documento:",2,2,$DB,"SELECT `iddocumento`, `tip_nombre` FROM `tipodocumento` ORDER BY iddocumento","",$rw[2],6,1);

//$FB->llena_texto("Documento:", 3, 115, $DB, "", "", @$rw[3],4,1);
	
	echo @$html.= "<td >Documento:</td><td ><input class='form-control' type='text' name='param3' id='param3' value='$rw[3]' placeholder='' maxlength='30' autocomplete='off'  onKeyUp=testtimeout();  />
	</td></tr>";

$FB->llena_texto("Nombre Del Paciente:",4, 1, $DB, "", "", @$rw[4], 1, 1);
$FB->llena_texto("Fecha de Nacimiento:", 6, 10, $DB, "", "", @$rw[6], 6,1);
$FB->llena_texto("Sexo:", 7, 8, $DB, $sexo, "", @$rw[7], 4, 1);
$FB->llena_texto("Domicilio:",9, 1, $DB, "", "", @$rw[9],1, 0);
$FB->llena_texto("Telefono:",11, 1, $DB, "", "", @$rw[11],6, 1);
$FB->llena_texto("Entidad:",12, 1, $DB, "", "", @$rw[12],4, 0);
$FB->llena_texto("Mun/vereda:",13, 1, $DB, "", "", @$rw[13],17, 0);
$FB->llena_texto("Barrio:",14, 1, $DB, "", "", @$rw[14],6, 1);
$FB->llena_texto("Profesion:",15, 1, $DB, "", "", @$rw[15],4, 0);
$FB->llena_texto("Departamento:",16, 1, $DB, "", "", @$rw[16],17, 0);
$FB->llena_texto("Zona:",17, 1, $DB, "", "", @$rw[17],6, 0);
$FB->llena_texto("Esp:",18, 1, $DB, "", "", @$rw[18],4, 0);
$FB->llena_texto("Sede:",22,2,$DB,"SELECT `idsede`, `sed_nombre`, `sed_direccion`, `sed_telefonos` FROM `sedes` ORDER BY idsede","",@$rw[22],6,1);

$FB->cierra_tabla(); 

		echo '<div class="field_wrapper">
	<a href="javascript:void(0);" class="add_button" title="Add field"><img src="img/agregar.jpg"/>AGREGAR</a>';
	echo"<table width='100%'  ><tr bgcolor='#074F91' class=''>
<td colspan='8' width='' align='center'   style='color:#FFFFFF' >AGREGAR SERVICIO</td></tr>";
if($id_param==""){

	echo '<tr bgcolor="#FFFFFF" class="text">
	<td>SERVICIO:<select name="param50" id="param50"  >
	   <option  value=0>Seleccione...</option>';
             $sql="SELECT `exa_idexamen`, CONCAT(`exa_nombre`, '|' , `exa_codigo`) as codname FROM `examenes` order by exa_nombre ";
			  $LT->llenaselect_ajax($sql,0,1, $para, $DB);
		echo '</select></td> 
       <td>CANTIDAD: </td><td><input type="text" name="param70" id="param70" value=""/> </td> 
       <td>VR.UNITARIO: </td><td><input type="text" name="param90" id="param90" value=""/> </td> 
	</tr>';	 
	echo '<input type="hidden" name="campos" id="campos" value="1"/></table></div>';

	
}else {

	$sql4="SELECT `idservicio`, `ser_idviene`, `ser_codigo`, `ser_idexamen`,`ser_catidad`, `ser_valor` FROM `servicio` WHERE `ser_idviene`='$id_param' ";
 $DB1->Execute($sql4); 
//$rw4=mysqli_fetch_row($DB->Consulta_ID);  
$va=0; 
$aunmen=0;

	while($rw4=mysqli_fetch_row($DB1->Consulta_ID))
	{
		
		$va++; $p=$va%2;
		if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
		
	
	echo '<tr bgcolor='.$color.' class="text">
       <td>SERVICIO/CODIGO:<select name="param5'.$aunmen.'" id="param5'.$aunmen.'"  >
	   <option  value=0>Seleccione...</option>';
             $sql="SELECT `exa_idexamen`, CONCAT(`exa_nombre`, '|' , `exa_codigo`) as codname FROM `examenes` ";
			  $LT->llenaselect_ajax($sql,0,1, $rw4[3], $DB);
		echo '</select></td> 
       <td>CANTIDAD: </td><td><input type="text" name="param7'.$aunmen.'" id="param7'.$aunmen.'" value="'.$rw4[4].'"/> </td> 
       <td>VR.UNITARIO: </td><td><input type="text" name="param9'.$aunmen.'" id="param9'.$aunmen.'" value="'.$rw4[5].'"/> </td> 
	</tr>';	 
	$aunmen++;

	}
	//echo $aunmen;
		echo '<input type="hidden" name="campos" id="campos" value="'.$aunmen.'"/></table></div>';
}



$FB->titulo_azul1("FACTURACION",18,0, 5); 

$FB->llena_texto("CAJERO:",20, 1, $DB, "", "",@$rw[20],1, 0);
$FB->llena_texto("ABONO:",25, 1, $DB, "", "",@$rw[19],4, 0);



echo "<table width='100%' cellpadding=0 cellspacing=0>";
$FB->llena_texto("id_param", 1, 13, $DB, "", "", $id_param, 5, 0);
$FB->llena_texto("tabla", 1, 13, $DB, "", "", $tabla, 5, 0);
$FB->llena_texto("condecion", 1, 13, $DB, "", "", $condecion, 5, 0);
$FB->llena_texto("resolucion", 1, 13, $DB, "", "", $resolucion, 5, 0);
$FB->llena_texto("consecutivo", 1, 13, $DB, "", "", $consecutivo, 5, 0);
$FB->llena_texto("paciente", 1, 13, $DB, "", "", $paciente, 5, 0);		
$FB->llena_texto("sede", 1, 13, $DB, "", "", @$rw[22], 5, 0);		

echo "<tr bgcolor='#F5F5F5'><td align='center' colspan='4'>
	<input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip'  onClick='javascript:history.back();' value='Cerrar' style='width:190px;' > 
	
	<input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip' type='' onClick='javascript:submitform();' id='enviar'  name='enviar' value='IMPRIMIR' style='width:190px;' >
	<input class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip' type='submit' id='enviar' name='enviar' value='GUARDAR' style='width:190px;' >
	</td>
	</tr>";

//$FB->titulo_azul1("SERVICIOS AGREGADOS",12,0, 5);  GaBrIeLGaRcIaMaRqUeZ <button class='btn btn-primary btn-sm' data-widget='edit' data-toggle='tooltip'  style='width:190px;' >IMPRIMIR</button>
$FB->cierra_tabla(); 
			
$FB->cierra_form(); 
?>