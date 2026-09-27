<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST" ENCTYPE="multipart/form-data">
        <input type="file" name="plik" accept="image/jpg"/><br/>
        <input type="submit" value="<-" name="poprzednie"/>
        <input type="submit" value="Wyslij plik" name="dodaj"/>
        <input type="submit" value="->" name="nastepne"/>
    </form>
</body>
</html>

<?php
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $nazwa = $_FILES['plik']['name']; 
        if(in_array(pathinfo($nazwa, PATHINFO_EXTENSION), array("jpg", "png", "gif", "bmp", "svg", "jpeg")))
        {
            $temp = $_FILES['plik']['tmp_name'] ;
            $typ = $_FILES['plik']['type'];
            $rozmiar = $_FILES['plik']['size'];
            $lokalizacja = $_SERVER['DOCUMENT_ROOT'];
            $opis = explode(".", $nazwa);
            move_uploaded_file($temp, $lokalizacja."/Sebastian_upload/".$nazwa);

            $connect = mysqli_connect("localhost", "root", "", "zdjecia");
            $query = "INSERT INTO zdjecia VALUES ('', '$nazwa', '$opis[0]');";
            $result = mysqli_query($connect, $query);
            mysqli_close($connect);
        }
}
?>