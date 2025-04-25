# 🔐 php-mvc-login-seguro

Um sistema de login seguro utilizando PHP puro com arquitetura MVC, sessions, rotas protegidas, mensagens de retorno e boas práticas de segurança.

---

## 🧰 Tecnologias utilizadas

- PHP 8+
- Composer (PSR-4)
- HTML5 + CSS3 (Bootstrap)
- Sessões PHP (`$_SESSION`)
- Hash de senhas com `password_hash`
- Autoload com PSR-4
- Estrutura MVC customizada

---

## 🛡️ Funcionalidades

✅ Autenticação com senha segura  
✅ Logout seguro com `session_destroy`  
✅ Controle de sessão com `$_SESSION`  
✅ Proteção contra acesso não autorizado  
✅ Middleware de verificação de login  
✅ Roteamento simples com método + URI  
✅ Página protegida (`/dashboard`)  
✅ Mensagens dinâmicas de erro e sucesso  
✅ Separação de responsabilidades (MVC)

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
|   |    ├── AdminController.php
|   |    ├── BeginController.php
|   |    ├── HomeController.php
|   |    └── LoginController.php
|   ├── Helpers/
|   |    ├── Auth.php
|   |    └── Flash.php
│   ├── Middleware/
|   |    └── Auth.php
│   ├── Models/
|   |   └── User.php
│   └── Views/
|       ├── admin/
|       |      └── edit.php
|       ├── user/
|       |    ├── delete.php
|       |    └── edit.php
|       ├── begin.php
|       ├── dashboard.php
|       ├── home.php
|       ├── layout.php
|       ├── login.php
|       └── register.php
|       
├── config/
│   └── config.php.example
|   └── router.php
├── Core/
|   ├── Controller.php
|   ├── Database.php
|   └── Router.php
├── public/
|   ├── .htaccess
│   └── index.php
├── composer.json
└── README.md
```

## 🧠 Conceitos aplicados

- Arquitetura MVC
- Roteamento manual
- Middleware básico
- Hash e verificação de senha
- Redirecionamentos
- Organização de código
- Segurança com sessões

## 🧪 Testes manuais

- ✅ Teste de login com credenciais válidas
- ❌ Redirecionamento ao tentar acessar /dashboard sem login
- ✅ Logout destrói sessão e redireciona

🙋‍♂️ Autor
Desenvolvido com 💙 por [Mihguel da Silva Santos Tavares de Araujo](https://www.linkedin.com/in/mihguel-da-silva-santos-tavares-de-araujo/)
GitHub: [@mihguelsilva](https://github.com/mihguelsilva)

## 📝 Licença

Este projeto está sob a licença MIT. Sinta-se à vontade para utilizar, modificar e contribuir.