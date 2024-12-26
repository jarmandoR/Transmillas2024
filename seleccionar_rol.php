<?php
require("login_autentica.php"); 
$nivel_acceso=$_SESSION['usuario_rol']; 
include("cabezote1.php"); 
?>
<script language="javascript">
function llena_cambio(valor)
{
	destino="seleccionar_destino.php?rol_nombre="+valor;
	document.location.href=destino;
}
</script>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>MinEdu | Solicitud Usuario</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="../minedu/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../minedu/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../minedu/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="css/normalize.css" />
<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body class="bg-black">
        <div class="form-box2" id="login-box">
            <div class="header">Seleccione su rol de acceso</div>
                    <div class="form-group col-lg-6" style="background-color:#FFF; color:#000; width:100%;">
                    <br><br>
					<?php
$FB->llena_texto("", 2, 2, $DB, "SELECT rol_nombre, rol_nombre FROM usuarios INNER JOIN roles ON roles_idroles=idroles 
AND usu_mail='".$_SESSION['usuario_login']."' ORDER BY rol_nombre","llena_cambio(this.value)","",2,1);
?>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

                    </div>
                    
                                    <div class="footer">     
                                    <br><br><br><br><br               
                </div>

        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/custom-file-input.js"></script>
    </body>
</html>