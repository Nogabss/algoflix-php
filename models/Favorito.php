<?php

require_once __DIR__ . '/../config/Database.php';

class Favorito
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function adicionar($usuario_id, $filme_id)
    {
        $sql = "INSERT INTO favoritos (usuario_id, filme_id)
                VALUES (:usuario, :filme)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':usuario' => $usuario_id,
            ':filme' => $filme_id
        ]);
    }

    public function remover($usuario_id, $filme_id)
    {
        $sql = "DELETE FROM favoritos
                WHERE usuario_id = :usuario
                AND filme_id = :filme";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':usuario' => $usuario_id,
            ':filme' => $filme_id
        ]);
    }

    public function existe($usuario_id, $filme_id)
    {
        $sql = "SELECT 1 FROM favoritos
                WHERE usuario_id = :usuario AND filme_id = :filme
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':usuario' => $usuario_id,
            ':filme'   => $filme_id
        ]);

        return (bool) $stmt->fetchColumn();
    }

    public function listar($usuario_id)
    {
        $sql = "SELECT f.*
                FROM favoritos fav
                JOIN filmes f ON f.id = fav.filme_id
                WHERE fav.usuario_id = :usuario";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([':usuario' => $usuario_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}