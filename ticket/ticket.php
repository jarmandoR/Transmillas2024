<?php
require('pdf_js.php');
	
	class PDF_AutoPrint extends PDF_JavaScript
	{
		function AutoPrint($dialog=false)
		{
			//Open the print dialog or start printing immediately on the standard printer
			$param=($dialog ? 'true' : 'false');
			$script="print($param);";
			$this->IncludeJS($script);
		}
	
		function AutoPrintToPrinter($server, $printer, $dialog=false)
		{
			//Print on a shared printer (requires at least Acrobat 6)
			$script = "var pp = getPrintParams();";
			if($dialog)
				$script .= "pp.interactive = pp.constants.interactionLevel.full;";
			else
				$script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
			$script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
			$script .= "print(pp);";
			$this->IncludeJS($script);
		}
	}
$pdf=new PDF_AutoPrint($orientation='P',$unit='mm', array(45,350));
//$pdf->FPDF('P','mm','A4');
//$pdf=new FPDF('P','cm','custom',362.835,263.622);  //ingreso medida puntos
//$pdf->Open();
$pdf->AliasNbPages();
$pdf->SetLeftMargin(1.8);
$pdf->PageNo();
$pdf->SetTopMargin(1.7);
$pdf->SetAutoPageBreak(0.5);
$pdf->AddPage();
$pdf->SetFont('arial','',8);
		
		
		
		
$pdf->Cell(1.2,0.4,'',0,0,'L');//señor(es)
$pdf->Cell(5.8,0.4,'joseeeee',0,0,'L');
$pdf->Cell(2,0.4,'',0,0,'L');//documento
$pdf->Cell(2.8,0.4,'',0,0,'L');
$pdf->Ln(0.4);
$pdf->Cell(1.2,0.4,'',0,0,'L');//señor(es)
$pdf->Cell(5.8,0.4,'',0,0,'L');
$pdf->Cell(2,0.4,'',0,0,'L');//documento
$pdf->Cell(2.8,0.4,'',0,0,'L');
$pdf->Ln(0.4);
$pdf->Cell(1.2,0.4,'',0,0,'L');//direccion
$pdf->Cell(5.8,0.4,'dirrrrr',0,0,'L');
$pdf->Cell(2,0.4,'',0,0,'L');//fecha
$pdf->Cell(2.8,0.4,'12/09/2019',0,0,'R');
$pdf->Ln(0.4);
$pdf->Cell(1.2,0.36,'',0,0,'L');//cantidad
$pdf->Cell(7.2,0.36,'',0,0,'L');//descripcion
$pdf->Cell(1.5,0.36,'',0,0,'L');//precio unitario
$pdf->Cell(1.9,0.36,'',0,0,'L');//importe
$pdf->Ln(0.36);
		$j='0';
		  
		
		
				$pdf->Cell(1.2,0.47,2,0,0,'C');//cantidad
				$pdf->Cell(7.5,0.47,'camisas',0,0,'L');//descripcion
				$pdf->Cell(1.5,0.47,'2000',0,0,'R');//precio unitario
				$pdf->Cell(1.9,0.47,'1',0,0,'C');//importe
				$pdf->Ln(0.47);
			
		
		
			$numero_letras='dos mmil';
			
			//celdas vacias
			$pdf->Cell(11.8,0.2,$numero_letras,0,0,'C');
			$pdf->Ln(0.2);
			$pdf->Cell(9.9,0.65,'',0,0,'L');				
						
			$pdf->Ln(0.6);

//$pdf->AutoPrint(true);
$pdf->Output();

?>
