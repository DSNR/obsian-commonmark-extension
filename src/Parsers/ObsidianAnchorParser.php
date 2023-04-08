<?php

namespace Dsnr\ObsidianCommonmarkExtension\Parsers;

use Dsnr\ObsidianCommonmarkExtension\Node\Inline\Anchor;
use League\CommonMark\Parser\Inline\InlineParserInterface;
use League\CommonMark\Parser\Inline\InlineParserMatch;
use League\CommonMark\Parser\InlineParserContext;


class ObsidianAnchorParser implements InlineParserInterface
{

    public function getMatchDefinition(): InlineParserMatch
    {
       return InlineParserMatch::regex('\^\w+');
    }

    public function parse(InlineParserContext $inlineContext): bool
    {
        $cursor = $inlineContext->getCursor();

        $previousChar = $cursor->peek(-1);

        if ($previousChar !== null && $previousChar !== ' ') {
            return false;
        }

        $cursor->advanceBy($inlineContext->getFullMatchLength());

        $match = $inlineContext->getFullMatch();

        $inlineContext->getContainer()->appendChild(new Anchor($match));

        return true;
    }
}
