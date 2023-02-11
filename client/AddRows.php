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

$sql = "INSERT INTO achtbaan (Id
                             ,NaamAchtbaan
                             ,NaamPretpark
                             ,Land
                             ,Topsnelheid
                             ,Hoogte
                             ,Datum
                             ,Cijfer)
        VALUES
                            (NULL, 'Red Force', 'Ferrari Land', 'Spanje', 192, 112, '1968-03-02', 9.2),
                            (NULL, 'Ring Racer', 'Circuit Nürburgring', 'Duitsland', 160, 110, '1974-08-01', 8.7),
                            (NULL, 'Hyperion', 'EnergyLandia', 'Polen', 141, 77, '2009-09-09', 6.3),
                            (NULL, 'Furius Baco', 'PortAventura', 'Spanje', 138, 23, '2018-06-06', 5.5),
                            (NULL, 'Shambhala', 'PortAventura', 'Spanje', 134, 102, '2017-04-03', 9.7);";

$statement = $pdo->prepare($sql);

$statement->execute();

echo 'Het invoeren is gelukt!';

header('Location: read.php');
