-- ============================================================
-- Algoflix — Banco de dados completo
--
-- Cria o banco, todas as tabelas e popula com dados de teste.
-- Importe este arquivo único no phpMyAdmin (ou via terminal).
--
-- Usuário admin de teste:
--   CPF:   00000000000
--   Senha: 123
-- ============================================================

DROP DATABASE IF EXISTS netflix_db;
CREATE DATABASE netflix_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE netflix_db;

-- ============================================================
-- Tabelas
-- ============================================================

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) UNIQUE,
    data_nascimento DATE,
    email VARCHAR(100),
    senha VARCHAR(255) NOT NULL,
    role ENUM('usuario','admin') NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB;

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE filmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    capa VARCHAR(255),
    ano YEAR,
    duracao INT COMMENT 'em minutos',
    tipo ENUM('filme','serie') NOT NULL DEFAULT 'filme',
    categoria_id INT,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE favoritos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    filme_id INT NOT NULL,
    data_adicionado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (filme_id) REFERENCES filmes(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE avaliacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    filme_id INT NOT NULL,
    nota INT NOT NULL CHECK (nota BETWEEN 1 AND 5),
    data_avaliacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (filme_id) REFERENCES filmes(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    filme_id INT NOT NULL,
    comentario TEXT NOT NULL,
    data_comentario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (filme_id) REFERENCES filmes(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE historico_visualizacao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    filme_id INT NOT NULL,
    data_visualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (filme_id) REFERENCES filmes(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================================
-- Dados de teste
-- ============================================================

INSERT INTO categorias (nome) VALUES
    ('Ação'),
    ('Aventura'),
    ('Animação'),
    ('Comédia'),
    ('Drama'),
    ('Ficção Científica'),
    ('Infantil'),
    ('Documentário');

INSERT INTO filmes (titulo, descricao, tipo, categoria_id) VALUES
    ('Matrix',                          'Filme sobre realidade simulada',          'filme', 6),
    ('Interestelar',                    'Viagem espacial',                         'filme', 6),
    ('Vingadores',                      'Heróis da Marvel',                        'filme', 1),
    ('Ta Chovendo Hambúrguer',          'Chove Hambúrguer',                        'filme', 3),
    ('Smurfs',                          'Um filme sobre Smurfs',                   'filme', 7),
    ('A Fantástica Fábrica de Chocolate','Battle Royale Infantil por herança',     'filme', 2),
    ('Perdido pra Cachorro',            'POV de Chiuaua',                          'filme', 4),
    ('Carros 2',                        'Carros espiões',                          'filme', 3),
    ('Internet: O Filme',               'Youtubers',                               'filme', 4),
    ('A Nova Onda do Imperador',        'Lhama',                                   'filme', 3);

-- Admin de teste
-- CPF: 00000000000  /  Senha: 123  (hash bcrypt válido)
INSERT INTO usuarios (nome, cpf, data_nascimento, email, senha, role) VALUES
    ('Administrador', '00000000000', '1990-01-01', 'admin@algoflix.com',
     '$2b$10$CS.Gx6K7MW7p82S2gcfm.exzhwYLwS3TfCx0ShCMjmKU.3T7Grrda', 'admin');
