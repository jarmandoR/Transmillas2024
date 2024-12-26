<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo_excel'])) {
    // Ruta donde quieres guardar el archivo
    $rutaDestino = 'pre_facturas/tabla_datos.xlsx';

    // Verificar si el archivo fue subido correctamente
    if (move_uploaded_file($_FILES['archivo_excel']['tmp_name'], $rutaDestino)) {
        echo "Archivo guardado correctamente en el servidor.";
    } else {
        echo "Error al guardar el archivo.";
    }
} else {
    echo "No se recibió ningún archivo.";
}
?>