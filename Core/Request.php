<?php
namespace Core;

class Request
{
    private string $contentType = '';
    private string $uri = '';
    private string $method = '';
    private array $queryParams = [];
    private array $body = [];
    private array $api = [];

    public function __construct()
    {
        $this->contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $this->uri = explode('?', $_SERVER['REQUEST_URI'])[0] ?? '';
        $this->method = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->queryParams = $_GET ?? [];
        $this->body = $_POST ?? [];
        $this->api = json_decode(file_get_contents('php://input'), true) ?? [];
    }

    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    public function getUri(): ?string
    {
        return rtrim($this->uri, '/') ?: '/';
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function getParam(string $key): ?string
    {
        return $this->queryParams[$key] ?? '';
    }

    public function params(): ?array
    {
        return $this->queryParams;
    }

    public function getBody(string $key): ?string
    {
        if (str_contains($this->getContentType(), 'application/json')) {
            return $this->api[$key];
        }

        if (str_contains($this->getContentType(), 'application/x-www-form-urlencoded')) {
            return $this->body[$key];
        }

        return '';
    }

    public function body(): ?array
    {
        if (str_contains($this->getContentType(), 'application/json')) {
            return $this->api;
        }

        if (str_contains($this->getContentType(), 'application/x-www-form-urlencoded')) {
            return $this->body;
        }

        return [];
    }

}
?>