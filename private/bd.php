<?php

define("DSN", "mysql:host=localhost;dbname=hackathon1");
define("USER", "root");
define("PASS", "grims426");

// Connection
$pdo = new PDO(DSN, USER, PASS);


if (!$pdo) {
    die('error');
}
