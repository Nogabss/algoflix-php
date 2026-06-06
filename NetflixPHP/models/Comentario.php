<?php

require_once __DIR__ . '/../config/Database.php';

class Comentario
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function adicionar($usuario_id, $filme_id, $comentario)
    {
        $sql = "INSERT INTO comentarios (usuario_id, filme_id, comentario)
                VALUES (:usuario, :filme, :comentario)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':usuario' => $usuario_id,
            ':filme' => $filme_id,
            ':comentario' => $comentario
        ]);
    }

    public function listar($filme_id)
    {
        $sql = "SELECT c.*, u.nome
                FROM comentarios c
                JOIN usuarios u ON u.id = c.usuario_id
                WHERE filme_id = :filme
                ORDER BY c.id DESC";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([':filme' => $filme_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}