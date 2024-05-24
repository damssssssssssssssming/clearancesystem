<?php

require_once('fpdf/fpdf.php');
require_once('src/autoload.php');
require_once('src/fpdi.php');

$pdf = new \setasign\Fpdi\Fpdi();

$pageCount = $pdf->setSourceFile('indigency.pdf');
$pageId = $pdf->importPage(1, \setasign\Fpdi\PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage();
$pdf->useImportedPage($pageId);
$pdf->SetTextColor(0, 0, 0); // Black color

// Set text position and size
$pdf->SetXY(50, 50); // Adjust position as needed
$pdf->setFont('Arial');
$pdf->SetFontSize(20); // Adjust font size as needed

// Overlay the modified text
$pdf->Text(65, 66, 'Markniel Dangca'); 
$pdf->Text(65, 77, '17'); 
$pdf->Text(141, 77, 'Married'); 
$pdf->SetFontSize(13);
$pdf->Text(42, 87, '152 Ginintuang Landas Santa Monica Novaliches Quezon City');
$pdf->SetFontSize(20);
$pdf->Text(120, 97, '4');
$pdf->Text(90, 115, 'Para saken');
$pdf->Text(90, 125, 'Sarili');
$pdf->SetDrawColor(0, 0, 0); // Black color

// Set line width
$pdf->SetLineWidth(0.5);

// Draw check mark
 // Adjust position as needed
$pdf->Line(23, 145, 25, 150); // Draw line 1
$pdf->Line(25, 150, 29, 140); // Draw line 2

$pdf->Line(23, 157, 25, 162); // Draw line 1
$pdf->Line(25, 162, 29, 152);

$pdf->Line(23, 169, 25, 174); // Draw line 1
$pdf->Line(25, 174, 29, 164);

$pdf->Line(133, 145, 135, 150); // Draw line 1
$pdf->Line(135, 150, 139, 140);

$pdf->Line(133, 157, 135, 162); // Draw line 1
$pdf->Line(135, 162, 139, 152);

$pdf->Output('I', 'edeted.pdf');
?>
 