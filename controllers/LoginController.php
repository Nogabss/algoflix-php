<?php

require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../helpers/Csrf.php';
require_once __DIR__ . '/../helpers/Aviso.php';
require_once __DIR__ . '/../models/UserModel.php';

class LoginController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    // Mostra o formulário de login
    public function index()
    {
        require __DIR__ . '/../views/login.php';
    }

    // Processa o login (POST)
    public function entrar()
    {
        if (!Csrf::check($_POST['csrf_token'])) {
            Aviso::erro("Token CSRF inválido. Recarregue a página e tente novamente.");
        }

        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];
        $usuario = $this->model->buscarPorCpf($cpf);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id']   = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_role'] = $usuario['role'];
            $_SESSION['is_admin']     = ($usuario['role'] === 'admin');

            // Cookie "lembrar-me" (30 dias) — guarda o CPF para preencher o form
            if (isset($_POST['lembrar'])) {
                setcookie('lembrar_usuario', $usuario['cpf'], time() + (86400 * 30), '/');
            }

            header("Location: " . BASE_URL . "/index.php");
            exit;
        }

        Aviso::erro(
            "CPF ou senha incorretos. Verifique os dados e tente de novo.",
            BASE_URL . "/controllers/LoginController.php?action=index",
            "Tentar novamente"
        );
    }

    // Logout
    public function sair()
    {
        $_SESSION = [];
        session_destroy();
        setcookie('lembrar_usuario', '', time() - 3600, '/');

        header("Location: " . BASE_URL . "/controllers/LoginController.php?action=index");
        exit;
    }
}

// Roteia ?action=... quando o controller é chamado direto
if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    $controller = new LoginController();
    $action = $_REQUEST['action'] ?? 'index';

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        Aviso::erro("Ação inválida.");
    }
}
