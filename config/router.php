<?php
// Método GET
$router->get('/', [\App\Controllers\Site\PaginaPrincipalController::class, 'get']);
$router->get('/acesso-negado', [\App\Controllers\AcessoNegadoController::class, 'index']);
$router->get('/admin/users', [\App\Controllers\Admin\AdminController::class, 'index']);
$router->get('/admin/users/edit', [\App\Controllers\Admin\AdminController::class, 'edit']);
$router->get('/contato', [\App\Controllers\Site\ContatoController::class, 'get']);
$router->get("/home", [\App\Controllers\Site\HomeController::class, 'get']);
$router->get("/login", [\App\Controllers\LoginController::class, 'get']);
$router->get("/logout", [\App\Controllers\LoginController::class, 'logout']);
$router->get("/register", [\App\Controllers\User\UserRegisterController::class, 'get']);
$router->get('/user/delete', [\App\Controllers\User\UserDeleteController::class, 'get']);
$router->get("/user/edit", [\App\Controllers\User\UserEditController::class, 'get']);

// Método POST
$router->post('/admin/users/update', [\App\Controllers\Admin\AdminController::class, 'update']);
$router->post('/admin/users/delete', [\App\Controllers\Admin\AdminController::class, 'delete']);
$router->post('/contato/enviar', [\App\Controllers\Site\ContatoController::class, 'send']);
$router->post("/login", [\App\Controllers\LoginController::class, 'login']);
$router->post("/register", [\App\Controllers\User\UserRegisterController::class, 'create']);
$router->post('/user/delete', [\App\Controllers\User\UserDeleteController::class, 'delete']);
$router->post("/user/edit", [\App\Controllers\User\UserEditController::class, 'update']);
?>