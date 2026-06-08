<?php

session_start();

// Login falso para testes locais sem precisar passar pelo login real
$_SESSION['usuario_id'] = 1;
$_SESSION['usuario_nome'] = 'Administrador';
$_SESSION['usuario_role'] = 'admin';
$_SESSION['is_admin'] = true;

echo "Login realizado como admin (usuario_id = 1).";
