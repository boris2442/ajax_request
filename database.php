<?php

define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBNAME", "espace_membre_2025");

define("DBPASS", "");
$dsn = "mysql:dbname=" . DBNAME . "; host=" . DBHOST;
try {
    $db = new PDO($dsn, DBUSER, DBPASS);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->exec("SET NAMES utf8");
    // echo "Connexion à la base de données réussie";
} catch (PDOException $e) {
    die("Erreur: " . $e->getMessage());
}
