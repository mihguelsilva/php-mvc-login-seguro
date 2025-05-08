<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'consts.php';
require ROOT_DIR .DS . 'vendor' . DS . 'autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOT_DIR);
$dotenv->load();

use \Core\{Acl, Container, Request, Router};

$container = new Container();
require ROOT_DIR . DS . 'config' . DS . 'dependencies.php';


$router = new Router($container->get(Request::class), $container->get(Acl::class), $container);

// Definir as rotas
require_once __DIR__ .DS . '..' . DS . 'config' . DS . 'router.php';

// Resolver a rota e chamar o controller apropriado
$router->resolve();
?>