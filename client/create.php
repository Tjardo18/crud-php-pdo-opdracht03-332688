<?php

require('lib/console_log.php');
require('config/config.php');
require('config/input.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=$dbCharset";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
} catch (PDOException $e) {
    echo "<h1>Er is iets fout gegaan tijdens het verbinden met de database. Neem contact op met de Database Beheerder.</h1>";
    console_log($e->getMessage());
}

$sql = "INSERT INTO achtbaan (Id
                          ,NaamAchtbaan
                          ,NaamPretpark
                          ,Land
                          ,Topsnelheid
                          ,Hoogte
                          ,Datum
                          ,Cijfer)
        VALUES            (NULL
                          ,:na
                          ,:np
                          ,:ld
                          ,:ts
                          ,:he
                          ,:dm
                          ,:cr);";

$statement = $pdo->prepare($sql);

$statement->bindValue(':na', $achtbaan, PDO::PARAM_STR);
$statement->bindValue(':np', $pretpark, PDO::PARAM_STR);
$statement->bindValue(':ld', $land, PDO::PARAM_STR);
$statement->bindValue(':ts', $topsnelheid, PDO::PARAM_INT);
$statement->bindValue(':he', $hoogte, PDO::PARAM_INT);
$statement->bindValue(':dm', $datum, PDO::PARAM_STR);
$statement->bindValue(':cr', $cijfer, PDO::PARAM_STR);

$statement->execute();

echo 'Het invoeren is gelukt!';

header('Location: read.php');
