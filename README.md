# Teste para entrevista

## Introdução

Aplicação feita para um processo de seleção de uma vaga de dev. PHP.

## Tábula de conteúdo

- [Características](#características)
- [Setup](#setup)
  - [Recomendado](#recomendado)
  - [Alternativo](#alternativo)
- [Estrutura do sistema](#estrutura-do-sistema)
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

- (Se a porta 8000 estiver em uso, mude a linha 9 do arquivo `docker-compose.yml` para `port: [uma-porta-livre]:80`)

### Alternativo

#### Dependências

- PHP 7.4, com:
  - pdo
  - pdo_mysql
- MySQL 5.7
- Apache 2, com:
  - mod_rewrite

#### Execução
Após instalar as dependencias, adicione o diretório do repositório ao arquivo de configuração do Apache:
```
<Directory [caminho-do-repositorio]>
    AllowOverride All
    Require all granted
</Directory>
```

<!--- TODO: completar guia de instalação --->

## Estrutura do sistema

- `/login` - Página de login
- `/cadastro` - Página de cadastro
- `/pacientes` - Página de listagem e edição de pacientes
- `/importar` - Página de importação de arquivo de pacientes

## Estrutura do projeto

<!--- TODO: completar guia de instalação --->

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
