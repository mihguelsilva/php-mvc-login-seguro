<?php

use \Core\Response;
use \App\Controllers\Admin\{AdminController};
use \App\Controllers\Site\{ContatoController, HomeController, PaginaPrincipalController};
use \App\Controllers\User\{UserDeleteController, UserEditController, UserRegisterController};
use \App\Controllers\LoginController;

// Método GET
$router->get(
    '/',
    fn() => (new Response(200, $router->controller([PaginaPrincipalController::class, 'get'])))
        ->send()
);

$router->get(
    '/admin/users', 
    fn() => (new Response(200, $router->controller([AdminController::class, 'index'])))
        ->send()
);

$router->get(
    '/admin/users/edit', 
    fn() => (new Response(200, $router->controller([AdminController::class, 'edit'])))
        ->send()
);

$router->get(
    '/login',
    fn() => (new Response(200, $router->controller([LoginController::class, 'get'])))
        ->send()
);

$router->get(
    "/logout", 
    fn() => (new Response(200, $router->controller([LoginController::class, 'logout'])))
        ->send()
);

$router->get(
    '/home',
    fn() => (new Response(200, $router->controller([HomeController::class, 'get'])))
        ->send()
);

$router->get(
    '/contato',
    fn() => (new Response(200, $router->controller([ContatoController::class, 'get'])))
        ->send()
);

$router->get(
    '/register',
    fn() => (new Response(200, $router->controller([UserRegisterController::class, 'get'])))
        ->send()
);

$router->get(
    '/user/delete', 
    fn() => (new Response(200, $router->controller([UserDeleteController::class, 'get'])))
        ->send()
);
$router->get(
    "/user/edit", 
    fn() => (new Response(200, $router->controller([UserEditController::class, 'get'])))
        ->send()
);


// $router->get('/admin/users', [\App\Controllers\Admin\AdminController::class, 'index']);
// $router->get('/admin/users/edit', [\App\Controllers\Admin\AdminController::class, 'edit']);
// $router->get('/contato', [\App\Controllers\Site\ContatoController::class, 'get']);
// $router->get("/home", [\App\Controllers\Site\HomeController::class, 'get']);
// $router->get("/login", [\App\Controllers\LoginController::class, 'get']);
// $router->get("/register", [\App\Controllers\User\UserRegisterController::class, 'get']);
// $router->get('/user/delete', [\App\Controllers\User\UserDeleteController::class, 'get']);
// $router->get("/user/edit", [\App\Controllers\User\UserEditController::class, 'get']);

// Método POST
$router->post('/admin/users/update', [\App\Controllers\Admin\AdminController::class, 'update']);
$router->post('/admin/users/delete', [\App\Controllers\Admin\AdminController::class, 'delete']);
$router->post('/contato/enviar', [\App\Controllers\Site\ContatoController::class, 'send']);
$router->post("/login", [\App\Controllers\LoginController::class, 'login']);
$router->post("/register", [\App\Controllers\User\UserRegisterController::class, 'create']);
$router->post('/user/delete', [\App\Controllers\User\UserDeleteController::class, 'delete']);
$router->post("/user/edit", [\App\Controllers\User\UserEditController::class, 'update']);
