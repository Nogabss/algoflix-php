<?php

require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../helpers/Csrf.php';
require_once __DIR__ . '/../models/Favorito.php';

class FavoritoController
{
    private $model;

    public function __construct()
    {
        $this->model = new Favorito();
    }

    public function adicionar()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /login.php");
            exit;
        }

        if (!Csrf::check($_POST['csrf_token'])) {
            die("CSRF inválido");
        }

        $usuario = $_SESSION['usuario_id'];
        $filme = $_POST['filme_id'];

        $this->model->adicionar($usuario, $filme);

        header("Location: /minha-lista.php");
        exit;
    }

    public function remover()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /login.php");
            exit;
        }

        if (!Csrf::check($_POST['csrf_token'])) {
            die("CSRF inválido");
        }

        $usuario = $_SESSION['usuario_id'];
        $filme = $_POST['filme_id'];

        $this->model->remover($usuario, $filme);

        header("Location: /minha-lista.php");
        exit;
    }
}