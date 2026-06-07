<?php

require_once __DIR__ . '/../config/Database.php';

class Categoria
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function listarTodas()
    {
        $sql = "SELECT * FROM categorias ORDER BY nome ASC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM categorias WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($nome)
    {
        $sql = "INSERT INTO categorias (nome) VALUES (:nome)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([':nome' => $nome]);
    }

    public function atualizar($id, $nome)
    {
        $sql = "UPDATE categorias SET nome = :nome WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nome' => $nome,
            ':id'   => $id
        ]);
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM categorias WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([':id' => $id]);
    }
}
