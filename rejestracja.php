
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <header>
        <h2>Rejestracja muzeum || wojny światowej</h2>
    </header>
    
    <section class="container">
        <h2>Rejestracja</h2>

        <form method="POST">
            <label for="imie">Imię:</label>
            <input type="text" name="imie" required><br>

            <label for="nazwisko">Nazwisko:</label>
            <input type="text" name="nazwisko" required><br>

            <label for="login">Login (e-mail):</label>
            <input type="text" name="login" required><br>

            <label for="haslo">Hasło:</label>
            <input type="password" name="haslo" required><br>

            <label for="haslo2">Potwierdź hasło:</label>
            <input type="password" name="haslo2" required><br>

            <label for="rola">Rola:</label>
            <select name="rola">
                <option value="zwiedzajacy">Zwiedzający</option>
                <option value="administrator">Administrator</option>
            </select><br>

            <button type="submit">Zarejestruj</button>
                
        </form>
    </section>
    
    <a href="logowanie.php">Masz już konto?</a>
    <a href="strona.html">strona</a>

</body>
</html>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $imie = trim($_POST['imie']);
    $nazwisko = trim($_POST['nazwisko']);
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    $haslo2 = $_POST['haslo2'];
    $rola = $_POST['rola'];

    
    if (empty($imie) || empty($nazwisko) || empty($login) || empty($haslo) || empty($haslo2)) {
        echo "Wszystkie pola muszą być wypełnione!";
        
    }

 
    if (!preg_match('/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$/u', $imie)) {
        echo "Imię może zawierać tylko litery!";
        
    }

    if (!preg_match('/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$/u', $nazwisko)) {
        echo "Nazwisko może zawierać tylko litery!";
      
    }

 
    $imie = ucfirst(mb_strtolower($imie, 'UTF-8'));
    $nazwisko = ucfirst(mb_strtolower($nazwisko, 'UTF-8'));


    if ($haslo !== $haslo2) {
        echo "Hasła się nie zgadzają!";
        
    }

  
    $haslo = sha1($haslo);

   
    $connect = mysqli_connect('localhost', 'root', '', 'muzeum');
   

    
    $query = "SELECT * FROM uzytkownicy WHERE email = '$login'";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "Podany login już istnieje!";
        
    }

   
    $query1 = "INSERT INTO uzytkownicy (imie_nazwisko, email, haslo, rola) 
               VALUES ('$imie $nazwisko', '$login', '$haslo', '$rola')";

    if (mysqli_query($connect, $query1)) {
        
        header("Location: logowanie.php");
       
    } else {
        echo "Wystąpił błąd podczas rejestracji!";
    }
    
    mysqli_close($connect);
}
?>

