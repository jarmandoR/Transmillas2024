<?php 
require("login_autentica.php");
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$idproyectos=$_REQUEST["p2"];
$p3=$_REQUEST["p3"];
require("cabezote1.php");
$FB = new funciones_varias;
$param_edicion=1;
include("menu.php"); ?>
<form name="form1" action="nuevo_adminok.php" method="post">
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#001A55">
<tr><td><?php $FB->titulo_azul1("Usuario"); ?></td><td><?php $FB->titulo_azul1("&nbsp;"); ?></td></tr>
<?php 
$sql="SELECT idusuarios, usu_nombre FROM usuarios LEFT JOIN prousuarios ON usuarios_idusuarios=idusuarios AND roles_idroles='$p3' ORDER BY usu_nombre ";
$DB->Execute($sql);
$DB1 = new DB_mssql;
$DB1->conectar();
$va=0; 
while($rw=mysqli_fetch_row($DB->Consulta_ID))
{
	$va++;
	$p=$va%2;
	$id_p=$rw[0];
	if($p==0){$color="#FFFFFF";}
	else{$color="#EFEFEF";}
	$sql1="SELECT COUNT(*) FROM  prousuarios WHERE usuarios_idusuarios='$id_p' AND proyectos_idproyectos='$idproyectos' ";
	$DB1->Execute($sql1);
	if($DB1->recogedato(0)>0){ $cons="checked";} else {$cons="";}
	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	echo "<td>".utf8_encode($rw[1])."</td><td align='center'><input type='checkbox' name='uss$va' $cons id='uss$va' value='1'>
	<input type='hidden' name='sas$va' id='sas$va' value='$id_p'></td>";
	echo "</tr>";
}
$DB1->cerrarconsulta();
$DB->cerrarconsulta();
?>
<input type="hidden" value="<?php echo $va; ?>" id="va" name="va">
<input type="hidden" value="<?php echo $idproyectos; ?>" id="param2" name="param2">
<input type="hidden" value="Usuarios-proyectos" id="tabla" name="tabla">
<tr><td align="right" colspan="2"><input type="submit" value="Actualizar"></td></tr>
</table>
</form>