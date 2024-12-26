<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<title>Transmillas</title>
        <meta>

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
    <body>

<form action="reclamosok.php" method="post" enctype='multipart/form-data' onsubmit="return validarguia(this);">

<?php

require("connection/conectarse.php");
require("connection/funciones.php");
require("connection/arrays.php");
require("connection/funciones_clases.php");
require("connection/sql_transact.php");
require("connection/llenatablas.php");
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$FB = new funciones_varias;
$QL = new sql_transact;
$LT = new llenatablas;

$FB->titulo_azul1("Formulario de Reclamos ","2","0", 4); 

	$FB->llena_texto("Fecha de Envio:", 8, 10, $DB, "", "", "$fechaactual", 2, 1);
	$FB->llena_texto("Tipo Reclamo:", 9, 82, $DB, $tiporeclamo, "", "", 2, 1);
	$FB->llena_texto("Nombre:", 4, 1, $DB, "", "", "", 1, 1);
	$FB->llena_texto("telefono:", 5, 1, $DB, "", "", "", 1, 1);
	$FB->llena_texto("E-mail:", 6, 111, $DB, "", "", "", 1, 1);
	$FB->llena_texto("Ciudad donde quiere recibir la notificacion:", 1, 1, $DB, "", "", "", 1, 1);
	$FB->llena_texto("Direccion donde quiere recibir la notificacion:",11, 1, $DB, "", "", "", 1, 1);
	$FB->llena_texto("Descripcion de Reclamo:<br> Por favor coloque una descripcion <br>del paquete y su contenido", 7,9, $DB, "", "", "", 2, 1);
	$FB->llena_texto("Numero De Guia Completo<br> lo encontrara en la parte superior del recibo",2, 1, $DB, "", "", "",2,1);
	$FB->llena_texto("param3", 1, 13, $DB, "", "ser_consecutivo", 0, 5, 0);
	$FB->llena_texto("Foto del Recibo <br>o Guia que se enttrego ", 8, 6, $DB, "", "", "",1,0);
	echo "<tr><td><button type='submit' class='btn btn-primary btn-lg'>Enviar Reclamo </button></td></tr>";	
	$FB->llena_texto("param10", 1, 13, $DB, "", "0", 0, 5, 0);	

 ?>
<div id="enviarmensaje" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- dialog body -->
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
      <!-- dialog buttons -->
	  <div id="mensajevalor2" class="alert alert-danger"  >Alerta</div>
      <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></div>
    </div>
  </div>
</div>
    </body>
</html>