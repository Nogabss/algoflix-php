<?php
require_once '../config.php';
require_once '../models/UserModel.php';

$userModel = new UserModel($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) die("CSRF Inválido.");

    $cpf = $_POST['cpf'];
    $data_nasc = $_POST['data_nascimento'];
    $nova_senha = $_POST['nova_senha'];

    if ($userModel->atualizarSenha($cpf, $data_nasc, $nova_senha)) {
        echo "Senha atualizada com sucesso! <a href='../views/login.php'>Faça login</a>";
    } else {
        echo "Dados incorretos. CPF ou Data de Nascimento não conferem. <a href='../views/recuperar_senha.php'>Voltar</a>";
    }
}
?>
