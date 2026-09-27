

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wylogowanie</title>
</head>
<body>
   
    <form method="POST">
        <button type="submit" name="logout">Wyloguj się</button>
    </form>
</body>
</html><?php
session_start();


if (!isset($_SESSION['email'])) {
    echo "Musisz być zalogowany!";
    exit;
}


if (isset($_POST['logout'])) {
    session_unset();
    session_destroy(); 
    header("Location: logowanie.php"); 
    
}

?>
