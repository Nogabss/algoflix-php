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
            header("Location: /login.php");
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

        header("Location: /filme.php?id=" . $filme);
        exit;
    }
}