<!DOCTYPE html>
<html class="bg-black"><head>
<meta charset="UTF-8">
<title>Transmillas </title >
<link rel="shortcut icon" href="images/favicon.ico" />
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" /> 
<link rel="stylesheet" type="text/css" href="css/normalize.css" />
<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src='js/ajax.js'></script>
<script src='js/consultas_js.js'></script>
<script language="javascript">
function ver_sec(valor, destino, div)
{
	destino=destino+""+valor;
	MostrarConsulta(destino, div);
}
</script>
    </head>
    <body class="bg-black" onLoad="ver_sec(0,'resultados4.php?cond=81&param1=', 'llega_sub1');">
        <div class="form-box2" id="login-box">
            <div class="header">Solicitar Nuevo Usuario</div>
            <form action="registrook.php" method="post" enctype='multipart/form-data'>
                <div class="body bg-gray">
                    <div class="form-group col-lg-6"><input type="text" name="param1" class="form-control" placeholder="Primer Nombre" required/></div>
                    <div class="form-group col-lg-6"><input type="text" name="param2" class="form-control" placeholder="Segundo Nombre"/></div>
                    <div class="form-group col-lg-6"><input type="text" name="param3" class="form-control" placeholder="Primer Apellido" required/></div>
                    <div class="form-group col-lg-6"><input type="text" name="param4" class="form-control" placeholder="Segundo Apellido" /></div>
                    <div class="form-group col-lg-6">
					<label><input type="checkbox" name="param5" value="Masculino" > Masculino &nbsp;</label>
                    <label> <input type="checkbox" name="param5" value="Femenido" > Femenino</label>
                    <br>
                    </div>
                    <div class="form-group col-lg-6">
                        <small>Foto de perfil (jpg - 1MB máximo)</small>
                        <br><input type="file" name="file1" id="file1" style="width:190px; background-color:#680B01; color:#F8F8F8; border-color:#680B01;" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple required/>
                       <!-- <label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Subir Archivo&hellip;</span></label>!-->
                    </div>
                    <div class="form-group col-lg-5"><small>Fecha de nacimiento</small>
					<input type="date" class="form-control" name="param8" placeholder="Fecha Nacimiento" required/>
                    </div>
                    <div class="form-group col-lg-7">
                    <div class="input-group">
                    <div class="input-group-btn"><br>
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Documento <span class="fa fa-caret-down"></span></button>
                           <ul class="dropdown-menu">
                                <li><a href="#">T.I.</a></li>
                                <li><a href="#">Cedula Ciudadania</a></li>
                                <li><a href="#">Cedula Extranjeria</a></li>
                                <li><a href="#">NIT</a></li>
                                <li><a href="#">Pasaporte</a></li>
                            </ul>
                         </div><br><!-- /btn-group -->
                         <input type="text" class="form-control" name="param9" placeholder="# de documento" required>
                    </div>
                    </div>
                    <div class="form-group col-lg-6">
<?php
require("connection/conectarse.php");
require("connection/llenatablas.php");
$DB = new DB_mssql;
$DB->conectar();
$LT = new llenatablas;
$sql="(SELECT idpaises, pai_nombre FROM paises WHERE pai_nombre='COLOMBIA') UNION (SELECT idpaises, pai_nombre FROM paises WHERE pai_nombre!='COLOMBIA' ORDER BY pai_nombre) ";
echo "<select name='param10' id='param10' class='form-control' required><option value=''>Pais de nacimiento</option>";
$LT->llenaselect_ajax($sql,0,1, $para, $DB);
echo "</select>";
 ?>
                    </div>
                      <div class="form-group col-lg-6">
                        <select class="form-control" name="param13" required >
                             <option value=''>Nivel Académico</option>
                             <option>Bachiller</option>
                             <option>Tecnólogo</option>
                             <option>Profesional</option>
                             <option>Especialización</option>
                             <option>Maestria</option>
                             <option>Doctorado</option>
                             <option>Phd</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-6">
                      <div class="input-group">
                         <div class="input-group-addon">
                             <i class="fa fa-phone"></i>
                         </div>
                         <input type="text" name="param11" class="form-control" placeholder="Teléfono fijo"/>
                       </div><!-- /.input group -->
                    </div>
                    <div class="form-group col-lg-6">
                      <div class="input-group">
                         <div class="input-group-addon">
                             <i class="fa fa-phone"></i>
                         </div>
                         <input type="text" name="param12" class="form-control" placeholder="Celular" required/>
                       </div><!-- /.input group -->
                    </div>
                    <div class="input-group col-lg-12">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" name="param6" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="input-group col-lg-12">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" name="param6-1" class="form-control" placeholder="Confirmar Email" required>
                    </div>
                    <div class="form-group col-lg-6">
                        <input type="password" name="param7" class="form-control" placeholder="Password" required/>
                    </div>
                    <div class="form-group col-lg-6">
<?php                    
$sql="SELECT idciudades, dep_nombre, ciu_nombre FROM ciudades INNER JOIN departamentos ON departamentos_iddepartamentos=iddepartamentos ORDER BY dep_nombre, ciu_nombre ";
echo "<select name='param15' id='param15' class='form-control'>";
echo "<option  value=''>Ciudad de residencia</option>";
$LT->llenaselect_ajax($sql,0,"1-2", $para, $DB);
echo "</select>";
?>
                    </div>
                    <div class="form-group col-lg-6">
<?php 
$ani=date("Y");                   
$sql="SELECT identidades, ent_nombre FROM contratosproyectos INNER JOIN entidades ON identidades=entidades_identidades AND '$ani'>=YEAR(cop_fechainicio) 
AND '$ani'<=YEAR(cop_fechafin) ORDER BY ent_nombre ";
echo "<select name='param18' id='param18' class='form-control'>";
echo "<option  value=''>Entidad aliada</option>";
$LT->llenaselect_ajax($sql,0,"1", $para, $DB);
echo "</select>";
?>
                    </div>
                    <div class="form-group col-lg-6">
<?php                    
$sql="SELECT idroles, rol_nombre FROM roles ORDER BY rol_nombre ";
echo "<select name='param14' id='param14' class='form-control' onChange='ver_sec(this.value, \"resultados4.php?cond=81&param1=\", \"llega_sub1\");'>";
echo "<option  value=''>Rol de acceso requerido</option>";
$LT->llenaselect_ajax($sql,0,1, $para, $DB);
echo "</select>";
?>
                    </div>
                    <div class="form-group col-lg-6"><div id="llega_sub1"></div></div>
                    <div class="form-group col-lg-6"><div id="llega_sub2"></div></div>
                    <div class="form-group col-lg-12">
                        <div class="g-recaptcha" data-sitekey="6LfK2CETAAAAAI1xp7ctOytSexpsF3BRHBToS0CT"></div>
                    </div>
                </div>
                <div class="footer">                    
                    <button type="submit" class="btn bg-olive btn-block">Enviar Solicitud</button>
                    <a href="index.php" class="text-center">Ya soy usuario.</a>
                </div>
            </form>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/custom-file-input.js"></script>
    </body>
</html>