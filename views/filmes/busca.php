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

<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="pagina-cabecalho">
    <h1>Resultados para "<?= htmlspecialchars($termo) ?>"</h1>
</div>

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
                    <div class="capa-placeholder"></div>
                <?php endif; ?>
                <h3><?= htmlspecialchars($f['titulo']) ?></h3>
            </a>
            <p class="meta"><?= htmlspecialchars($f['categoria_nome'] ?? '') ?></p>
        </article>
    <?php endforeach; ?>
</main>

</body>
</html>
