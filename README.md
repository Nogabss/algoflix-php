# Algoflix PHP

Plataforma de streaming fictícia desenvolvida em PHP puro (sem frameworks),
seguindo o padrão MVC + POO + PDO, com sistema de autenticação completo,
catálogo de filmes/séries e interações de usuário.

Projeto acadêmico desenvolvido em grupo (3 pessoas).

## Tecnologias

- PHP 8
- MySQL
- XAMPP (Apache)
- HTML5 semântico
- CSS3 (tema escuro estilo streaming)

## Funcionalidades

### Autenticação (Pessoa 1)

- Cadastro de usuário
- Login com CPF + senha
- `password_hash` / `password_verify`
- Cookie "Lembrar-me" (30 dias)
- Recuperação de senha por CPF + data de nascimento
- Logout
- Controle de sessão e permissão (admin x usuário)

### Catálogo (Pessoa 2)

- CRUD de filmes (admin)
- CRUD de categorias (admin)
- Página inicial com carrosséis por categoria
- Listagem com filtro por categoria
- Busca por título
- Página de detalhes do filme

### Interações (Pessoa 3)

- Favoritos ("Minha Lista")
- Avaliações (1 a 5 estrelas, com média)
- Comentários
- Histórico de visualização
- Dashboard administrativo (estatísticas)
- Proteção CSRF em todos os formulários

## Estrutura do projeto

```
algoflix-php/
├── index.php                  # Página inicial (menu + carrosséis)
├── database.sql               # Dump único: cria banco + tabelas + dados
├── config/
│   ├── Database.php           # Singleton PDO
│   ├── config.php             # BASE_URL
│   └── session.php            # Inicia sessão
├── controllers/               # 9 controllers (classe + dispatch ?action=)
├── models/                    # 7 models (PDO + prepared statements)
├── views/                     # HTML semântico
├── helpers/
│   └── Csrf.php               # Token + verificação
├── assets/
│   └── css/style.css          # Tema escuro estilo streaming
└── tests/                     # Scripts auxiliares
```

## Padrão MVC

- **Models** (`models/`) — só falam com o banco via PDO. Usam `Database::getConnection()` (Singleton).
- **Controllers** (`controllers/`) — classes com métodos. Cada arquivo tem dispatch `?action=metodo` no final.
- **Views** (`views/`) — só HTML + `foreach`/`if` para exibir dados.

Todos os controllers seguem o mesmo padrão:

```
http://localhost/algoflix-php/controllers/FilmeController.php?action=index
http://localhost/algoflix-php/controllers/FilmeController.php?action=detalhes&id=1
http://localhost/algoflix-php/controllers/LoginController.php?action=entrar
```

## Instalação

### 1. Clone o projeto

```bash
git clone https://github.com/Nogabss/algoflix-php.git
```

Coloque a pasta dentro de `xampp/htdocs/`.

### 2. Inicie Apache e MySQL no XAMPP

### 3. Importe o banco

No phpMyAdmin, clique em **Importar** e selecione `database.sql`.

Ou pelo terminal:

```bash
mysql -u root < database.sql
```

Pronto — o arquivo já cria o banco `netflix_db`, todas as tabelas, popula com filmes/categorias de teste e cria o usuário admin com senha hasheada.

### 4. Acesse o sistema

```text
http://localhost/algoflix-php/
```

## Usuário de teste

| Tipo  | CPF         | Senha |
| ----- | ----------- | ----- |
| Admin | 00000000000 | 123   |

Para criar um usuário comum, use a tela de cadastro.

## Conceitos PHP utilizados

- Variáveis, arrays e strings
- Estruturas de controle (`if`, `else`, `switch`)
- Estruturas de laço (`foreach`, `for`, `while`)
- Funções (com e sem tipagem, valor padrão, retorno)
- `include` / `require_once`
- Sessões (`$_SESSION`)
- Cookies (`setcookie`, `$_COOKIE`)
- `password_hash()` / `password_verify()`
- MySQL via PDO com prepared statements
- Relação entre tabelas (`FOREIGN KEY`)
- Programação Orientada a Objetos (classes, métodos, construtores)
- Singleton (conexão única do banco)
- Padrão MVC
- Proteção CSRF

## Segurança

- **SQL Injection** — todos os queries usam `prepare()` + placeholders.
- **XSS** — `htmlspecialchars()` em saídas dinâmicas.
- **CSRF** — token em sessão + validação em todos os POST.
- **Senhas** — armazenadas com `password_hash` (BCRYPT).
- **Permissão admin** — operações de criar/editar/excluir verificam `$_SESSION['is_admin']`.

## Como mudar de pasta

Se a pasta do projeto não for `algoflix-php`, edite uma linha em `config/config.php`:

```php
define('BASE_URL', '/sua-pasta');
```

## Autores

Trabalho desenvolvido em grupo:

- **Pessoa 1** — Autenticação e Usuários
- **Pessoa 2** — Catálogo de Filmes e Categorias
- **Pessoa 3** — Interações (Favoritos, Avaliações, Comentários, Dashboard)
