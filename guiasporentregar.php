<?php
require("login_autentica.php"); 
//require_once("expdf/lib/pdf/mpdf.php");  
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$id_sedes=$_SESSION['usu_idsede'];
include 'barcode.php';
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$DB2 = new DB_mssql;
$DB2->conectar();
$DB3 = new DB_mssql;
$DB3->conectar();





$asc="ASC";

$conde=" ";
$conde2=" ";
$conde3=" ";
if($param34!=''){ $fechaactual=$param34;  }

if($param35!=''){ $id_sedes=$param35; } 

	$idcidades=ciudadesedes($id_sedes,$DB);
	if($idcidades=='0'){
		$conde2="";

	}else {
	  $conde2=" and (cli_idciudad in $idcidades  or (inner_sedes=$id_sedes and ser_idusuarioguia!='0') )"; 	
	}	

$conde1=""; 

if($param32!="" and $param31!=""){ 
 $conde1="and $param31 like '%$param32%' "; 
  }else { $conde1="  "; } 

//if($param1==""){ $param1="ser_prioridad"; } 
$conde4="and (ser_fechaguia like '$fechaactual%' or ser_fechaasignacion like '$fechaactual%' )";

  
      if($param33!=''){ $conde3 ="and  (ser_idusuarioguia='$param33' and ser_fechaguia like '$fechaactual%' )"; $conde4=""; } 


	 if($param33==''){ $conde3 =" "; } 

?>

<link rel="stylesheet" href="css/imprimir.css">
<style type="text/css">
	#imagen {
width: 480px;
	}
</style>

<?php

$html ="";


    $sql="SELECT `idclientes`,`ser_consecutivo`, `cli_nombre`,  `ser_destinatario`, `ser_telefonocontacto`,`ciu_nombre`,
 `ser_direccioncontacto`, `ser_paquetedescripcion`, `ser_piezas`,`ser_clasificacion`, `ser_valorprestamo`, 
 `ser_valorabono`, `ser_valorseguro`,`ser_resolucion`, `ser_pendientecobrar`,ser_valor,ser_peso,`cli_idciudad`,`ser_ciudadentrega`,
 `ser_tipopaq` ,`cli_telefono`, `cli_direccion`,ser_volumen,ser_verificado,ser_prioridad,ser_guiare,ser_estado,ser_devolverreci 

 FROM serviciosdia  where  ser_estado='9'   and ser_estado!='100'  $conde1 $conde2  $conde3  $conde4  ORDER BY ser_fechaguia $asc ";
 $DB3->Execute($sql);

	include('facturageneral.php');	


  ?>
  <body>
    <div id="imagen">
		<?php echo $html; ?>
    </div>

</body>


 