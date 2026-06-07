<?php
require_once __DIR__ . '/config/session.php';
require_once __DIR__ . '/models/Filme.php';
require_once __DIR__ . '/models/Categoria.php';

$filmeModel = new Filme();
$categorias = (new Categoria())->listarTodas();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Algoflix</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<header class="topo">
    <h1>🎬 Algoflix</h1>
    <nav>
        <a href="<?= BASE_URL ?>/index.php">Início</a>
        <a href="<?= BASE_URL ?>/controllers/FilmeController.php?action=index">Catálogo</a>
        <?php if (!empty($_SESSION['usuario_id'])): ?>
            <a href="<?= BASE_URL ?>/controllers/FavoritoController.php?action=lista">Minha Lista</a>
        <?php else: ?>
            <a href="<?= BASE_URL ?>/login.php">Entrar</a>
        <?php endif; ?>
        <?php if (!empty($_SESSION['is_admin'])): ?>
            <a href="<?= BASE_URL ?>/controllers/DashboardController.php?action=index">Dashboard</a>
        <?php endif; ?>
    </nav>

    <form method="GET" action="<?= BASE_URL ?>/controllers/FilmeController.php" class="busca">
        <input type="hidden" name="action" value="busca">
        <input type="search" name="q" placeholder="Buscar..." required>
        <button type="submit">🔎</button>
    </form>
</header>

<main class="home">
    <!-- Para cada categoria, mostra uma fileira com os filmes dela -->
    <?php foreach ($categorias as $cat): ?>
        <?php $filmes = $filmeModel->listarPorCategoria($cat['id']); ?>

        <?php if (!empty($filmes)): ?>
            <section class="carrossel">
                <h2><?= htmlspecialchars($cat['nome']) ?></h2>
                <div class="trilha">
                    <?php foreach ($filmes as $f): ?>
                        <a class="card pequeno" href="<?= BASE_URL ?>/controllers/FilmeController.php?action=detalhes&id=<?= $f['id'] ?>">
                            <?php if (!empty($f['capa'])): ?>
                                <img src="<?= htmlspecialchars($f['capa']) ?>" alt="">
                            <?php else: ?>
                                <div class="capa-placeholder">🎞️</div>
                            <?php endif; ?>
                            <h3><?= htmlspecialchars($f['titulo']) ?></h3>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
    <?php endforeach; ?>
</main>

</body>
</html>
