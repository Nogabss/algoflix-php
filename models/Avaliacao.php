<?php

require_once __DIR__ . '/../config/Database.php';

class Avaliacao
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function salvar($usuario_id, $filme_id, $nota)
    {
        $sql = "INSERT INTO avaliacoes (usuario_id, filme_id, nota)
                VALUES (:usuario, :filme, :nota)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':usuario' => $usuario_id,
            ':filme' => $filme_id,
            ':nota' => $nota
        ]);
    }

    public function media($filme_id)
    {
        $sql = "SELECT AVG(nota) as media
                FROM avaliacoes
                WHERE filme_id = :filme";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':filme' => $filme_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}