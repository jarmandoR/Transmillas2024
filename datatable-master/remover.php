<?php
include("../connection/variables.php");
require_once "clases/conexion.php";
// Configurar el huso horario para Colombia
date_default_timezone_set('America/Bogota');

// Obtener la fecha y hora actual
$fechaActual = date('Y-m-d H:i:s');
// $id_nombre = $_POST["id_nombre"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $obj = new conectar();
    $conexion = $obj->conexion();


    $tabla = $_POST["tabla"];
    $idTransaccion = json_decode($_POST['idTransaccion']);
    // $facturaJson = json_encode($_POST['facturas']);
    
    if( $tabla=='Bancolombia'){
        // Realizar consulta

            $sql4 = "SELECT `Idtransbancolombia`,Factura,guia FROM `transbancolombia` where Idtransbancolombia = $idTransaccion ";

            $result4 = mysqli_query($conexion, $sql4);
                    while ($mos = mysqli_fetch_row($result4)) {
                        $facturas = $mos[1];
                        $guias = $mos[2];
        
                    }
        }else{
        // Realizar consulta
        $sql4 = "SELECT `Idtransdavivienda`,`factura`,guia FROM `transdavivienda` where Idtransdavivienda = $idTransaccion ";

        $result4 = mysqli_query($conexion, $sql4);
                while ($mos = mysqli_fetch_row($result4)) {
                    $facturas = $mos[1];
                    $guias = $mos[2];
    
                }
        }
    



    


                
if ($facturas!='Sin facturar') {

    if( $tabla=='Bancolombia'){
        // Realizar la actualización en la base de datos
            $sql = "UPDATE transbancolombia SET Factura = 'Sin facturar' WHERE Idtransbancolombia = $idTransaccion";
        }else{
        // Realizar la actualización en la base de datos
            $sql = "UPDATE transdavivienda SET factura = 'Sin facturar' WHERE Idtransdavivienda = $idTransaccion";
        }
    
    
            if (mysqli_query($conexion, $sql)) {
                echo "OK";
            } else {
                echo "Error al actualizar la factura: " . mysqli_error($conexion);
            }
    $facturasJson = json_decode($mos[1]);
    foreach ($facturasJson as $idg) {
        // $sql1 = "UPDATE `pagoscuentas` SET `pag_userverifica`='',`pag_fechaverifica`='',pag_valorconfirmado='',pag_numerotrans=''  WHERE pag_guia='$idg'";
        // $fechat=date("$param5 H:i:s");
		$sql1="UPDATE `facturascreditos` SET `fac_fechapago`='',`fac_tipopago`='',fac_userpago='',fac_descripcion='' WHERE fac_numeroref='$idg'";
        
        
        
        
        if (mysqli_query($conexion, $sql1)) {
            
        } else {
            echo "Error al remover: " . mysqli_error($conexion);
        }
    }
}

if($guias!=''){
    if( $tabla=='Bancolombia'){
        // Realizar la actualización en la base de datos
            $sql = "UPDATE transbancolombia SET guia = '' WHERE Idtransbancolombia = $idTransaccion";
        }else{
        // Realizar la actualización en la base de datos
            $sql = "UPDATE transdavivienda SET guia = '' WHERE Idtransdavivienda = $idTransaccion";
        }
    
    
            if (mysqli_query($conexion, $sql)) {
                echo "OK";
            } else {
                echo "Error al actualizar la factura: " . mysqli_error($conexion);
            }
    $guiasJson = json_decode($mos[2]);
    foreach ($guiasJson as $idg) {
        $sql1 = "UPDATE `pagoscuentas` SET `pag_userverifica`='',`pag_fechaverifica`='',pag_valorconfirmado='',pag_numerotrans=''  WHERE pag_guia='$idg'";
        // $fechat=date("$param5 H:i:s");
		// $sql1="UPDATE `facturascreditos` SET `fac_fechapago`='',`fac_tipopago`='',fac_userpago='',fac_descripcion='' WHERE idfacturascreditos='$param2'";
        
        
        
        
        if (mysqli_query($conexion, $sql1)) {
            
        } else {
            echo "Error al remover: " . mysqli_error($conexion);
        }
    }
}
                    $facturas = $mos[1];
                    $guias = $mos[2];

                    
                    

    

                // Cerrar la conexión a la base de datos
                mysqli_close($conexion);
} else {
    echo "Acceso no permitido.";
}
?>