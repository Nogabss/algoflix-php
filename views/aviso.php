<?php
require_once __DIR__ . '/../config/session.php';

// Variáveis esperadas:
//   $mensagem    (string) — texto principal
//   $tipo        ('erro' | 'sucesso') — define a cor
//   $voltarUrl   (string|null) — para onde o botão volta
//   $voltarTexto (string) — texto do botão
$tipo        = $tipo ?? 'erro';
$voltarUrl   = $voltarUrl ?? BASE_URL . '/index.php';
$voltarTexto = $voltarTexto ?? 'Voltar ao início';
$titulo      = $tipo === 'sucesso' ? 'Sucesso' : 'Atenção';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $titulo ?> - Algoflix</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<header class="topo-simples">
    <a href="<?= BASE_URL ?>/index.php" class="marca">algoflix</a>
</header>

<main class="aviso-container">
    <div class="aviso aviso-<?= $tipo ?>">
        <h2><?= $titulo ?></h2>
        <p><?= htmlspecialchars($mensagem) ?></p>
        <a href="<?= $voltarUrl ?>" class="botao-voltar"><?= htmlspecialchars($voltarTexto) ?></a>
    </div>
</main>

</body>
</html>
