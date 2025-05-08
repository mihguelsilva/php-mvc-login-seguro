<?php
namespace Core;

class Router
{   
    private array $routes = [];
    private array $middlewares = [];

    public function __construct(
        private Request $request, 
        private Acl $acl, 
        private Container $container
    ) {}

    public function get(string $uri, callable|array $controller): void
    {
        $this->addRoutes('GET', $uri, $controller);
    }

    public function post(string $uri, callable|array $controller): void
    {
        $this->addRoutes('POST', $uri, $controller);
    }

    public function put(string $uri, callable|array $controller): void
    {
        $this->addRoutes('PUT', $uri, $controller);
    }

    public function delete(string $uri, callable|array $controller): void
    {
        $this->addRoutes('DELETE', $uri, $controller);
    }

    private function addRoutes(string $method, string $uri, callable|array $callback): void
    {
        $this->routes[$method][$uri] = $callback;
    }

    public function middleware(string $method, string $uri, callable|array $callback): void
    {
        $this->middlewares[$method][$uri] = $callback;
    }

    private function checkPermissions(string $class, string $method): void
    {
        $permission = "$class::$method";

        if (!$this->acl->hasAccess($permission)) {
            (new Response(403, ['error' => 'Acesso negado'], 'application/json'))->send();
            exit();
        }
    }

    public function controller(callable|array $route): mixed
    {
        if (is_array($route) && $route != []) {
            [$class, $method] = $route;

            $this->checkPermissions($class, $method);
            
            $controller = $this->container->get($class);

            if (!is_object($controller) && !class_exists($class)) {
                throw New \Exception("Classe '{$class}' não existe!");
            }

            if (!method_exists($controller, $method)) {
                throw New \Exception("Método '{$method}' não existe na classe '{$class}'!");
            }

            return call_user_func([$controller, $method], $this->request);
        }

        if ((is_callable($route))) {
            return call_user_func($route);
        }

        return false;
    }

    public function resolve():void
    {
        $method = $this->request->getMethod();
        $uri = $this->request->getUri();

        $route = $this->routes[$method][$uri] ?? [];
        $middleware = $this->middlewares[$method][$uri] ?? [];

        $this->controller($middleware);
        if ($this->controller($route) != false) exit();


        (new Response(404, ['error' => 'pagina não encontrada'], 'application/json'))->send();

        /*
        if (is_callable($route)) {
            call_user_func($route);
        } else {
            echo "Erro 404 - Página não encontrada<br> <a href='/home'>Voltar</a>";
        }
            */

        /**
         * Método utilizado para executar, de maneira dinâmica, sempre o index. A questão é
         * que todo o index teria que ter configurado uma estrutura de rotas, que para um projeto
         * em início, até seria interessante, mas não escalável.
        */
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