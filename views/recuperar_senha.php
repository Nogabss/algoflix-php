<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../helpers/Csrf.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Senha - Algoflix</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<header class="topo-simples">
    <a href="<?= BASE_URL ?>/controllers/LoginController.php?action=index">← Login</a>
</header>

<main class="form-container">
    <h2>Recuperar Senha</h2>

    <form method="POST" action="<?= BASE_URL ?>/controllers/RecuperarSenhaController.php">
        <input type="hidden" name="action" value="atualizar">
        <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">

        <label>Seu CPF
            <input type="text" name="cpf" required>
        </label>

        <label>Sua Data de Nascimento
            <input type="date" name="data_nascimento" required>
        </label>

        <label>Nova Senha
            <input type="password" name="nova_senha" required>
        </label>

        <button type="submit">Atualizar Senha</button>
    </form>

    <p><a href="<?= BASE_URL ?>/controllers/LoginController.php?action=index">Voltar para Login</a></p>
</main>

</body>
</html>
