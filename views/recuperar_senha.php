<?php require_once '../config.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Senha - PHP Flix</title>
</head>
<body>
    <main>
        <h2>Recuperar Senha</h2>
        <form action="../controllers/RecuperarSenhaController.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            
            <label for="cpf">Seu CPF:</label><br>
            <input type="text" id="cpf" name="cpf" required><br><br>
            
            <label for="data_nascimento">Sua Data de Nascimento:</label><br>
            <input type="date" id="data_nascimento" name="data_nascimento" required><br><br>
            
            <label for="nova_senha">Nova Senha:</label><br>
            <input type="password" id="nova_senha" name="nova_senha" required><br><br>
            
            <button type="submit">Atualizar Senha</button>
        </form>
        <br>
        <a href="login.php">Voltar para Login</a>
    </main>
</body>
</html>
