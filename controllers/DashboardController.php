<?php

require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../helpers/Aviso.php';

class DashboardController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function index()
    {
        if (empty($_SESSION['is_admin'])) {
            Aviso::erro(
                "Esta área é restrita ao administrador.",
                BASE_URL . "/index.php",
                "Voltar ao início"
            );
        }

        $dados = [
            "usuarios"      => $this->count("usuarios"),
            "filmes"        => $this->count("filmes"),
            "comentarios"   => $this->count("comentarios"),
            "avaliacoes"    => $this->count("avaliacoes"),
            "favoritos"     => $this->count("favoritos"),
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

if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    $controller = new DashboardController();
    $action = $_REQUEST['action'] ?? 'index';

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        Aviso::erro("Ação inválida.");
    }
}
