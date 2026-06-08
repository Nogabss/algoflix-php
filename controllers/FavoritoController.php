<?php

require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../helpers/Csrf.php';
require_once __DIR__ . '/../helpers/Aviso.php';
require_once __DIR__ . '/../models/Favorito.php';

class FavoritoController
{
    private $model;

    public function __construct()
    {
        $this->model = new Favorito();
    }

    public function lista()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: " . BASE_URL . "/login.php");
            exit;
        }

        $filmes = $this->model->listar($_SESSION['usuario_id']);
        require __DIR__ . '/../views/favoritos/minha-lista.php';
    }

    public function adicionar()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: " . BASE_URL . "/login.php");
            exit;
        }

        if (!Csrf::check($_POST['csrf_token'])) {
            Aviso::erro("Token CSRF inválido. Recarregue a página e tente novamente.");
        }

        $usuario = $_SESSION['usuario_id'];
        $filme = $_POST['filme_id'];

        $this->model->adicionar($usuario, $filme);

        header("Location: " . BASE_URL . "/controllers/FavoritoController.php?action=lista");
        exit;
    }

    public function remover()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: " . BASE_URL . "/login.php");
            exit;
        }

        if (!Csrf::check($_POST['csrf_token'])) {
            Aviso::erro("Token CSRF inválido. Recarregue a página e tente novamente.");
        }

        $usuario = $_SESSION['usuario_id'];
        $filme = $_POST['filme_id'];

        $this->model->remover($usuario, $filme);

        header("Location: " . BASE_URL . "/controllers/FavoritoController.php?action=lista");
        exit;
    }
}

if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    $controller = new FavoritoController();
    $action = $_REQUEST['action'] ?? 'lista';

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        Aviso::erro("Ação inválida.");
    }
}
