<?php
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../helpers/Csrf.php';
require_once __DIR__ . '/../../models/Comentario.php';

$model = new Comentario();
$comentarios = $model->listar($filme_id);
?>

<h2>💬 Comentários</h2>

<!-- Formulário -->
<form method="POST" action="<?= BASE_URL ?>/controllers/ComentarioController.php">
    <input type="hidden" name="filme_id" value="<?= $filme_id ?>">
    <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">

    <textarea name="comentario" placeholder="Escreva seu comentário..." required></textarea>
    <button>Enviar</button>
</form>

<hr>

<!-- Lista -->
<?php foreach ($comentarios as $c): ?>
    <div style="background:#222;color:white;margin:10px;padding:10px;">
        <b><?= htmlspecialchars($c['nome']) ?></b><br>
        <?= htmlspecialchars($c['comentario']) ?>
        <small><?= $c['data_comentario'] ?></small>
    </div>
<?php endforeach; ?>