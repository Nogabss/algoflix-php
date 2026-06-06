<?php
require_once __DIR__ . '/../../helpers/Csrf.php';
?>

<h2>⭐ Avaliar Filme</h2>

<form method="POST" action="/controllers/AvaliacaoController.php">

    <input type="hidden" name="filme_id" value="<?= $filme_id ?>">
    <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">

    <label>Nota:</label>
    <select name="nota">
        <option value="1">⭐</option>
        <option value="2">⭐⭐</option>
        <option value="3">⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="5">⭐⭐⭐⭐⭐</option>
    </select>

    <button>Enviar avaliação</button>
</form>