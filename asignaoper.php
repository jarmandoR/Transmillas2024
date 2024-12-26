<?php
require("login_autentica.php"); //coneccion bade de datos
$DB1 = new DB_mssql;
$DB1->conectar();
$DB = new DB_mssql;
$DB->conectar();
$id_nombre=$_SESSION['usuario_nombre'];
$id_usuario= $_SESSION['usuario_id'];
//Obtenemos los datos de los input
$cond="";
$guia = $_POST["valores"];
$operador = $_POST["operador"];
$ciudado = $_POST["ciudado"];


 $sql="SELECT `ser_piezas`,idservicios,ser_estado,ser_desvaliguia,ser_ciudadentrega,ser_idverificadopeso,ser_direccioncontacto FROM  `servicios` INNER JOIN ciudades on idciudades=ser_ciudadentrega WHERE ser_consecutivo='$guia' and  inner_sedes='$ciudado' ";		
$DB1->Execute($sql);
$rw1=mysqli_fetch_row($DB1->Consulta_ID);

$idser=$rw1[1];
$piezasg=$rw1[0];
$estado=$rw1[2];
$descricion=$rw1[3];
$inser=1;
if($idser==''){	
	$datos=array("resultado"  => "1");

}else {

	if($estado==8 or $estado==11){

			$estadog=9;

			$rw1[6]=str_replace("&"," ", $rw1[6]);
			$mensaje3="ENTREGA: ".$rw1[6];

			$sql1="UPDATE `cuentaspromotor` SET `cue_idoperentrega`='$operador', `cue_fecha`='$fechatiempo', cue_estado='9'  where cue_idservicio=$idser";
			$DB1->Execute($sql1);	
			
		 $sql2="UPDATE `servicios` SET  ser_idusuarioguia='$operador',`ser_idusuarioregistro`='$id_usuario',`ser_fechaguia`='$fechatiempo',ser_estado='9',ser_visto=0
			WHERE `idservicios`='$idser' ";
			$DB->Execute($sql2);
			
			 $sql3="UPDATE `guias` SET `gui_encomienda`='$id_nombre',`gui_fechaencomienda`='$fechatiempo' WHERE `gui_idservicio`='$idser'";
			$DB->Execute($sql3); 
				

			$sqlse = "INSERT INTO `seguimientoruta`( `seg_fecha`, `seg_idservicio`, `seg_direccion`, `seg_tipo`, `seg_estado`,`seg_idusuario`) values ('$fechatiempo','$idser','$mensaje3','Entrega','Asignada','$operador')";
			$DB1->Execute($sqlse);	

				$datos=array("resultado"  => "2");


}else if($estado==9){
	$datos=array("resultado"  => "4");
	return;

}else{
		$datos=array("resultado"  => "3");

		return;
	}
}

	//Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
	header('Content-Type: application/json');
	//Devolvemos el array pasado a JSON como objeto
	echo json_encode($datos, JSON_FORCE_OBJECT);
?>