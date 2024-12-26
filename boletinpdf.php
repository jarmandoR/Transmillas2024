<?php
require("login_autentica.php"); 
require_once("expdf/lib/pdf/mpdf.php");  
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$DB2 = new DB_mssql;
$DB2->conectar();

$date=date("Y-m-d");
$sql="SELECT idhistoria, his_fecha,his_hora,his_codigo,pac_nombre,pac_iddocumento,usu_nombre,his_motivo,sed_nombre,sed_direccion,sed_telefonos From historiaclinica 
inner join pacientes on idpaciente=his_idpaciente  
inner join usuarios on idusuarios=his_idusuario 
inner join sedes on idsede=his_idsede where roles_idroles=3 and idhistoria='$id_param'";
$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	
	
  $html=' <header>
      <div id="logo">
        <img src="img/fondopdf2.png">
      </div>
    </header>
    <main>
	<div id="citamedica">
	<table width="1000" border="2" align="center" cellpadding="1" cellspacing="0" >
          <tr>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Fecha de la Cita:</span> </td><td>'.utf8_encode($rw[1]).' </td></tr><tr>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Hora:</span> </td><td>'.utf8_encode($rw[2]).' </td></tr><tr>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Codigo:</span> </td><td>'.utf8_encode($rw[3]).' </td></tr><tr>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Nombre del Paciente:</span> </td><td>'.utf8_encode($rw[4]).' </td></tr><tr>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Documento:</span> </td><td>'.utf8_encode($rw[5]).' </td></tr><tr>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Medico:</span> </td><td>'.utf8_encode($rw[6]).' </td></tr><tr>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Motivo:</span> </td><td>'.utf8_encode($rw[7]).' </td></tr><tr>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Sede:</span> </td><td>'.utf8_encode($rw[8]).' </td></tr><tr>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Dirección:</span> </td><td>'.utf8_encode($rw[9]).' </td></tr><tr>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Teléfono:</span> </td><td>'.utf8_encode($rw[10]).' </td></tr>
			</tr>

	  </table>
	  </div>
    </main><footer>
	</footer>'; 
 	$mpdf=new mPDF('c','A4');
	$css= file_get_contents('expdf/reportes/css/style.css');
	$mpdf->writeHTML($css,1);
	$mpdf->writeHTML($html);
	//$mpdf->Output('reporte.pdf','I');  
	$mpdf->Output('citamedica.pdf','D');   
	
?>