<?php

declare(strict_types=1);

namespace Coleo\View;

use Twig\Extension\AbstractExtension;

class TwigViewer implements ViewerInterface
{
    private \Twig\Environment $twig;

    public function __construct($templatePath, $options = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader($templatePath);
        $this->twig = new \Twig\Environment($loader, $options);
    }

    public function addExtension(AbstractExtension $extension): self
    {
        $this->twig->addExtension($extension);
        return $this;
    }

    public function addGlobal($varName, $value): self
    {
        $this->twig->addGlobal($varName, $value);
        return $this;
    }

    public function render(string $template, array $data = []): string
    {
        return $this->twig->render($template . '.html.twig', $data);
    }
}
