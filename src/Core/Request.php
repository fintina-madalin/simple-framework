<?php

namespace App\Core;

class Request
{
    private array $get;
    private array $post;
    private array $server;

    public const POST = 'POST';
    public const GET = 'GET';

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
    }

    public function get(?string $key = null): mixed
    {
        if ($key === null) {
            return $this->get;
        }
        return $this->get[$key] ?? null;
    }

    public function post(?string $key = null): mixed
    {
        if ($key === null) {
            return $this->post;
        }
        return $this->post[$key] ?? null;
    }

    public function server(?string $key = null): mixed
    {
        if ($key === null) {
            return $this->server;
        }
        return $this->server[$key] ?? null;
    }

    public function getMethod(): mixed
    {
        return $this->server('REQUEST_METHOD');
    }

    public function getUri(): mixed
    {
        return $this->server('REQUEST_URI');
    }
}