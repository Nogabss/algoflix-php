<?php

require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../helpers/Csrf.php';
require_once __DIR__ . '/../models/Comentario.php';

class ComentarioController
{
    private $model;

    public function __construct()
    {
        $this->model = new Comentario();
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
        $comentario = trim($_POST['comentario']);

        if (strlen($comentario) < 2) {
            die("Comentário muito curto");
        }

        $this->model->adicionar($usuario, $filme, $comentario);

        header("Location: /filme.php?id=" . $filme);
        exit;
    }
}