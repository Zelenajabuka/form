<?php
require("includes/common.inc.php");

$conn = new MySQLi("localhost","root","","db_phpmysql");
if($conn->connect_errno>0) {
    die("Fehler im Verbindungsaufbau: " . $conn->connect_error);
}

$sql = "
    INSERT INTO tbl_user
        (Emailadresse, Passwort, Vorname, Nachname, GebDatum)
    VALUES
        ('test12@test.at','sdöjf','Anita',NULL,'1977-12-12'),
        ('test11@test.at','dsajsdi','Thomas','Maier',NULL)
";
$ok = $conn->query($sql) or die("Fehler in der Query: " . $conn->error);
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>MySQL</title>
    <link rel="stylesheet" href="css/common.css">
</head>

<body>
</body>
</html>