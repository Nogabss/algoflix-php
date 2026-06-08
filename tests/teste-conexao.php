<?php
require_once __DIR__ . "/../config/Database.php";

try {
    $pdo = Database::getConnection();
    echo "OK: conectado!";
} catch (Exception $e) {
    echo $e->getMessage();
}