<?php
// require("login_autentica.php");
// $id_usuario=$_SESSION['usuario_id'];
// $id_nombre=$_SESSION['usuario_nombre'];
// $nivel_acceso=$_SESSION['usuario_rol'];
// $DB = new DB_mssql;
// $DB->conectar();
// $DB1 = new DB_mssql;
// $DB1->conectar();
// $DB2 = new DB_mssql;
// $DB2->conectar();
// $FB = new funciones_varias;


// function base64_encode_image($filename) {
//     if (file_exists($filename)) {
//         $imgData = base64_encode(file_get_contents($filename));
//         $src = 'data:' . mime_content_type($filename) . ';base64,' . $imgData;
//         return $src;
//     } else {
//         die("La imagen no existe en la ruta especificada.");
//     }
// }
// header('Content-type: application/vnd.ms-word');
// header("Content-Disposition: attachment; filename=Precios".".doc");
// header("Pragma: no-cache");
// header("Expires: 0");



// // require_once('fpdf/fpdf.php');
// // Asegúrate de tener la tabla en la solicitud POST
// if(isset($_POST['htmlTable'])) {

//     // Convierte la imagen a base64 (solución alternativa)

//     $imageDataUri = base64_encode_image('img/hoja_Nueva.png');
//     // Muestra el contenido HTML
//     echo '<html>';
//     echo '<head><style>';


// echo'</style></head>';
// echo '<body>';
// echo'<img src="'.$imageDataUri.'" />';
// echo$_POST['htmlTable'];
// echo '</body>';
// echo '</html>';


// } else {
//     die("No hay datos para generar el PDF.");
// }

// HTML con imagen de fondo
if(isset($_POST['nomcredito'])) {
$nomcredito="Precios credito ".$_POST['nomcredito']."";
}else {
    $nomcredito="";

}
$html = '
<html>
<head>
<style>
    @page {
        margin: 1in 0.5in 1in 0.5in; /* Margenes: top, right, bottom, left */
    }
    body {
        font-family: Arial, sans-serif;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid black;
        padding: 5px;
        text-align: left;
    }
</style>
</head>
<body>

<h1>'.$nomcredito.'</h1>

'.$_POST['htmlTable'].'
</body>
</html>
';

// Nombre del archivo a generar
$filename = 'Precios_de_envio.xls';

// Cabeceras para forzar la descarga
// header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
// header('Content-Disposition: attachment;filename="' . $filename . '"');
// header('Cache-Control: max-age=0');

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");  

// Imprimir el HTML
echo $html;

// Salir del script
exit;







































// // Definir la matriz de datos
//  $matriz = array(
//    array("Tipo de servicio", "holi"),
// //     array("Peso en kilos", $cot_peso),
// //     array("Ciudad Origen", $cot_origen),
// //     array("Ciudad Destino", $cot_destino),
// //     array("Valor Carga Minima", $cot_val_minima),
// //     array("Valor Kilo adicional", $cot_kilo_adi),
// //     array("Volumen", $cot_vol),
// //     array("Valor Asegurado", $cot_val_asegurado),
// //     array("Valor seguro", $cot_val_seguro),
// //     array("Valor kilos adicionales", $cot_val_kilos_adi),
// //     array("Valor servicio", $cot_val_servicio),
// //     array("Valor Total (servicio + seguro)", $cot_val_total)
// //     // Continúa con los datos de tu matriz...
// );
// // Establecer el tamaño de la celda y la separación entre las celdas
// $cellWidth = 80; // Ancho de cada celda
// $cellHeight = 5; // Alto de cada celda
// $margin = 25; // Margen izquierdo
// $margind = 25; // Margen izquierdo

// // Bucle para crear las 12 filas
// // Bucle para crear las filas
// foreach ($matriz as $fila) {
//     // Establecer la posición para la fila actual
//     $x = $margin;
//     $y = $pdf->GetY();

//     // Bucle para crear las celdas de la fila actual
//     foreach ($fila as $valor) {
//         // Agregar celda con el valor actual de la matriz
//         $pdf->SetXY($x, $y);
//         $pdf->Cell($cellWidth, $cellHeight, $valor, 1); // Agregar borde

//         // Mover a la siguiente columna
//         $x += $cellWidth;
//     }

//     // Mover a la siguiente fila
//     $pdf->Ln();
// }










// $pdf->Ln(5);

// $pdf->MultiCell(0, 5, utf8_decode('Es importante que, al momento de solicitar el servicio de transporte de carga, le indique al funcionario de Transmillas que su servicio será liquidado bajo el siguiente número de cotización: '), 0,'J');
// $pdf->Ln(5);

// $pdf->MultiCell(0, 5, utf8_decode('El transporte de carga se realizará vía terrestre con un tiempo de entrega de 24 horas. Con el objetivo de brindar una mejor calidad de servicio, el cliente puede hacer el rastreo ingresando el número de remesa asignado a través de la página: https://www.transmillas.com/#Rastreo'), 0,'J');
// $pdf->Ln(5);

// $pdf->MultiCell(0, 5, utf8_decode('Esta cotización es válida para las características anteriormente descritas. En caso de que el peso a transportar sea diferente, se realizará la corrección necesaria al precio final negociado.'), 0,'J');
// $pdf->Ln(5);



// // $pdf->Ln(6);
// // $pdf->MultiCell(0, 5, utf8_decode('Atentamente,   							                        '), 0,'J');
// // $pdf->Ln(5);
// // $pdf->MultiCell(0, 5, utf8_decode(''.$usuhecho.'   							                        '), 0,'J');
// // $pdf->MultiCell(0, 5, utf8_decode('Asesor Comercial				                                            '), 0,'J');
// // $pdf->MultiCell(0, 5, utf8_decode('Transmillas Logística y Transportadora S.A.S 						    '), 0,'J');
// // $pdf->MultiCell(0, 5, utf8_decode('Nit: 901089478-8						                                    '), 0,'J');
// // $pdf->MultiCell(0, 5, utf8_decode('Telefono: 3103122 ext (110) / 3166910614                              '), 0,'J');
// // $pdf->MultiCell(0, 5, utf8_decode('https://www.transmillas.com/                             '), 0,'J');






// $pdf->Ln(10);


// $pdf->Output();
// // $filename = 'Precios/'.$nombredoc.'.pdf'; // Ruta donde deseas guardar el PDF en el servidor
// $pdf->Output($filename, 'F');






?>