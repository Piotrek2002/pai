<?php
session_start();
$link = mysqli_connect("localhost", "scott", "tiger", "instytut");

if (!$link) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if (isset($_POST['id_prac']) && is_numeric($_POST['id_prac']) && is_string($_POST['nazwisko'])) {
    $sql = "INSERT INTO pracownicy(id_prac, nazwisko) VALUES(?, ?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("is", $_POST['id_prac'], $_POST['nazwisko']);
    $result = $stmt->execute();

    if ($result) {
        $_SESSION['message'] = "Pracownik został dodany pomyślnie!";
        header("Location: file06_get.php");
    } else {
        $_SESSION['message'] = "Błąd: " . mysqli_error($link);
        header("Location: file06_post.php");
    }
    $stmt->close();
} else {
    $_SESSION['message'] = "Niepoprawne dane.";
    header("Location: file06_post.php");
}

mysqli_close($link);
?>
