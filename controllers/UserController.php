<?php
require_once '../config.php';
require_once '../models/UserModel.php';

$userModel = new UserModel($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) die("CSRF Inválido.");

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $data_nasc = $_POST['data_nascimento'];
    $senha = $_POST['senha'];
    $role = $_POST['role'] ?? 'usuario';

    if ($userModel->cadastrar($nome, $cpf, $data_nasc, $senha, $role)) {
        header("Location: ../views/login.php");
        exit;
    } else {
        echo "Erro ao cadastrar. CPF pode já existir. <a href='../views/cadastro.php'>Voltar</a>";
    }
}
?>
