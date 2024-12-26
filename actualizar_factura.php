<?php
include("../connection/variables.php");
require_once "clases/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $obj = new conectar();
    $conexion = $obj->conexion();

    // Obtener los datos del formulario
    $idTransaccion = $_POST["idTransaccion"];
    $nuevoValor = $_POST["nuevoValor"];

    // Realizar la actualización en la base de datos
    $sql = "UPDATE transdavivienda SET factura = '$nuevoValor' WHERE Idtransdavivienda = $idTransaccion";

    if (mysqli_query($conexion, $sql)) {
        echo "La factura se actualizó correctamente.";
    } else {
        echo "Error al actualizar la factura: " . mysqli_error($conexion);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Acceso no permitido.";
}
?>
