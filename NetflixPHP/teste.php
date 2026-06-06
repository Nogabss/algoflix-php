<?php
require_once "config/Database.php";

try {
    $pdo = Database::getConnection();
    echo "OK: conectado!";
} catch (Exception $e) {
    echo $e->getMessage();
}