<?php


$conn = mysqli_connect('localhost', 'root', '', 'muzeum');

if (isset($_POST['id'])) {
    $id = $_POST['id']; 

   
    $sql = "DELETE FROM uzytkownicy WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        
        header("Location: panel_admin.php");
        
    } else {
        echo "Błąd usuwania użytkownika: " . mysqli_error($conn);
    }
} else {
    echo "Brak ID użytkownika do usunięcia.";
}


mysqli_close($conn);
?>