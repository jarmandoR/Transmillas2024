<?php
// Obtener los datos de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['image']) && isset($data['filename'])) {
    // Decodificar la imagen en base64
    $imageData = $data['image'];
    $filename = $data['filename'];

    // Eliminar el encabezado "data:image/jpeg;base64,"
    $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $imageData = base64_decode($imageData);

    // Ruta donde guardar la imagen
    $filePath = 'Guias/' . $filename;

    // Guardar la imagen en el servidor
    if (file_put_contents($filePath, $imageData)) {
        echo json_encode(['success' => true, 'message' => 'Imagen guardada correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al guardar la imagen.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
}
?>