<?php
require("includes/common.inc.php");

$conn = new MySQLi("localhost","root","","db_phpmysql");
if($conn->connect_errno>0) {
    die("Fehler im Verbindungsaufbau: " . $conn->connect_error);
}

$msg = "";

if(count($_POST)>0) {
    ta($_POST);

    $sql = "
        INSERT INTO tbl_user
            (Emailadresse, Passwort, Vorname, Nachname, GebDatum)
        VALUES (
            '" . $_POST["Emailadresse"] . "',
            '" . $_POST["Passwort"] . "',
            '" . $_POST["Vorname"] . "',
            '" . $_POST["Nachname"] . "',
            '" . $_POST["GebDatum"] . "'
        )
    ";
    ta($sql);
    $ok = $conn->query($sql) or die("Fehler in der Query: " . $conn->error);
    
    if($ok) {
        $msg = '<p class="success">Vielen Dank. Ihr Eintrag ist erfolgt.</p>';
    }
    else {
        $msg = '<p class="error">Leider konnte Ihr Eintrag nicht wie gewünscht durchgeführt werden.</p>';
    }
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
    <?php echo($msg); ?>
    <form method="post">
        <label for="Emailadressse">Emailadresse:</label><input type="email" name="Emailadresse" id="Emailadresse" required>
        <label for="Passwort">Passwort:</label><input type="password" name="Passwort" id="Passwort" required>
        <label for="Vorname">Vorname:</label><input type="text" name="Vorname" id="Vorname">
        <label for="Nachname">Nachname:</label><input type="text" name="Nachname" id="Nachname">
        <label for="GebDatum">Geburtsdatum:</label><input type="date" name="GebDatum" id="GebDatum">
        <input type="submit" value="eintragen">
    </form>
</body>
</html>