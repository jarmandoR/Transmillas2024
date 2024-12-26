<?php
require("login_autentica.php");
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$tabla=$_REQUEST["tabla"];
include("cabezote1.php");
$FB = new funciones_varias;
?>
<head>
	<style type="text/css">
		*{ font-family: sans-serif; margin: 0;}
		dl{ margin: 60px auto; width: 600px; }
		dt, dd{ padding: 20px; }
		dt{ background: #333333; color: white; border-bottom: 1px solid #141414; border-top: 1px solid #4E4E4E; cursor: pointer; }
		dd{ background: #F5F5F5; display: none; line-height: 1.6em; }
		dt.activo, dt:hover{ background: #424242; }

		dt:before{ content: "▸"; margin-right: 10px; }
		dt.activo:before{ content: "▾"; }
	</style>	

	<script type="text/javascript" src="js/jquery-latest.js"></script>
	<script type="text/javascript">
	   $('dl dd').hide();
       $('dl dt').click(function(){
          if ($(this).hasClass('activo')) {
               $(this).removeClass('activo');
               $(this).next().slideUp();
          } else {
               $('dl dt').removeClass('activo');
               $(this).addClass('activo');
               $('dl dd').slideUp();
               $(this).next().slideDown();
          }
       });
	</script>

</head>
<body onLoad="
<?php 
switch ($tabla)
{
	case "Ciudad":
	echo "cambio_ajax2(param1.value, 1, 'llega_sub1', 'param2', 1, 0); ";
	break;
	case "Vereda":
	echo "cambio_ajax2(param1.value, 1, 'llega_sub1', 'param2', 1, 0); cambio_ajax2(0, 1, 'llega_sub2', 'param3', 2, 0); ";
	break;
	case "Permiso":
	echo "cambio_ajax2(param1.value, 5, 'llega_sub1', 'param2', 1, 0);  ";
	break;
	case "Socio Local":
	echo "cambio_ajax2(param1.value, 1, 'llega_sub1', 'param2', 1, 0); cambio_ajax2(0, 1, 'llega_sub2', 'param3', 2, 0); ";
	break;
	case "Objetivo intemedio":
	echo "cambio_ajax2(param1.value, 3, 'llega_sub1', 'param2', 1, 0);  ";
	break;
	case "Indicador-Proyectos":
	echo "cambio_ajax2(param1.value, 3, 'llega_sub1', 'param2', 1, 0);  cambio_ajax2(param3.value, 4, 'detalle_indicadores', '', 3, 0); 
	cambio_ajax4(0, 0, 6, 'llega_sub2', 'param13', 2, 0);";
	break;
	default:
	break;
}
?>
">
<div id="area_trabajo_abajo">
<form action="nuevo_adminok.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
<table width="99%" border="0" align="center" cellpadding="1" cellspacing="1">
<tr><td colspan="2"><?php $FB->titulo_azul1("Agregar $tabla","",""); ?></td></tr>
<?php
$tabla1=$tabla;
switch ($tabla)
{
case "Rol": ?>
<tr><td class="Intabla">Nombre Rol:</td>
<td align="right"><input name="param1" type="text" class="Textbox" id="param1"></td></tr>
<?php break; ?>
<?php case "Usuario": ?>
<tr><td class="Intabla">Rol:</td>
<td align="right" class="Intabla">
<select name="param1" id="param1" >
<option value="">Seleccione...</option>
<?php 
$DB = new DB_mssql;
$DB->conectar();
$sql="SELECT idroles, rol_nombre FROM roles WHERE idroles!=0 $conde $cond_rol ORDER BY rol_nombre ";
$DB->llenaselect($sql,0,1, $param1);
?>
</select>
</td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Nombre:</td>
<td align="right"><input name="param3" type="text"  class="Textbox"  id="param3" size="40"></td></tr>
<tr><td class="Intabla">Email:</td>
<td align="right"><input name="param4" type="text"  class="Textbox"  id="param4" size="40"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Contrase&ntilde;a:</td>
<td align="right"><input name="param5" type="password" id="param5" size="30"></td></tr>
<tr><td class="Intabla">Repetir contrase&ntilde;a:</td>
<td align="right"><input name="param6" type="password" id="param6" size="30"></td></tr>
<?php break; ?>
<?php case "Menu": ?>
<tr bgcolor="#F5F5F5"><td class="Intabla">Nombre Men&uacute;:</td>
<td align="right"><input name="param1" type="text"  class="Textbox"  id="param1" size="40" ></td></tr>
<tr><td class="Intabla">URL destino:</td>
<td align="right"><input name="param2" type="text"  class="Textbox"  id="param2" size="40"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Predecesor:</td>
<td align="right">
<select name="param3" id="param3">
<option value="0">Seleccione...</option>
<?php  
$DB = new DB_mssql;
$DB->conectar();
$sql="SELECT idmenu, men_nombre FROM menu WHERE men_predecesor=0 ORDER BY men_nombre ";
$DB->llenaselect($sql,0,1, $rw[3]);
$DB->cerrarconsulta();
?>
</select>
</td></tr>
<tr><td class="Intabla">Orden:</td>
<td align="right"><input name="param4" type="text"  class="Textbox"  id="param4" size="10"></td></tr>
<?php break; ?>
<?php case "Permiso": ?>
<tr bgcolor="#F5F5F5"><td class="Intabla">Predecesor:</td>
<td align="right">
<select name="param1" id="param1" onChange="cambio_ajax2(this.value, 5, 'llega_sub1', 'param2', 1, 0)">
<option value="">Seleccione...</option>
<?php  
$DB = new DB_mssql;
$DB->conectar();
$sql="SELECT idmenu, men_nombre FROM menu WHERE men_predecesor=0 ORDER BY men_nombre ";
$DB->llenaselect($sql,0,1, $rw[3]);
?>
</select>
</td></tr>
<tr><td class="Intabla">Item Men&uacute;:</td>
<td align="right"><div id="llega_sub1"></div></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Rol:</td>
<td align="right">
<select name="param3" id="param3">
<option value="">Seleccione...</option>
<?php  
$sql="SELECT idroles, rol_nombre FROM roles ORDER BY rol_nombre ";
$DB->llenaselect($sql,0,1, $rw[3]);
$DB->cerrarconsulta();
?>
</select>
</td></tr>
<tr><td class="Intabla">Crear Nuevo:</td>
<td align="right"><input type="checkbox" name="param4" id="param4" value="1"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Editar:</td>
<td align="right"><input type="checkbox" name="param5" id="param5" value="1"></td></tr>
<tr><td class="Intabla">Eliminar:</td>
<td align="right"><input type="checkbox" name="param6" id="param6" value="1"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Consultar:</td>
<td align="right"><input type="checkbox" name="param7" id="param7" value="1"></td></tr>
<?php break; ?>
<?php case "Pais": ?>
<tr bgcolor="#F5F5F5"><td class="Intabla">Nombre Pais:</td>
<td align="right"><input name="param1" type="text" class="Textbox" id="param1"></td></tr>
<tr><td class="Intabla">C&oacute;digo:</td>
<td align="right"><input name="param2" type="text"  class="Textbox"  id="param2"></td></tr>
<?php break; ?>
<?php case "Departamento": ?>
<tr><td class="Intabla">Pais:</td>
<td align="right">
<select name="param1" id="param1">
<option value="">Seleccione...</option>
<?php  
$DB = new DB_mssql;
$DB->conectar();
$sql="SELECT idpaises, pai_nombre FROM paises ORDER BY pai_nombre ";
$DB->llenaselect($sql,0,1, $rw[1]);
?>
</select>
</td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Nombre departamento:</td>
<td align="right"><input name="param2" type="text" class="Textbox" id="param2"></td></tr>
<tr><td class="Intabla">C&oacute;digo:</td>
<td align="right"><input name="param3" type="text" class="Textbox" id="param3"></td></tr>
<?php break; ?>

<?php case "Ciudad": ?>
<tr bgcolor="#F5F5F5"><td class="Intabla">Predecesor:</td>
<td align="right"><select name="param1" id="param1" onChange="cambio_ajax2(this.value, 1, 'llega_sub1', 'param2', 1, 0);">
<option  value=''>Seleccione...</option>
<?php
$DB = new DB_mssql;
$DB->conectar();
$sql="SELECT idpaises, pai_nombre FROM paises ORDER BY pai_nombre ";
$DB->llenaselect($sql,0,1, "");
?>
</select></td></tr>
<tr><td class="Intabla">Departamento:</td><td align="right"><div id="llega_sub1"></div></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Ciudades:</td>
<td align="right"><input name="param3" type="text" class="Textbox" id="param3" size="40"></td></tr>
<tr><td class="Intabla">C&oacute;digo:</td>
<td align="right"><input name="param4" type="text" class="Textbox" id="param4" size="20"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Latitud:</td>
<td align="right"><input name="param5" type="text" class="Textbox" id="param5" size="20"></td></tr>
<tr><td class="Intabla">Longitud:</td>
<td align="right"><input name="param6" type="text" class="Textbox" id="param6" size="20"></td></tr>
<?php break; ?>
<?php case "Vereda": ?>
<tr><td class="Intabla">Predecesor:</td>
<td align="right"><select name="param1" id="param1" onChange="cambio_ajax2(this.value, 1, 'llega_sub1', 'param2', 1, 0);">
<option  value=''>Seleccione...</option>
<?php
$DB = new DB_mssql;
$DB->conectar();
$sql="SELECT idpaises, pai_nombre FROM paises ORDER BY pai_nombre ";
$DB->llenaselect($sql,0,1, "");
?>
</select></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Departamento:</td><td align="right"><div id="llega_sub1"></div></td></tr>
<tr><td class="Intabla">Ciudad:</td><td align="right"><div id="llega_sub2"></div></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Vereda:</td>
<td align="right"><input name="param4" type="text" class="Textbox" id="param4" size="40"></td></tr>
<tr><td class="Intabla">C&oacute;digo:</td>
<td align="right"><input name="param5" type="text" class="Textbox" id="param5" size="20"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Latitud:</td>
<td align="right"><input name="param6" type="text" class="Textbox" id="param6" size="20"></td></tr>
<tr><td class="Intabla">Longitud:</td>
<td align="right"><input name="param7" type="text" class="Textbox" id="param7" size="20"></td></tr>
<?php break; ?>
<?php case "Componente": ?>
<tr><td class="Intabla">Nombre Componente:</td>
<td align="right"><input name="param1" type="text"  class="Textbox"  id="param1" size="40" ></td></tr>
<?php break; ?>
<?php case "Tipos de Indicadores": ?>
<tr><td class="Intabla">Tipo de instrumento:</td>
<td align="right"><input name="param1" type="text"  class="Textbox"  id="param1" ></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Prefijo:</td>
<td align="right"><input name="param2" type="text" class="Textbox" id="param2" ></td></tr>
<tr><td class="Intabla">Sufijo:</td>
<td align="right"><input name="param3" type="text" class="Textbox" id="param3" ></td></tr>
<?php break; ?>
<?php case "Indicador": ?>
<tr><td class="Intabla">Tipo de indicador:</td>
<td align="right"><select name="param1" id="param1">
<option  value=''>Seleccione...</option>
<?php
$DB = new DB_mssql;
$DB->conectar();
$sql="SELECT idtiposindicadores, int_nombre FROM tiposindicadores ORDER BY int_nombre ";
$DB->llenaselect($sql,0,1, "");
?>
</select></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">C&oacute;digo:</td><td align="right"><input name="param2" type="text" class="Textbox" id="param2"></td></tr>
<tr><td class="Intabla">Nombre:</td><td align="right"><input name="param3" type="text" class="Textbox" id="param3" size="40"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Descripci&oacute;n:</td><td align="right"><textarea name="param4" class="Textbox" id="param4" cols="30"></textarea></td></tr>
<tr><td class="Intabla">Niveles de desagregación:</td><td align="right"><textarea name="param5" class="Textbox" id="param5" cols="30"></textarea></td></tr>
<?php break; ?>
<?php case "Donante": ?>
<tr bgcolor="#F5F5F5"><td class="Intabla">Pais:</td>
<td align="right"><select name="param1" id="param1">
<option  value=''>Seleccione...</option>
<?php
$DB = new DB_mssql;
$DB->conectar();
$sql="SELECT idpaises, pai_nombre FROM paises ORDER BY pai_nombre ";
$DB->llenaselect($sql,0,1, "");
?>
</select></td></tr>
<tr><td class="Intabla">Nombre:</td><td align="right"><input name="param2" type="text" class="Textbox" id="param2"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Alias:</td><td align="right"><input name="param3" type="text" class="Textbox" id="param3"></td></tr>
<tr><td class="Intabla">Identificaci&oacute;n:</td><td align="right"><input name="param4" type="text" class="Textbox" id="param4" size="40"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Direcci&oacute;n:</td><td align="right"><input name="param5" class="Textbox" id="param5"></td></tr>
<tr><td class="Intabla">Sitio Web:</td><td align="right"><input name="param11" class="Textbox" id="param11"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Te&aacute;fono:</td><td align="right"><input name="param6" class="Textbox" id="param6"></td></tr>
<tr><td class="Intabla">Contacto 1:</td><td align="right"><input name="param7" class="Textbox" id="param7"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Email:</td><td align="right"><input name="param8" class="Textbox" id="param8"></td></tr>
<tr><td class="Intabla">Contacto 2:</td><td align="right"><input name="param9" class="Textbox" id="param9"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Email:</td><td align="right"><input name="param10" class="Textbox" id="param10"></td></tr>
<tr><td class="Intabla">Imagen:</td><td width="555" align="right"><input type="file" name="param65" id="param65"></td></tr>
<?php break; ?>

<?php case "Partner": ?>
<tr bgcolor="#F5F5F5"><td class="Intabla">Pais:</td>
<td align="right"><select name="param1" id="param1">
<option  value=''>Seleccione...</option>
<?php
$DB = new DB_mssql;
$DB->conectar();
$sql="SELECT idpaises, pai_nombre FROM paises ORDER BY pai_nombre ";
$DB->llenaselect($sql,0,1, "");
?>
</select></td></tr>
<tr><td class="Intabla">Nombre:</td><td align="right"><input name="param2" type="text" class="Textbox" id="param2"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Alias:</td><td align="right"><input name="param3" type="text" class="Textbox" id="param3"></td></tr>
<tr><td class="Intabla">Identificaci&oacute;n:</td><td align="right"><input name="param4" type="text" class="Textbox" id="param4" size="40"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Direcci&oacute;n:</td><td align="right"><input name="param5" class="Textbox" id="param5"></td></tr>
<tr><td class="Intabla">Sitio Web:</td><td align="right"><input name="param11" class="Textbox" id="param11"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Te&aacute;fono:</td><td align="right"><input name="param6" class="Textbox" id="param6"></td></tr>
<tr><td class="Intabla">Contacto 1:</td><td align="right"><input name="param7" class="Textbox" id="param7"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Email:</td><td align="right"><input name="param8" class="Textbox" id="param8"></td></tr>
<tr><td class="Intabla">Contacto 2:</td><td align="right"><input name="param9" class="Textbox" id="param9"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Email:</td><td align="right"><input name="param10" class="Textbox" id="param10"></td></tr>
<tr><td class="Intabla">Imagen:</td><td width="555" align="right"><input type="file" name="param65" id="param65"></td></tr>
<?php break; ?>
<?php case "Socio Local": ?>
<tr bgcolor="#F5F5F5"><td class="Intabla">Pais:</td>
<td align="right"><select name="param1" id="param1" onChange="cambio_ajax2(this.value, 1, 'llega_sub1', 'param2', 1, 0);">
<option  value=''>Seleccione...</option>
<?php
$DB = new DB_mssql;
$DB->conectar();
$sql="SELECT idpaises, pai_nombre FROM paises ORDER BY pai_nombre ";
$DB->llenaselect($sql,0,1, "");
?>
</select></td></tr>
<tr><td class="Intabla">Departamento:</td><td align="right"><div id="llega_sub1"></div></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Ciudad:</td><td align="right"><div id="llega_sub2"></div></td></tr>
<tr><td class="Intabla">Nombre:</td><td align="right"><input name="param4" type="text" class="Textbox" id="param4"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Alias:</td><td align="right"><input name="param5" type="text" class="Textbox" id="param5"></td></tr>
<tr><td class="Intabla">Identificaci&oacute;n:</td><td align="right"><input name="param6" type="text" class="Textbox" id="param6" size="40"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Direcci&oacute;n:</td><td align="right"><input name="param7" class="Textbox" id="param7"></td></tr>
<tr><td class="Intabla">Sitio Web:</td><td align="right"><input name="param13" class="Textbox" id="param13"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Te&aacute;fono:</td><td align="right"><input name="param8" class="Textbox" id="param8"></td></tr>
<tr><td class="Intabla">Contacto 1:</td><td align="right"><input name="param9" class="Textbox" id="param9"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Email:</td><td align="right"><input name="param10" class="Textbox" id="param10"></td></tr>
<tr><td class="Intabla">Contacto 2:</td><td align="right"><input name="param11" class="Textbox" id="param11"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Email:</td><td align="right"><input name="param12" class="Textbox" id="param12"></td></tr>
<tr><td class="Intabla">Imagen:</td><td width="555" align="right"><input type="file" name="param65" id="param65"></td></tr>
<?php break; ?>
<?php case "Programa": ?>
<tr><td class="Intabla">Nombre:</td>
<td align="right"><input name="param1" type="text"  class="Textbox"  id="param1" ></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Alias:</td>
<td align="right"><input name="param2" type="text" class="Textbox" id="param2" ></td></tr>
<tr><td class="Intabla">Descripci&oacute;n:</td>
<td align="right"><input name="param3" type="text" class="Textbox" id="param3" ></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Fecha:</td>
<td align="right"><table width="20%" border="0" cellspacing="0" cellpadding="0"><tr>
<td><input name="param4" type="text"  class="Textbox"  id="param4"  size="12" maxlength="10" readonly></td>
<td><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'param4'});</script></td></tr>
</table></td></tr>
<tr><td class="Intabla">Valor:</td>
<td align="right"><input name="param5" type="text" class="Textbox" id="param5" ></td></tr>
<?php break; ?>
<?php case "Proyecto": ?>
<tr><td class="Intabla">Programa:</td>
<td align="right"><select name="param1" id="param1">
<option  value=''>Seleccione...</option>
<?php
$DB = new DB_mssql;
$DB->conectar();
$sql="SELECT idprogramas, prg_nombre FROM programas ORDER BY prg_nombre ";
$DB->llenaselect($sql,0,1, "");
?>
</select></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Nombre:</td><td align="right"><input name="param2" type="text" class="Textbox" id="param2"></td></tr>
<tr><td class="Intabla">Centro de costo:</td><td align="right"><input name="param3" class="Textbox" id="param3"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Nombre corto:</td><td align="right"><input name="param4" class="Textbox" id="param4"></td></tr>
<tr><td class="Intabla">Fecha Inicial:</td>
<td align="right"><table width="20%" border="0" cellspacing="0" cellpadding="0"><tr>
<td><input name="param5" type="text"  class="Textbox"  id="param5"  size="12" maxlength="10" readonly></td>
<td><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'param5'});</script></td></tr>
</table></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Fecha final:</td>
<td align="right"><table width="20%" border="0" cellspacing="0" cellpadding="0"><tr>
<td><input name="param6" type="text"  class="Textbox"  id="param6"  size="12" maxlength="10" readonly></td>
<td><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'param6'});</script></td></tr>
</table></td></tr>
<tr><td class="Intabla">Valor:</td><td align="right"><input name="param7" type="text" class="Textbox" id="param7"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Objeto:</td>
<td align="right"><textarea name="param8" type="text" class="Textbox" id="param8" cols="30"></textarea></td></tr>
<tr><td class="Intabla">Contrapartida:</td><td align="right"><input name="param9" type="text" class="Textbox" id="param9"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Objetivos:</td>
<td align="right"><textarea name="param10" type="text" class="Textbox" id="param10" cols="30"></textarea></td></tr>
<tr><td class="Intabla">Beneficiarios:</td>
<td align="right"><textarea name="param11" type="text" class="Textbox" id="param11" cols="30"></textarea></td></tr>
<tr><td class="Intabla">Estado:</td>
<td align="right"><select name="param12" id="param12" >
<option value="">Seleccione...</option>
<?php $DB->llenaselect_ar("",$estado_pro); ?>
</select>
</td></tr>
<tr><td colspan="2">
	<dl>
		<dt>Titulo 1</dt>
		<dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur maxime cupiditate nesciunt molestias itaque vel reiciendis officiis explicabo cum impedit dolorem quod minus beatae architecto necessitatibus sed exercitationem aliquam omnis!</dd>

		<dt>Titulo 2</dt>
		<dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates mollitia quos! Dolor cum vitae aperiam deserunt hic quas quidem qui excepturi minima repudiandae pariatur id sit dignissimos laborum provident velit!</dd>

		<dt>Titulo 3</dt>
		<dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio voluptatum expedita sunt voluptatibus ratione assumenda quo animi numquam blanditiis asperiores illo laudantium et quae itaque reiciendis nam ducimus officiis officia?</dd>

		<dt>Titulo 4</dt>
		<dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto obcaecati numquam nemo quasi omnis accusamus illo distinctio doloribus architecto culpa maiores blanditiis laborum accusantium assumenda vero necessitatibus optio? Ipsa perferendis.</dd>

		<dt>Titulo 5</dt>
		<dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto obcaecati numquam nemo quasi omnis accusamus illo distinctio doloribus architecto culpa maiores blanditiis laborum accusantium assumenda vero necessitatibus optio? Ipsa perferendis.</dd>
	</dl>	

</td></tr>
<?php break; ?>
<?php case "Objetivo intemedio": ?>
<tr bgcolor="#F5F5F5"><td class="Intabla">Programa:</td>
<td align="right"><select name="param1" id="param1" onChange="cambio_ajax2(this.value, 3, 'llega_sub1', 'param2', 1, 0);">
<option  value=''>Seleccione...</option>
<?php
$DB = new DB_mssql;
$DB->conectar();
$sql="SELECT idprogramas, prg_nombre FROM programas ORDER BY prg_nombre ";
$DB->llenaselect($sql,0,1, "");
?>
</select></td></tr>
<tr><td class="Intabla">Proyecto:</td><td align="right"><div id="llega_sub1"></div></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Componente:</td>
<td align="right">
<select name="param3" id="param3">
<option  value=''>Seleccione...</option>
<?php
$sql="SELECT idcomponentes, com_nombre FROM componentes ORDER BY com_nombre ";
$DB->llenaselect($sql,0,1, "");
?>
</select></td></tr>
<tr><td class="Intabla">Objetivo:</td>
<td align="right"><input name="param4" type="text" class="Textbox" id="param4" size="20"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Descripci&oacute;n:</td>
<td align="right"><textarea name="param5" type="text" class="Textbox" id="param5" cols="30"></textarea></td></tr>
<tr><td class="Intabla">Meta:</td>
<td align="right"><input name="param6" type="text" class="Textbox" id="param6" size="20"></td></tr>
<?php break; ?>
<?php case "Objetivo final": ?>
<tr bgcolor="#F5F5F5"><td class="Intabla">Objetivo:</td>
<td align="right"><input name="param1" type="text" class="Textbox" id="param1" size="20"></td></tr>
<tr><td class="Intabla">Descripci&oacute;n:</td>
<td align="right"><textarea name="param2" type="text" class="Textbox" id="param2" cols="30"></textarea></td></tr>
<?php break; ?>
<?php case "Productos": ?>
<tr><td class="Intabla">Producto:</td>
<td align="right"><input name="param1" type="text" class="Textbox" id="param1" size="20"></td></tr>
<?php break; ?>
<?php case "Actividad": ?>
<tr><td class="Intabla">Actividad:</td>
<td align="right"><input name="param1" type="text" class="Textbox" id="param1" size="20"></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Descripci&oacute;n:</td>
<td align="right"><textarea name="param2" type="text" class="Textbox" id="param2" cols="30"></textarea></td></tr>
<tr><td class="Intabla">Fecha Inicial:</td>
<td align="right"><table width="20%" border="0" cellspacing="0" cellpadding="0"><tr>
<td><input name="param3" type="text"  class="Textbox"  id="param3"  size="12" maxlength="10" readonly></td>
<td><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'param3'});</script></td></tr>
</table></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Fecha final:</td>
<td align="right"><table width="20%" border="0" cellspacing="0" cellpadding="0"><tr>
<td><input name="param4" type="text"  class="Textbox"  id="param4"  size="12" maxlength="10" readonly></td>
<td><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'param4'});</script></td></tr>
</table></td></tr>
<tr><td class="Intabla">Responsable:</td>
<td align="right"><input name="param5" type="text" class="Textbox" id="param5" size="20"></td></tr>
<?php break; ?>
<?php case "Indicador-Proyectos": ?>
<tr bgcolor="#F5F5F5"><td class="Intabla">Programa:</td>
<td align="right"><select name="param1" id="param1" onChange="cambio_ajax2(this.value, 3, 'llega_sub1', 'param2', 1, 0);">
<option  value=''>Seleccione...</option>
<?php
$DB = new DB_mssql;
$DB->conectar();
$sql="SELECT idprogramas, prg_nombre FROM programas ORDER BY prg_nombre ";
$DB->llenaselect($sql,0,1, "");
?>
</select></td></tr>
<tr><td class="Intabla">Proyecto:</td><td align="right"><div id="llega_sub1"></div></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Indicador:</td>
<td align="right"><select name="param3" id="param3" onChange="cambio_ajax2(this.value, 4, 'detalle_indicadores', '', 1, 0);">
<option  value=''>Seleccione...</option>
<?php
$sql="SELECT idindicadores, ind_nombre FROM indicadores ORDER BY ind_nombre ";
$DB->llenaselect($sql,0,1, "");
?>
</select></td></tr>
<tr><td colspan="2"><div id="detalle_indicadores"></div></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">C&oacute;digo:</td><td align="right"><input name="param7" type="text" class="Textbox" id="param7"></td></tr>
<tr><td class="Intabla">Descripci&oacute;n:</td><td align="right"><textarea name="param8" class="Textbox" id="param8" cols="30"></textarea></td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Meta:</td><td align="right"><input name="param9" type="text" class="Textbox" id="param9"></td></tr>
<tr><td class="Intabla">Frecuencia:</td><td align="right">
<select name="param10" id="param10" >
<option value="">Seleccione...</option>
<?php $DB->llenaselect_ar("",$frecuencia_captura); ?>
</select>
</td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">M&eacute;todo de captura:</td><td align="right">
<select name="param11" id="param11" >
<option value="">Seleccione...</option>
<?php $DB->llenaselect_ar("",$metodo_captura); ?>
</select>
</td></tr>
<tr><td class="Intabla">Viene de:</td><td align="right">
<select name="param12" id="param12"  onChange="cambio_ajax4(this.value, param2.value, 6, 'llega_sub2', 'param13', 3, 0);" >
<option value="">Seleccione...</option>
<?php $DB->llenaselect_ar("",$viene_de); ?>
</select>
</td></tr>
<tr bgcolor="#F5F5F5"><td class="Intabla">Target:</td><td align="right"><div id="llega_sub2"></div></td></tr>
<?php break; ?>

<?php } ?>
<tr bgcolor="#F5F5F5"><td align="center" colspan="2">
<table width="30%" border="0" cellspacing="0" cellpadding="0">
<tr><td align="right"><input type="button" name="button2" id="button2" value="Volver" onClick="javascript:history.back();"></td><td>&nbsp;&nbsp;</td>
<td><input type="submit" name="button" id="submit" value="Agregar"></td></tr>
</table>
<input type="hidden" name="condecion" id="condecion" value="<?php echo $_REQUEST["condecion"]; ?>">
<input type="hidden" name="tabla" id="tabla" value="<?php echo $tabla; ?>">
<input type="hidden" name="general" id="general" value="<?php echo $general; ?>"></td></tr>
</table>
</form></div>
</body>
</html>