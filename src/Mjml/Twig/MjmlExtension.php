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
     * @var string
     */
    private $mjmlFilePath;

    /**
     * MjmlExtension constructor.
     *
     * @param RendererInterface $renderer
     * @param string $mjmlFilePath if set, reads this mjml file and creates a mjml.html file which will be read and return on render
     */
    public function __construct(RendererInterface $renderer, string $mjmlFilePath = "")
    {
        $this->renderer = $renderer;
        $this->mjmlFilePath = $mjmlFilePath;
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
        if ($this->mjmlFilePath !== '') {
            $this->writeInFile($content);
        }
        return $this->renderer->render($content);
    }

    private function writeInFile(string $content)
    {
        $myfile = fopen($this->mjmlFilePath, "w") or die("Unable to open file!");
        fwrite($myfile, $content);
        fclose($myfile);
    }
}
