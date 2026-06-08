<?php
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../helpers/Csrf.php';
?>

<h2>Comentários</h2>

<?php if (!empty($_SESSION['usuario_id'])): ?>
    <form method="POST" action="<?= BASE_URL ?>/controllers/ComentarioController.php">
        <input type="hidden" name="action" value="adicionar">
        <input type="hidden" name="filme_id" value="<?= $filme_id ?>">
        <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">

        <textarea name="comentario" placeholder="Escreva seu comentário..." required></textarea>
        <button>Enviar</button>
    </form>
<?php else: ?>
    <p class="aviso-inline">
        <a href="<?= BASE_URL ?>/controllers/LoginController.php?action=index">Faça login</a>
        para deixar um comentário.
    </p>
<?php endif; ?>

<hr>

<?php if (empty($comentarios)): ?>
    <p class="vazio">Ainda não há comentários. Seja o primeiro!</p>
<?php endif; ?>

<?php foreach ($comentarios as $c): ?>
    <div class="comentario">
        <b><?= htmlspecialchars($c['nome']) ?></b>
        <small><?= $c['data_comentario'] ?></small>
        <p><?= htmlspecialchars($c['comentario']) ?></p>
    </div>
<?php endforeach; ?>