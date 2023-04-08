<?php

namespace Dsnr\ObsidianCommonmarkExtension\Parsers;

use Illuminate\Support\Str;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Parser\Inline\InlineParserInterface;
use League\CommonMark\Parser\Inline\InlineParserMatch;
use League\CommonMark\Parser\InlineParserContext;

class ObsidianLinkParser implements InlineParserInterface
{

    public function getMatchDefinition(): InlineParserMatch
    {
        return InlineParserMatch::regex('(?<!!)\[\[([^\]\|#]+)?(?:#([^\|\]]+))?(?:\|([^\]]+))?\]\]');
    }

    public function parse(InlineParserContext $inlineContext): bool
    {
        $cursor = $inlineContext->getCursor();

        $cursor->advanceBy($inlineContext->getFullMatchLength());

        $subMatches  = $inlineContext->getSubMatches();
        $docsVersion = request()->segment(2);
        $linkName    = $subMatches[0];
        $linkAnchor  = $subMatches[1] ?? null;
        $linkText    = $subMatches[2] ?? $linkName ?: $linkAnchor;
        $linkUrl     = url('/docs/' . $docsVersion . '/' .  Str::slug($linkName));

        if ($linkAnchor) {
            $linkUrl .= '#' . $linkAnchor;
        }

        $inlineContext->getContainer()->appendChild(new Link($linkUrl, $linkText));

        return true;
    }
}
