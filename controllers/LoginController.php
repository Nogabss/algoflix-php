<?php
require_once '../config.php';
require_once '../models/UserModel.php';

$userModel = new UserModel($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação CSRF
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Token CSRF inválido.");
    }

    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $usuario = $userModel->buscarPorCpf($cpf);

    // Valida a senha usando password_verify
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_role'] = $usuario['role']; // Controle de permissão (admin x usuario)

        // Implementação do Cookie "Lembrar-me" (Dura 30 dias)
        if (isset($_POST['lembrar'])) {
            setcookie('lembrar_usuario', $usuario['cpf'], time() + (86400 * 30), "/");
        }

        header("Location: ../views/perfil.php");
        exit;
    } else {
        echo "CPF ou senha incorretos! <a href='../views/login.php'>Tentar novamente</a>";
    }
}
?>
