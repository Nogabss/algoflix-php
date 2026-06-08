<?php
require_once '../config.php';

// Controle de Sessão: Se não estiver logado, expulsa para o login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

// Logout simples na mesma página para economizar arquivos
if (isset($_GET['sair'])) {
    session_destroy();
    setcookie('lembrar_usuario', '', time() - 3600, '/'); // Apaga o cookie
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Meu Perfil - PHP Flix</title>
</head>
<body>
    <header>
        <h1>Bem-vindo, <?php echo $_SESSION['usuario_nome']; ?>!</h1>
        <p>Seu nível de acesso é: <strong><?php echo $_SESSION['usuario_role']; ?></strong></p>
    </header>
    
    <main>
        <?php if ($_SESSION['usuario_role'] === 'admin'): ?>
            <section style="background: #fee; padding: 10px; border: 1px solid #f00;">
                <h2>Painel do Administrador</h2>
                <p>Aqui você colocaria links para o CRUD de filmes/receitas.</p>
            </section>
        <?php else: ?>
            <section style="background: #eef; padding: 10px; border: 1px solid #00f;">
                <h2>Área do Usuário</h2>
                <p>Conteúdo exclusivo para usuários logados.</p>
            </section>
        <?php endif; ?>
        
        <br>
        <a href="?sair=1"><button>Sair (Logout)</button></a>
    </main>
</body>
</html>
