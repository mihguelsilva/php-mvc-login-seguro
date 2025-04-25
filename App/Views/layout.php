<!-- app/Views/layout.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Meu Projeto Seguro' ?></title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Suavidade nos ícones e links */
        .navbar-nav .nav-link,
        .btn {
            transition: all 0.2s ease-in-out;
        }

        /* Efeito ao passar o mouse */
        .navbar-nav .nav-link:hover,
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Estilo para dropdowns */
        .dropdown-menu .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #000;
        }

        /* Botões com bordas arredondadas e elegância */
        .btn {
            border-radius: 0.5rem;
            font-weight: 500;
        }

        /* Cor do botão ativo */
        .navbar .nav-link.active,
        .navbar .btn.active {
            background-color: #0d6efd;
            color: white !important;
        }

        /* Estilo fixo para a navbar (opcional) */
        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {

            .navbar-nav .nav-link,
            .btn {
                margin-bottom: 0.5rem;
            }
        }

        /* Estilo para o item de menu ativo baseado na URL */
        .navbar-nav .nav-link.active-page {
            background-color: #0d6efd;
            color: white !important;
            font-weight: bold;
        }
    </style>
</head>

<body class="bg-light">
    <header class="container-fluid bg-light p-3 text-center">
        <h1>Projeto MVC de Mihguel</h1>
    </header>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/') ? 'active-page' : ''; ?>" href="/" class='btn btn-outline-danger'>Projeto</a>
                </li>
                <div class="d-flex text-light">
                <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/contato') ? 'active-page' : ''; ?>" href="/contato" class='btn btn-outline-danger'>Contato</a>
            </div>
                <?php if (App\Helpers\Auth::check()): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/home') ? 'active-page' : ''; ?>" href="/home" class='btn btn-outline-primary'>HOME</a>
                    </li>
                    <?php if (App\Helpers\Auth::admin()): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/admin/users') ? 'active-page' : ''; ?>" href="/admin/users" class='btn btn-outline-primary'>Dashboard</a>
                        </li>
                    <?php endif ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Minha Conta</a>
                        <ul class="dropdown-menu">
                            <li><a href="/user/edit" class="dropdown-item <?php echo ($_SERVER['REQUEST_URI'] == '/user/edit') ? 'active-page' : ''; ?>">Editar Conta</a></li>
                            <li><a href="/user/delete" class="dropdown-item <?php echo ($_SERVER['REQUEST_URI'] == '/user/delete') ? 'active-page' : ''; ?>">Deletar Conta</a></li>
                        </ul>
                    </li>
            </ul>
            <div class="d-flex text-light">
                <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/logout') ? 'active-page' : ''; ?>" href="/logout" class='btn btn-outline-danger'>Sair</a>
            </div>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/register') ? 'active-page' : ''; ?>" href="/register" class='btn btn-outline-primary'>Cadastrar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/login') ? 'active-page' : ''; ?>" href="/login" class='btn btn-outline-primary'>Login</a>
            </li>
            </ul>
        <?php endif; ?>
        </div>
    </nav>


    <main class="container py-5">
        <?= $content ?? '' ?>
    </main>

    <footer class="mt-5 text-center text-muted">
        <hr>
        <div>
            <small>Desenvolvido com ❤️ por <strong>Mihguel da Silva Santos Tavares de Araujo</strong></small>
        </div>
        <div class="mt-3">
            <a href="https://www.linkedin.com/in/mihguel-da-silva-santos-tavares-de-araujo/" target="_blank" class="btn btn-outline-primary btn-sm">LinkedIn</a>
            <a href="https://github.com/mihguelsilva" target="_blank" class="btn btn-outline-dark btn-sm">GitHub</a>
        </div>
        <hr>
        <small>&copy; <?php echo date("Y"); ?> Todos os direitos reservados.</small>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>