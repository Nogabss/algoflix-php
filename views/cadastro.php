<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../helpers/Csrf.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Algoflix</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<header class="topo-simples">
    <a href="<?= BASE_URL ?>/controllers/LoginController.php?action=index">← Login</a>
</header>

<main class="form-container">
    <h2>Cadastrar Usuário</h2>

    <form method="POST" action="<?= BASE_URL ?>/controllers/UserController.php">
        <input type="hidden" name="action" value="cadastrar">
        <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">

        <label>Nome
            <input type="text" name="nome" required>
        </label>

        <label>CPF
            <input type="text" name="cpf" required>
        </label>

        <label>Data de Nascimento
            <input type="date" name="data_nascimento" required>
        </label>

        <label>Senha
            <input type="password" name="senha" required>
        </label>

        <button type="submit">Cadastrar</button>
    </form>

    <p><a href="<?= BASE_URL ?>/controllers/LoginController.php?action=index">Voltar para Login</a></p>
</main>

</body>
</html>
