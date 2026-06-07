<?php
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../helpers/Csrf.php';

// Se $filme não for null, estamos editando. Se for null, estamos criando.
$editando = !empty($filme);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $editando ? 'Editar' : 'Novo' ?> filme</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<header class="topo">
    <a href="<?= BASE_URL ?>/controllers/FilmeController.php?action=index">← Voltar</a>
</header>

<main class="form-container">
    <h1><?= $editando ? 'Editar filme' : 'Novo filme' ?></h1>

    <form method="POST" action="<?= BASE_URL ?>/controllers/FilmeController.php">
        <input type="hidden" name="action" value="<?= $editando ? 'editar' : 'criar' ?>">
        <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">

        <?php if ($editando): ?>
            <input type="hidden" name="id" value="<?= $filme['id'] ?>">
        <?php endif; ?>

        <label>Título
            <input type="text" name="titulo" required
                   value="<?= htmlspecialchars($filme['titulo'] ?? '') ?>">
        </label>

        <label>Descrição
            <textarea name="descricao"><?= htmlspecialchars($filme['descricao'] ?? '') ?></textarea>
        </label>

        <label>Capa (URL da imagem)
            <input type="text" name="capa"
                   value="<?= htmlspecialchars($filme['capa'] ?? '') ?>">
        </label>

        <label>Ano
            <input type="number" name="ano"
                   value="<?= htmlspecialchars($filme['ano'] ?? '') ?>">
        </label>

        <label>Tipo
            <select name="tipo">
                <option value="filme">Filme</option>
                <option value="serie"
                    <?= (($filme['tipo'] ?? '') === 'serie') ? 'selected' : '' ?>>Série</option>
            </select>
        </label>

        <label>Categoria
            <select name="categoria_id">
                <option value="">-- Sem categoria --</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id'] ?>"
                        <?= (($filme['categoria_id'] ?? '') == $cat['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <button type="submit">Salvar</button>
    </form>
</main>

</body>
</html>
