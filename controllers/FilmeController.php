<?php

require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../helpers/Csrf.php';
require_once __DIR__ . '/../models/Filme.php';

class FilmeController
{
    private $model;

    public function __construct()
    {
        $this->model = new Filme();
    }

    // Mostra a lista de todos os filmes
    public function index()
    {
        $filmes = $this->model->listarTodos();
        require __DIR__ . '/../views/filmes/index.php';
    }

    // Mostra a página de um filme
    public function detalhes()
    {
        $id = $_GET['id'] ?? 0;
        $filme = $this->model->buscarPorId($id);

        if (!$filme) {
            echo "Filme não encontrado.";
            return;
        }

        require __DIR__ . '/../views/filmes/detalhes.php';
    }

    // Mostra os filmes de uma categoria
    public function porCategoria()
    {
        $categoria_id = $_GET['categoria_id'] ?? 0;
        $filmes = $this->model->listarPorCategoria($categoria_id);
        require __DIR__ . '/../views/filmes/index.php';
    }

    // Busca por título
    public function busca()
    {
        $termo = $_GET['q'] ?? '';
        $filmes = $this->model->buscar($termo);
        require __DIR__ . '/../views/filmes/busca.php';
    }

    // Mostra formulário e salva novo filme
    public function criar()
    {
        $this->exigirAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Csrf::check($_POST['csrf_token'])) {
                die("CSRF inválido");
            }

            // Validação simples: título é obrigatório
            if (empty(trim($_POST['titulo']))) {
                die("O título é obrigatório.");
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

    // Mostra formulário e salva edição
    public function editar()
    {
        $this->exigirAdmin();

        $id = $_GET['id'] ?? $_POST['id'] ?? 0;
        $filme = $this->model->buscarPorId($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Csrf::check($_POST['csrf_token'])) {
                die("CSRF inválido");
            }

            if (empty(trim($_POST['titulo']))) {
                die("O título é obrigatório.");
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

    // Exclui um filme
    public function excluir()
    {
        $this->exigirAdmin();

        if (!Csrf::check($_POST['csrf_token'])) {
            die("CSRF inválido");
        }

        $this->model->excluir($_POST['id']);

        header("Location: " . BASE_URL . "/controllers/FilmeController.php?action=index");
        exit;
    }

    // Só admin pode criar/editar/excluir filmes
    private function exigirAdmin()
    {
        if (empty($_SESSION['is_admin'])) {
            die("Acesso restrito ao administrador.");
        }
    }
}

// Só executa a dispatch quando o arquivo é chamado direto pelo navegador
// (não quando outros arquivos fazem require deste controller)
if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    $controller = new FilmeController();
    $action = $_REQUEST['action'] ?? 'index';

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Ação inválida.";
    }
}
