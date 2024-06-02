<?php
session_start();
require('funkcje.php');

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] != 1) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
    <meta charset='UTF-8' />
</head>
<body>
<?php
echo "Zalogowano jako: " . $_SESSION['zalogowanyImie'];
?>
<form action="index.php" method="POST">
    <input type="submit" name="wyloguj" value="Wyloguj">
</form>

<form action="user.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
<?php
if (isset($_FILES["fileToUpload"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        echo "<img src='$target_file' alt='Uploaded Image'>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
</body>
</html>
