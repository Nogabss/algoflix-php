<?php

require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../helpers/Csrf.php';
require_once __DIR__ . '/../models/Avaliacao.php';

class AvaliacaoController
{
    private $model;

    public function __construct()
    {
        $this->model = new Avaliacao();
    }

    public function salvar()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: " . BASE_URL . "/login.php");
            exit;
        }

        if (!Csrf::check($_POST['csrf_token'])) {
            die("CSRF inválido");
        }

        $usuario = $_SESSION['usuario_id'];
        $filme = $_POST['filme_id'];
        $nota = (int) $_POST['nota'];

        if ($nota < 1 || $nota > 5) {
            die("Nota inválida");
        }

        $this->model->salvar($usuario, $filme, $nota);

        header("Location: " . BASE_URL . "/controllers/FilmeController.php?action=detalhes&id=" . $filme);
        exit;
    }
}

// Roteia ?action=... quando o controller é chamado direto
if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    $controller = new AvaliacaoController();
    $action = $_REQUEST['action'] ?? 'salvar';

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Ação inválida.";
    }
}
