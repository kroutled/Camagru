<?php
/*connect to database using PDO */
$DB_DSN = "mysql:host=127.0.0.1;dbname=camagru";
$DB_USER="root";
$DB_PASSWORD="kroutled";

try {
    $handle = new PDO("$DB_DSN", "$DB_USER", "$DB_PASSWORD");
    $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
    die("Oops. Something went wrong in the database!");
}