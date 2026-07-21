# 📝 Notes Studio

> Aplicação de gerenciamento de notas desenvolvida para praticar conceitos fundamentais do ecossistema **PHP & Laravel**. Projeto realizado como parte de treinamento prático na **Udemy**.

---

## 🚀 Tecnologias & Frameworks

- **Backend:** PHP 8.4.23 | Laravel Framework 13.16.1
- **Frontend:** Blade Templating Engine, Bootstrap 5, FontAwesome
- **Arquitetura & Segurança:** Middleware (auth status), Crypt (IDs mascarados), Validações de Formulário & Proteção CSRF

---

## 💡 Funcionalidades Principais

- [x] **Autenticação:** Sistema de login/logout protegido via Session & Middlewares (`CheckIfLogged` / `CheckIsNotLogged`).
- [x] **Gestão de Notas (CRUD Completo):**
    - Criar, visualizar, editar e excluir notas vinculadas ao usuário logado.
    - Tela de confirmação dedicada para exclusões acidentais.
- [x] **Segurança:** Criptografia de IDs nas rotas de alteração/exclusão (`Crypt::encrypt`).
- [x] **Design Zen/Minimalista:** Interface limpa inspirada na estética oriental/Muji, focada em tipografia e legibilidade.

---

## 🛠️ Como Executar o Projeto

### 1. Clonar o repositório

```bash
git clone https://github.com/KauSR1/laravel-notes.git
cd seu-repositorio
```

### 2. Instalar as dependências

```bash
composer install
```

### 3. Configurar o ambiente

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar o banco de dados

Ajuste as credenciais do banco de dados no arquivo `.env` e execute:

```bash
php artisan migrate --seed
```

### 5. Iniciar o servidor

```bash
php artisan serve
```

Acesse a aplicação em:

```text
http://localhost:8000
```

---

## 🎓 Origem do Projeto

Projeto desenvolvido durante um curso prático na plataforma **Udemy**, com foco na estruturação profissional de código, arquitetura **MVC** e conceitos de segurança utilizando o ecossistema **Laravel**.
