<?php
session_start();
require('funkcje.php');

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
        header("Location: index.php");
        exit;
    }
}
?>
