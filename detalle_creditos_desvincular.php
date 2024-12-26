<?php 
require("login_autentica.php");
$DB1 = new DB_mssql;
$DB1->conectar();
$DB = new DB_mssql;
$DB->conectar();

$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$asc="ASC";
$conde1=""; 
$conde3=""; 
$conde2=""; 
$opcion=$_REQUEST["preguia"];

if($param4!=''){  $fechainicio=$param4;}
if($param5!=''){  $fechaactual=$param5;}

if($param1==""){ $param1="ser_prioridad"; } 
if($param2!=''){ $conde2 =" and ser_numerofactura like '%$param2%'";  }
if($param3!=''){ $conde3 =" and (rel_nom_credito like '%$param3%')";  }

if($param6=='Sin Facturar'){
	$conde4=' and ser_numerofactura is null';
}elseif($param6=='Facturados'){
	$conde4=' and ser_numerofactura>=1';
}else{
	$conde4='';	
}



 $sql="SELECT distinct(ser_numerofactura)
 FROM  servicios s inner join rel_sercli  on idservicios=ser_idservicio 
inner join clientesservicios on idclientesdir=ser_idclientes inner join ciudades on idciudades=cli_idciudad   inner join rel_sercre rs on rs.idservicio=idservicios where date(ser_fecharegistro)>='$fechainicio' and  date(ser_fecharegistro)<='$fechaactual' and ser_clasificacion=2  and ser_estado>=3 and ser_estado!=100  $conde1 $conde2 $conde3  $conde4 ORDER BY idrelsercre $asc ";

$idguias='';
$html1= "";
$totalcontado=0;
$guiafacturadas=0;
$DB->Execute($sql); $va=0; 
$facturas="";
	while($rw1=mysqli_fetch_row($DB->Consulta_ID))
	{
		$nombre=$rw1[0];
		$sql2="SELECT idfacturascreditos FROM `facturascreditos` WHERE fac_numerofactura='$nombre'";
		$DB1->Execute($sql2);
		$idfactura=mysqli_fetch_row($DB->Consulta_ID);
		if($idfactura[0]<=0)
		{
			 $sql2="UPDATE servicios SET  ser_numerofactura='' WHERE ser_numerofactura='$nombre'";
			$DB1->Execute($sql2);

			// Verifica si el parámetro ya existe en el array. Si no existe, agrega el parámetro al array
			$facturas.=$nombre.",";
		}
		

	}

if($facturas!="" and $facturas!=","){
	echo "Se Desvicularon las siguientes facturas: ".$facturas;
}else{
	echo "No se encontraron facturas para desvincular";
}


?>