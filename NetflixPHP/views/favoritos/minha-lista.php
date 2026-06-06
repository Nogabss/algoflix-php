<?php
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../helpers/Csrf.php';
require_once __DIR__ . '/../../models/Favorito.php';

$favorito = new Favorito();
$filmes = $favorito->listar($_SESSION['usuario_id']);
?>

<h1>🎬 Minha Lista</h1>

<div style="display:flex; flex-wrap:wrap; gap:15px;">
    <?php foreach ($filmes as $filme): ?>
        <div style="width:200px; background:#111; color:white; padding:10px;">
            
            <h3><?= $filme['titulo'] ?></h3>

            <form method="POST" action="/controllers/FavoritoController.php">
                <input type="hidden" name="filme_id" value="<?= $filme['id'] ?>">
                <input type="hidden" name="csrf_token" value="<?= Csrf::token() ?>">
                <button name="action" value="remover">❌ Remover</button>
            </form>

        </div>
    <?php endforeach; ?>
</div>