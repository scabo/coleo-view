<?php 

namespace Coleo\View;

interface ViewerInterface
{
    public function addGlobal($varName, $value): self;
    public function render(string $template, array $data = []): string;
}