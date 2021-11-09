<?php
require("includes/common.inc.php");

$conn = new MySQLi("localhost","root","","db_phpmysql");
if($conn->connect_errno>0) {
    die("Fehler im Verbindungsaufbau: " . $conn->connect_error);
}

$anzDatensaetzeProSeite = 5;
$seite = 1;

$sql = "
    SELECT COUNT(*) AS cnt FROM tbl_user
";
$daten = $conn->query($sql) or die("Fehler in der Query: " . $conn->error);
$zeile = $daten->fetch_object();
$anzDatensaetzeGesamt = $zeile->cnt;
$maxSeite = ceil($anzDatensaetzeGesamt/$anzDatensaetzeProSeite);

if(count($_POST)>0) {
    $seite = $_POST["neueSeite"];
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>MySQL</title>
    <link rel="stylesheet" href="css/common.css">
    <script>
        function blaettere(richtung) {
            var aktuelleSeite = parseInt(document.getElementById("neueSeite").value);
            if(aktuelleSeite + richtung>0 && aktuelleSeite + richtung<=<?php echo($maxSeite); ?>) {
                var neueSeite = aktuelleSeite + richtung;
                document.getElementById("neueSeite").value = neueSeite;
                document.getElementById("frm").submit();
            }
        }
    </script>
</head>

<body>
    <form method="post" id="frm">
        <button type="button" onclick="blaettere(-1);">&lsaquo;</button>
        <input type="number" value="<?php echo($seite); ?>" name="neueSeite" id="neueSeite" min="1" max="<?php echo($maxSeite); ?>" readonly>
        <button type="button" onclick="blaettere(1);">&rsaquo;</button>
    </form>
    
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
                LIMIT " . ($seite-1)*$anzDatensaetzeProSeite . "," . $anzDatensaetzeProSeite . "
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