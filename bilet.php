
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kup bilet</title>
</head>
<body>
    <h2>Formularz zakupu biletu</h2>

    <form method="POST">
        <label>Data wizyty:</label>
        <input type="date" name="data_wizyty" required><br><br>

        <label>Typ biletu:</label>
        <select name="typ">
            <option value="ulgowy">Ulgowy (20 zł)</option>
            <option value="normalny">Normalny (40 zł)</option>
        </select><br><br>

        <label>Ilość:</label>
        <input type="number" name="ilosc" min="1" value="1" required><br><br>

        <button type="submit">Kup bilet</button>
        
    </form>
    <a href="strona.html">strona</a>
</body>
</html>
<?php
session_start();

if (!isset($_SESSION['email'])) {
    echo "Musisz być zalogowany!";
    exit;
}

$connect = mysqli_connect('localhost', 'root', '', 'muzeum');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data_wizyty = $_POST['data_wizyty'];
    $typ = $_POST['typ'];
    $ilosc = $_POST['ilosc'];

    // Określenie ceny
    $cena_jednostkowa = ($typ == 'ulgowy') ? 20 : 40;
    $cena = $cena_jednostkowa * $ilosc;

    $email = $_SESSION['email'];
    $q = "SELECT imie_nazwisko FROM uzytkownicy WHERE email = '$email'";
    $res = mysqli_query($connect, $q);

    if ($row = mysqli_fetch_array($res)) {
        $imie_nazwisko = $row[0];

        // Zapisanie biletu do bazy danych
        $q2 = "INSERT INTO bilety (imie, data_wizyty, typ, ilosc, cena) 
               VALUES ('$imie_nazwisko', '$data_wizyty', '$typ', $ilosc, $cena)";

        if (mysqli_query($connect, $q2)) {
            // Zapisaliśmy bilet do bazy - teraz przekierowanie do PDF (bez przekazywania ID)
            header("Location: pdf.php");
            exit;
        } else {
            echo "Błąd przy zapisie biletu do bazy: " . mysqli_error($connect);
        }
    } else {
        echo "Nie znaleziono użytkownika.";
    }
}
?>
