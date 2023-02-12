<link rel="stylesheet" href="../style/style.css">
<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
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

$sql = "SELECT Id
              ,NaamAchtbaan
              ,NaamPretpark
              ,Land
              ,Topsnelheid
              ,Hoogte
              ,Datum
              ,Cijfer
        FROM achtbaan
        ORDER BY Topsnelheid DESC";

$statement = $pdo->prepare($sql);
$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_OBJ);

$rows = "";
foreach ($result as $achtbaan) {
    $rows .= "<tr>
                <td>$achtbaan->Id</td>
                <td>$achtbaan->NaamAchtbaan</td>
                <td>$achtbaan->NaamPretpark</td>
                <td>$achtbaan->Land</td>
                <td>$achtbaan->Topsnelheid</td>
                <td>$achtbaan->Hoogte</td>
                <td>$achtbaan->Datum</td>
                <td>$achtbaan->Cijfer</td>
                <td>
                    <a href='delete.php?id={$achtbaan->Id}'>
                        <img src='img/b_drop.png' alt=''>
                    </a>
                </td>
                <td>
                    <a href='update.php?id={$achtbaan->Id}'>
                        <img src='img/b_edit.png' alt=''>
                    </a>
                </td>
             </tr>";
}
?>
<div class="card read">
    <h1>De snelste achtbanen van Europa</h1>
    <table>
        <th>Id</th>
        <th>NaamAchtbaan</th>
        <th>NaamPretpark</th>
        <th>Land</th>
        <th>Topsnelheid</th>
        <th>Hoogte</th>
        <th>Datum</th>
        <th>Cijfer</th>
        <th></th>
        <th></th>
        <tr>
            <?php echo $rows; ?>
        </tr>
    </table>
    <br>
    <div class="buttons">
        <a href="../index.php">
            <input type="submit" value="  Nieuw  ">
        </a>
        <a href="truncate.php">
            <input type="submit" class="truncate" value="Truncate">
        </a>
    </div>
</div>