<?php
/*connect to database using PDO */
$DB_DSN = "mysql:host=127.0.0.1;dbname=camagru";
$DB_USER="root";
$DB_PASSWORD="kroutled";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $opt);
    echo "connected";
?>