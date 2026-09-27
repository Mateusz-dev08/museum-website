<?php
require('fpdf/fpdf.php');


$imie = $_POST['imie'];
$data_wizyty = $_POST['data'];
$typ_biletu = $_POST['typ'];
$ilosc = (int)$_POST['ilosc'];

$cena = ($typ_biletu === "normalny") ? 20 : 10;
$laczna_cena = $ilosc * $cena;


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Bilet do Muzeum', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Imię i nazwisko: ' . $imie, 0, 1);
$pdf->Cell(0, 10, 'Data wizyty: ' . $data_wizyty, 0, 1);
$pdf->Cell(0, 10, 'Typ biletu: ' . ucfirst($typ_biletu), 0, 1);
$pdf->Cell(0, 10, 'Ilość biletów: ' . $ilosc, 0, 1);
$pdf->Cell(0, 10, 'Łączna cena: ' . $laczna_cena . ' zł', 0, 1);

$pdf->Ln(10);
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Muzeum II Wojny Światowej, Gdańsk', 0, 1, 'C');

$pdf->Output();
?>