<?php

namespace App\Support\Markdown;

use InvalidArgumentException;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\Heading;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;

class HeadingRenderer implements BlockRendererInterface
{
    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        if (! ($block instanceof Heading)) {
            throw new InvalidArgumentException('Incompatible block type: ' . get_class($block));
        }

        $tag = 'h' . $block->getLevel();

        $attrs = $block->getData('attributes', [
            'class' => 'heading-level-' . $block->getLevel(),
        ]);

        return new HtmlElement(
            $tag,
            $attrs,
            $htmlRenderer->renderInlines($block->children())
        );
    }
}
