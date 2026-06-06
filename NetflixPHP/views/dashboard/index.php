<h1>📊 Dashboard Admin Netflix</h1>

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;">

    <div style="background:#111;color:white;padding:20px;">
        <h3>👤 Usuários</h3>
        <p><?= $dados['usuarios'] ?></p>
    </div>

    <div style="background:#111;color:white;padding:20px;">
        <h3>🎬 Filmes</h3>
        <p><?= $dados['filmes'] ?></p>
    </div>

    <div style="background:#111;color:white;padding:20px;">
        <h3>💬 Comentários</h3>
        <p><?= $dados['comentarios'] ?></p>
    </div>

    <div style="background:#111;color:white;padding:20px;">
        <h3>⭐ Avaliações</h3>
        <p><?= $dados['avaliacoes'] ?></p>
    </div>

    <div style="background:#111;color:white;padding:20px;">
        <h3>❤️ Favoritos</h3>
        <p><?= $dados['favoritos'] ?></p>
    </div>

</div>