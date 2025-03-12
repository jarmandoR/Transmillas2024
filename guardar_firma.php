<?php
require("connection/conectarse.php");
require("connection/funciones.php");
require("connection/arrays.php");
require("connection/funciones_clases.php");
require("connection/sql_transact.php");
include('definirvar.php');


if (isset($_POST['idfirma'])) {
    // Verificar si se reciben los datos esperados
    if(isset($_POST['image'], $_POST['idfirma'], $_POST['idguia'])) {

        $firma = $_POST['image'];
        $idfirma = $_POST['idfirma'];
        $idguia = $_POST['idguia'];

        // Conectar a la base de datos
        $DB = new DB_mssql;
        $DB->conectar();

        // Definir la fecha actual
        $fechatiempo = date('Y-m-d H:i:s');

        // Actualizar la tabla con la firma
        $sql = "UPDATE firma_clientes SET fecha_registro='$fechatiempo', firma='$firma', estado='pendiente',tipo='firma' WHERE id='$idfirma'";

        // Ejecutar la consulta SQL y manejar los errores
        if ($DB->Execute($sql)) {

            
            echo "Gracias";

        } else {
            echo "Error al guardar la firma";
        }
    } else {
        echo "Faltan datos necesarios paraactualizar";
    }
}else {


    if(isset($_POST['image'], $_POST['idguia'],$_POST['nombre'],$_POST['telefono'])) {

        // Ruta y nombre de archivo destino
        $telefono= $_POST['telefono'];
        $nombre= $_POST['nombre'];
        $idfirma = $_POST['idfirma'];
        $idguia = $_POST['idguia'];
        $tipo = $_POST['tipo'];
        $firma = $_POST['image'];
        
        

        // Conectar a la base de datos
        $DB = new DB_mssql;
        $DB->conectar();

        // Definir la fecha actual
        $fechatiempo = date('Y-m-d H:i:s');

        // Guardar tabla con la firma
        // $sql = "UPDATE firma_clientes SET fecha_registro='$fechatiempo', firma='$firma', estado='pendiente',tipo='firma' WHERE id='$idfirma'";
            // Actualizar la tabla con la firma
            $sql = "INSERT INTO firma_clientes (id_guia,firma, tipo_firma, nombre, numero_documento,correo_electronico, telefono,enviar_whatsapp,foto,fecha_registro,estado,tipo) 
                                           VALUES ('$idguia','$firma', '$tipo', '$nombre', '', '', '$telefono', '','','$fechatiempo','pendiente','firma')";
        // Ejecutar la consulta SQL y manejar los errores
        if ($DB->Execute($sql)) {

            
            echo "Gracias";

        } else {
            echo "Error al guardar la firma";
        }
    } else {
       
        echo "Faltan datos necesarios para guardar";
    }





}
?>
