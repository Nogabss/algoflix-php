<?php

require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../helpers/Csrf.php';
require_once __DIR__ . '/../helpers/Aviso.php';
require_once __DIR__ . '/../models/UserModel.php';

class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function index()
    {
        require __DIR__ . '/../views/cadastro.php';
    }

    public function perfil()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: " . BASE_URL . "/controllers/LoginController.php?action=index");
            exit;
        }

        require __DIR__ . '/../views/perfil.php';
    }

    public function cadastrar()
    {
        if (!Csrf::check($_POST['csrf_token'])) {
            Aviso::erro("Token CSRF inválido. Recarregue a página e tente novamente.");
        }

        $nome      = $_POST['nome'];
        $cpf       = $_POST['cpf'];
        $data_nasc = $_POST['data_nascimento'];
        $senha     = $_POST['senha'];

        if (empty(trim($nome)) || empty(trim($cpf)) || empty($senha)) {
            Aviso::erro(
                "Todos os campos são obrigatórios.",
                BASE_URL . "/controllers/UserController.php?action=index",
                "Voltar ao cadastro"
            );
        }

        $role = 'usuario';

        if ($this->model->cadastrar($nome, $cpf, $data_nasc, $senha, $role)) {
            header("Location: " . BASE_URL . "/controllers/LoginController.php?action=index");
            exit;
        }

        Aviso::erro(
            "Não foi possível cadastrar. Esse CPF talvez já esteja em uso.",
            BASE_URL . "/controllers/UserController.php?action=index",
            "Voltar ao cadastro"
        );
    }
}

if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    $controller = new UserController();
    $action = $_REQUEST['action'] ?? 'index';

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        Aviso::erro("Ação inválida.");
    }
}
