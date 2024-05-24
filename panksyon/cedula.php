<?php

require_once('../library/fpdf/fpdf.php');
require_once('../library/src/autoload.php');
require_once('../library/src/fpdi.php');

$pdf = new setasign\Fpdi\Fpdi();

$pageCount = $pdf->setSourceFile('../pdfs/CEDULA-FORM.pdf');
$pageId = $pdf->importPage(1, setasign\Fpdi\PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage();
$pdf->useImportedPage($pageId);
$pdf->SetTextColor(0, 0, 0); // Black color

// Set text position and size
$pdf->SetXY(50, 50); // Adjust position as needed
$pdf->setFont('Arial');
$pdf->SetFontSize(20); // Adjust font size as needed

// Overlay the modified text
$pdf->Text(65, 66, 'Kunyare'); 

?>