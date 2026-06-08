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

<?php include __DIR__ . '/views/partials/header.php'; ?>

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
                                <div class="capa-placeholder"></div>
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
