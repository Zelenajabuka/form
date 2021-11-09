<?php
require("includes/common.inc.php");

$conn = new MySQLi("localhost","root","","db_phpmysql");
if($conn->connect_errno>0) {
    die("Fehler im Verbindungsaufbau: " . $conn->connect_error);
}

$sql = "
    SELECT Nachname, Vorname, Emailadresse, Passwort, IDUser FROM tbl_user
    WHERE(
        Nachname LIKE '%maier%' OR
        Vorname IS NULL
    )
    ORDER BY Nachname DESC, Vorname ASC
    LIMIT 2,2
";
$antwort = $conn->query($sql) or die("Fehler in der Query: " . $conn->error);
ta($antwort);

while($zeile = $antwort->fetch_object()) {
    ta($zeile);
}
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