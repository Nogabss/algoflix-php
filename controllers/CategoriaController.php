<?php

require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../helpers/Csrf.php';
require_once __DIR__ . '/../helpers/Aviso.php';
require_once __DIR__ . '/../models/Categoria.php';

class CategoriaController
{
    private $model;

    public function __construct()
    {
        $this->model = new Categoria();
    }

    public function index()
    {
        $categorias = $this->model->listarTodas();
        require __DIR__ . '/../views/categorias/index.php';
    }

  
    public function criar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Csrf::check($_POST['csrf_token'])) {
                Aviso::erro("Token CSRF inválido. Recarregue a página e tente novamente.");
            }

            $this->model->criar($_POST['nome']);

            header("Location: " . BASE_URL . "/controllers/CategoriaController.php?action=index");
            exit;
        }

        $categoria = null;
        require __DIR__ . '/../views/categorias/form.php';
    }

   
    public function editar()
    {
        $id = $_GET['id'] ?? $_POST['id'] ?? 0;
        $categoria = $this->model->buscarPorId($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Csrf::check($_POST['csrf_token'])) {
                Aviso::erro("Token CSRF inválido. Recarregue a página e tente novamente.");
            }

            $this->model->atualizar($id, $_POST['nome']);

            header("Location: " . BASE_URL . "/controllers/CategoriaController.php?action=index");
            exit;
        }

        require __DIR__ . '/../views/categorias/form.php';
    }

    public function excluir()
    {
        if (!Csrf::check($_POST['csrf_token'])) {
            Aviso::erro("Token CSRF inválido. Recarregue a página e tente novamente.");
        }

        $this->model->excluir($_POST['id']);

        header("Location: " . BASE_URL . "/controllers/CategoriaController.php?action=index");
        exit;
    }
}

if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    $controller = new CategoriaController();
    $action = $_REQUEST['action'] ?? 'index';

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        Aviso::erro("Ação inválida.");
    }
}