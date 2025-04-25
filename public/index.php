<?php
define("DS", DIRECTORY_SEPARATOR);
require_once '..' .DS . 'vendor' . DS . 'autoload.php';

use \Core\Router;

$router = new Router();

// Definir as rotas
require_once __DIR__ .DS . '..' . DS . 'config' . DS . 'router.php';

// Resolver a rota e chamar o controller apropriado
$router->resolve();
?>