<?php
// include class



$nombrecon=$_GET["nombrecon"];
$cedulacon=$_GET["cedulacon"];
$placasvehi=$_GET["placasvehi"];
$valorcont=$_GET["valorcont"];
$fechaini=$_GET["fechaini"];
$fechafin=$_GET["fechafin"];
$piezascont=$_GET["piezascont"];
$telefonocon=$_GET["telefonocon"];
$firmacon=$_GET["firmacon"];
$expedida=$_GET["expedida"];
$ciudaddes=$_GET["ciudaddes"];
$ciudadori=$_GET["ciudadori"];
$num_mani=$_GET["num_mani"];
$num_remesa=$_GET["num_remesa"];

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
// for($i=1;$i<=40;$i++)
//     $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);


$pdf->SetFont('Times', '', 12);
$pdf->SetLeftMargin(25);
$pdf->SetRightMargin(25);
$pdf->MultiCell(0, 5, utf8_decode('CONTRATO DE PRESTACION DE SERVICIOS DE TRANSPORTE CARGA TERRRESTRE AUTOMOTOR DE MERCANCIA POR CARRETERA EN EL TERRITORIO NACIONAL'), 0,'C');
$pdf->Ln(10);



$locale = 'es_CO'; // Define el locale para el idioma y formato de moneda colombiano
$fmt = new NumberFormatter($locale, NumberFormatter::SPELLOUT); // Crea una instancia de NumberFormatter

$valorEnLetras = $fmt->formatCurrency($valorcont, 'COP');


//Elimina la palabra "coma" y lo que le sigue
$valorEnLetras = preg_replace('/\bcoma\b.*$/i', '', $valorEnLetras);

$valorEnLetras_en_mayusculas = strtoupper($valorEnLetras);
// $pdf->MultiCell(0, 5, utf8_decode(''.$valorEnLetras_en_mayusculas.' PESOS'), 0,'C');

$valorcont_formateado = number_format($valorcont, 0, ',', '.');
$pdf->MultiCell(0, 5, utf8_decode('LILIANA WALTEROS AGUDELO, identificada con C.C. No. 35.510.501 expedida en Bogotá D.C, actuando en su calidad de Gerente General de TRANSMILLAS LOGISTICA Y TRANSPORTADORA S.A.S, identificada con NIT No. 901.089.478-8, quien para efectos del presente contrato se denominará, Contratante, y por la otra, '.$nombrecon.', actuando en nombre propio, identificado con C.C. No. '.$cedulacon.'   expedida en '.$expedida.', quien en adelante se llamará EL CONTRATISTA, hemos acordado celebrar el presente contrato de servicio de transporte, previa las siguientes consideraciones: PRIMERA.CONTRATAR EL SERVICIO DE TRANSPORTE TERRESTRE AUTOMOTOR DEL VEHICULO PLACAS '.$placasvehi.'  , de acuerdo a lo establecido en el ART.981 del código de comercio. Los Documentos del VEHICULO forman parte del presente Contrato y definen igualmente las actividades, alcance y obligaciones del Contrato y del vehículo.  SEGUNDA.VALOR Y FORMA DE PAGO. El valor del presente contrato corresponde a la suma de '.$valorEnLetras_en_mayusculas.' PESOS MCTE   ($'.$valorcont.'). TRANSMILLAS, cancelará el valor del contrato que se suscribirá mediante un pago único inmediato en la ciudad de destino, previa certificación de recibido a satisfacción suscrita por el supervisor del contrato, quien verificara el cumplimiento de las obligaciones contractuales y el pago al día de los parafiscales. TERCERA.PLAZO. El plazo de ejecución se Fija desde '.$dia1.' y '.$dia2.' de '.$mes1.' del   año '.$ano1.'. CUARTA. OBLIGACIONES DEL CONTRATISTA:  1. Ejecutar el objeto contractual a satisfacción de TRANSMILLAS LOGISTICA Y TRANSPORTADORA S.A.S., de forma idónea y oportuna. 2. Garantizar la calidad de los servicios contratados, 3. cumplir con las Especificaciones técnicas y mecánicas del vehículo que se encuentren en perfectas condiciones para la ejecución de este contrato y responder por ello.  4. Mantener vigente durante la ejecución del contrato los seguros y garantías del vehículo exigidos por el contrato tales como: SOAT, y todos aquellos seguros exigidos por las normas legales vigentes que amparen riesgos inherentes a la actividad para la cual se dará uso al vehículo. 5. Encontrarse a paz y salvo con sus aportes de seguridad social y demás aportes parafiscales si a ello hubiere lugar. debe acreditar el pago de los aportes de sus empleados a los sistemas de salud, pensiones, riesgos profesionales, Dada la naturaleza del contrato, será de cargo exclusivo del CONTRATISTA todo lo relacionado con el pago de salarios, prestaciones sociales y seguros, así como las indemnizaciones que puedan corresponder a los trabajadores que emplee para el cumplimiento del presente contrato, siendo responsable por los daños que estos causen. 6. El conductor deberá contar con teléfono móvil en donde pueda ser permanentemente contactado por TRANSMILLAS. 7.Responder ante las autoridades de los actos u omisiones en el ejercicio de las actividades que desarrolle en virtud del contrato, cuando ello cause perjuicio a la administración o a terceros. 8. El conductor deberá amparar que la mercancía entregada por el CONTRATANTE, este debidamente acoplada dentro del vehículo de carga contratado. 9. El conductor deberá informar cualquier acto que afecte la mercancía transportada a la ciudad de destino, (DECOMISO, PERDIDA, HURTO O DAÑO DE LA MERCANCIA) y requerir los documentos necesarios de la afectación. 10.El conductor deberá informar al CONTRATANTE, y poner en conocimiento al titular o propietario del vehículo automotor, el uso para la prestación del servicio al que se contrata.   QUINTA. OBLIGACIONES DEL CONTRATANTE  1. Efectuar el pago referente al contrato, conforme a lo estipulado en la cláusula segunda 2. El Contratante entregara al contratista los documentos legales que acompañan el presente contrato, MANIFIESTO DE CARGA DE TRANSPORTE y REMESA UNICA DE TRANSPORTE DE CARGA, documentos que están relacionados con las remesas de transporte de TRANSMILLAS, así como con la cantidad de piezas '.$piezascont.' de remesas que identifican la mercancía para transportar a su ciudad de destino. 3.Entregar al contratista la mercancía a transportar con su respectivo embalaje y en perfecto estado. 4. En general prestar toda la colaboración que requiera el CONTRATISTA, para la debida ejecución del contrato. 5. El Contratista mantendrá exento al Contratante por cualquier obligación de carácter laboral o relacionado que se originen en el incumplimiento de las obligaciones laborales que el Contratista asume frente al personal, subordinados o terceros que se vinculen a la ejecución de las obligaciones derivadas del presente Contrato. SEXTA. RECOGIDA Y ENTREGA. Para efectos de ejecución del presente contrato, el domicilio contractual de RECOGIDA de la mercancía será la ciudad de '.$ciudadori.'  , y entregada en la(s) ciudad(es) de '.$ciudaddes.'  .SEPTIMA. PRIVACIDAD. este contrato es únicamente acordado para las mercancías entregadas y que serán estipuladas  en el MANIFIESTO DE CARGA N.'.$num_mani.'    y REMESA N. '.$num_remesa.', entregado por TRANSMILLAS LOGISTICAS Y TRANSPORTADORA S.A.S, al contratista, y que la Sociedad no se hace responsable por la perdida/hurto/daño de otras mercancías transportadas en el vehículo del presente contrato.'), 0,'J');

// $pdf->MultiCell(0, 5, utf8_decode('LILIANA WALTROS AGUDELO, identificada con C.C. No. 35.510.501 expedida en Bogotá D.C, actuando en su calidad de Gerente General de TRANSMILLAS LOGISTICA Y TRANSPORTADORA S.A.S, identificada con NIT No. 901.089.478-8, quien para efectos del presente contrato se denominara , Contratante '.$nombrecon.' , actuando en nombre propio, identificado con C.C. No. '.$cedulacon.'   expedida en  '.$expedida.'   , quien en adelante se llamará EL CONTRATISTA, hemos acordado celebrar el presente contrato de servicio de transporte, previa las siguientes consideraciones: PRIMERA.CONTRATAR EL SERVICIO DE TRANSPORTE TERRESTRE AUTOMOTOR DEL VEHICULO PLACAS '.$placasvehi.' ,de acuerdo a lo establecido en el ART.981 del código de comercio. Los Documentos del VEHICULO forman parte del presente Contrato y definen igualmente las actividades, alcance y obligaciones del Contrato y del vehículo.  SEGUNDA.VALOR Y FORMA DE PAGO. El valor del presente contrato corresponde a la suma de '.$valorEnLetras_en_mayusculas.' PESOS MCTE ($'.$valorcont.').   TRANSMILLAS, cancelará el valor del contrato que se suscribirá mediante un-Pago único inmediato en la ciudad de destino, previa certificación de recibido a satisfacción suscrita por el supervisor del contrato, quien verificara el cumplimiento de las obligaciones contractuales y el pago al día de los parafiscales. TERCERA.PLAZO. El plazo de ejecución se Fija desde del ('.$dia1.') al ('.$dia2.') del '.$mes1.' del año '.$ano1.'.  CUARTA. OBLIGACIONES DEL CONTRATISTA:  1. Ejecutar el objeto contractual a satisfacción de TRANSMILLAS LOGISTICA Y TRANSPORTADORA S.A.S., de forma idónea y oportuna. 2. Garantizar la calidad de los servicios contratados, 3. cumplir con las Especificaciones Técnicas y mecánicas del vehículo que se encuentren en perfectas condiciones para la ejecución de este contrato y responder por ello.  4. Mantener vigente durante la ejecución del contrato los seguros y garantías del vehículo exigidos por el contrato tales como: SOAT, y todos aquellos seguros exigidos por las normas legales vigentes que amparen riesgos inherentes a la actividad para la cual se dará uso al vehículo. 5. Encontrarse a paz y salvo con sus aportes de seguridad social y demás aportes parafiscales si a ello hubiere lugar. debe acreditar el pago de los aportes de sus empleados a los sistemas de salud, pensiones, riesgos profesionales, Dada la naturaleza del contrato, será de cargo exclusivo del CONTRATISTA todo lo relacionado con el pago de salarios, prestaciones sociales y seguros, así como las indemnizaciones que puedan corresponder a los trabajadores que emplee para el cumplimiento del presente contrato, siendo responsable por los daños que estos causen. 6. El conductor deberá contar con teléfono móvil en donde pueda ser permanentemente contactado por TRANSMILLAS. 7.Responder ante las autoridades de los actos u omisiones en el ejercicio de las actividades que desarrolle en virtud del contrato, cuando ello cause perjuicio a la administración o a terceros. 8. El conductor deberá amparar que la mercancía entregada por el CONTRATANTE, este debidamente acoplada dentro del vehículo de carga contratado. 9. El conductor deberá informar cualquier acto que afecte la mercancía transportada a la ciudad de destino , (DECOMISO,PERDIDA,HURTO)y requerir los documentos necesarios de la afectación QUINTA. OBLIGACIONES DEL CONTRATANTE  1. Efectuar el pago referente al contrato, conforme a lo estipulado en la cláusula segunda 2. El Contratante entregara al contratista los documentos legales que acompañan el presente contrato (MANIFIESTO DE CARGA DE TRANSPORTE, REMESA UNICA DE TRANSPORTE DE CARGA, así como de informar al reverso del presento contrato la cantidad de  '.$piezascont.'.   de remesas que identifican la mercancía para transportar a su ciudad de destino. 3.Entregar al contratista la mercancía a transportar con su respectivo embalaje y en perfecto estado. 4. En general prestar toda la colaboración que requiera el CONTRATISTA, para la debida ejecución del contrato. el Contratista mantendrá exento al Contratante por cualquier obligación de carácter laboral o relacionado que se originen en el incumplimiento de las obligaciones laborales que el Contratista asume frente al personal, subordinados o terceros que se vinculen a la ejecución de las obligaciones derivadas del presente Contrato. SEXTA. RECOGIDA Y ENTREGA. Para efectos de ejecución del presente contrato, el domicilio contractual de RECOGIDA de la mercancía será la ciudad de '.$ciudadori.', y entregada en las ciudades de '.$ciudaddes.'. SEPTIMA. PRIVACIDAD. este contrato es unicamente acordado para las mercancías entregadas por TRANSMILLAS LOGISTICAS Y TRANSPORTADORA S.A.S, al contratista, y que la Sociedad no se hace responsable por la Perdida/hurto/daño de otras mercancias transportadas en el vehiculo del presente contrato.'), 0,'J');
$pdf->Ln(10);
$pdf->MultiCell(0, 5, utf8_decode('NOTA: ADJUNTO A ESTE DOCUMENTO, RELACION DE REMESAS DE CARGA, ESTABLECIDAS EN LA CLAUSULA SEPTIMA DE ESTE CONTRATO.'), 0,'C');
 $pdf->Ln(10);
$pdf->MultiCell(0, 5, utf8_decode('Dado en Bogotá D.C,('.$dia1.') día del mes '.$mes1.' de '.$ano1.''), 0,'J');

$ruta_firma="img_manifiestos/conductores/$firmacon";
$ruta_sello="img_manifiestos/empresa/sello.png";

if (file_exists($ruta_firma) or $firmacon!="") {
    // Mostrar la firma si existe
    // $pdf->Image(''.$ruta_firma.'', $pdf->GetX(), $pdf->GetY() - 30, 40, 14);
    // Ubicación de la primera imagen (izquierda)
$pdf->Image($ruta_sello, $pdf->GetX(), $pdf->GetY() +25, 40, 14);

// Calcular la ubicación de la segunda imagen (derecha)
$coord_x_segunda_imagen = $pdf->GetX() +100; // Ajusta el valor de 50 según sea necesario para la separación entre las imágenes
$coord_y_segunda_imagen = $pdf->GetY() +25;
$pdf->Image($ruta_firma, $coord_x_segunda_imagen, $coord_y_segunda_imagen, 60, 34);
} else {
    // Mostrar un mensaje si la imagen no existe
    $pdf->Cell(0, 5, 'si no se ve la firma revisar foto y volver a cargar ', 0, 1);
}
$pdf->Ln(50);
$pdf->MultiCell(0, 5, utf8_decode('CONTRATANTE  							                                                       CONTRATISTA  '), 0,'J');
$pdf->MultiCell(0, 5, utf8_decode('Liliana Walteros Agudelo				                                            '.$nombrecon.' '), 0,'J');
$pdf->MultiCell(0, 5, utf8_decode('C.C. 35.510.501							                                                            C.C '.$cedulacon.'    '), 0,'J');
$pdf->MultiCell(0, 5, utf8_decode('Representante Legal						                                                       Tel. '.$telefonocon.' '), 0,'J');
$pdf->Ln(10);
$pdf->MultiCell(0, 5, utf8_decode('TRANSMILLAS LOGISTICA Y TRANSPORTADORA S.A.S                              '), 0,'J');






$pdf->Ln(10);


$pdf->Output();
?>