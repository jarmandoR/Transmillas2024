<?php
include("../connection/variables.php");
require_once "clases/conexion.php";
// Configurar el huso horario para Colombia
date_default_timezone_set('America/Bogota');

// Obtener la fecha y hora actual
$fechaActual = date('Y-m-d H:i:s');



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $obj = new conectar();
    $conexion = $obj->conexion();

    // Obtener los datos del formulario
    // $idTransaccion = $_POST["idTransaccion"];
    $id_nombre = $_POST["id_nombre"];
    $tabla = $_POST["tabla"];

    // Recibir los IDs seleccionados
    $idTransaccion = json_decode($_POST['idTransaccion']);
    $guias = json_decode($_POST['guias']);
    $guiasJson = json_encode($_POST['guias']);
    

    foreach ($idTransaccion as $id) {
        // // echo "$id<br>";

        // echo$sql="UPDATE `primas` SET `pri_img_compro`='$imagen' WHERE pri_fecha_inicio ='$fechaHora1' and pri_idusu = '$id' ";	
        // $DB1->Execute($sql);
        // foreach ($guias as $idg) {
            // echo "$id<br>";
            if( $tabla=='Bancolombia'){
                // Realizar la actualización en la base de datos
                    $sql = "UPDATE transbancolombia SET guia = '$guiasJson' WHERE Idtransbancolombia = $id";
                }else{
                // Realizar la actualización en la base de datos
                    $sql = "UPDATE transdavivienda SET guia = '$guiasJson' WHERE Idtransdavivienda = $id";
                }
            
            
                    if (mysqli_query($conexion, $sql)) {
                        echo "OK";
                    } else {
                        echo "Error al actualizar la guia: " . mysqli_error($conexion);
                    }
                
                // Cerrar la conexión a la base de datos
                
        // }
    }

    foreach ($guias as $idg) {
        $sql1 = "UPDATE `pagoscuentas` SET `pag_userverifica`='$id_nombre',`pag_fechaverifica`='$fechaActual',pag_valorconfirmado='',pag_numerotrans=''  WHERE pag_guia='$idg'";
        if (mysqli_query($conexion, $sql1)) {
            
        } else {
            echo "Error al confirmar guia: " . mysqli_error($conexion);
        }
    }
    mysqli_close($conexion);

} else {
    echo "Acceso no permitido.";
}
?>
