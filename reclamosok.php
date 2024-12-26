<?php
require("definirvar.php");
require("connection/conectarse.php");
require("connection/funciones.php");
require("connection/sql_transact.php");
$DB = new DB_mssql;
$DB->conectar();
$QL = new sql_transact;


if($param10!=''){
		
	$rand=rand(0,99);
	$variableunica=date("Y").date("m").date("d").date("h").date("i").date("s").$rand;
	$sql="INSERT INTO `reclamos`(`rec_numero`, `rec_fechaingreso`, `rec_fechaenvio`, `rec_tipo`, `rec_nombre`, `rec_telefono`, `rec_correo`,`rec_descripcion`, `rec_guia`, `rec_idservicio`, `rec_ciudadenvio`,`rec_direccion`, `rec_userregistra`,rec_estado) 
	values ('$variableunica','$fechaactual','$param8','$param9','$param4','$param5','$param6','$param7','$param2','$param10','$param1','$param11','Cliente','Confirmar')";
	
	$vinculo=$DB->Executeid($sql);
	/*  $sql3="update  `servicios` set ser_estado='18' where idservicios='$param10'";
	$DB->Execute($sql3); */
	//echoLog($sql3);
	// $sql="update  `cuentaspromotor` set cue_estado='18' where cue_idservicio='$param10'";
	 //$DB->Execute($sql);
	//echoLog($sql3);
	if($_FILES["param8"]!=''){
		$QL->addDocumento1($_FILES["param8"], 1, "reclamos", $vinculo, "reclamos", $DB);
	}
	

	$mensaje = "
	<html>
	<head>
	<title>HTML</title>
	</head>
	<body>
	<h1>Reclamo de Guia</h1>
	<p>
	Hola $param4. <br>Hemos recibido su solicitud de reclamo, de la guia $param2 ha sido recibida. 
	<br> En máximo 48 hábiles nos comunicaremos con usted para seguir con el proceso del reclamo.
	<br> por favor estar pendiente del correo y telefono.
	<br> Su numero de reclamo es: $variableunica.
	</p>
	</body>
	</html>";

$corEmpresa='pqrtransmillas@gmail.com';
			$paramEnv=$param6;



			$emails = array($corEmpresa,$paramEnv);

			for($i = 0; $i < count($emails); $i++) {

			enviar_mail2($emails[$i],'',$mensaje,$param4,'Reclamo',1);
    		}



	// $param6='pqrtransmillas@gmail.com,'.$param6;

	// enviar_mail2($param6,'',$mensaje,$param4,'Reclamo',1);
	
	header ("Location: reclamorespuesta.php?correo=$param6");
}else{

echo '<div class="alert alert-danger">
  <a href="reclamoscliente.php" class="alert-link"> Ocurrio un Error en el Registro, 
  Por favor vuelva aingresar la informacion y verifique su numero de Guia</a>
</div>';

}


?> 