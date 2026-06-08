<?php
require_once __DIR__ . '/../config/session.php';

// Controle de sessão: se não estiver logado, vai para o login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: " . BASE_URL . "/controllers/LoginController.php?action=index");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Meu Perfil - Algoflix</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<?php include __DIR__ . '/partials/header.php'; ?>

<div class="pagina-cabecalho">
    <h1>Meu perfil</h1>
</div>

<main class="perfil">
    <div class="card-info">
        <p class="label">Nome</p>
        <p class="valor"><?= htmlspecialchars($_SESSION['usuario_nome']) ?></p>
    </div>

    <div class="card-info">
        <p class="label">Nível de acesso</p>
        <p class="valor"><?= htmlspecialchars(ucfirst($_SESSION['usuario_role'])) ?></p>
    </div>

    <?php if ($_SESSION['usuario_role'] === 'admin'): ?>
        <section class="painel">
            <h2>Painel do administrador</h2>
            <p>Você pode cadastrar, editar e excluir filmes e categorias.</p>
            <div class="toolbar-admin">
                <a href="<?= BASE_URL ?>/controllers/FilmeController.php?action=criar" class="botao-acao">+ Novo filme</a>
                <a href="<?= BASE_URL ?>/controllers/CategoriaController.php?action=index" class="botao-acao secundario">Gerenciar categorias</a>
                <a href="<?= BASE_URL ?>/controllers/DashboardController.php?action=index" class="botao-acao secundario">Dashboard</a>
            </div>
        </section>
    <?php endif; ?>
</main>

</body>
</html>
