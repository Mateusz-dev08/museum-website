# Museum Website – strona muzeum II wojny światowej

Projekt szkolny: strona internetowa muzeum z systemem kont użytkowników i zakupem biletów.

## Funkcje
- rejestracja i logowanie użytkowników (hasła szyfrowane SHA1)
- zabezpieczenie logowania kodem CAPTCHA
- role użytkowników: zwiedzający i administrator (panel administratora)
- zakup biletów (ulgowy / normalny) z zapisem do bazy danych
- generowanie biletu w formacie PDF
- galeria zdjęć

## Technologie
PHP, MySQL, HTML, CSS, biblioteka FPDF

## Uruchomienie
1. Skopiuj folder do `C:\xampp\htdocs\`
2. Uruchom Apache i MySQL w XAMPP
3. W phpMyAdmin zaimportuj plik `muzeum.sql`
4. Otwórz `localhost/MUZEUM/logowanie.php`

Konto testowe administratora: `admin@muzeum.pl` / `admin123`
