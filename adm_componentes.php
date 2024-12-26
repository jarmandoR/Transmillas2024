<?php 
require("login_autentica.php"); 
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
?>
<html>
<head>
<?php require("cabezote1.php"); ?>
</head>
<body>
<?php include("menu.php"); 
$FB = new funciones_varias;
$param_edicion=1;
?>
<div id="area_trabajo_abajo">
<table width="99%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#001A55">
<tr><td align="center" colspan="5"><?php $FB->titulo_azul1("Componentes");  ?></td></tr>
<?php 
if(isset($_REQUEST["bandera"])){ $FB->mensaje_bandera($_REQUEST["bandera"]); }
if($rcrear==1) { $FB->nuevo("Componente", $condecion); } ?>
<tr><td><?php $FB->titulo_azul1("Componente");  ?></td><td colspan="2"><?php $FB->titulo_azul1("Acci&oacute;n");  ?></td></tr>
<?php
$sql="SELECT idcomponentes, com_nombre FROM componentes ";
$DB->llenatabla($sql,2, "Componente",$condecion,"","","","","","",$param_edicion);
$DB->cerrarconsulta();
?>
</table>
</div>
</body>
</html>