<?php
// Header global do site.
// Inclui marca, navegação principal, busca e ações da conta.
// As ações de admin (criar filme, gerenciar categorias) ficam nas próprias
// páginas como "toolbar", não aqui — não fazem parte da navegação global.
require_once __DIR__ . '/../../config/session.php';
?>
<header class="topo">
    <a href="<?= BASE_URL ?>/index.php" class="marca">algoflix</a>

    <nav class="nav-principal">
        <a href="<?= BASE_URL ?>/index.php">Início</a>
        <a href="<?= BASE_URL ?>/controllers/FilmeController.php?action=index">Catálogo</a>
        <?php if (!empty($_SESSION['usuario_id'])): ?>
            <a href="<?= BASE_URL ?>/controllers/FavoritoController.php?action=lista">Minha Lista</a>
        <?php endif; ?>
    </nav>

    <form method="GET" action="<?= BASE_URL ?>/controllers/FilmeController.php" class="busca">
        <input type="hidden" name="action" value="busca">
        <input type="search" name="q" placeholder="Buscar título" required>
    </form>

    <div class="conta">
        <?php if (!empty($_SESSION['usuario_id'])): ?>
            <a href="<?= BASE_URL ?>/controllers/UserController.php?action=perfil" class="usuario">
                <?= htmlspecialchars($_SESSION['usuario_nome'] ?? 'Perfil') ?>
            </a>
            <a href="<?= BASE_URL ?>/controllers/LoginController.php?action=sair" class="link-sutil">Sair</a>
        <?php else: ?>
            <a href="<?= BASE_URL ?>/controllers/LoginController.php?action=index" class="link-sutil">Entrar</a>
            <a href="<?= BASE_URL ?>/controllers/UserController.php?action=index" class="botao-entrar">Cadastrar</a>
        <?php endif; ?>
    </div>
</header>
