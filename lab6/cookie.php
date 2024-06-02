<?php
session_start();
require('funkcje.php');

if (isset($_GET['utworzCookie'])) {
    $czas = test_input($_GET['czas']);
    setcookie("testCookie", "wartośćCookie", time() + $czas, "/");
    echo "Cookie zostało utworzone na $czas sekund.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
    <meta charset='UTF-8' />
</head>
<body>
<a href="index.php">Wstecz</a>
</body>
</html>
