<?php

require_once __DIR__ . '/../config/Database.php';

class Historico
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function registrar($usuario_id, $filme_id)
    {
        $sql = "INSERT INTO historico_visualizacao (usuario_id, filme_id)
                VALUES (:usuario, :filme)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':usuario' => $usuario_id,
            ':filme' => $filme_id
        ]);
    }

    public function listar($usuario_id)
    {
        $sql = "SELECT h.*, f.titulo
                FROM historico_visualizacao h
                JOIN filmes f ON f.id = h.filme_id
                WHERE h.usuario_id = :usuario
                ORDER BY h.id DESC";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([':usuario' => $usuario_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}