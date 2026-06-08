<?php

require_once __DIR__ . '/../config/Database.php';

class UserModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function cadastrar($nome, $cpf, $data_nasc, $senha, $role = 'usuario')
    {
        $hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nome, cpf, data_nascimento, senha, role)
                VALUES (:nome, :cpf, :data_nasc, :senha, :role)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nome'      => $nome,
            ':cpf'       => $cpf,
            ':data_nasc' => $data_nasc,
            ':senha'     => $hash,
            ':role'      => $role
        ]);
    }

    public function buscarPorCpf($cpf)
    {
        $sql = "SELECT * FROM usuarios WHERE cpf = :cpf";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':cpf' => $cpf]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarSenha($cpf, $data_nasc, $nova_senha)
    {
        $sqlCheck = "SELECT id FROM usuarios WHERE cpf = :cpf AND data_nascimento = :data_nasc";
        $stmtCheck = $this->pdo->prepare($sqlCheck);
        $stmtCheck->execute([
            ':cpf'       => $cpf,
            ':data_nasc' => $data_nasc
        ]);

        if (!$stmtCheck->fetch()) {
            return false;
        }

        $hash = password_hash($nova_senha, PASSWORD_DEFAULT);
        $sqlUpdate = "UPDATE usuarios SET senha = :senha WHERE cpf = :cpf";
        $stmtUpdate = $this->pdo->prepare($sqlUpdate);

        return $stmtUpdate->execute([
            ':senha' => $hash,
            ':cpf'   => $cpf
        ]);
    }
}
