<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
		<title>Transmillas</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" /> 
        <link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="shortcut icon" href="images/favicon.ico" />
		<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body class="bg-black">

<form action="guardarok.php" method="post" enctype='multipart/form-data'>

<?php
require("connection/conectarse.php");
require("connection/funciones.php");
require("connection/funciones_clases.php");
require("connection/sql_transact.php");
require("connection/llenatablas.php");
$DB = new DB_mssql;
$DB->conectar();
$LT = new llenatablas;

	$FB->llena_texto("Sede:",1,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0  )", "", "$id_sedes", 2, 1);
	$FB->llena_texto("Fecha de Envio:", 8, 10, $DB, "", "", "$fechaactual", 2, 0);
	$FB->llena_texto("Tipo Reclamo:", 9, 82, $DB, $tiporeclamo, "", "", 2, 1);
	$FB->llena_texto("Nombre:", 4, 1, $DB, "", "", "", 1, 0);
	$FB->llena_texto("telefono:", 5, 1, $DB, "", "", "", 1, 0);
	$FB->llena_texto("E-mail:", 6, 1, $DB, "", "", "", 1, 0);
	$FB->llena_texto("Descripcion de Reclamo:", 7,9, $DB, "", "", "", 2, 0);
	$FB->llena_texto("Numero De Guia Completo",2, 1, $DB, "", "", "",2,1);
	$FB->llena_texto("param3", 1, 13, $DB, "", "ser_consecutivo", 0, 5, 0);
	echo "<td><button type='button' class='btn btn-primary btn-lg' onclick='buscarguia(29);'  >Validar Guia </button></td></tr>";		
	$FB->llena_texto("Foto Guia", 8, 6, $DB, "", "", "",1,0);
	$FB->llena_texto("", 2, 4, $DB, "llega_sub2", "", "",1,0);

 ?>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/custom-file-input.js"></script>
    </body>
</html>