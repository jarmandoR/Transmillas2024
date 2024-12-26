<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php 
require("login_autentica.php"); 
include("layout.php");

$FB->titulo_azul1("Usuarios",9,0,7);  
$FB->abre_form("form1","","post");
// $FB->llena_texto("Roles:",1,2,$DB,"SELECT idroles, rol_nombre FROM roles ORDER BY rol_nombre","cambio3(this.value,param2.value,0,\"adm_usuarios.php\",1);",$param1,1,0);
// $FB->llena_texto("Roles:",1,2,$DB,"SELECT idroles, rol_nombre FROM roles ORDER BY rol_nombre","cambiarPagina(1);",$param1,1,0);
echo"<tr><td><label>Rol</l<bel></td><td><select id='param1' onChange='cambiarPagina(1,50);'>";
echo"<option value=''>seleccionar...</option>";
$sqlRol="SELECT idroles, rol_nombre FROM roles ORDER BY rol_nombre";
$DB1->Execute($sqlRol); 
while($rwR=mysqli_fetch_row($DB1->Consulta_ID)){
	echo"<option value='$rwR[0]'>$rwR[1]</option>";
}

echo"</select></td></tr>";
echo"<tr><td><label>Estado</l<bel></td><td><select id='param2' onchange='cambiarPagina(1,50);'><option value=''>seleccionar...</option><option value='1'>Activo</option><option value='0'>Inactivo</option></select></td></tr>";
//  $FB->llena_texto("Estado:",2,8,$DB,$estado_pro,"cambio3(param1.value,this.value,0,\"adm_usuarios.php\", 1);",$param2,1,0);

// $FB->llena_texto("Estado:",2,8,$DB,$estado_pro,"cambiarPagina(1);",$param2,1,0);
$FB->cierra_form(); 

if($rcrear==1) { $FB->nuevo("Usuario", $condecion, "configuracion.php?idmen=138"); } 
$FB->titulo_azul6("Rol",1,0,5,"rol_nombre",$asc2); 
// $FB->titulo_azul6("Nombre",1,0,0,"usu_nombre",$asc2); 
// $FB->titulo_azul1("CC",1,100,0); 
// $FB->titulo_azul1("Usuario",1,100,0); 
// $FB->titulo_azul1("Profesion",1,0,0); 
// $FB->titulo_azul1("Firma/Huella",1,0,0);
// $FB->titulo_azul1("Foto",1,0,0);
// $FB->titulo_azul1("Contrato",1,0,0);
// $FB->titulo_azul1("Laborando en sistema",1,0,0); 
// $FB->titulo_azul1("Ver en sistema ",1,0,0); 
// $FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
// //echo $param2;
$conde1=""; if($param2!=""){ if($param2=="Activo") { $conde1=" AND usu_estado='1' "; } else { $conde1=" AND usu_estado='0' "; } }  
if($param1!="0" and $param1!=""){ $conde=" AND idroles='$param1' "; } else { $conde="";} 


$sql="SELECT `idusuarios`, `rol_nombre` , `usu_nombre` , `usu_mail`, `usu_usuario` ,`usu_nivelacademico` ,`usu_identificacion`, `usu_estado` , `idroles`,`usu_tipocontrato`,usu_filtro,usu_ver_nomina FROM usuarios INNER JOIN roles ON roles_idroles=idroles and idusuarios!=1 $conde $conde1 $conde2 ORDER BY usu_nombre ASC";

$DB->Execute($sql); 
echo"<input type='hidden' id='query' value='$sql'>";
$va=0; 
echo"<input type='hidden' id='mostrarPor' value='50'>";
echo"<div id ='cuerpo'> ";

//if($param3!="0" and $param3!=""){ $conde2=" AND entidades_identidades IN (SELECT identidades FROM contratosproyectos INNER JOIN entidades ON entidades_identidades=identidades AND proyectos_idproyectos='$param3')"; } else { $conde2="";} 

 //$sql="SELECT `idusuarios`, `rol_nombre` , `usu_nombre` , `usu_mail` , `usu_usuario` ,`usu_nivelacademico` ,`usu_identificacion` , `usu_estado` , `idroles`  FROM usuarios INNER JOIN roles ON roles_idroles=idroles and idusuarios!=1 $conde $conde1 $conde2 GROUP BY usu_nombre ORDER BY usu_nombre $asc ";

// while($rw=mysqli_fetch_row($DB->Consulta_ID)){
// 	$va++; $p=$va%2; $id_p=$rw[0];
// 	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
// 	echo "<tr bgcolor='$color' class='text' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
// 	echo "<td onclick='pop_dis(\"$rw[3]\", \"Usuarios-Roles\");' style='cursor: pointer;' title='Haga click aqui para asignar roles al usuario'>$rw[1]</td>
// 	<td onclick='pop_dis2(\"$rw[0]\", \"Detalle Usuario\");' style='cursor: pointer;' title='Haga click aqui para detalles del usuario'>$rw[2]</td>";

// 	echo "<td align='center'>$rw[6]</td><td align='center'>$rw[4]</td><td align='center'>$rw[5]</td>";
// 	$sql1="SELECT doc_ruta FROM documentos WHERE doc_idviene='$id_p' AND doc_tabla='Usuario' and doc_version=1 ORDER BY doc_fecha DESC ";
// 	$DB1->Execute($sql1);
// 	$ruta=$DB1->recogedato(0);

// 	$sql1="SELECT doc_ruta FROM documentos WHERE doc_idviene='$id_p' AND doc_tabla='Usuario' and doc_version=2 ORDER BY doc_fecha DESC ";
// 	$DB1->Execute($sql1);
// 	@$firma=$DB1->recogedato(0);	

	
// 	echo "<td align='center'><a href='$ruta' target='_blank'><img src='$ruta' width='50'></a></td><td align='center'><a href='$firma' target='_blank'><img src='$firma' width='50'></a></td>";
// 	if($rw[9]==''){
// 		$rw[9]='Actualizar';
// 	}
// 	echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($id_p,\"tipocontrato\",\"$rw[9]\")';  title='contrato' >$rw[9]</td>";
// 	$colorselect1="";
// 	$st1="";
// 	$st2="";
// 	echo "<td><div id='inactivo$va'>"; if($rw[7]==1){ $st1="selected"; $colorselect1="style='background-color:rgb(7, 79, 145); color:#FFFFFF;'"; } else { $colorselect1="style='background-color:#8B0000; color:#FFFFFF;'"; $st2="selected"; } 
// 	echo "<select name='param14' id='param14' $colorselect1 class='form-control' onChange='cambio_ajax2(this.value, 65, \"inactivo$va\", \"$va\", 1, $id_p)' required>";

// 	// $LT->llenaselect_ar($st,$estado_pro);
// 	echo"<option value='0' $st2 >Inactivo</option>";
// 	echo"<option value='1' $st1 >Activo</option>";
// 	echo "</select></div></td>";
// 	$colorselect2="";
// 	$st3="";
// 	$st4="";
	
// 	echo "<td><div id='inactivo$va'>"; if($rw[10]==1){ $st3="selected"; $colorselect2="style='background-color:rgb(7, 79, 145); color:#FFFFFF;'";} else { $st4="selected"; $colorselect2="style='background-color:#8B0000; color:#FFFFFF;'";} 
// 	echo "<select name='param15' id='param15' $colorselect2 class='form-control' onChange='cambio_ajax2(this.value, 80, \"inactivo$va\", \"$va\", 1, $id_p)' required>";
// 	// $LT->llenaselect_ar($st,$estado_pro);
// 	echo"<option value='0'  $st4 >Inactivo</option>";
// 	echo"<option value='1' $st3 >Activo</option>";
// 	echo "</select></div></td>";

// 	$DB->edites($id_p, "Usuario", $param_edicion, $condecion);
// 	echo "</tr>";
// }
echo"</div>";
include("footer.php");
?>

<script>
cambiarPagina(1,50);

function cambiarPagina(numpag,cantdat){
 

var img = $('<img>');

// Establecer el atributo src de la imagen
img.attr('src', 'img/loading.gif');

img.attr('alt', 'Descripción de la imagen');
img.attr('width', 200);
img.attr('height', 150);

img.css({
    'position': 'absolute',
    'top': '50%',  // Centrar verticalmente
    'left': '50%',  // Centrar horizontalmente
    'transform': 'translate(-50%, -50%)',  // Corregir el centrado
    'max-width': '100%',
    'max-height': '100%'
});
// Agregar la imagen al div con el id 'cuerpo'
$('#cuerpo').html(img);



var query = document.getElementById('query').value;
// var cantidad = parseInt(document.getElementById('cantidad').value);
var rol = document.getElementById('param1').value;
var estado = document.getElementById('param2').value;
var mostrarPor = cantdat;


var offset = (numpag*mostrarPor)-mostrarPor;

var conde;
var conde1;

if(rol!="0" && rol!=""){ conde=" AND idroles='"+rol+"' "; } else { conde="";} 
if(estado!=""){ conde1=" AND usu_estado='"+estado+"' ";   conde1=" AND usu_estado='"+estado+"' "; } else { conde1=" "} 






var textoOriginal = query;
// Palabra específica después de la cual quieres agregar el texto
var palabraEspecifica = "ASC";
// Texto que quieres agregar después de la palabra específica
var textoAgregar = " LIMIT "+mostrarPor+" OFFSET "+offset;
// Encontrar la posición de la palabra específica en el texto original
var posicionPalabra = textoOriginal.indexOf(palabraEspecifica);
// Verificar si la palabra específica se encontró en el texto
if (posicionPalabra !== -1) {
    // Concatenar el texto original hasta la palabra específica, la palabra específica, el texto a agregar y el resto del texto original
    var conLimite = textoOriginal.substring(0, posicionPalabra + palabraEspecifica.length) + textoAgregar + textoOriginal.substring(posicionPalabra + palabraEspecifica.length);  
    // Mostrar el texto modificado
    console.log(conLimite);
} else {
    // La palabra específica no se encontró en el texto original
    console.log("La palabra específica no se encontró en el texto original.");
}

	


// var conLimite = query;
// Palabra específica después de la cual quieres agregar el texto
var palabraEspecifica1 = "!=1";
// Texto que quieres agregar después de la palabra específica
var textoAgregar1 = " "+conde;
// Encontrar la posición de la palabra específica en el texto original
var posicionPalabra1 = conLimite.indexOf(palabraEspecifica1);
// Verificar si la palabra específica se encontró en el texto
if (posicionPalabra1 !== -1) {
    // Concatenar el texto original hasta la palabra específica, la palabra específica, el texto a agregar y el resto del texto original
    var conRol = conLimite.substring(0, posicionPalabra1 + palabraEspecifica1.length) + textoAgregar1 + conLimite.substring(posicionPalabra1 + palabraEspecifica.length);  
    // Mostrar el texto modificado
    console.log(conRol);
} else {
    // La palabra específica no se encontró en el texto original
    console.log("La palabra específica no se encontró en el texto original.");
}




// var conRol = query;
// Palabra específica después de la cual quieres agregar el texto
var palabraEspecifica2 = "!=1";
// Texto que quieres agregar después de la palabra específica
var textoAgregar2 = " "+conde1;
// Encontrar la posición de la palabra específica en el texto original
var posicionPalabra2 = conRol.indexOf(palabraEspecifica2);
// Verificar si la palabra específica se encontró en el texto
if (posicionPalabra2 !== -1) {
    // Concatenar el texto original hasta la palabra específica, la palabra específica, el texto a agregar y el resto del texto original
    var textoModificadoCompleto = conRol.substring(0, posicionPalabra2 + palabraEspecifica.length) + textoAgregar2 + conRol.substring(posicionPalabra2 + palabraEspecifica.length);  
    // Mostrar el texto modificado
    console.log(textoModificadoCompleto);
} else {
    // La palabra específica no se encontró en el texto original
    console.log("La palabra específica no se encontró en el texto original.");
}








// console.log("se cambio de pagina"+query);
    var ruta="query="+textoModificadoCompleto+"&conde="+conde+"&conde1="+conde1+"&mostrarPor="+mostrarPor;


    $.ajax({
      
      url: 'adm_usuarios_paginacion.php',
      type: 'POST',
      data: ruta,
      })
      .done(function(res){
		$('#cuerpo').html(res);
		boton();
      })
      .fail(function(){

     
      })
      .always(function(){

  
      });


	  function boton(){
		var button = "#"+numpag;
		if (numpag>1) {
			$('.active').removeClass('active');
		}

		$(button).addClass('active');
	}
}


function cambioEstado(valor,funcion, select,id_usuario){

    const dateInput = document.getElementById(id_usuario);
                if (valor === '0') {
                        dateInput.style.display = 'block'; // Muestra el input
                    } else {
                        dateInput.style.display = 'none'; // Oculta el input
                    }


    var ruta="valor="+valor+"&funcion="+funcion+"&select="+select+"&id_usuario="+id_usuario;
    $.ajax({
      
      url: 'estadosUsuarios.php',
      type: 'POST',
      data: ruta,
      })
      .done(function(res){
		// $('#cuerpo').html(res);
		// boton();
      })
      .fail(function(){

     
      })
      .always(function(){

  
      });


}

function cambiofechafin(valor,id){

// const dateInput = document.getElementById(id_usuario);
//             if (valor === '0') {
//                     dateInput.style.display = 'block'; // Muestra el input
//                 } else {
//                     dateInput.style.display = 'none'; // Oculta el input
//                 }
var funcion=2;

var ruta="valor="+valor+"&funcion="+funcion+"&id_usuario="+id;
$.ajax({
  
  url: 'estadosUsuarios.php',
  type: 'POST',
  data: ruta,
  })
  .done(function(res){
    // $('#cuerpo').html(res);
    // boton();
    alert("¡Fecha guardada con exito!"+res);
  })
  .fail(function(){

 
  })
  .always(function(){


  });


}
</script>
