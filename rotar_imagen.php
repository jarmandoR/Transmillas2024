
<?php
// require_once("expdf/lib/pdf/mpdf.php");  


require("login_autentica.php");
include("cabezote3.php"); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $direccion = $_POST['direccion'];
    $ruta_imagen = $_POST['url']; // Ruta de la imagen enviada por POST

    // Verifica que la imagen existe
    if (!file_exists($ruta_imagen)) {
        echo "Error: La imagen no existe. Ruta: $ruta_imagen";
        exit;
    }

    // Intenta crear la imagen desde el archivo JPEG
    $imagen = @imagecreatefromjpeg($ruta_imagen);
    if ($imagen === false) {
        echo "Error: No se pudo crear la imagen desde el archivo JPEG. Verifica que el archivo sea un JPEG válido.";
        exit;
    } else {
        echo "Imagen cargada correctamente. ";
    }

    // Determina la rotación
    if ($direccion == 'izquierda') {
        $rotacion = 90;
    } else if ($direccion == 'derecha') {
        $rotacion = -90;
    } else {
        echo "Error: Dirección no válida. Debe ser 'izquierda' o 'derecha'.";
        imagedestroy($imagen);
        exit;
    }

    // Rotar la imagen
    $imagen_rotada = imagerotate($imagen, $rotacion, 0);
    if ($imagen_rotada === false) {
        echo "Error: No se pudo rotar la imagen.";
        imagedestroy($imagen);
        exit;
    } else {
        echo "Imagen rotada correctamente. ";
    }

    // Guarda la imagen rotada
    if (!imagejpeg($imagen_rotada, $ruta_imagen)) {
        echo "Error: No se pudo guardar la imagen rotada en $ruta_imagen. Verifica los permisos de escritura.";
        imagedestroy($imagen);
        imagedestroy($imagen_rotada);
        exit;
    } else {
        echo "Imagen guardada correctamente en $ruta_imagen. ";
    }

    // Libera la memoria
    imagedestroy($imagen);
    imagedestroy($imagen_rotada);

    echo "Proceso completado con éxito.";
} else {
    echo "Método no permitido.";
}
?>