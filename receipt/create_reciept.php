<?php

require ('fpdf.php');

class PDF_reciept extends FPDF {
    function _construct ($orientation = 'P', $unit = 'pt', $format = 'Letter', $margin = 40) {
        $this->FPDF($orientation, $unit, $format);
        $this->SetTopMargin($margin);
        $this->SetLeftMargin($margin);
        $this->SetRightMargin($margin);
        $this->SetAutoPageBreak(true, $margin);
    }

    function Header() {
        $this->SetFont('Arial', 'B', 20);
        $this->SetFillColor(240, 67, 29);
        $this->SetTextColor(225);
        $this->Cell(0, 30, "FANABLO online store", 0, 1, 'C', true);
    }

    function Footer() {
        $this->SetFont('Arial', '', 12);
        $this->SetTextColor(0);
        $this->SetXY(10,-60);
        $this->Cell(0, 20, "FANABLO online store vous remercie pour votre achat", 'T', 0, 'C');
    }

    function PriceTable($products, $prices) {
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(0);
        $this->SetFillColor(240, 67, 29);
        $this->SetLineWidth(0.2);
        $this->Cell(70, 15, "Produit x Quantite", 'LTR', 0, 'C', true);
        $this->Cell(50, 15, "Prix", 'LTR', 1, 'C', true);

        $this->SetFont('Arial', '');
        $this->SetFillColor(238);
        $this->SetLineWidth(0.2);
        $fill = false;

        for ($i = 0; $i < count($products); $i++) {
            $this->Cell(70, 10, $products[$i], 1, 0, 'L', $fill);
            $this->Cell(50, 10, $prices[$i] . ' MAD' , 1, 1, 'R', $fill);
            $fill = !$fill;
        }
        $this->SetX(50);
        $this->Cell(30, 10, "Total", 1);
        $this->Cell(50, 10, array_sum($prices).' MAD ', 1, 1, 'R');
    }
}

$pdf = new PDF_reciept();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY(50);
$pdf->Cell(40, 13, "Client : ");
$pdf->SetFont('Arial', '');
$pdf->Cell(30, 13, $_POST['name']." ".$_POST['firstName']);

$pdf->SetX(100);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(25, 13, 'Date : ');
$pdf->SetFont('Arial', '');
$pdf->Cell(10, 13, date('j F Y'), 0, 1);


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 13, 'Adresse : ');
$pdf->SetFont('Arial', 'I');
$pdf->Cell(30, 13, $_POST['address'].', '.$_POST['city'] . ', ' .$_POST['postal_code'] . ' ' . $_POST['country'], 0, 2);
$pdf->Ln(20);

$pdf->PriceTable($_POST['product'], $_POST['price']);

$pdf->SetFont('Arial', '');
$pdf->SetTextColor(0);
$pdf->Ln(30);
$pdf->Write(13, "En cas de probleme veuillez contacter : ");

$pdf->SetFont('Arial', 'U', 12);
$pdf->SetTextColor(1, 162, 232);
$pdf->Write(13, "support@fanablo.com", "mailto:example@example.com");


$pdf->Output('reciept.pdf', 'F');?>