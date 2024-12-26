<?php
require("login_autentica.php"); 
//require_once("expdf/lib/pdf/mpdf.php");  
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$id_sedes=$_SESSION['usu_idsede'];
require "ticket/fpdf/fpdf.php";
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$DB2 = new DB_mssql;
$DB2->conectar();
$DB3 = new DB_mssql;
$DB3->conectar();
$param5=$_REQUEST["param5"];

if($param5==""){ $param5=$id_sedes;}
if($param34!=''){ $fechaactual=$param34;  }




if($param5!=''){ 
	$id_sedes=$param5; 
	$idcidades=ciudadesedes($param5,$DB);
	if($idcidades=='0'){
		$conde1=" and cli_idciudad in (0) "; 

	}else {
	  $conde1=" and cli_idciudad in $idcidades "; 	
	}
} else {  

$idcidades=ciudadesedes($id_sedes,$DB);
if($idcidades=='0'){
	$conde1="";

}else {
  $conde1=" and cli_idciudad in $idcidades "; 	
}


}
if($nivel_acceso==1){ $conde2="";  	 } else {  $conde2=" and idsedes=$id_sedes"; }


$conde3="";
// $conde5="and (ser_fechaguia like '$fechaactual%' or ser_fechaasignacion like '$fechaactual%' )";
$conde5="and ser_fechaasignacion like '$fechaactual%' ";
if($param4==''){ $param4=0;   } else { $conde3=" and inner_sedes=$param4";   }

$pdf = new FPDF($orientation='L',$unit='mm', array(100,70));
$pdf->AddPage();

//Fields Name position

if($param33!=''){ $conde4 ="and ((ser_idresponsable='$param33' and ser_fechaasignacion like '$fechaactual%') or (ser_idusuarioguia='$param33' and ser_fechaguia like '$fechaactual%' )) "; $conde5="";  } 
//if($param33!=''){ $conde4 ="and (ser_idresponsable='$param33' and ser_fechaasignacion like '$fechaactual%') "; $conde5="";  } 


  $sql="SELECT `idservicios`,ser_guiare,ser_consecutivo,ciu_nombre,`ser_direccioncontacto`,ser_piezas,`ser_telefonocontacto`,`ser_destinatario`
FROM serviciosdia   where  ser_estado>='6' and ser_estado!='100'  $conde1 $conde3 $conde4  $conde5 ORDER BY ser_fechafinal $asc ";

$DB->Execute($sql);
$va=0; 
//echo "doss";
  while($rw1=mysqli_fetch_row($DB->Consulta_ID))
   {
	$rw1[4]=str_replace("&"," ", $rw1[4]);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',13);

$pdf->Cell(30, 2, 'GUIA:', 0);
$pdf->Cell(40, 2, $rw1[1].'/'.$rw1[2], 0);
$pdf->Ln(6);
$pdf->Cell(30, 2, 'DESTINO:', 0);
$pdf->Cell(40, 2, $rw1[3], 0);
$pdf->Ln(6);
$pdf->Cell(30, 2, 'DIRECCION:', 0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(40, 2, $rw1[4], 0);
$pdf->SetFont('Arial','B',13);
$pdf->Ln(6);
$pdf->Cell(30, 2, '# PIEZAS:', 0);
$pdf->Cell(40, 2, $rw1[5], 0);

$pdf->Ln(6);
$pdf->Cell(35, 2, 'TELEFONO:', 0);
$pdf->Cell(40, 2, $rw1[6], 0);
$pdf->Ln(6);
$pdf->Cell(50, 2, 'DESTINATARIO:', 0);
$pdf->SetFont('Arial','B',11);
$pdf->Ln(6);
$pdf->Cell(80, 2, $rw1[7], 0);
$pdf->Ln(6);
   }
//$pdf->AutoPrint();
$pdf->output(); 



?>
