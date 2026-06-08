<?php require_once '../config.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - PHP Flix</title>
</head>
<body>
    <main>
        <h2>Cadastrar Usuário</h2>
        <form action="../controllers/UserController.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" required><br><br>
            
            <label for="cpf">CPF:</label><br>
            <input type="text" id="cpf" name="cpf" required><br><br>
            
            <label for="data_nascimento">Data de Nascimento:</label><br>
            <input type="date" id="data_nascimento" name="data_nascimento" required><br><br>
            
            <label for="senha">Senha:</label><br>
            <input type="password" id="senha" name="senha" required><br><br>

            <label for="role">Nível de Acesso:</label><br>
            <select id="role" name="role">
                <option value="usuario">Usuário Comum</option>
                <option value="admin">Administrador</option>
            </select><br><br>
            
            <button type="submit">Cadastrar</button>
        </form>
        <br>
        <a href="login.php">Voltar para Login</a>
    </main>
</body>
</html>
