<?php
session_start();
require('funkcje.php');

if (isset($_POST['wyloguj'])) {
    $_SESSION['zalogowany'] = 0;
    session_destroy();
}

if (isset($_POST['zaloguj'])) {
    $login = test_input($_POST['login']);
    $haslo = test_input($_POST['haslo']);

    if (($login == $osoba1->login && $haslo == $osoba1->haslo) ||
        ($login == $osoba2->login && $haslo == $osoba2->haslo)) {
        $_SESSION['zalogowanyImie'] = ($login == $osoba1->login) ? $osoba1->imieNazwisko : $osoba2->imieNazwisko;
        $_SESSION['zalogowany'] = 1;
        header("Location: user.php");
        exit;
    } else {
        echo "Niepoprawny login lub hasło";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
    <meta charset='UTF-8' />
</head>
<body>
    <h1>Nasz system</h1>
    <form action="logowanie.php" method="POST">
        <fieldset>
            <legend>Logowanie</legend>
            <label for="login">Login:</label>
            <input type="text" id="login" name="login"><br>
            <label for="haslo">Hasło:</label>
            <input type="password" id="haslo" name="haslo"><br>
            <input type="submit" name="zaloguj" value="Zaloguj">
        </fieldset>
    </form>

    <form action="cookie.php" method="GET">
        <fieldset>
            <legend>Utwórz Cookie</legend>
            <label for="czas">Czas życia cookie (w sekundach):</label>
            <input type="number" id="czas" name="czas">
            <input type="submit" name="utworzCookie" value="Utwórz Cookie">
        </fieldset>
    </form>
    <?php
    if (isset($_COOKIE["testCookie"])) {
        echo "Wartość cookie: " . $_COOKIE["testCookie"];
    } else {
        echo "Cookie nie jest ustawione.";
    }
    ?>
</body>
</html>
