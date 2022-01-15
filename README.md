# Teste para entrevista

// TODO: Completar sec

## Features
- Mapeamento de rotas
- Design pattern em Model View Controller (MVC)

## Testes manuais
**Autenticação**
- [x] Um usuário pode se cadastrar
- [x] Um usuário pode se logar com sucesso
- [x] Um usuário pode sair da seção


- [x] **Erros serão mostrados se:**
  - [x] Usuário não existir
  - [x] Senha incorreta

---

**Importação de arquivo**
- [x] Um usuário pode importar um arquivo 
- [x] Um arquivo pode ser importado com sucesso se tiver o formato CSV, com separador de vírgula, com o nome das colunas na primeira linha.


- [x] **Erros serão mostrados se:**
  - [x] o arquivo não estiver no formato correto
  - [x] o arquivo possuir entrada duplicada de matrícula

---

**Gerenciamento de pacientes**
- [ ] Um usuário pode cadastrar um paciente na tela de pacientes
- [ ] Um usuário pode editar um paciente na tela de pacientes
- [ ] Um usuário pode excluir um paciente na tela de pacientes
- [ ] Um usuário pode pesquisar um paciente na tela de pacientes

---

**Views:**

Apenas se não houver um usuário autenticado na sessão:
- [x] Uma página de login será exibida em `/login`
- [x] Uma página de cadastro de usuário será exibida em `/cadastro`

Apenas se houver um usuário autenticado na sessão:
- [x] Uma página de listagem e edição de pacientes será exibida em `/pacientes`
- [x] Uma página de importação de pacientes será exibida em `/importar`

## Estrutura do código
