<?php
define("DS", DIRECTORY_SEPARATOR);
define("ROOT_DIR", dirname(__DIR__));
define('SESSION_TIMEOUT', 1800); // 30 minutos
require_once '..' .DS . 'vendor' . DS . 'autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOT_DIR);
$dotenv->load();

use \Core\Router;

$router = new Router();

// Definir as rotas
require_once __DIR__ .DS . '..' . DS . 'config' . DS . 'router.php';

// Resolver a rota e chamar o controller apropriado
$router->resolve();
?>