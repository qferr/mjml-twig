<?php

namespace Qferrer\Mjml\Twig;

use Twig\TwigFilter;
use Qferrer\Mjml\RendererInterface;
use Twig\Extension\AbstractExtension;

/**
 * Class MjmlExtension
 */
class MjmlExtension extends AbstractExtension
{
    /**
     * @var RendererInterface
     */
    protected $renderer;

    /**
     * MjmlExtension constructor.
     *
     * @param RendererInterface $renderer
     */
    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @inheritDoc
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('mjml_to_html', [$this, 'render'], ['is_safe' => ['all']])
        ];
    }

    /**
     * Render MJML to HTML
     *
     * @param string $content
     *
     * @return string The generated HTML
     */
    public function render(string $content): string
    {
        return $this->renderer->render($content);
    }
}
