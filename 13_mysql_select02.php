<?php
require("includes/common.inc.php");

$conn = new MySQLi("localhost","root","","db_phpmysql");
if($conn->connect_errno>0) {
    die("Fehler im Verbindungsaufbau: " . $conn->connect_error);
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
    <table>
        <thead>
            <tr>
                <th scope="col">IDUser</th>
                <th scope="col">Vorname</th>
                <th scope="col">Nachname</th>
                <th scope="col">Email</th>
                <th scope="col">Passwort</th>
                <th scope="col">Geb.-Datum</th>
                <th scope="col">Reg.-Zeitpunkt</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "
                SELECT * FROM tbl_user
                ORDER BY Nachname ASC
            ";
            $antwort = $conn->query($sql) or die("Fehler in der Query: " . $conn->error);

            while($zeile = $antwort->fetch_object()) {
                echo('
                    <tr>
                        <td>' . $zeile->IDUser . '</td>
                        <td>' . $zeile->Vorname . '</td>
                        <td>' . $zeile->Nachname . '</td>
                        <td>' . $zeile->Emailadresse . '</td>
                        <td>' . $zeile->Passwort . '</td>
                        <td>' . $zeile->GebDatum . '</td>
                        <td>' . $zeile->RegZeitpunkt . '</td>
                    </tr>
                ');
            }
            ?>
        </tbody>
    </table>
</body>
</html>