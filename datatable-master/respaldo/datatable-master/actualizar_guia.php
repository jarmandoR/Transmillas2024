<?php
include("../connection/variables.php");
require_once "clases/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $obj = new conectar();
    $conexion = $obj->conexion();

    // Obtener los datos del formulario
    $idTransaccion = $_POST["idTransaccion"];
    $nuevoValor = $_POST["nuevoValor"];
    $tabla = $_POST["tabla"];

    if( $tabla=='Bancolombia'){
    // Realizar la actualización en la base de datos
    $sql = "UPDATE transbancolombia SET guia = '$nuevoValor' WHERE Idtransbancolombia = $idTransaccion";
    }else{
    // Realizar la actualización en la base de datos
    $sql = "UPDATE transdavivienda SET guia = '$nuevoValor' WHERE Idtransdavivienda = $idTransaccion";
    }


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
