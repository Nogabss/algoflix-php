<?php

require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../helpers/Csrf.php';
require_once __DIR__ . '/../helpers/Aviso.php';
require_once __DIR__ . '/../models/Filme.php';

class FilmeController
{
    private $model;

    public function __construct()
    {
        $this->model = new Filme();
    }

    public function index()
    {
        $filmes = $this->model->listarTodos();
        require __DIR__ . '/../views/filmes/index.php';
    }

    public function detalhes()
    {
        $id = $_GET['id'] ?? 0;
        $filme = $this->model->buscarPorId($id);

        if (!$filme) {
            Aviso::erro("Filme não encontrado.", BASE_URL . "/controllers/FilmeController.php?action=index", "Voltar ao catálogo");
        }

        require __DIR__ . '/../views/filmes/detalhes.php';
    }

    public function porCategoria()
    {
        $categoria_id = $_GET['categoria_id'] ?? 0;
        $filmes = $this->model->listarPorCategoria($categoria_id);
        require __DIR__ . '/../views/filmes/index.php';
    }

    public function busca()
    {
        $termo = $_GET['q'] ?? '';
        $filmes = $this->model->buscar($termo);
        require __DIR__ . '/../views/filmes/busca.php';
    }

    public function criar()
    {
        $this->exigirAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Csrf::check($_POST['csrf_token'])) {
                Aviso::erro("Token CSRF inválido. Recarregue a página e tente novamente.");
            }

            if (empty(trim($_POST['titulo']))) {
                Aviso::erro("O título do filme é obrigatório.");
            }

            if (empty($_POST['categoria_id'])) {
                Aviso::erro("A categoria é obrigatória.");
            }

            $this->model->criar(
                $_POST['titulo'],
                $_POST['descricao'],
                $_POST['capa'],
                $_POST['ano'],
                $_POST['tipo'],
                $_POST['categoria_id']
            );

            header("Location: " . BASE_URL . "/controllers/FilmeController.php?action=index");
            exit;
        }

        require_once __DIR__ . '/../models/Categoria.php';
        $categorias = (new Categoria())->listarTodas();
        $filme = null;

        require __DIR__ . '/../views/filmes/form.php';
    }

    public function editar()
    {
        $this->exigirAdmin();

        $id = $_GET['id'] ?? $_POST['id'] ?? 0;
        $filme = $this->model->buscarPorId($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Csrf::check($_POST['csrf_token'])) {
                Aviso::erro("Token CSRF inválido. Recarregue a página e tente novamente.");
            }

            if (empty(trim($_POST['titulo']))) {
                Aviso::erro("O título do filme é obrigatório.");
            }

            if (empty($_POST['categoria_id'])) {
                Aviso::erro("A categoria é obrigatória.");
            }

            $this->model->atualizar(
                $id,
                $_POST['titulo'],
                $_POST['descricao'],
                $_POST['capa'],
                $_POST['ano'],
                $_POST['tipo'],
                $_POST['categoria_id']
            );

            header("Location: " . BASE_URL . "/controllers/FilmeController.php?action=index");
            exit;
        }

        require_once __DIR__ . '/../models/Categoria.php';
        $categorias = (new Categoria())->listarTodas();

        require __DIR__ . '/../views/filmes/form.php';
    }

    public function excluir()
    {
        $this->exigirAdmin();

        if (!Csrf::check($_POST['csrf_token'])) {
            Aviso::erro("Token CSRF inválido. Recarregue a página e tente novamente.");
        }

        $this->model->excluir($_POST['id']);

        header("Location: " . BASE_URL . "/controllers/FilmeController.php?action=index");
        exit;
    }

    private function exigirAdmin()
    {
        if (empty($_SESSION['is_admin'])) {
            Aviso::erro(
                "Esta área é restrita ao administrador.",
                BASE_URL . "/index.php",
                "Voltar ao início"
            );
        }
    }
}

if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    $controller = new FilmeController();
    $action = $_REQUEST['action'] ?? 'index';

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        Aviso::erro("Ação inválida.");
    }
}