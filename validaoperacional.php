<?php 
require("login_autentica.php"); 
include("layout.php");

$DB = new DB_mssql;
$DB->conectar();  

	$preoperacional='validarpreoperacional';
	
	$fecha=$_REQUEST["fecha"];
	 $iduser=$_REQUEST["iduser"];
	 $campo=$_REQUEST["campo"];
	 $idvehiculo=$_REQUEST["idvehiculo"];
	 $mostrarpreguntas=0;
	 $slq="SELECT `pre_obsevaciones`,`pre_correctiva`,`pre_responsable`,pre_descvalidada,idpreoperacinal,predatosvalidados,preestado,prevehiculo, `pre_temperatura`, `pre_kilrecorridos`,`pre_codigoimpresora`,`pre_limpiomaleta`,`roles_idroles`,pre_img_kilo FROM `pre-operacional` inner join usuarios on preidusuario=idusuarios where preidusuario='$iduser' and prefechaingreso like '$fecha%'";	
	 $DB->Execute($slq); 
	 $rw2=mysqli_fetch_row($DB->Consulta_ID);
	 //$idvehiculo=$rw2[7];
	if($rw2[6]=='covid19' or $rw2[6]=='Validado Covid19'){
		$param4='covid19';
		$param5='valida';
	}else{
		
		$param4='ingresado';
		$param5='valida';
	

	}
	$roluser=$rw2[12];
	if($roluser==3){
		$mostrarpreguntas=1;
	}
	include("preoperacional.php");

 ?>

