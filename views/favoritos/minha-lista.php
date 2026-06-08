<?php
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../helpers/Csrf.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minha Lista</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="pagina-cabecalho">
    <h1>Minha Lista</h1>
</div>

<?php if (empty($filmes)): ?>
    <p class="vazio">Você ainda não adicionou nenhum filme. Explore o <a href="<?= BASE_URL ?>/controllers/FilmeController.php?action=index">catálogo</a>.</p>
<?php else: ?>
    <main class="grade">
        <?php foreach ($filmes as $filme): ?>
            <article class="card">
                <a href="<?= BASE_URL ?>/controllers/FilmeController.php?action=detalhes&id=<?= $filme['id'] ?>">
                    <?php if (!empty($filme['capa'])): ?>
                        <img src="<?= htmlspecialchars($filme['capa']) ?>" alt="">
                    <?php else: ?>
                        <div class="capa-placeholder"></div>
                    <?php endif; ?>

                    <form method="POST"
                          action="<?= BASE_URL ?>/controllers/FavoritoController.php"
                          class="botao-remover"
                          onsubmit="return confirm('Remover este filme da sua lista?');">
                        <input type="hidden" name="action" value="remover">
                        <input type="hidden" name="filme_id" value="<?= $filme['id'] ?>">
                        <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                        <button type="submit" title="Remover da lista">×</button>
                    </form>

                    <h3><?= htmlspecialchars($filme['titulo']) ?></h3>
                    <p class="meta">
                        <?= htmlspecialchars($filme['categoria_nome'] ?? 'Sem categoria') ?>
                        <?php if (!empty($filme['ano'])): ?> • <?= $filme['ano'] ?><?php endif; ?>
                    </p>
                </a>
            </article>
        <?php endforeach; ?>
    </main>
<?php endif; ?>

</body>
</html>
