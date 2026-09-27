
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h2>Logowanie do muzeum || wojny światowej</h2>
</header>

<section class="container">
    <h2>Logowanie</h2>

    <form method="POST">
        <label for="name">Twoje imię:</label>
        <input type="text" name="name" required><br> 

        <label for="login">Login (e-mail):</label>
        <input type="text" name="login" required><br> 

        <label for="haslo">Hasło:</label>
        <input type="password" name="haslo" required><br>

        <img src="captcha.php" alt="CAPTCHA"><br>
        <label for="captcha_input">Przepisz kod z obrazka:</label>
        <input type="text" name="captcha" required><br>

        <label><input type="checkbox" name="remember"> Zapamiętaj mnie</label><br> 

        <button type="submit">Zaloguj</button>
    </form>
</section>
<a href="rejestracja.php">Rejestracja</a>
<a href="strona.html">strona</a>

<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $haslo_form = $_POST['haslo'];
    $captcha_input = $_POST['captcha'];
    $name = $_POST['name'] ?? '';

   
    if (!empty($name)) {
        setcookie('name', $name, time() + 3600, "/");
    }

   
    if (isset($_POST['remember'])) {
        setcookie('zapamietaj_login', $login, time() + (86400 * 30), "/"); 
    } else {
        setcookie('zapamietaj_login', '', time() - 3600, "/"); 
    }

   
    if (empty($login) || empty($haslo_form) || empty($captcha_input)) {
        echo "Wypełnij wszystkie pola!";
    } elseif ($_SESSION['captcha'] !== $captcha_input) {
        echo "Błędny kod CAPTCHA!";
    } else {
        
        $haslo = sha1($haslo_form);

        
        $connect = mysqli_connect('localhost', 'root', '', 'muzeum');

      
       
        $query = "SELECT * FROM uzytkownicy WHERE email='$login' AND haslo='$haslo'";
        $result = mysqli_query($connect, $query);

        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_array($result);
            $_SESSION['uzytkownik_id'] = $user['id'];
            $_SESSION['uzytkownik_imie'] = $user['imie_nazwisko'];
            $_SESSION['uzytkownik_rola'] = $user['rola'];

          
            setcookie('name', $user['imie_nazwisko'], time() + 3600, "/");

            $_SESSION['email'] = $user['email'];
            if ($user['rola'] === 'administrator') {
                header("Location: panel_admin.php");  
            } else {
                header("Location: strona.html");  
            }
            exit;
        } else {
            echo "Nieprawidłowy login lub hasło!";
        }

        mysqli_close($connect);
    }
}
?>

</body>
</html>