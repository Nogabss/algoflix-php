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

    // Lista todas as categorias
    public function index()
    {
        $categorias = $this->model->listarTodas();
        require __DIR__ . '/../views/categorias/index.php';
    }

    // Mostra formulário e salva nova categoria
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

    // Mostra formulário e salva edição
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

    // Exclui uma categoria
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

// Só executa quando o arquivo é chamado direto pelo navegador
if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    $controller = new CategoriaController();
    $action = $_REQUEST['action'] ?? 'index';

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        Aviso::erro("Ação inválida.");
    }
}
