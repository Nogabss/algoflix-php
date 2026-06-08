<?php require_once '../config.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - PHP Flix</title>
</head>
<body>
    <main>
        <h2>Entrar no Sistema</h2>
        <form action="../controllers/LoginController.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            
            <label for="cpf">CPF:</label><br>
            <input type="text" id="cpf" name="cpf" value="<?php echo isset($_COOKIE['lembrar_usuario']) ? $_COOKIE['lembrar_usuario'] : ''; ?>" required><br><br>
            
            <label for="senha">Senha:</label><br>
            <input type="password" id="senha" name="senha" required><br><br>
            
            <label>
                <input type="checkbox" name="lembrar"> Lembrar-me
            </label><br><br>
            
            <button type="submit">Entrar</button>
        </form>
        <br>
        <a href="cadastro.php">Criar conta</a> | <a href="recuperar_senha.php">Esqueci a senha</a>
    </main>
</body>
</html>
