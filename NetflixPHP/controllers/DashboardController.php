<?php

require_once __DIR__ . '/../config/Database.php';

class DashboardController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function index()
    {
        // Segurança: só admin pode ver
        if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'admin') {
            header("Location: /");
            exit;
        }

        $dados = [
            "usuarios" => $this->count("usuarios"),
            "filmes" => $this->count("filmes"),
            "comentarios" => $this->count("comentarios"),
            "avaliacoes" => $this->count("avaliacoes"),
            "favoritos" => $this->count("favoritos"),
            "visualizacoes" => $this->count("historico_visualizacao")
        ];

        require_once __DIR__ . '/../views/dashboard/index.php';
    }

    private function count($tabela)
    {
        $sql = "SELECT COUNT(*) FROM $tabela";
        return $this->pdo->query($sql)->fetchColumn();
    }
}