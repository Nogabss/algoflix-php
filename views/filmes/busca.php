<?php
require_once __DIR__ . '/../../config/session.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Busca</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<header class="topo">
    <a href="<?= BASE_URL ?>/controllers/FilmeController.php?action=index">← Catálogo</a>
    <form method="GET" action="<?= BASE_URL ?>/controllers/FilmeController.php" class="busca">
        <input type="hidden" name="action" value="busca">
        <input type="search" name="q" value="<?= htmlspecialchars($termo) ?>" required>
        <button type="submit">Buscar</button>
    </form>
</header>

<main class="grade">
    <h1>Resultados para: <?= htmlspecialchars($termo) ?></h1>

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
            <p class="meta"><?= htmlspecialchars($f['categoria_nome'] ?? '') ?></p>
        </article>
    <?php endforeach; ?>
</main>

</body>
</html>
