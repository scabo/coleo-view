<?php

namespace Coleo\View\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ViteExtension extends AbstractExtension
{
    private string $manifestPath;
    private array $manifest = [];

    public function __construct(string $manifestPath)
    {
        $this->manifestPath = $manifestPath;
        $this->loadManifest();
    }

    private function loadManifest(): void
    {
        if (file_exists($this->manifestPath)) {
            $this->manifest = json_decode(file_get_contents($this->manifestPath), true);
        }
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('vite_asset', [$this, 'getViteAsset']),
            new TwigFunction('vite_css', [$this, 'getViteCss']),
        ];
    }

    public function getViteAsset(string $entry): string
    {
        if (!isset($this->manifest[$entry])) {
            throw new \RuntimeException("Asset '{$entry}' not found in manifest");
        }

        return '/build/' . $this->manifest[$entry]['file'];
    }

    public function getViteCss(string $entry): string
    {
        if (!isset($this->manifest[$entry]) || !isset($this->manifest[$entry]['css'])) {
            return '';
        }

        $cssFiles = $this->manifest[$entry]['css'];
        return '/build/' . $cssFiles[0];
    }
}
