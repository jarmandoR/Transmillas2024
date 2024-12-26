<?php


$dbname="u713516042_transmillas"; 
$dbhost="localhost";
$dbuser="u713516042_jose";
$dbpass="0?jBMSc4GUcN";
$Usu_ses="vive";
$salt = "transmi2344fsdfd"; 




/* $link = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
mysqli_select_db($link, $dbname) or die("Could not open the db '$dbname'");
 */
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener fecha actual menos un año
$fechaActual = date('Y-m-d');
$fechaHaceUnAnio = date('Y-m-d', strtotime('-1 year', strtotime($fechaActual)));


/* echo $sql1 = "insert into documentos2 SELECT * FROM documentos  WHERE doc_tabla='cajamenor' And doc_fecha <= '2022-12-01'  order by doc_fecha desc limit 1000";
     $result1 = $conn->query($sql1); */

// Consulta para seleccionar los documentos a eliminar
echo $sql = "SELECT doc_ruta,iddocumentos FROM documentos3 order by doc_fecha asc limit 1000";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rutaDocumento = $row['doc_ruta'];
        
        // Eliminar archivo del servidor
        if (file_exists($rutaDocumento)) {
            unlink($rutaDocumento);
            echo "Archivo eliminado: " . $rutaDocumento . "<br>";
        } else {
            echo "Archivo no encontrado: " . $rutaDocumento . "<br>";
        }

        

    }  

/*     echo $sql3 = "CREATE TEMPORARY TABLE documentos3 SELECT * FROM documentos  WHERE doc_tabla='cajamenor' and doc_fecha <= '$fechaHaceUnAnio' order by doc_fecha desc limit 1000";
     $result3 = $conn->query($sql3);


    $sql2 = "delete  from `documentos` WHERE iddocumentos in (select iddocumentos from documentos3)";
    $result2 = $conn->query($sql2);  */
    
} else {
    echo "No se encontraron documentos a eliminar.";
}

$conn->close();



?>