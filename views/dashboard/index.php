<?php
require_once __DIR__ . '/../../config/session.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Algoflix</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="pagina-cabecalho">
    <h1>Dashboard</h1>
    <div class="toolbar-admin">
        <a href="<?= BASE_URL ?>/controllers/FilmeController.php?action=criar" class="botao-acao">+ Novo filme</a>
        <a href="<?= BASE_URL ?>/controllers/CategoriaController.php?action=index" class="botao-acao secundario">Gerenciar categorias</a>
    </div>
</div>

<main>
    <section class="cards-dashboard">
        <article class="card-dash">
            <h3>Usuários</h3>
            <p class="numero"><?= (int) $dados['usuarios'] ?></p>
        </article>

        <article class="card-dash">
            <h3>Filmes</h3>
            <p class="numero"><?= (int) $dados['filmes'] ?></p>
        </article>

        <article class="card-dash">
            <h3>Comentários</h3>
            <p class="numero"><?= (int) $dados['comentarios'] ?></p>
        </article>

        <article class="card-dash">
            <h3>Avaliações</h3>
            <p class="numero"><?= (int) $dados['avaliacoes'] ?></p>
        </article>

        <article class="card-dash">
            <h3>Favoritos</h3>
            <p class="numero"><?= (int) $dados['favoritos'] ?></p>
        </article>

        <article class="card-dash">
            <h3>Visualizações</h3>
            <p class="numero"><?= (int) $dados['visualizacoes'] ?></p>
        </article>
    </section>
</main>

</body>
</html>
