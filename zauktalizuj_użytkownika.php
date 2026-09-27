
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edycja profilu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h2>Edycja profilu użytkownika</h2>
</header>

<section class="container">
    <h2>Formularz edycji</h2>

    <form method="POST">
        <label for="imie">Imię:</label>
        <input type="text" name="imie" ><br>

        <label for="nazwisko">Nazwisko:</label>
        <input type="text" name="nazwisko" ><br>

        <label for="haslo">Nowe hasło:</label>
        <input type="password" name="haslo" ><br>

        <button type="submit">Zapisz zmiany</button>
    </form>
    <a href="panel_admin.php">strona</a>
</section>

</body>
</html>
<?php
session_start();

$connect = mysqli_connect('localhost', 'root', '', 'muzeum');



$email_sesja = $_SESSION['email']; 


$query = "SELECT * FROM uzytkownicy WHERE email='$email_sesja'";
$result = mysqli_query($connect, $query);
if ($result) {
    $dane = mysqli_fetch_array($result);
} else {
    echo " Błąd pobierania danych: " ;
   
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $haslo = $_POST['haslo'];

    
    if (!preg_match('/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$/u', $imie)) {
        echo " Imię może zawierać tylko litery!";
        
    }

    if (!preg_match('/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$/u', $nazwisko)) {
        echo " Nazwisko może zawierać tylko litery!";
       
    }

   

   
    $imie = ucfirst(mb_strtolower($imie, 'UTF-8'));
    $nazwisko = ucfirst(mb_strtolower($nazwisko, 'UTF-8'));
    $imie_nazwisko = "$imie $nazwisko";
    $haslo_hash = sha1($haslo);

  
    $query = "UPDATE uzytkownicy SET imie_nazwisko='$imie_nazwisko', haslo='$haslo_hash' WHERE email='$email_sesja'";

    if (mysqli_query($connect, $query)) {
        echo " Dane zostały zaktualizowane.";
    } else {
        echo " Błąd podczas aktualizacji: " ;
    }
}
?>

