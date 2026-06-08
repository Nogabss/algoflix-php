<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../helpers/Csrf.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - Algoflix</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<header class="topo-simples">
    <a href="<?= BASE_URL ?>/index.php" class="marca">algoflix</a>
</header>

<main class="form-container">
    <h2>Entrar no Sistema</h2>

    <form method="POST" action="<?= BASE_URL ?>/controllers/LoginController.php">
        <input type="hidden" name="action" value="entrar">
        <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">

        <label>CPF
            <input type="text" name="cpf" required
                   value="<?= isset($_COOKIE['lembrar_usuario']) ? htmlspecialchars($_COOKIE['lembrar_usuario']) : '' ?>">
        </label>

        <label>Senha
            <input type="password" name="senha" required>
        </label>

        <label>
            <input type="checkbox" name="lembrar"> Lembrar-me
        </label>

        <button type="submit">Entrar</button>
    </form>

    <p>
        <a href="<?= BASE_URL ?>/controllers/UserController.php?action=index">Criar conta</a> |
        <a href="<?= BASE_URL ?>/controllers/RecuperarSenhaController.php?action=index">Esqueci a senha</a>
    </p>
</main>

</body>
</html>
