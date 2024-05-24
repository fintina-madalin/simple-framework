<?php

namespace App\Core;

use App\Core\Exceptions\ViewException;
class View
{
    private string $viewsDir;
    private string $layout;

    public function __construct(string $viewsDir, ?string $layout = null)
    {
        $this->viewsDir = rtrim($viewsDir, '/') . '/';
        $this->layout = $layout ?? Config::get('template')['layout'];
    }

    public function render(string $template, array $data = []): void
    {
        $templatePath = $this->viewsDir . $template . '.php';

        if (!file_exists($templatePath)) {
            throw new ViewException("Template '$template' not found at path '$templatePath'");
        }

        $content = $this->renderTemplate($templatePath, $data);

        // Wrap the content in the layout
        $layoutPath = $this->viewsDir . $this->layout . '.php';
        if (file_exists($layoutPath)) {
            echo $this->renderTemplate($layoutPath, array_merge($data, ['content' => $content]));
        } else {
            // Fallback: if the layout file is not found, just render the content
            echo $content;
        }
    }

    private function renderTemplate(string $templatePath, array $data): string
    {
        extract($data, EXTR_SKIP);
        ob_start();
        require $templatePath;
        return ob_get_clean();
    }
}
