<?php
session_start();


header("Content-Type: image/png");

// Tworzenie obrazu
$image = imagecreatetruecolor(120, 40);
$bgColor = imagecolorallocate($image, 255, 255, 255); 
$textColor = imagecolorallocate($image, 0, 0, 0);
$lineColor = imagecolorallocate($image, 200, 200, 200); 

// Wypełnienie tła
imagefill($image, 0, 0, $bgColor);

// Generowanie tekstu CAPTCHA
$captchaText = substr(md5(rand()), 0, 6);
$_SESSION["captcha"] = $captchaText;

// Linie zakłócające
for ($i = 0; $i < 5; $i++) {
    imageline($image, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $lineColor);
}

// Dodanie tekstu
imagestring($image, 5, 30, 10, $captchaText, $textColor);

// Wysyłanie obrazu
imagepng($image);
imagedestroy($image);
?>