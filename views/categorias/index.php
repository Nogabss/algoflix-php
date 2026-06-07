<?php
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../helpers/Csrf.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Categorias - Algoflix</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<header class="topo">
    <a href="<?= BASE_URL ?>/controllers/FilmeController.php?action=index">← Catálogo</a>
    <a href="<?= BASE_URL ?>/controllers/CategoriaController.php?action=criar">+ Nova categoria</a>
</header>

<main>
    <h1>Categorias</h1>
    <table class="tabela">
        <thead><tr><th>ID</th><th>Nome</th><th>Ações</th></tr></thead>
        <tbody>
        <?php foreach ($categorias as $c): ?>
            <tr>
                <td><?= (int)$c['id'] ?></td>
                <td><?= htmlspecialchars($c['nome']) ?></td>
                <td>
                    <a href="<?= BASE_URL ?>/controllers/CategoriaController.php?action=editar&id=<?= (int)$c['id'] ?>">Editar</a>
                    <form method="POST" action="<?= BASE_URL ?>/controllers/CategoriaController.php" style="display:inline"
                          onsubmit="return confirm('Excluir esta categoria?');">
                        <input type="hidden" name="action" value="excluir">
                        <input type="hidden" name="id" value="<?= (int)$c['id'] ?>">
                        <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>

</body>
</html>
