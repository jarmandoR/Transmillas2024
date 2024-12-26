<?php
require("login_autentica.php"); //coneccion bade de datos
$DB1 = new DB_mssql;
$DB1->conectar();
$DB = new DB_mssql;
$DB->conectar();
$id_nombre=$_SESSION['usuario_nombre'];

//Obtenemos los datos de los input
$cond="";
$valores = $_POST["valores"];
$ciudaddes = $_POST["ciudaddes"];
$ciudado = $_POST["ciudado"];
$gnpiezas = explode(" ", $valores);
$guia=$gnpiezas[0];
$pieza=$gnpiezas[1];

 $sql="SELECT `ser_piezas`,idservicios,ser_estado,ser_desvaliguia,ser_ciudadentrega FROM `servicios` INNER JOIN ciudades on idciudades=ser_ciudadentrega WHERE ser_consecutivo='$guia' and  inner_sedes='$ciudaddes' ";		
$DB1->Execute($sql);
$rw1=mysqli_fetch_row($DB1->Consulta_ID);

$idser=$rw1[1];
$piezasg=$rw1[0];
$estado=$rw1[2];
$descricion=$rw1[3];

if($idser==''){

	$sql="INSERT INTO `malpistoleada`(`numeroguiamal`, `mal_idsedeori`, `mal_idciudaddes`,mal_fecha,mal_enviada) VALUES ('$guia',$ciudado,'$ciudaddes','$fechaactual','1')";
	$DB1->Execute($sql);
	$datos=array("resultado"  => "1");

}else {


	$sqlg="SELECT  numeropieza from piezasguia where numeroguia='$guia' and numeropieza='$pieza'";		
	$DB->Execute($sqlg);
	$rwg=mysqli_fetch_row($DB->Consulta_ID);
	if($rwg[0]==''){
		$sql="INSERT INTO `piezasguia`(`numeroguia`, `numeropieza`) values ('$guia',$pieza)";
		$DB1->Execute($sql);

	}


	if($estado==7){

			$llego='SI';
			$inser=1;
			$estadog=8;
			$descr='Validada con Pistola';
			if($piezasg>1){

				$sql="UPDATE  `piezasguia` SET guiallega=1  WHERE numeroguia='$guia' and numeropieza='$pieza' ";
				$DB1->Execute($sql);

				$sql="SELECT  count(numeropieza) from piezasguia where numeroguia='$guia' and guiallega=1  ";		
				$DB->Execute($sql);
				$rw2=mysqli_fetch_row($DB->Consulta_ID);
					
				if($rw2[0]!=$piezasg){
					$inser=0;
					$sql2="UPDATE `servicios` SET  `ser_fechaguia`='$fechatiempo' WHERE `idservicios`='$idser' ";			
					$DB->Execute($sql2);
				}

			}else{

				$sql4="UPDATE  `piezasguia` SET guiallega=1  WHERE numeroguia='$guia'";
				$DB1->Execute($sql4);
			}

			if($inser==1){

			$sql1="UPDATE `cuentaspromotor` SET  `cue_fecha`='$fechatiempo', cue_estado='$estadog'  where cue_idservicio=$idser";
			$DB1->Execute($sql1);	

			$sql2="UPDATE `servicios` SET  `ser_idusuarioregistro`='$id_usuario',`ser_fechaguia`='$fechatiempo',ser_estado='$estadog',ser_desvaliguia='$descr',ser_llego='$llego'
			WHERE `idservicios`='$idser' ";
			$DB->Execute($sql2);

			$sql3="UPDATE `guias` SET `gui_validasede`='$id_nombre',`gui_fechavalidasede`='$fechatiempo' WHERE `gui_idservicio`='$idser'";
			$DB->Execute($sql3); 

			}

			
			$datos=array("resultado"  => "2");

}else if($estado==8){
	$datos=array("resultado"  => "4");


}
else{
		$datos=array("resultado"  => "3");


	}
}

	//Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
	header('Content-Type: application/json');
	//Devolvemos el array pasado a JSON como objeto
	echo json_encode($datos, JSON_FORCE_OBJECT);
?>