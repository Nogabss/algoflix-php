<?php

session_start();

$_SESSION['usuario_id'] = 1;
$_SESSION['usuario_nome'] = 'Administrador';
$_SESSION['usuario_role'] = 'admin';
$_SESSION['is_admin'] = true;

echo "Login realizado como admin (usuario_id = 1).";
