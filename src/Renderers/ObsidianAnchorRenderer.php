<?php

namespace Dsnr\ObsidianCommonmarkExtension\Renderers;

use Dsnr\ObsidianCommonmarkExtension\Node\Inline\Anchor;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Xml\XmlNodeRendererInterface;


final class ObsidianAnchorRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{

    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        Anchor::assertInstanceOf($node);

        $attrs = $node->data->get('attributes');

        if (($id = $node->getId()) !== null) {
            $attrs['id'] = $id;
        }

        return new HtmlElement('a', $attrs,$childRenderer->renderNodes($node->children()));
    }


    public function getXmlTagName(Node $node): string
    {
        return 'anchor';
    }

    public function getXmlAttributes(Node $node): array
    {
        return [ ];
    }
}
