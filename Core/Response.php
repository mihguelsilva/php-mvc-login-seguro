<?php

namespace Core;

class Response
{
    private int $statusCode = 200;
    private array $headers = [];
    private string $contentType = 'text/html';
    private mixed $body = '';

    public function __construct(int $statusCode, mixed $body, string $contentType = 'text/html') {
        $this->setStatusCode($statusCode);
        $this->setContentType($contentType);
        $this->setBody($body);
    }

    public function setStatusCode(int $status): void
    {
        $this->statusCode = $status;
    }

    public function setContentType(string $contentType): void
    {
        $this->contentType = $contentType;
        $this->addHeaders('Content-Type', $contentType);
    }

    public function addHeaders(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }

    public function setBody(mixed $content): void
    {
        $this->body = $content;
    }

    public function sendHeaders(): void
    {
        http_response_code($this->statusCode);

        foreach ($this->headers as $key => $value) {
            header("$key: $value");
        }
    }

    public function send(): void
    {
        $this->sendHeaders();
        switch ($this->contentType) {
            case 'text/html':
                echo $this->body;
                break;
            case 'application/json':
                $json = json_encode($this->body);
                if ($json === false) {
                    http_response_code(500);
                    echo json_encode(['error' => 'Failed to encode JSON']);
                } else {
                    echo $json;
                }
                break;

                default:
                echo $this->body;
                break;
        }
        exit();
    }
}
