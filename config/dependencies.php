<?php
use \App\Controllers\{LoginController};
use \App\Controllers\Admin\{AdminController};
use \App\Controllers\Site\{ContatoController, HomeController, PaginaPrincipalController};
use \App\Controllers\User\{UserDeleteController, UserEditController, UserRegisterController};
use \App\Core\SessionManager;
use \App\Models\{User, MensagemContato};
use \Core\{Acl, Database, Request};

$container->singleton(Database::class, fn() => new Database());
$container->singleton(SessionManager::class, fn() => new SessionManager());
$container->singleton(Request::class, fn() => new Request());

$container->singleton(Acl::class, fn() => new Acl($container->get(SessionManager::class)));
$container->singleton(MensagemContato::class, fn($c) => new MensagemContato($c->get(Database::class)));
$container->singleton(User::class, fn($c) => new User($c->get(Database::class)));

// \App\Controllers\Admin
$container->singleton(AdminController::class, fn($c) => new AdminController($c->get(SessionManager::class), $c->get(User::class)));

// \App\Controllers\Sites
$container->singleton(ContatoController::class, fn($c) => new ContatoController($c->get(SessionManager::class), $c->get(MensagemContato::class)));
$container->singleton(HomeController::class, fn($c) => new HomeController($c->get(SessionManager::class)));
$container->singleton(PaginaPrincipalController::class, fn($c) => new PaginaPrincipalController($c->get(SessionManager::class)));

// \App\Controllers\User
$container->singleton(UserDeleteController::class, fn($c) => new UserDeleteController($c->get(SessionManager::class), $c->get(User::class)));
$container->singleton(UserEditController::class, fn($c) => new UserEditController($c->get(User::class)));
$container->singleton(UserRegisterController::class, fn($c) => new UserRegisterController($c->get(User::class), $c->get(MensagemContato::class)));

$container->singleton(LoginController::class, fn($c) => new LoginController($c->get(SessionManager::class), $c->get(User::class)));
?>