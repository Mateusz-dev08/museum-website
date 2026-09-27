<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <a href="WYLOGOWANIE.php">wyloguj</a>
     <link rel="stylesheet" href="style.css">
</body>
</html>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'muzeum');
$sql = "SELECT id, imie_nazwisko, email FROM uzytkownicy"; 
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Imię i Nazwisko</th><th>Email</th><th>Akcje</th></tr>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['imie_nazwisko'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>
                <form method='POST' action='usun_uzytkownika.php' style='display:inline;'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'> 
                    <button type='submit'>Usuń</button>
                </form>
                <form method='GET' action='zauktalizuj_użytkownika.php' style='display:inline;'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <button type='submit'>Edytuj</button>
                </form>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Brak użytkowników do wyświetlenia.";
}

mysqli_close($conn);
?>