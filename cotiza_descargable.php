<?php
// include class



// $nombrecon=$_GET["nombrecon"];
// $cedulacon=$_GET["cedulacon"];
// $placasvehi=$_GET["placasvehi"];
// $valorcont=$_GET["valorcont"];
// $fechaini=$_GET["fechaini"];
// $fechafin=$_GET["fechafin"];
// $piezascont=$_GET["piezascont"];
// $telefonocon=$_GET["telefonocon"];
// $firmacon=$_GET["firmacon"];
// $expedida=$_GET["expedida"];
// $ciudaddes=$_GET["ciudaddes"];
// $ciudadori=$_GET["ciudadori"];
// $num_mani=$_GET["num_mani"];
// $num_remesa=$_GET["num_remesa"];

$cot_id=$_GET["id"];
$cot_clirente=$_GET["clirente"];	
$cot_nit=$_GET["nit"];	
$cot_origen=$_GET["origen"];	
$cot_destino=$_GET["destino"];	
$cot_direc_origen=$_GET["direc_origen"];	
$cot_direc_destino=$_GET["direc_destino"];	
$cot_desc_merc=$_GET["desc_merc"];	
$cot_tipo_servi=$_GET["tipo_servi"];	
$cot_peso=$_GET["peso"];	
$cot_val_minima=$_GET["val_minima"];	
$cot_kilo_adi=$_GET["kilo_adi"];	
$cot_vol=$_GET["vol"];	
$cot_val_asegurado=$_GET["val_asegurado"];	
$cot_val_seguro=$_GET["val_seguro"];	
$cot_val_kilos_adi=$_GET["val_kilos_adi"];	
$cot_val_servicio=$_GET["val_servicio"];	
$cot_val_total=$_GET["val_total"];	
$cot_fecha=$_GET["fecha"];
$ciudadhecho=$_GET["ciudadhecho"];
$usuhecho=$_GET["usuhecho"];



$nombredoc="Cotizacion".$cot_id;

// Convertir la fecha en un timestamp
$timestamp1 = strtotime($fechaini);

// Obtener el día de la fecha
$dia1 = date('d', $timestamp1);
$mes1 = date('m', $timestamp1);
$ano1 = date('Y', $timestamp1);
// Convertir la fecha en un timestamp
$timestamp2 = strtotime($fechafin);

// Obtener el día de la fecha
$dia2 = date('d', $timestamp2);
$mes2 = date('m', $timestamp2);
$ano2 = date('Y', $timestamp2);



require('fpdf/fpdf.php');



class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    // $this->Image('assets/cabecerapagina.jpg',10,8,0);
    // Times bold 15
    $this->SetFont('Times','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    // $this->Cell(30,10,'Title',1,0,'C');
    // Salto de línea
    $this->Ln(20);

   
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Times italic 8
    $this->SetFont('Times','I',8);

}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
// Establecer posición absoluta para la imagen
$pdf->Image('img/hoja_Nueva.png', 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());

// Establecer posición relativa para el texto
$pdf->SetXY(10, 10); // Ajusta la posición según tus necesidades
// for($i=1;$i<=40;$i++)
//     $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
$pdf->SetLeftMargin(25);
$pdf->SetRightMargin(25);
$pdf->Ln(15);
$pdf->SetFont('Times', 'B', 12);




$pdf->MultiCell(0, 5, utf8_decode($ciudadhecho), 0,'L');
$pdf->Ln(2);
$pdf->MultiCell(0, 5, utf8_decode('COTIZACION '.$cot_id.''), 0,'R');
$pdf->Ln(2);
$pdf->MultiCell(0, 5, utf8_decode('Señores:'), 0,'L');
$pdf->Ln(2);
$pdf->MultiCell(0, 5, utf8_decode($cot_clirente), 0,'L');
$pdf->Ln(2);
$pdf->MultiCell(0, 5, utf8_decode('NIT. '.$cot_nit.''), 0,'L');
$pdf->Ln(2);

$ciudad_en_negrita = utf8_decode($cot_origen);
$pdf->SetFont('Times','',12);
$texto = utf8_decode('Por medio de la siguiente, damos respuesta a la cotización del servicio de transporte de carga desde la ciudad de '.$cot_origen.' hacia la ciudad de '.$cot_destino.', con las siguientes características:');

$pdf->MultiCell(0, 5, $texto, 0,'J');
$pdf->Ln(2);


$pdf->MultiCell(0, 5, utf8_decode('Dirección ciudad de origen: '.$cot_direc_origen.''), 0,'J');
$pdf->Ln(1);

$pdf->MultiCell(0, 5, utf8_decode('Dirección ciudad de destino: '.$cot_direc_destino.' '), 0,'J');
$pdf->Ln(1);

$pdf->MultiCell(0, 5, utf8_decode('Descripción de la mercancía a transportar: '.$cot_desc_merc.''), 0,'J');
$pdf->Ln(1);


// Definir la matriz de datos
$matriz = array(
    array("Tipo de servicio", $cot_tipo_servi),
    array("Peso en kilos", $cot_peso),
    array("Ciudad Origen", $cot_origen),
    array("Ciudad Destino", $cot_destino),
    array("Valor Carga Minima", $cot_val_minima),
    array("Valor Kilo adicional", $cot_kilo_adi),
    array("Volumen", $cot_vol),
    array("Valor Asegurado", $cot_val_asegurado),
    array("Valor seguro", $cot_val_seguro),
    array("Valor kilos adicionales", $cot_val_kilos_adi),
    array("Valor servicio", $cot_val_servicio),
    array("Valor Total (servicio + seguro)", $cot_val_total)
    // Continúa con los datos de tu matriz...
);
// Establecer el tamaño de la celda y la separación entre las celdas
$cellWidth = 80; // Ancho de cada celda
$cellHeight = 5; // Alto de cada celda
$margin = 25; // Margen izquierdo
$margind = 25; // Margen izquierdo

// Bucle para crear las 12 filas
// Bucle para crear las filas
foreach ($matriz as $fila) {
    // Establecer la posición para la fila actual
    $x = $margin;
    $y = $pdf->GetY();
    
    // Bucle para crear las celdas de la fila actual
    foreach ($fila as $valor) {
        // Agregar celda con el valor actual de la matriz
        $pdf->SetXY($x, $y);
        $pdf->Cell($cellWidth, $cellHeight, $valor, 1); // Agregar borde
        
        // Mover a la siguiente columna
        $x += $cellWidth;
    }
    
    // Mover a la siguiente fila
    $pdf->Ln();
}










$pdf->Ln(5);

$pdf->MultiCell(0, 5, utf8_decode('Es importante que, al momento de solicitar el servicio de transporte de carga, le indique al funcionario de Transmillas que su servicio será liquidado bajo el siguiente número de cotización: '.$cot_id.' '), 0,'J');
$pdf->Ln(5);

$pdf->MultiCell(0, 5, utf8_decode('El transporte de carga se realizará vía terrestre con un tiempo de entrega de 24 horas. Con el objetivo de brindar una mejor calidad de servicio, el cliente puede hacer el rastreo ingresando el número de remesa asignado a través de la página: https://www.transmillas.com/#Rastreo'), 0,'J');
$pdf->Ln(5);

$pdf->MultiCell(0, 5, utf8_decode('Esta cotización es válida para las características anteriormente descritas. En caso de que el peso a transportar sea diferente, se realizará la corrección necesaria al precio final negociado.'), 0,'J');
$pdf->Ln(5);



$pdf->Ln(6);
$pdf->MultiCell(0, 5, utf8_decode('Atentamente,   							                        '), 0,'J');
$pdf->Ln(5);
$pdf->MultiCell(0, 5, utf8_decode(''.$usuhecho.'   							                        '), 0,'J');
$pdf->MultiCell(0, 5, utf8_decode('Asesor Comercial				                                            '), 0,'J');
$pdf->MultiCell(0, 5, utf8_decode('Transmillas Logística y Transportadora S.A.S 						    '), 0,'J');
$pdf->MultiCell(0, 5, utf8_decode('Nit: 901089478-8						                                    '), 0,'J');
$pdf->MultiCell(0, 5, utf8_decode('Telefono: 3103122 ext (110) / 3166910614                              '), 0,'J');
$pdf->MultiCell(0, 5, utf8_decode('https://www.transmillas.com/                             '), 0,'J');






$pdf->Ln(10);


$pdf->Output();
$filename = 'cotizaciones/'.$nombredoc.'.pdf'; // Ruta donde deseas guardar el PDF en el servidor
$pdf->Output($filename, 'F');
?>