<?php 
require("login_autentica.php"); 
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$DB2 = new DB_mssql;
$DB2->conectar();
$FB = new funciones_varias;
if(isset($_REQUEST["condecion"])){$condecion=$_REQUEST["condecion"];} else { $condecion=""; }
if(isset($_REQUEST["id_param"])){$id_param=$_REQUEST["id_param"];} else { $id_param=""; }
//ob_start(); 

header('Content-type: application/vnd.ms-word');
header("Content-Disposition: attachment; filename=citamedica".".doc");
header("Pragma: no-cache");
header("Expires: 0"); 

$date=date("Y-m-d");
$sql="SELECT idhistoria, his_fecha,his_hora,his_codigo,pac_nombre,pac_iddocumento,usu_nombre,his_motivo,sed_nombre,sed_direccion,sed_telefonos From historiaclinica 
inner join pacientes on idpaciente=his_idpaciente  
inner join usuarios on idusuarios=his_idusuario 
inner join sedes on idsede=his_idsede where roles_idroles=3 and idhistoria='$id_param'";


$DB->Execute($sql);
$rw=mysqli_fetch_array($DB->Consulta_ID);	
	
echo	 $html=' <header class="clearfix">
      <div id="logo">
        <img src="img/fondopdf.png">
      </div>
      <h1>Cita Medica </h1>
      <h1>'.$date.'</h1><br />
    </header>
    <main>
	<div id="citamedica">
	<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" >
          <tr>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Fecha de la Cita:</span> </td><td  bgcolor="#074F91" style="color:#FFF">'.$rw[1].' </td>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Hora:</span> </td><td  bgcolor="#074F91" style="color:#FFF">'.$rw[2].' </td>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Codigo:</span> </td><td  bgcolor="#074F91" style="color:#FFF">'.$rw[3].' </td>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Nombre del Paciente:</span> </td><td  bgcolor="#074F91" style="color:#FFF">'.$rw[4].' </td>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Documento:</span> </td><td  bgcolor="#074F91" style="color:#FFF">'.$rw[5].' </td>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Medico:</span> </td><td  bgcolor="#074F91" style="color:#FFF">'.$rw[6].' </td>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Motivo:</span> </td><td  bgcolor="#074F91" style="color:#FFF">'.$rw[7].' </td>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Sede:</span> </td><td  bgcolor="#074F91" style="color:#FFF">'.$rw[8].' </td>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Dirección:</span> </td><td  bgcolor="#074F91" style="color:#FFF">'.$rw[9].' </td>
		  <td  bgcolor="#074F91" style="color:#FFF"><span>Teléfono:</span> </td><td  bgcolor="#074F91" style="color:#FFF">'.$rw[10].' </td>
			</tr>

	  </table>
	  </div>
    </main><footer>
	</footer>';

?>