
<?php
include("../connection/variables.php");
require_once "clases/conexion.php";
// Configurar el huso horario para Colombia
date_default_timezone_set('America/Bogota');

// Obtener la fecha y hora actual
$fechaActual = date('Y-m-d H:i:s');
$id_nombre = $_POST["id_nombre"];
$descripcion= $_POST["descripcion"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $obj = new conectar();
    $conexion = $obj->conexion();


    $tabla = $_POST["tabla"];
    $idTransaccion = json_decode($_POST['idTransaccion']);
    $facturaJson = json_decode($_POST['facturas']);
    $factura = json_encode($_POST['facturas']);

    foreach ($idTransaccion as $id) {

            if( $tabla=='Bancolombia'){
                // Realizar la actualización en la base de datos
                    $sql = "UPDATE transbancolombia SET Factura = '$factura' WHERE Idtransbancolombia = $id";
                }else{
                // Realizar la actualización en la base de datos
                    $sql = "UPDATE transdavivienda SET factura = '$factura' WHERE Idtransdavivienda = $id";
                }
            
            
                    if (mysqli_query($conexion, $sql)) {
                        echo "OK";
                    } else {
                        echo "Error al actualizar la factura: " . mysqli_error($conexion);
                    }
                
    }
    echo$tabla;
    foreach ($facturaJson as $idg) {
       
        // $sql1 = "UPDATE `pagoscuentas` SET `pag_userverifica`='$id_nombre',`pag_fechaverifica`='$fechaActual',pag_valorconfirmado='',pag_numerotrans=''  WHERE pag_guia='$idg'";
        // $fechat=date("$param5 H:i:s");
		echo$sql1="UPDATE `facturascreditos` SET `fac_fechapago`='$fechaActual',`fac_tipopago`='Transferencia Bancaria',fac_userpago='$id_nombre',fac_descripcion='$descripcion' WHERE fac_numeroref='$idg'";
        
        
        
        
        if (mysqli_query($conexion, $sql1)) {
            
        } else {
            echo "Error al confirmar guia: " . mysqli_error($conexion);
        }
    }

                // Cerrar la conexión a la base de datos
                mysqli_close($conexion);
} else {
    echo "Acceso no permitido.";
}
?>

