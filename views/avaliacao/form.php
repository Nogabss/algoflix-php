<?php
require_once __DIR__ . '/../../helpers/Csrf.php';
?>

<h2>Sua avaliação</h2>

<form method="POST" action="<?= BASE_URL ?>/controllers/AvaliacaoController.php" class="form-avaliacao">
    <input type="hidden" name="action" value="salvar">
    <input type="hidden" name="filme_id" value="<?= $filme_id ?>">
    <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">

    <label>Nota:
        <select name="nota">
            <option value="1">⭐</option>
            <option value="2">⭐⭐</option>
            <option value="3" selected>⭐⭐⭐</option>
            <option value="4">⭐⭐⭐⭐</option>
            <option value="5">⭐⭐⭐⭐⭐</option>
        </select>
    </label>

    <button>Enviar avaliação</button>
</form>