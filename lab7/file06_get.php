<?php
$link = mysqli_connect("localhost", "scott", "tiger", "instytut");

if (!$link) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$sql = "SELECT * FROM pracownicy";
$result = $link->query($sql);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1>Lista pracowników</h1>
<?php
foreach ($result as $v) {
    echo $v["ID_PRAC"] . " " . $v["NAZWISKO"] . "<br/>";
}
?>
<a href="file06_post.php">Dodaj nowego pracownika</a>
</body>
</html>
<?php
$result->free();
$link->close();
?>
