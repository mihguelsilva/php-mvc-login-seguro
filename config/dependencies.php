<?php
use \App\Controllers\{LoginController};
use \App\Controllers\Admin\{AdminController};
use \App\Controllers\Site\{ContatoController, HomeController, PaginaPrincipalController};
use \App\Controllers\User\{UserDeleteController, UserEditController, UserRegisterController};
use \App\Core\SessionManager;
use \App\Helpers\{Csrf, Flash};
use \App\Models\{User, MensagemContato};
use \Core\{Acl, Controller, Database, Request};

$container->singleton(Database::class, fn() => new Database());
$container->singleton(SessionManager::class, fn() => new SessionManager());
$container->singleton(Request::class, fn() => new Request());
$container->singleton(Controller::class, fn($c) => new Controller(
    $c->get(SessionManager::class)
));

$container->singleton(Acl::class, fn() => new Acl($container->get(SessionManager::class)));
$container->singleton(MensagemContato::class, fn($c) => new MensagemContato($c->get(Database::class)));
$container->singleton(User::class, fn($c) => new User($c->get(Database::class)));

$container->singleton(Csrf::class, fn($c) => new Csrf($c->get(SessionManager::class)));
$container->singleton(Flash::class, fn($c) => new Flash($c->get(SessionManager::class)));

// \App\Controllers\Admin
$container->singleton(AdminController::class, fn($c) => new AdminController(
    $c->get(SessionManager::class), 
    $c->get(User::class),
    $c->get(Csrf::class),
    $c->get(Flash::class),
    $c->get(Controller::class)
));

// \App\Controllers\Sites
$container->singleton(ContatoController::class, fn($c) => new ContatoController(
    $c->get(MensagemContato::class),
    $c->get(Csrf::class),
    $c->get(Flash::class),
    $c->get(Controller::class)
));
$container->singleton(HomeController::class, fn($c) => new HomeController(
    $c->get(SessionManager::class),
    $c->get(Controller::class)
));
$container->singleton(PaginaPrincipalController::class, fn($c) => new PaginaPrincipalController(
    $c->get(SessionManager::class),
    $c->get(Controller::class)
));

// \App\Controllers\User
$container->singleton(UserDeleteController::class, fn($c) => new UserDeleteController(
    $c->get(SessionManager::class), 
    $c->get(User::class),
    $c->get(Csrf::class),
    $c->get(Flash::class),
    $c->get(Controller::class)
));
$container->singleton(UserEditController::class, fn($c) => new UserEditController(
    $c->get(User::class),
    $c->get(Csrf::class),
    $c->get(Flash::class),
    $c->get(Controller::class)
));
$container->singleton(UserRegisterController::class, fn($c) => new UserRegisterController(
    $c->get(User::class), 
    $c->get(MensagemContato::class),
    $c->get(Csrf::class),
    $c->get(Flash::class),
    $c->get(Controller::class)
));

$container->singleton(LoginController::class, fn($c) => new LoginController(
    $c->get(SessionManager::class), 
    $c->get(User::class),
    $c->get(Csrf::class),
    $c->get(Flash::class),
    $c->get(Controller::class)
));
?>