<?php
namespace Core;

class Router
{
    private array $routes = [];

    public function get(string $uri, callable $controller): void
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post(string $uri, callable $controller): void
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function resolve():void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $route = $this->routes[$method][$uri] ?? null;

        if (is_callable($route)) {
            call_user_func($route);
        } else {
            echo "Erro 404 - Página não encontrada<br> <a href='/home'>Voltar</a>";
        }

        /*
        * Nova abordagem ensinada, porém não tão eficaz
        if (isset($this->routes[$method][$uri])) {
            $controller = $this->routes[$method][$uri];
            $controllerInstance = new $controller();
            $controllerInstance->index();  // Método padrão
        } else {
            echo "404 - Página não encontrada";
        }
            */ 
    }
}
?>