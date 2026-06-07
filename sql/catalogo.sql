-- ============================================================
-- Catálogo de Filmes e Séries (Pessoa 2)
--
-- Extensões necessárias ao banco netflix_db:
--  - Tabela categorias (gêneros)
--  - Colunas extras em filmes (capa, ano, duracao, tipo, categoria_id)
--  - Dados de teste
-- ============================================================

CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL UNIQUE
) ENGINE=InnoDB;

ALTER TABLE filmes
    ADD COLUMN capa VARCHAR(255) NULL AFTER descricao,
    ADD COLUMN ano YEAR NULL AFTER capa,
    ADD COLUMN duracao INT NULL COMMENT 'em minutos' AFTER ano,
    ADD COLUMN tipo ENUM('filme','serie') NOT NULL DEFAULT 'filme' AFTER duracao,
    ADD COLUMN categoria_id INT NULL AFTER tipo,
    ADD CONSTRAINT fk_filmes_categoria
        FOREIGN KEY (categoria_id) REFERENCES categorias(id)
        ON DELETE SET NULL;

INSERT INTO categorias (nome) VALUES
    ('Ação'),
    ('Aventura'),
    ('Animação'),
    ('Comédia'),
    ('Drama'),
    ('Ficção Científica'),
    ('Infantil'),
    ('Documentário');

-- Atribui categorias aos filmes já existentes (do netflix_interacoes.sql)
UPDATE filmes SET categoria_id = (SELECT id FROM categorias WHERE nome='Ficção Científica') WHERE titulo='Matrix';
UPDATE filmes SET categoria_id = (SELECT id FROM categorias WHERE nome='Ficção Científica') WHERE titulo='Interestelar';
UPDATE filmes SET categoria_id = (SELECT id FROM categorias WHERE nome='Ação')               WHERE titulo='Vingadores';
UPDATE filmes SET categoria_id = (SELECT id FROM categorias WHERE nome='Animação')           WHERE titulo='Ta Chovendo Hambúrguer';
UPDATE filmes SET categoria_id = (SELECT id FROM categorias WHERE nome='Infantil')           WHERE titulo='Smurfs';
UPDATE filmes SET categoria_id = (SELECT id FROM categorias WHERE nome='Aventura')           WHERE titulo='A Fantástica Fábrica de Chocolate';
UPDATE filmes SET categoria_id = (SELECT id FROM categorias WHERE nome='Comédia')            WHERE titulo='Perdido pra Cachorro';
UPDATE filmes SET categoria_id = (SELECT id FROM categorias WHERE nome='Animação')           WHERE titulo='Carros 2';
UPDATE filmes SET categoria_id = (SELECT id FROM categorias WHERE nome='Comédia')            WHERE titulo='Internet: O Filme';
UPDATE filmes SET categoria_id = (SELECT id FROM categorias WHERE nome='Animação')           WHERE titulo='A Nova Onda do Imperador';
