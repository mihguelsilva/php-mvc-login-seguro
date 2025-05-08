# 🔐 php-mvc-login-seguro

Sistema de login seguro em **PHP puro** com arquitetura **MVC**, gerenciamento de sessões, rotas protegidas, ACL (controle de acesso), injeção de dependência via container e boas práticas de segurança.


---

## 🧰 Tecnologias utilizadas

- PHP 8+
- Composer (PSR-4)
- HTML5 + CSS3 (Bootstrap)
- Sessões PHP (`$_SESSION`)
- Hash de senhas com `password_hash`
- Autoload com PSR-4
- **PHPMailer** para envio de e-mails
- Estrutura MVC customizada
- ACL com verificação de permissões
- Injeção de dependência via Service Container

---

## 🛡️ **Funcionalidades**

✅ **Autenticação com senha segura**  
✅ **Logout seguro com** `session_destroy`  
✅ **Controle de sessão com** `$_SESSION`  
✅ **Proteção contra acesso não autorizado**  
✅ **Middleware de verificação de login**  
✅ **Roteamento simples com método + URI**  
✅ **Página protegida** (`/dashboard`)  
✅ **Mensagens dinâmicas de erro e sucesso**  
✅ **Separação de responsabilidades (MVC)**  
✅ **Armazenamento seguro de senhas** com `password_hash()`  
✅ **Redirecionamento automático** após login/logout
✅ **Templates com renderização dinâmica**


---

## 🚀 Como rodar localmente

```bash
# Clone o repositório
git clone https://github.com/mihguelsilva/php-mvc-login-seguro.git
```

# Acesse a pasta
cd php-mvc-login-seguro

# Instale as dependências via composer
composer install

# Copie o arquivo de configuração base
cp config/config.php.example config/config.php

# Suba um servidor embutido do PHP (se quiser)
php -S localhost:8000 -t public

Acesse http://localhost:8000 e pronto! 

## 🧪 Usuário de exemplo
Você pode cadastrar manualmente no banco de dados.

Utilize o ```password_hash()``` para gerar a senha ou insira esse exemplo:

```sql
INSERT INTO users (username, password) VALUES (
  'admin',
  '$2y$10$Kx0VX8b2axjLhqq3DzJe5eyZxsfjYwqiyZTjK8MLyWSlvDw9sd8xG' -- senha: admin123
);
```

## 📁 Estrutura de Pastas

```pgsql
php-mvc-login-seguro/
├── App/
│   ├── Controllers/
│   │    ├── Admin/
│   │    |    └── AdminController.php
│   │    ├── Api/
│   │    ├── Site/
│   │    |    ├── ContatoController.php
│   │    |    ├── HomeController.php
│   │    |    └── PaginaPrincipalController.php
│   │    └──User/
│   │    |    ├── UserDeleteController.php
│   │    |    ├── UserEditController.php
│   │    |    └── UserRegisterController.php
│   │    ├── AcessoNegadoController.php
│   │    └── LoginController.php
│   ├── Core/
│   │    └── SessionManager.php
│   ├── Helpers/
│   │    ├── Auth.php
|   |    ├── Csrf.php
│   │    ├── Flash.php
│   │    ├── Sanitize.php
│   │    ├── SessionManager.php
│   │    └── TemplateEngine.php
│   ├── Middleware/
│   ├── Models/
|   |    ├── MensagemContato.php
│   │    └── User.php
│   └── Views/
│       ├── admin/
│       │      └── edit.php
│       ├── user/
│       │    ├── delete.php
│       │    └── edit.php
│       ├── begin.php
│       ├── contato.php
│       ├── dashboard.php
│       ├── home.php
│       ├── layout.php
│       ├── login.php
│       └── register.php
├── config/
│   ├── admin.php
│   ├── common.php
│   ├── consts.php
│   ├── dependencies.php
│   ├── public.php
│   ├── config.php.example
│   ├── router.php
│   └── user.php
├── Core/
│   ├── Acl.php
│   ├── Container.php
│   ├── Controller.php
│   ├── Database.php
│   ├── Mailer.php
│   ├── Request.php
│   ├── Response.php
│   └── Router.php
├── public/
│   ├── .htaccess
│   └── index.php
├── static/
│   └── html/
│   |   └── email_message.php
├── composer.json
└── README.md
```

## 🧠 Conceitos aplicados

- Arquitetura MVC
- Roteamento manual
- Middleware básico para controle de autenticação
- Hash e verificação de senha com `password_hash()` e `password_verify()`
- Redirecionamentos automáticos após login/logout
- Organização de código e boas práticas de segurança com PHP
- Segurança com sessões

## 🧪 Testes manuais

- ✅ Login com credenciais válidas
- ✅ Redirecionamento para dashboard após login
- ✅ Logout destrói sessão
- ❌ Acesso ao /dashboard sem login redireciona para login
- ✅ ACL bloqueia acesso indevido com base em perfil

## 🙋‍♂️ Autor
Desenvolvido com 💙 por [Mihguel da Silva Santos Tavares de Araujo](https://www.linkedin.com/in/mihguel-da-silva-santos-tavares-de-araujo/)
GitHub: [@mihguelsilva](https://github.com/mihguelsilva)

## 📝 Licença

Este projeto está sob a licença MIT. Sinta-se à vontade para utilizar, modificar e contribuir.

## 💬 Feedback

Gostou do projeto? Tem sugestões de melhorias? Deixe um comentário ou abra uma issue no GitHub.
Sua contribuição é muito bem-vinda! 😄