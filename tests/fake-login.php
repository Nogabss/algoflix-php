<?php

session_start();

// Login falso para testes (enquanto a Pessoa 1 não terminar o login real)
$_SESSION['usuario_id'] = 1;
$_SESSION['is_admin'] = true;

echo "Login realizado como admin (usuario_id = 1).";
