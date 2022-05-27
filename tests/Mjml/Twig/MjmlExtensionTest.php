<?php

namespace Qferrer\Tests\Mjml\Twig;

use Twig\Node\Node;
use Twig\TwigFilter;
use PHPUnit\Framework\TestCase;
use Qferrer\Mjml\RendererInterface;
use Qferrer\Mjml\Twig\MjmlExtension;

class MjmlExtensionTest extends TestCase
{
    protected $renderer;
    protected $extension;

    public function setUp(): void
    {
        $this->renderer = $this->createMock(RendererInterface::class);
        $this->extension = new MjmlExtension($this->renderer);
    }

    public function testGetFilters()
    {
        $filters = $this->extension->getFilters();
        $this->assertCount(1, $filters);

        /** @var TwigFilter $filter */
        $filter = array_shift($filters);
        $this->assertEquals('mjml_to_html', $filter->getName());
        $this->assertEquals([$this->extension, 'render'], $filter->getCallable());
        $this->assertContains('all', $filter->getSafe($this->createMock(Node::class)));
    }

    public function testRender()
    {
        $content = '<mjml></mjml>';

        $this->renderer
            ->expects($this->exactly(1))
            ->method('render')
            ->with($content);

        $this->extension->render($content);
    }
}
