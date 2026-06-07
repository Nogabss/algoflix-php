<?php
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../helpers/Csrf.php';

// Esta view é incluída por FavoritoController::lista(), que já define $filmes
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minha Lista</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<header class="topo">
    <a href="<?= BASE_URL ?>/controllers/FilmeController.php?action=index">← Catálogo</a>
</header>

<main>
    <h1>🎬 Minha Lista</h1>

    <?php if (empty($filmes)): ?>
        <p>Você ainda não adicionou nenhum filme.</p>
    <?php endif; ?>

    <div class="grade">
        <?php foreach ($filmes as $filme): ?>
            <article class="card">
                <a href="<?= BASE_URL ?>/controllers/FilmeController.php?action=detalhes&id=<?= $filme['id'] ?>">
                    <h3><?= htmlspecialchars($filme['titulo']) ?></h3>
                </a>

                <form method="POST" action="<?= BASE_URL ?>/controllers/FavoritoController.php">
                    <input type="hidden" name="action" value="remover">
                    <input type="hidden" name="filme_id" value="<?= $filme['id'] ?>">
                    <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                    <button type="submit">❌ Remover</button>
                </form>
            </article>
        <?php endforeach; ?>
    </div>
</main>

</body>
</html>
