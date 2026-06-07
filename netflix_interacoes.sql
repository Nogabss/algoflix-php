CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    senha VARCHAR(255)
) ENGINE=InnoDB;

CREATE TABLE filmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255),
    descricao TEXT
) ENGINE=InnoDB;

CREATE TABLE favoritos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    filme_id INT NOT NULL,
    data_adicionado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (filme_id) REFERENCES filmes(id)
) ENGINE=InnoDB;

CREATE TABLE avaliacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    filme_id INT NOT NULL,
    nota INT NOT NULL CHECK (nota BETWEEN 1 AND 5),
    data_avaliacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
        ON DELETE CASCADE,

    FOREIGN KEY (filme_id) REFERENCES filmes(id)
        ON DELETE CASCADE
);

CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    filme_id INT NOT NULL,
    comentario TEXT NOT NULL,
    data_comentario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
        ON DELETE CASCADE,

    FOREIGN KEY (filme_id) REFERENCES filmes(id)
        ON DELETE CASCADE
);

CREATE TABLE historico_visualizacao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    filme_id INT NOT NULL,
    data_visualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
        ON DELETE CASCADE,

    FOREIGN KEY (filme_id) REFERENCES filmes(id)
        ON DELETE CASCADE
);

INSERT INTO usuarios
(nome,email,senha)
VALUES
(
'Administrador',
'admin@netflix.com',
'123'
);

INSERT INTO filmes
(titulo,descricao)
VALUES
(
'Matrix',
'Filme sobre realidade simulada'
),
(
'Interestelar',
'Viagem espacial'
),
(
'Vingadores',
'Heróis da Marvel'
),
(
'Ta Chovendo Hambúrguer',
'Chove Hambúrguer'
),
(
'Smurfs',
'Um filme sobre Smurfs'
),
(
'A Fantástica Fábrica de Chocolate',
'Battle Royale Infantil por herança'
),
(
'Perdido pra Cachorro',
'POV de Chiuaua'
),
(
'Carros 2',
'Carros espiões'
),
(
'Internet: O Filme',
'Youtubers'
),
(
'A Nova Onda do Imperador',
'Lhama'
);