<?php
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../helpers/Csrf.php';
require_once __DIR__ . '/../../models/Categoria.php';

// Carrega as categorias para mostrar os filtros
$categorias = (new Categoria())->listarTodas();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Catálogo - Algoflix</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<header class="topo">
    <h1>🎬 Algoflix</h1>
    <nav>
        <a href="<?= BASE_URL ?>/controllers/FilmeController.php?action=index">Catálogo</a>
        <a href="<?= BASE_URL ?>/controllers/FilmeController.php?action=criar">+ Novo filme</a>
        <a href="<?= BASE_URL ?>/controllers/CategoriaController.php?action=index">Categorias</a>
    </nav>

    <form method="GET" action="<?= BASE_URL ?>/controllers/FilmeController.php" class="busca">
        <input type="hidden" name="action" value="busca">
        <input type="search" name="q" placeholder="Buscar filme..." required>
        <button type="submit">Buscar</button>
    </form>
</header>

<!-- Filtros por categoria -->
<section class="filtros">
    <a href="<?= BASE_URL ?>/controllers/FilmeController.php?action=index" class="chip">Todos</a>
    <?php foreach ($categorias as $cat): ?>
        <a class="chip" href="<?= BASE_URL ?>/controllers/FilmeController.php?action=porCategoria&categoria_id=<?= $cat['id'] ?>">
            <?= htmlspecialchars($cat['nome']) ?>
        </a>
    <?php endforeach; ?>
</section>

<!-- Lista de filmes -->
<main class="grade">
    <?php if (empty($filmes)): ?>
        <p>Nenhum filme encontrado.</p>
    <?php endif; ?>

    <?php foreach ($filmes as $f): ?>
        <article class="card">
            <a href="<?= BASE_URL ?>/controllers/FilmeController.php?action=detalhes&id=<?= $f['id'] ?>">
                <?php if (!empty($f['capa'])): ?>
                    <img src="<?= htmlspecialchars($f['capa']) ?>" alt="">
                <?php else: ?>
                    <div class="capa-placeholder">🎞️</div>
                <?php endif; ?>
                <h3><?= htmlspecialchars($f['titulo']) ?></h3>
            </a>
            <p class="meta">
                <?= htmlspecialchars($f['categoria_nome'] ?? 'Sem categoria') ?>
            </p>

            <div class="acoes-admin">
                <a href="<?= BASE_URL ?>/controllers/FilmeController.php?action=editar&id=<?= $f['id'] ?>">Editar</a>

                <form method="POST" action="<?= BASE_URL ?>/controllers/FilmeController.php"
                      onsubmit="return confirm('Excluir este filme?');">
                    <input type="hidden" name="action" value="excluir">
                    <input type="hidden" name="id" value="<?= $f['id'] ?>">
                    <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                    <button type="submit">Excluir</button>
                </form>
            </div>
        </article>
    <?php endforeach; ?>
</main>

</body>
</html>
