# Teste para entrevista

## Introdução

Aplicação feita para um processo de seleção de uma vaga de dev. PHP.

---

Demo rodando **temporariamente** em: [https://app-pacientes-sys.herokuapp.com](https://app-pacientes-sys.herokuapp.com)

DDL do banco de dados em: [`docker/db/create_db.sql`](docker/db/create_db.sql)

Arquivo CSV com teste de dados em: [`test_data.csv`](test_data.csv)

## Índice de conteúdo

- [Características](#características)
- [Setup](#setup)
  - [Recomendado](#recomendado)
  - [Alternativo](#alternativo)
- [Rotas da aplicação](#estrutura-da-aplicação)
- [Estrutura do projeto](#estrutura-do-projeto)
- [Testes manuais](#testes-manuais)

## Características

- Mapeamento de rotas estáticas
- Padrão de design em MVC (Model View Controller)

## Setup

### Recomendado

- Dependências:

  - Obtenha o [Docker](https://www.docker.com/);
  - Obtenha o [Docker Compose](https://docs.docker.com/compose/install/);

- Execução:

  - Execute o comando `docker-compose up` na raiz do projeto;
  - Acesse [`http://localhost:8000`](http://localhost:8000) para testar a aplicação;

(Se a porta 8000 estiver em uso, mude a linha 9 do arquivo `docker-compose.yml` para `port: [uma-porta-livre]:80`)

### Alternativo

#### Dependências

- PHP 7.4, com:
  - pdo
  - pdo_mysql
- MySQL 5.7
- Apache 2.x, com:
  - mod_rewrite

#### Execução

Após instalar as dependências, aponte o diretório do repositório ao arquivo de configuração do Apache:

```apacheconf
<Directory [caminho-do-repositorio]>
    AllowOverride All # Permite que o arquivo de configuração `.htaccess` seja acessado
    Require all granted
</Directory>
```

Insira no arquivo [`.env`](.env) as novas variáveis de ambiente:

```dotenv
DB_HOST=[hostname do banco de dados]
DB_PORT=[porta do banco de dados]
DB_USER=[usuário do banco de dados]
DB_PASSWORD=[senha do banco de dados]
DB_NAME=[nome do banco de dados]
```

## Rotas da aplicação

- `/login` - Página de login
- `/cadastro` - Página de cadastro
- `/pacientes` - Página de listagem e edição de pacientes
- `/importar` - Página de importação de arquivo de pacientes

## Estrutura do projeto

```
teste-entrevista
├─ .env // arquivo de configuração do projeto
├─ .htaccess // Apache
├─ app.php // Entry point da aplicação, para onde é redirecionado todo o fluxo de requisições
├─ test_data.csv // Arquivo com dados de teste
├─ docker
│  ├─ db
│  │  └─ create_db.sql // DDL do banco de dados
├─ public // arquivos públicos
├─ src
│  ├─ App
│  │  ├─ Controller.php // Classe super de controles
│  │  ├─ Model.php // Classe super de modelos
│  │  ├─ Router.php // Classe de lógica de rotas
│  │  └─ View.php // Classe de lógica de renderização das views
│  ├─ Controllers // Classes de controladores de cada view diferente
│  ├─ Database
│  │  └─ Connection.php // Classe estática de conexão com o banco de dados
│  ├─ Models // Modelos do banco de dados
│  ├─ Utils 
│  │  └─ AuthGuard.php // Classe helper de autenticação
│  └─ Views // Views do sistema para cada rota
└─ vendor // Pacote vendorizado do Composer para o autoload das classes
```

## Testes manuais

### Autenticação

- [x] Um usuário pode se cadastrar
- [x] Um usuário pode se logar com sucesso
- [x] Um usuário pode sair da seção

- [x] **Erros serão mostrados se:**
  - [x] Usuário não existir
  - [x] Senha incorreta

### Importação de arquivo

- [x] Um usuário pode importar um arquivo
- [x] Um arquivo pode ser importado com sucesso se tiver o formato CSV, com separador de vírgula, com o nome das colunas na primeira linha.

- [x] **Erros serão mostrados se:**
  - [x] o arquivo não estiver no formato correto
  - [x] o arquivo possuir entrada duplicada de matrícula

### Gerenciamento de pacientes

- [x] Um usuário pode cadastrar um paciente na tela de pacientes
- [x] Um usuário pode editar um paciente seu na tela de pacientes
- [x] Um usuário pode excluir um paciente seu na tela de pacientes
- [x] Um usuário pode ver todos os pacientes seus na tela de pacientes

- [x] Um usuário não pode editar um paciente que não é seu
- [x] Um usuário não pode excluir um paciente que não é seu

### Relações do banco de dados

- [x] Um usuário tem vários pacientes
- [x] Um paciente pertence a um usuário
- [x] Um paciente tem uma matrícula
- [x] Vários usuários podem ter pacientes com a mesma matrícula
- [x] Um usuário não pode ter pacientes com a mesma matrícula

### Views

Apenas se não houver um usuário autenticado na sessão:

- [x] Uma página de login será exibida em `/login`
- [x] Uma página de cadastro de usuário será exibida em `/cadastro`

Apenas se houver um usuário autenticado na sessão:

- [x] Uma página de listagem e edição de pacientes será exibida em `/pacientes`
- [x] Uma página de importação de pacientes será exibida em `/importar`