<?php

require_once __DIR__ . '/../config/Database.php';

class Filme
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    // Lista todos os filmes, junto com o nome da categoria
    public function listarTodos()
    {
        $sql = "SELECT f.*, c.nome AS categoria_nome
                FROM filmes f
                LEFT JOIN categorias c ON c.id = f.categoria_id
                ORDER BY f.id DESC";

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Busca um filme pelo id
    public function buscarPorId($id)
    {
        $sql = "SELECT f.*, c.nome AS categoria_nome
                FROM filmes f
                LEFT JOIN categorias c ON c.id = f.categoria_id
                WHERE f.id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lista filmes de uma categoria
    public function listarPorCategoria($categoria_id)
    {
        $sql = "SELECT f.*, c.nome AS categoria_nome
                FROM filmes f
                LEFT JOIN categorias c ON c.id = f.categoria_id
                WHERE f.categoria_id = :cat";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':cat' => $categoria_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Procura pelo título
    public function buscar($termo)
    {
        $sql = "SELECT f.*, c.nome AS categoria_nome
                FROM filmes f
                LEFT JOIN categorias c ON c.id = f.categoria_id
                WHERE f.titulo LIKE :q";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':q' => '%' . $termo . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cria um novo filme
    public function criar($titulo, $descricao, $capa, $ano, $tipo, $categoria_id)
    {
        $sql = "INSERT INTO filmes (titulo, descricao, capa, ano, tipo, categoria_id)
                VALUES (:titulo, :descricao, :capa, :ano, :tipo, :categoria_id)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':titulo'       => $titulo,
            ':descricao'    => $descricao,
            ':capa'         => $capa,
            ':ano'          => $ano,
            ':tipo'         => $tipo,
            ':categoria_id' => $categoria_id
        ]);
    }

    // Atualiza um filme existente
    public function atualizar($id, $titulo, $descricao, $capa, $ano, $tipo, $categoria_id)
    {
        $sql = "UPDATE filmes
                SET titulo = :titulo,
                    descricao = :descricao,
                    capa = :capa,
                    ano = :ano,
                    tipo = :tipo,
                    categoria_id = :categoria_id
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':titulo'       => $titulo,
            ':descricao'    => $descricao,
            ':capa'         => $capa,
            ':ano'          => $ano,
            ':tipo'         => $tipo,
            ':categoria_id' => $categoria_id,
            ':id'           => $id
        ]);
    }

    // Exclui um filme
    public function excluir($id)
    {
        $sql = "DELETE FROM filmes WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
