<?php
session_start();

if (!isset($_SESSION['email'])) {
    echo "Musisz być zalogowany!";
  
}

require('fpdf/fpdf.php');

$connect = mysqli_connect('localhost', 'root', '', 'muzeum');


$email = $_SESSION['email'];


$q = "SELECT * FROM bilety WHERE imie = (SELECT imie_nazwisko FROM uzytkownicy WHERE email = '$email') ORDER BY id DESC LIMIT 1";
$res = mysqli_query($connect, $q);

if (mysqli_num_rows($res) == 0) {
    echo "Błąd przy pobieraniu danych biletu.";
   
}

$bilet = mysqli_fetch_array($res);


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Bilet muzealny', 0, 1, 'C');
$pdf->Ln(10);//przerwa

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'ID biletu: ' . $bilet['id'], 0, 1);
$pdf->Cell(0, 10, 'Imie i nazwisko: ' . $bilet['imie'], 0, 1);
$pdf->Cell(0, 10, 'Data wizyty: ' . $bilet['data_wizyty'], 0, 1);
$pdf->Cell(0, 10, 'Typ biletu: ' . $bilet['typ'], 0, 1);
$pdf->Cell(0, 10, 'Ilosc: ' . $bilet['ilosc'], 0, 1);
$pdf->Cell(0, 10, 'Cena: ' . $bilet['cena'] . ' PLN', 0, 1);


$pdf->Output();
exit;
?>