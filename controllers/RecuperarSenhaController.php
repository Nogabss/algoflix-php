<?php

require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../helpers/Csrf.php';
require_once __DIR__ . '/../helpers/Aviso.php';
require_once __DIR__ . '/../models/UserModel.php';

class RecuperarSenhaController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function index()
    {
        require __DIR__ . '/../views/recuperar_senha.php';
    }

    public function atualizar()
    {
        if (!Csrf::check($_POST['csrf_token'])) {
            Aviso::erro("Token CSRF inválido. Recarregue a página e tente novamente.");
        }

        $cpf        = $_POST['cpf'];
        $data_nasc  = $_POST['data_nascimento'];
        $nova_senha = $_POST['nova_senha'];

        if (empty($cpf) || empty($data_nasc) || empty($nova_senha)) {
            Aviso::erro(
                "Todos os campos são obrigatórios.",
                BASE_URL . "/controllers/RecuperarSenhaController.php?action=index",
                "Voltar"
            );
        }

        if ($this->model->atualizarSenha($cpf, $data_nasc, $nova_senha)) {
            Aviso::sucesso(
                "Sua senha foi atualizada com sucesso!",
                BASE_URL . "/controllers/LoginController.php?action=index",
                "Fazer login"
            );
        }

        Aviso::erro(
            "Dados incorretos. CPF ou data de nascimento não conferem.",
            BASE_URL . "/controllers/RecuperarSenhaController.php?action=index",
            "Tentar novamente"
        );
    }
}

if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    $controller = new RecuperarSenhaController();
    $action = $_REQUEST['action'] ?? 'index';

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        Aviso::erro("Ação inválida.");
    }
}
