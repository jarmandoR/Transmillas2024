<?php
require("login_autentica.php"); 
$DB = new DB_mssql;
$DB->conectar();


	$sql = "SELECT `idusuarios`,`usu_usuario`,  `usu_nombre`,  `usu_mail`, `usu_estado` FROM usuarios";
	//$registro = mysqli_query($dbx,$sql);
	$DB->Execute($sql);
	$tabla = "";

 	while($row = mysqli_fetch_array($DB->Consulta_ID)){		

		//$editar = '<a href=\"edicionUsuario.php?a='.$row['idusuarios'].'&b='.$row['usu_usuario'].'&c='.$row['usu_nombre'].'&d='.$row['usu_mail'].'&e='.$row['usu_estado'].'\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Editar\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>';
		//$eliminar = '<a href=\"actionDelete.php?id='.$row['idusuarios'].'\" onclick=\"return confirm(\'¿Seguro que desea eliminiar este usuario?\')\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Eliminar\" class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>';
		
		$tabla.='{
				  "idusuarios":"'.$row['idusuarios'].'",
				  "usuario":"'.$row['usu_usuario'].'",
				  "nombre":"'.$row['usu_nombre'].'",
				  "email":"'.$row['usu_mail'].'",
				  "estado":"'.$row['usu_estado'].'",
				  "acciones":""
				},';		
	}	

	//eliminamos la coma que sobra
	$tabla = substr($tabla,0, strlen($tabla) - 1);

	echo '{"data":['.$tabla.']}';	 
	
/* $data=mysqli_fetch_array($DB->Consulta_ID,MYSQLI_ASSOC);


//Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
header('Content-Type: application/json');
//Devolvemos el array pasado a JSON como objeto
echo $data;
echo json_encode($data, JSON_FORCE_OBJECT);  */
?>