<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<?php
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$rol_nombre=$_SESSION['rol_nombre'];
$id_sedes=$_SESSION['usu_idsede'];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$DB2 = new DB_mssql;
$DB2->conectar();
$FB = new funciones_varias;
$QL = new sql_transact;
$LT = new llenatablas;
$param_edicion=1; $rcrear=1;  
?>