<?phprequire("login_autentica.php");include("layout.php");
$DB2 = new DB_mssql;$DB2->conectar(); $nivel_acceso=$_SESSION['usuario_rol'];$estadofactura='recoleccion';$FB->llena_texto("Servicio:",15,82, $DB, $Servicio, "cambio2(this.value,\"recolecion_oficina.php\",\"Oficina\")","$param1",1, 1);if($param1==""){	include("oficina.php");		}else {		include("oficina.php");		}$FB->llena_texto("", 1, 142, $DB, "", "", 0, 12, 0);require("footer.php");
?>

