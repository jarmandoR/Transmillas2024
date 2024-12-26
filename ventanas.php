<?php
ini_set('post_max_size','100M');
ini_set('upload_max_filesize','100M');
ini_set('max_execution_time','1000');
ini_set('max_input_time','1000');

require("connection/conectarse.php");
$DB = new DB_mssql;
$DB->conectar();
$param3=0;	
$param16=0;
$param79=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Nuevos Horizontes</title>
<link href="css/estilos.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<SCRIPT LANGUAGE="JavaScript" src="js/ajax.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="js/validador.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" src="js/consultas_js.js"></SCRIPT>
<script language="JavaScript" src="js/calendar_us.js"></script>
<link rel="stylesheet" href="css/calendar.css">
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
#TabbedPanels1 .TabbedPanelsContentGroup .TabbedPanelsContent.TabbedPanelsContentVisible h4 {
	color: #A50000;
}
#TabbedPanels1 .TabbedPanelsContentGroup .TabbedPanelsContent .text {
	color: #116BF2;
}
#TabbedPanels1 .TabbedPanelsContentGroup .TabbedPanelsContent .text {
	color: #000;
}
-->
</style>
<script type="text/javascript">
document.getElementById('pass').value="";
document.getElementById('user').value="";
</script>
</head>
<body>
<form enctype="multipart/form-data" name="form2" method="post" action="nuevo_aspiok.php" >
<br />
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
   <td colspan="6"><img name="menu1_r1_c1" src="img/cabezal.png" width="1000" height="197" border="0" id="menu1_r1_c1" alt="" /></td>
   <td width="1"><img src="images/spacer.gif" width="1" height="97" border="0" alt="" /></td>
  </tr>
    <tr>
      <td colspan="6" valign="top">
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" valign="top"><div align="center">
      <table width="90%" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="100%" colspan="2" bgcolor="#FFFFFF" ><div id="TabbedPanels1" class="TabbedPanels"  >
           <ul class="TabbedPanelsTabGroup">
            
            <li class="TabbedPanelsTab" tabindex="0">Visi&oacute;n</li>
            <li class="TabbedPanelsTab" tabindex="0">Misi&oacute;n</li>
			 <li class="TabbedPanelsTab" tabindex="0">Declaraci&oacute;n de Fe</li>
           
           </ul>
           <div class="TabbedPanelsContentGroup"  style="height:400px;width:645px; 	overflow:scroll;">

            <div class="TabbedPanelsContent" id="vision"> <h4>Visi&oacute;n:</h4>
             <p class="text">Millones de gente tribal, hombres, mujeres y ni&ntilde;os contin&uacute;an aislados del evangelio. abrir
Prop&oacute;sito
Movilizamos, equipamos y coordinamos a los misioneros que vienen de y son enviados por sus iglesias locales. abrir</p></div>
            <div class="TabbedPanelsContent"> <h4>PROP&Oacute;SITO</h4>  <p class="text">
			

Nuevos Horizontes ayuda a las iglesias locales a plantar iglesias tribales.

Movilizamos, equipamos y coordinamos a los misioneros que vienen de y son enviados por sus iglesias locales. Trabajando a trav&eacute;s de Nuevos Horizontes, estos misioneros evangelizan a grupos de gente que no tienen acceso al Evangelio, traducen las Escrituras en su idioma, y fundan la iglesia. Una vez esa iglesia es fundada, ser&aacute; una iglesia local con la que podremos contar para llevar el Evangelio a otros que todav&iacute;a no han escuchado.

Prop&oacute;sito de existencia de Nuevos Horizontes:

Motivados por el amor de Cristo y capacitados con el poder del Esp&iacute;ritu Santo, Nuevos Horizontes existe para asistir al ministerio de la iglesia local por medio del entrenamiento, movilizaci&oacute;n, y coordinaci&oacute;n de misioneros para evangelizar grupos de personas no alcanzadas, traducir las Escrituras, y ver establecidas iglesias que siguen el modelo del Nuevo testamento y glorifiquen a Dios.
			
			</p></div>
            <div class="TabbedPanelsContent"> <h4>DOCTRINA</h4>  <p class="text">
				


<h5>Creemos:</h5>

En la inspiraci&oacute;n verbal de las Santas Escrituras, su suficiencia y su autoridad absoluta.

En un Dios que existe eternamente en tres personas, Padre, Hijo y Esp&iacute;ritu Santo.

En el Se&ntilde;or Jesucristo como verdadero Dios y verdadero hombre; en Su nacimiento virginal, Su humanidad sin pecado, Su muerte vicaria, Su resurrecci&oacute;n f&iacute;sica, Su actual intercesi&oacute;n y Su regreso personal, inminente y f&iacute;sico por Su iglesia.

En la ca&iacute;da del hombre, la cual result&oacute; en su separaci&oacute;n completa y universal de Dios, y en su necesidad de salvaci&oacute;n.

Que el Se&ntilde;or Jesucristo derram&oacute; Su sangre y muri&oacute; como sacrificio por los pecados de todo el mundo.

Que la salvaci&oacute;n es un regalo de Dios gratis y eterno, totalmente aparte de las obras, la cual se recibe de manera personal, por la fe en el Se&ntilde;or Jesucristo.

Que el Esp&iacute;ritu Santo regenera con vida divina, y de manera personal empieza a habitar en el creyente en el momento que &eacute;ste pone su fe en Cristo para salvaci&oacute;n.

En la resurrecci&oacute;n f&iacute;sica tanto de los salvos como de los no salvos.

En la vida perpetua de los salvos con el Se&ntilde;or, y en el castigo perpetuo para los no salvos.

Mantenemos y ense&ntilde;amos las siguientes posiciones:

El regreso pre-tribulacional y pre-milenial de Cristo por Su iglesia.

La interpretaci&oacute;n hist&oacute;rico-gramatical de la Biblia.

Que un alma una vez salva nunca se puede perder.

Practicamos el bautismo de los creyentes por inmersi&oacute;n.

No practicamos lo que se conoce com&uacute;nmente como "dones de se&ntilde;ales"


<h4>DECLARACI&Oacute;N DE FE:</h4>

La Biblia es la Palabra inspirada de Dios y es el &uacute;nico fundamento de fe y pr&aacute;ctica de todos los creyentes.

La Biblia revela a un Dios trino: Dios el Padre, Dios el Hijo, y Dios el Esp&iacute;ritu Santo.

El Padre envi&oacute; al Hijo para ser el Salvador de la humanidad perdida, la cual fue separada de Dios por el pecado.

Jes&uacute;s, el Hijo de Dios sufri&oacute; una muerte vicaria en la cruz, fue sepultado y resucit&oacute; al tercer d&iacute;a, conforme a las Escrituras, para salvar a la humanidad de la eterna separaci&oacute;n de Dios.

Quienes depositan su fe en la obra terminada del Se&ntilde;or Jesucristo son regenerados con vida divina por el Esp&iacute;ritu Santo.

Todos los creyentes tienen la responsabilidad de trabajar juntos para compartir el Mensaje del Evangelio con todos, para que Dios sea glorificado en todo.
			
			
			</p></div>

           </div>
          </div></td>
        </tr>
        <tr>
          <td class="error"><div align="center"><br /></td>
        </tr>
      </table></form>
        </div></td>
    <td width="50%">
	<form name="form1" method="post" action="seleccionar_destino.php">
     <table width="30%" align="center" cellpadding="0" cellspacing="0">
     <tr>
      <td width="29%" rowspan="3" valign="top"><div align="center">
       <table width="30%" align="center" cellpadding="0" cellspacing="0">
        <tr>
         <td colspan="3" bgcolor="#A50000" class="tittle3"><div align="center">Ingrese Su Usuario y Contrase&ntilde;a</div></td>
        </tr>
        <tr>
         <td class="error" colspan="2"><div align="center">
 <?php include ("aut_mensaje_error.inc.php");
 
if (isset($_GET['error_login'])){
$error=$_GET['error_login'];
echo $error_login_ms[$error];
}
?>
         </div></td>
        </tr>
        <tr>
         <td width="29%" rowspan="3" valign="top"><div align="center"><img src="img/ingreso.png" width="128" height="128" /></div></td>
         <td width="59%" align="right" class="Intabla">&nbsp;Usuario:<br />
          <input name="user" class="Textbox" type="text" id="user" size="25" /></td>
        </tr>
        <tr>
         <td align="right" class="Intabla">&nbsp;Contrase&ntilde;a:<br />
          <input name="pass" class="Textbox" type="password" id="pass" size="25" /></td>
        </tr>
	     <tr>
         <td height="31" align="right">
		 <input type="submit" name="Submit" value=" Ingresar " class="botones" /></td>
        </tr>
       </table>
      </div></td>
     </tr>
     </table>
    </form></td>
  </tr>
</table>
   </td>
    </tr>
<tr>
   <td colspan="6"><img id="base" src="img/base.gif" name="base" width="100%" height="31" border="0" alt="Todos los Derechos Reservados"/></td>
   <td><img src="images/spacer.gif" width="1" height="34" border="0" alt="" /></td>
  </tr>
  </table>
<script type="text/javascript">
document.getElementById('pass').value="";
document.getElementById('user').value="";
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>