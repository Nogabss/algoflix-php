<?php
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../helpers/Csrf.php';

$isEdicao = !empty($categoria);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $isEdicao ? 'Editar' : 'Nova' ?> categoria</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<header class="topo">
    <a href="<?= BASE_URL ?>/controllers/CategoriaController.php?action=index">← Voltar</a>
</header>

<main class="form-container">
    <h1><?= $isEdicao ? 'Editar categoria' : 'Nova categoria' ?></h1>

    <?php if (!empty($erro)): ?>
        <p class="erro"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>/controllers/CategoriaController.php">
        <input type="hidden" name="action" value="<?= $isEdicao ? 'editar' : 'criar' ?>">
        <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
        <?php if ($isEdicao): ?>
            <input type="hidden" name="id" value="<?= (int)$categoria['id'] ?>">
        <?php endif; ?>

        <label>Nome
            <input type="text" name="nome" required
                   value="<?= htmlspecialchars($categoria['nome'] ?? '') ?>">
        </label>

        <button type="submit"><?= $isEdicao ? 'Salvar' : 'Cadastrar' ?></button>
    </form>
</main>

</body>
</html>
