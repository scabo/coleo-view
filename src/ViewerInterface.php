<?php

declare(strict_types=1);

namespace Coleo\View;

interface ViewerInterface
{
    public function addGlobal($varName, $value): self;
    public function render(string $template, array $data = []): string;
}
