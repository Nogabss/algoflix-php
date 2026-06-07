<?php
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../helpers/Csrf.php';
require_once __DIR__ . '/../../models/Avaliacao.php';

// $filme já vem do FilmeController::detalhes()
$filme_id = $filme['id'];
$media = (new Avaliacao())->media($filme_id);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($filme['titulo']) ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<header class="topo">
    <a href="<?= BASE_URL ?>/controllers/FilmeController.php?action=index">← Voltar ao catálogo</a>
</header>

<main class="detalhes">
    <div class="capa-grande">
        <?php if (!empty($filme['capa'])): ?>
            <img src="<?= htmlspecialchars($filme['capa']) ?>" alt="">
        <?php else: ?>
            <div class="capa-placeholder grande">🎞️</div>
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

        <h2>⭐ Média: <?= $media['media'] ? round($media['media'], 1) : '0' ?></h2>

        <p><?= nl2br(htmlspecialchars($filme['descricao'] ?? '')) ?></p>

        <?php if (!empty($_SESSION['usuario_id'])): ?>
            <!-- Botão para favoritar -->
            <form method="POST" action="<?= BASE_URL ?>/controllers/FavoritoController.php">
                <input type="hidden" name="action" value="adicionar">
                <input type="hidden" name="filme_id" value="<?= $filme_id ?>">
                <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                <button type="submit">➕ Minha Lista</button>
            </form>
        <?php endif; ?>
    </div>
</main>

<section class="interacoes">
    <?php if (!empty($_SESSION['usuario_id'])): ?>
        <hr>
        <?php include __DIR__ . '/../avaliacao/form.php'; ?>
    <?php endif; ?>
    <hr>
    <?php include __DIR__ . '/../comentarios/index.php'; ?>
</section>

</body>
</html>
