<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<title>Transmillas</title>
        <meta>
<style type="text/css">
* { box-sizing:border-box; }

body {
	font-family: Helvetica;
	background: #eee;
  -webkit-font-smoothing: antialiased;
}

hgroup { 
	text-align:center;
	margin-top: 4em;
}

h1, h3 { font-weight: 300; }

h1 { color: #636363; }

h3 { color: #4a89dc; }

form {
	width: 380px;
	margin: 4em auto;
	padding: 3em 2em 2em 2em;
	background: #fafafa;
	border: 1px solid #ebebeb;
	box-shadow: rgba(0,0,0,0.14902) 0px 1px 1px 0px,rgba(0,0,0,0.09804) 0px 1px 2px 0px;
}

.group { 
	position: relative; 
	margin-bottom: 45px; 
}

input {
	font-size: 18px;
	padding: 10px 10px 10px 5px;
	-webkit-appearance: none;
	display: block;
	background: #fafafa;
	color: #636363;
	width: 100%;
	border: none;
	border-radius: 0;
	border-bottom: 1px solid #757575;
}

input:focus { outline: none; }


/* Label */

label {
	color: #999; 
	font-size: 18px;
	font-weight: normal;
	position: absolute;
	pointer-events: none;
	left: 5px;
	top: 10px;
	transition: all 0.2s ease;
}


/* active */

input:focus ~ label, input.used ~ label {
	top: -20px;
  transform: scale(.75); left: -2px;
	/* font-size: 14px; */
	color: #4a89dc;
}


/* Underline */

.bar {
	position: relative;
	display: block;
	width: 100%;
}

.bar:before, .bar:after {
	content: '';
	height: 2px; 
	width: 0;
	bottom: 1px; 
	position: absolute;
	background: #4a89dc; 
	transition: all 0.2s ease;
}

.bar:before { left: 50%; }

.bar:after { right: 50%; }


/* active */

input:focus ~ .bar:before, input:focus ~ .bar:after { width: 50%; }


/* Highlight */

.highlight {
	position: absolute;
	height: 60%; 
	width: 100px; 
	top: 25%; 
	left: 0;
	pointer-events: none;
	opacity: 0.5;
}


/* active */

input:focus ~ .highlight {
	animation: inputHighlighter 0.3s ease;
}


/* Animations */

@keyframes inputHighlighter {
	from { background: #4a89dc; }
	to 	{ width: 0; background: transparent; }
}


/* Button */

.button {
  position: relative;
  display: inline-block;
  padding: 12px 24px;
  margin: .3em 0 1em 0;
  width: 100%;
  vertical-align: middle;
  color: #fff;
  font-size: 16px;
  line-height: 20px;
  -webkit-font-smoothing: antialiased;
  text-align: center;
  letter-spacing: 1px;
  background: transparent;
  border: 0;
  border-bottom: 2px solid #3160B6;
  cursor: pointer;
  transition: all 0.15s ease;
}
.button:focus { outline: 0; }


/* Button modifiers */

.buttonBlue {
  background: #4a89dc;
  text-shadow: 1px 1px 0 rgba(39, 110, 204, .5);
}

.buttonBlue:hover { background: #357bd8; }


/* Ripples container */

.ripples {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  background: transparent;
}


/* Ripples circle */

.ripplesCircle {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  opacity: 0;
  width: 0;
  height: 0;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.25);
}

.ripples.is-active .ripplesCircle {
  animation: ripples .4s ease-in;
}


/* Ripples animation */

@keyframes ripples {
  0% { opacity: 0; }

  25% { opacity: 1; }

  100% {
    width: 200%;
    padding-bottom: 200%;
    opacity: 0;
  }
}

footer { text-align: center; }

footer p {
	color: #888;
	font-size: 13px;
	letter-spacing: .4px;
}

footer a {
	color: #4a89dc;
	text-decoration: none;
	transition: all .2s ease;
}

footer a:hover {
	color: #666;
	text-decoration: underline;
}

footer img {
	width: 80px;
	transition: all .2s ease;
}

footer img:hover { opacity: .83; }

footer img:focus , footer a:focus { outline: none; }

</style>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="css/paginar.css" rel="stylesheet" type="text/css" />
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
<link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
<link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
<link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" /> 

<script language="JavaScript" type="text/javascript" src="js/ajax.js"></script>
<script language="JavaScript" type="text/javascript" src="js/consultas_js.js"></script>
<script language="JavaScript" type="text/javascript" src="js/jquery.min.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/bootstrap.min.js"></script>
<link href="dist/css/select2.min.css" rel="stylesheet" />
<link href="dist/css/select2-bootstrap.css" rel="stylesheet">
<script src="dist/js/select2.min.js"></script>
<script>
function validarguia(des)
{
	var valorguia= document.getElementById("param2").value;

	var guia="";
	var trueorfalse;	
		datos = {"vlores":valorguia,"tipo":"1","idguia":"0"};
		$.ajax({
				url: "validarguiacliente.php",
				type: "POST",
				data: datos,
				async: false,
				success: function(result) {
					if(result!=null && result!=""){
						guia= result.idservicios;
						if(guia!=''){			
							trueorfalse=1;
							document.getElementById("param10").value=guia;
						}else {
							trueorfalse=3;
						}
					}else {
						trueorfalse=3;
					}	
				}
			});

			if(trueorfalse==3){ 	
				$("#enviarmensaje").modal("show"); 
							var divvalor= document.getElementById("mensajevalor2");
							divvalor.innerHTML="<strong>Atencion!</strong>BEDE DIGITAR UN NUMERO DE GUIA EXISTENTE, EL NUMERO DE GUIA APARECE EN EL RECIBO DE PAGO QUE LE FUE ENTREGADO</a>";
							return false;
			}
			else {				
				return true;
			}
			return false;
}
</script>
<!-- onsubmit="return validarguia(this); -->
    <body>

<form action="rastreoclienteok.php" method="post" enctype='multipart/form-data' ">

<?php


require("connection/conectarse.php");
require("connection/funciones.php");
require("connection/arrays.php");
require("connection/funciones_clases.php");
require("connection/sql_transact.php");
require("connection/llenatablas.php");
// require("detalle_pop.php");

$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$FB = new funciones_varias;
$QL = new sql_transact;
$LT = new llenatablas;

// $FB->titulo_azul1("Formulario de Reclamos ","2","0", 4); 

// 	$FB->llena_texto("Fecha de Envio:", 8, 10, $DB, "", "", "$fechaactual", 2, 1);
// 	$FB->llena_texto("Tipo Reclamo:", 9, 82, $DB, $tiporeclamo, "", "", 2, 1);
// 	$FB->llena_texto("Nombre:", 4, 1, $DB, "", "", "", 1, 1);
// 	$FB->llena_texto("telefono:", 5, 1, $DB, "", "", "", 1, 1);
// 	$FB->llena_texto("E-mail:", 6, 111, $DB, "", "", "", 1, 1);
// 	$FB->llena_texto("Ciudad donde quiere recibir la notificacion:", 1, 1, $DB, "", "", "", 1, 1);
// 	$FB->llena_texto("Direccion donde quiere recibir la notificacion:",9, 1, $DB, "", "", "", 1, 1);
// 	$FB->llena_texto("Descripcion de Reclamo:<br> Por favor coloque una descripcion <br>del paquete y su contenido", 7,9, $DB, "", "", "", 2, 1);
// 	$FB->llena_texto("Numero De Guia Completo<br> lo encontrara en la parte superior del recibo",2, 1, $DB, "", "", "",2,1);
// 	$FB->llena_texto("param3", 1, 13, $DB, "", "ser_consecutivo", 0, 5, 0);



// 			echo "<td><button type='button' class='btn btn-primary btn-lg' onclick='buscarguia(29);'  >Validar Guia </button></td></tr>";	
//             $FB->llena_texto("", 2, 4, $DB, "llega_sub2", "", "",1,0);

// 	$FB->llena_texto("Foto del Recibo <br>o Guia que se enttrego ", 8, 6, $DB, "", "", "",1,0);
// 	echo "<tr><td><button type='submit' class='btn btn-primary btn-lg'>Enviar Reclamo </button></td></tr>";

// 	$FB->llena_texto("param10", 1, 13, $DB, "", "0", 0, 5, 0);	


	?>
	<!-- login div -->


          <!--   alert("¡Antes de hacer tu reclamo descarga y lee el contrato del cliente a continuación.");

          </script> -->







<!-- <div class="alert alert-warning alert-dismissable">

  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><h2>¡Ingresa número de guia o telefono!<h2/></strong> 
  	
</div> -->




<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

<div style="width: 200px; height: 30px; ">

</div>

<?php
 ?>
<div id="enviarmensaje" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content"> -->
      <!-- dialog body -->
     <!--  <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div> -->
      <!-- dialog buttons -->
	 <!--  <div id="mensajevalor2" class="alert alert-danger"  >Alerta</div>
      <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></div>
    </div>
  </div>
</div> -->


<hgroup>
	<footer>
	<a href="http://www.polymer-project.org/" target="_blank"><img src="img/rastreoo.png"></a>
	</footer>
  <h2>Ingresa número de guia y telefono </h2>
  <!-- <h3>By Josh Adamous</h3> -->
</hgroup>

<!-- <form method='POST' action="rastreocliente.php"> -->
  <div class="group">
    <input type='text' name='guia' size='20' placeholder='Guia' ><span class="highlight"></span><span class="bar"></span>
    <!-- <label>Guia</label> -->
  </div>
  <div class="group">
    <input type='text' name='telefono' size='20' placeholder='Telefono' ><span class="highlight"></span><span class="bar"></span>
    <!-- <label>Telefono</label> -->
  </div>
  <button type="submit" class="button buttonBlue" name='enviar'  value="buscar">Buscar
    <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
  </button>
</form>
<!-- <button type='submit' class='btn btn-danger' name='enviar' >Enviar</button></tr>  -->
<?php
// if(isset($_POST['buscar']))
// {
// $guia=$_POST['guia'];
// $telefono=$_POST['telefono'];	

//  echo$vsql="SELECT idservicios,'recogida' as estado FROM `servicios` WHERE ser_idresponsable='$param2' and ser_estado=3 and  ser_fechaasignacion like '$fechaactual%'";
// $DB1->Execute($vsql);  
// }

?>


<!-- <footer><a href="http://www.polymer-project.org/" target="_blank"><img src="https://www.polymer-project.org/images/logos/p-logo.svg"></a>
  <p>You Gotta Love <a href="http://www.polymer-project.org/" target="_blank">Google</a></p>
</footer> -->
    </body>
</html>