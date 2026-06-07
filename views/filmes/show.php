<?php
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../helpers/Csrf.php';
require_once __DIR__ . '/../../models/Comentario.php';
require_once __DIR__ . '/../../models/Avaliacao.php';

$filme_id = $_GET['id'] ?? 1;

$comentarioModel = new Comentario();
$avaliacaoModel = new Avaliacao();

$comentarios = $comentarioModel->listar($filme_id);
$media = $avaliacaoModel->media($filme_id);
?>

<h1>🎬 Página do Filme</h1>

<h2>⭐ Média: <?= round($media['media'], 1) ?? "0" ?></h2>

<!-- FAVORITAR -->
<form method="POST" action="/controllers/FavoritoController.php">
    <input type="hidden" name="filme_id" value="<?= $filme_id ?>">
    <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
    <button name="action" value="adicionar">➕ Minha Lista</button>
</form>

<hr>

<!-- AVALIAÇÃO -->
<?php include __DIR__ . '/../avaliacao/form.php'; ?>

<hr>

<!-- COMENTÁRIOS -->
<?php include __DIR__ . '/../comentarios/index.php'; ?>