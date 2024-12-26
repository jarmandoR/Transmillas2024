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
        <div class="form-box2" id="login-box">
            <div class="header">Olvid&oacute; su contrase&ntilde;a?</div>
            <form action="recuperaok.php" method="post" enctype='multipart/form-data'>
                <div class="body bg-gray">
<?php
require("connection/conectarse.php");
require("connection/funciones.php");
require("connection/funciones_clases.php");
require("connection/sql_transact.php");
require("connection/llenatablas.php");
$DB = new DB_mssql;
$DB->conectar();
$LT = new llenatablas;
 ?>
                    <div class="input-group col-lg-12">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" name="param1" class="form-control" placeholder="Ingrese su correo electr&oacute;nico" required>
                    </div>
                    <div class="form-group col-lg-12">
                        <div class="g-recaptcha" data-sitekey="6LfK2CETAAAAAI1xp7ctOytSexpsF3BRHBToS0CT"></div>
                    </div>
                </div>
                <div class="footer">                    
                    <button type="submit" class="btn bg-olive btn-block">Enviar Solicitud</button>
                    <a href="index.php" class="text-center">volver</a>
                </div>
            </form>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/custom-file-input.js"></script>
    </body>
</html>