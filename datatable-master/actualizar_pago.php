<?php
include("../connection/variables.php");
require_once "clases/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $obj = new conectar();
    $conexion = $obj->conexion();

    // Obtener los datos del formulario
    // $idTransaccion = $_POST["idTransaccion"];
    // $nuevoValor = $_POST["nuevoValor"];
    // $tabla = $_POST["tabla"];
    date_default_timezone_set('America/Bogota'); // Ajusta a la zona horaria que necesites
    $fechatiempo = date("Y-m-d H:i:s");
    
    $id_nombre="";
    $param8=$_POST["param8"];
    $param6=$_POST["param6"];
    $id_param=$_POST["id_param"];
    

    $sql = "UPDATE `pagoscuentas` SET `pag_userverifica`='$id_nombre',`pag_fechaverifica`='$fechatiempo',pag_valorconfirmado='$param8',pag_numerotrans='$param6'  WHERE pag_guia='$id_param'";



    if (mysqli_query($conexion, $sql)) {
        echo "OK";
    } else {
        echo "Error al actualizar la factura: " . mysqli_error($conexion);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Acceso no permitido.";
}
?>
