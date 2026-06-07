<?php

session_start();

$_SESSION['usuario_id'] = '1';

require_once '../controllers/DashboardController.php';

$controller = new DashboardController();
$controller->index();