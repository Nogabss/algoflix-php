
DROP DATABASE IF EXISTS netflix_db;
CREATE DATABASE netflix_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE netflix_db;

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
    duracao INT,
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

INSERT INTO categorias (nome) VALUES
    ('Ação'),
    ('Aventura'),
    ('Animação'),
    ('Comédia'),
    ('Drama'),
    ('Ficção Científica'),
    ('Infantil'),
    ('Documentário');

INSERT INTO filmes (titulo, descricao, tipo, categoria_id, capa) VALUES
    ('Matrix',                          'Filme sobre realidade simulada',          'filme', 6, "https://static.wikia.nocookie.net/dublagem/images/7/7a/Matrix.jpg/revision/latest?cb=20250716174206&path-prefix=pt-br"),
    ('Interestelar',                    'Viagem espacial',                         'filme', 6, "http://papodecinema.com.br/wp-content/uploads/2014/10/20141001-interestelar-papo-de-cinema.webp"),
    ('Vingadores',                      'Heróis da Marvel',                        'filme', 1, "https://www.papodecinema.com.br/wp-content/uploads/2019/02/20190422-mryl2_003a_g_por-br_64x94-204x300.webp"),
    ('Ta Chovendo Hambúrguer',          'Chove Hambúrguer',                        'filme', 3, "https://www.papodecinema.com.br/wp-content/uploads/2012/08/20200507-ta-chovendo-hamburguer-papo-de-cinema-cartaz-209x300.webp"),
    ('Smurfs',                          'Um filme sobre Smurfs',                   'filme', 7, "https://www.papodecinema.com.br/wp-content/uploads/2012/05/20190423-poster-pequeno-imp-couche-a3-do-filme-os-smurfs-ver-3-d_nq_np_14053-mlb196974927_5029-f-204x300.webp"),
    ('A Fantástica Fábrica de Chocolate','Battle Royale Infantil por herança',     'filme', 2, "https://www.papodecinema.com.br/wp-content/uploads/2014/06/20240103-a-fantastica-fabrica-de-chocolate-2005-papo-de-cinema-cartaz-222x300.webp"),
    ('Perdido pra Cachorro',            'POV de Chiuaua',                          'filme', 4, "https://www.papodecinema.com.br/wp-content/uploads/2012/12/20200807-perdido-pra-cachorro-papo-de-cinema-cartaz-207x300.webp"),
    ('Carros 2',                        'Carros espiões',                          'filme', 3, "https://static.wikia.nocookie.net/dublagem/images/a/af/Carros_2.jpeg/revision/latest?cb=20230721135632&path-prefix=pt-br"),
    ('Internet: O Filme',               'Youtubers',                               'filme', 4, "https://media.themoviedb.org/t/p/w300_and_h450_face/7kyQPkPj6YDYzX4oMymtoiTzLx2.jpg"),
    ('A Nova Onda do Imperador',        'Lhama',                                   'filme', 3, "https://www.aabbportoalegre.com.br/intranet/modulos/biblioteca/imgs/1896.jpg");

INSERT INTO usuarios (nome, cpf, data_nascimento, email, senha, role) VALUES
    ('Administrador', '00000000000', '1990-01-01', 'admin@algoflix.com',
     '$2b$10$CS.Gx6K7MW7p82S2gcfm.exzhwYLwS3TfCx0ShCMjmKU.3T7Grrda', 'admin'),
    ('Maria Silva',   '11111111111', '1995-05-20', 'maria@algoflix.com',
     '$2b$10$CS.Gx6K7MW7p82S2gcfm.exzhwYLwS3TfCx0ShCMjmKU.3T7Grrda', 'usuario');

INSERT INTO avaliacoes (usuario_id, filme_id, nota) VALUES
    (1,  1, 5),  (2,  1, 5),
    (1,  2, 5),  (2,  2, 4),
    (1,  3, 4),  (2,  3, 4),
    (1,  4, 3),  (2,  4, 4),
    (1,  5, 2),  (2,  5, 3),
    (1,  6, 5),
    (1,  7, 3),
    (1,  8, 4),  (2,  8, 3),
    (2,  9, 2),
    (1, 10, 4),  (2, 10, 5);