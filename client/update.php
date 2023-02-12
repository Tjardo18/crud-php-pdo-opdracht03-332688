<?php

require('lib/console_log.php');
require('config/config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=$dbCharset";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
} catch (PDOException $e) {
    echo "<h1>Er is iets fout gegaan tijdens het verbinden met de database. Neem contact op met de Database Beheerder.</h1>";
    console_log($e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        require('config/input.php');

        $sql = "UPDATE achtbaan SET
                                NaamAchtbaan = :na
                               ,NaamPretpark = :np
                               ,Land = :ld
                               ,Topsnelheid = :ts
                               ,Hoogte = :he
                               ,Datum = :dm
                               ,Cijfer = :cr
                WHERE ID = :id;";

        // sql statement preparing + execute
        $yee = $pdo->prepare($sql);
        $yee->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
        $yee->bindValue(':na', $achtbaan, PDO::PARAM_STR);
        $yee->bindValue(':np', $pretpark, PDO::PARAM_STR);
        $yee->bindValue(':ld', $land, PDO::PARAM_STR);
        $yee->bindValue(':ts', $topsnelheid, PDO::PARAM_INT);
        $yee->bindValue(':he', $hoogte, PDO::PARAM_INT);
        $yee->bindValue(':dm', $datum, PDO::PARAM_STR);
        $yee->bindValue(':cr', $cijfer, PDO::PARAM_STR);
        $yee->execute();

        echo "Het updaten is gelukt!";
        header('Refresh:3; url=read.php');
    } catch (PDOException $e) {
        // error
        echo "Het updaten is mislukt!";
        console_log($e->getMessage());
        header('Refresh:3; url=read.php');
    }

    exit();
}

$sql = "SELECT Id
              ,NaamAchtbaan AS NA
              ,NaamPretpark AS NP
              ,Land AS LD
              ,Topsnelheid AS TS
              ,Hoogte AS HE
              ,Datum AS DM
              ,Cijfer AS CR
        FROM achtbaan
        WHERE ID = :id";

// SQL Statement preparing + Execute
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="client/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../style/style.css">
    <title>Achtbanen</title>
</head>

<body>
    <div class="card">
        <h1>Update Achtbaan</h1>
        <form action="update.php" method="POST">

            <div class="inputVeld">
                <label for="achtbaan">
                    Naam Achtbaan:
                    <input type="text" name="achtbaan" id="achtbaan" value="<?= $result->NA ?>" required>
                </label>
            </div>
            <div class="inputVeld">
                <label for="pretpark">
                    Naam Pretpark:
                    <input type="text" name="pretpark" id="pretpark" value="<?= $result->NP ?>" required>
                </label>
            </div>
            <div class="inputVeld">
                <label for="land">
                    Naam Land:
                    <input type="text" name="land" id="land" value="<?= $result->LD ?>" required>
                </label>
            </div>
            <div class="inputVeld">
                <label for="topsnelheid">
                    Topsnelheid (km/u):
                    <input type="number" name="topsnelheid" id="topsnelheid" min="1" max="200" value="<?= $result->TS ?>" required>
                </label>
            </div>
            <div class="inputVeld">
                <label for="hoogte">
                    Hoogte (m):
                    <input type="number" name="hoogte" id="hoogte" min="1" max="200" value="<?= $result->HE ?>">
                </label>
            </div>
            <div class="inputVeld">
                <label for="datum">
                    Datum eerste opening:
                    <input type="date" name="datum" id="datum" value="<?= $result->DM ?>">
                </label>
            </div>
            <div class="inputVeld">
                <label for="cijfer">
                    Cijfer voor achtbaan:
                    <div class="display">
                        <input type="range" name="cijfer" id="cijfer" min="1" max="10" step=".1" value="<?= $result->CR ?>" oninput="getal(this.value)">
                        <p id="cijferOutput">5.5</p>
                    </div>
                </label>
            </div>
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            <input type="submit" value="Updaten">
        </form>
    </div>

    <script src="../script.js"></script>
</body>

</html>