<?php
// Método GET
$router->get('/', [new \App\Controllers\BeginController, 'getBegin']);
$router->get('/admin/users', [new \App\Controllers\AdminController, 'index']);
$router->get('/admin/users/edit', [new \App\Controllers\AdminController, 'edit']);
$router->get("/home", [new \App\Controllers\HomeController, 'getHome']);
$router->get("/login", [new \App\Controllers\LoginController, 'getLogin']);
$router->get("/logout", [new \App\Controllers\LoginController, 'logout']);
$router->get("/register", [new \App\Controllers\LoginController, 'getRegister']);
$router->get('/user/delete', [new \App\Controllers\LoginController, 'getDelete']);
$router->get("/user/edit", [new \App\Controllers\LoginController, 'getEditUser']);



// Método POST
$router->post('/admin/users/update', [new \App\Controllers\AdminController, 'update']);
$router->post('/admin/users/delete', [new \App\Controllers\AdminController, 'delete']);
$router->post("/login", [new \App\Controllers\LoginController, 'login']);
$router->post("/register", [new \App\Controllers\LoginController, 'createUser']);
$router->post('/user/delete', [new \App\Controllers\LoginController, 'deleteUser']);
$router->post("/user/edit", [new \App\Controllers\LoginController, 'updateUser']);
?>