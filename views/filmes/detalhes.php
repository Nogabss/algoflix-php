<?php
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../helpers/Csrf.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($filme['titulo']) ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<?php include __DIR__ . '/../partials/header.php'; ?>

<main class="detalhes">
    <div class="capa-grande">
        <?php if (!empty($filme['capa'])): ?>
            <img src="<?= htmlspecialchars($filme['capa']) ?>" alt="">
        <?php else: ?>
            <div class="capa-placeholder grande"></div>
        <?php endif; ?>
    </div>

    <div class="info">
        <h1><?= htmlspecialchars($filme['titulo']) ?></h1>

        <p class="meta">
            <strong><?= htmlspecialchars($filme['tipo'] ?? 'filme') ?></strong>
            <?php if (!empty($filme['categoria_nome'])): ?>
                • <?= htmlspecialchars($filme['categoria_nome']) ?>
            <?php endif; ?>
            <?php if (!empty($filme['ano'])): ?>
                • <?= $filme['ano'] ?>
            <?php endif; ?>
        </p>

        <p class="nota-media">
            <span class="nota"><?= $media['media'] ? number_format($media['media'], 1, ',', '') : '—' ?></span>
            <span class="nota-label">de 5</span>
        </p>

        <p><?= nl2br(htmlspecialchars($filme['descricao'] ?? '')) ?></p>

        <?php if (!empty($_SESSION['usuario_id'])): ?>
            <form method="POST" action="<?= BASE_URL ?>/controllers/FavoritoController.php">
                <input type="hidden" name="action" value="<?= $jaEhFavorito ? 'remover' : 'adicionar' ?>">
                <input type="hidden" name="filme_id" value="<?= $filme_id ?>">
                <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                <?php if ($jaEhFavorito): ?>
                    <button type="submit" class="secundario">✓ Na sua lista — Remover</button>
                <?php else: ?>
                    <button type="submit">+ Adicionar à Lista</button>
                <?php endif; ?>
            </form>
        <?php endif; ?>
    </div>
</main>

<section class="interacoes">
    <hr>
    <?php if (!empty($_SESSION['usuario_id'])): ?>
        <?php include __DIR__ . '/../avaliacao/form.php'; ?>
    <?php else: ?>
        <p class="aviso-inline">
            <a href="<?= BASE_URL ?>/controllers/LoginController.php?action=index">Faça login</a>
            para avaliar e favoritar este filme.
        </p>
    <?php endif; ?>
    <hr>
    <?php include __DIR__ . '/../comentarios/index.php'; ?>
</section>

</body>
</html>
