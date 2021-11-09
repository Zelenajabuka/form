<?php
$conn = new MySQLi("localhost","root","","db_phpmysql");
if($conn->connect_errno>0) {
    die("Fehler im Verbindungsaufbau: " . $conn->connect_error);
}

$msg = "";

$sql = "
    DELETE FROM tbl_user
    WHERE(
        IDUser=24
    )
";
$ok = $conn->query($sql) or die("Fehler in der Query: " . $conn->error);
if($ok) {
    $msg = '<p class="success">Das SQL-Statement wurde erfolgreich ausgeführt. Es waren ' . $conn->affected_rows . ' Datensätze davon betroffen.</p>';
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>DELETE</title>
</head>

<body>
    <?php echo($msg); ?>
</body>
</html>