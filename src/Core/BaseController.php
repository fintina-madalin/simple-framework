<?php

namespace App\Core;

abstract class BaseController
{
    protected View $view;
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->view = new View(Config::get('template')['path']);
        $this->request = $request;
    }

    protected function render(string $template, array $data = []): void
    {
        $this->view->render($template, $data);
    }

    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }
    protected function download(string $content, string $contentType, string $filename): void
    {
        header('Content-Type: ' . $contentType);
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($content));
        echo $content;
    }
}