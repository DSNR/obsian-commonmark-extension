<?php

namespace Dsnr\ObsidianCommonmarkExtension\Parsers;

use Illuminate\Support\Str;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\Parser\Inline\InlineParserInterface;
use League\CommonMark\Parser\Inline\InlineParserMatch;
use League\CommonMark\Parser\InlineParserContext;

class ObsidianImageParser implements InlineParserInterface
{
    private $imagePath;

    public function __construct($imagePath)
    {

        $this->imagePath = $imagePath;
    }

    public function getMatchDefinition(): InlineParserMatch
    {
        return InlineParserMatch::regex('!\[\[([^\|\]#]+)\.([^\|\]#]+)(?:(?:\|([0-9]+)(?:x([0-9]+))?)|(?:#page=([0-9]+))?)\]\]');
    }

    public function parse(InlineParserContext $inlineContext): bool
    {

        $cursor = $inlineContext->getCursor();

        $cursor->advanceBy($inlineContext->getFullMatchLength());

        $matches = $inlineContext->getSubMatches();

        $filename  = Str::slug($matches[0]);

        $extension = $matches[1];

        $imageUrl  = $this->imagePath . '/'. $filename . '.' .  $extension;

        $inlineContext->getContainer()->appendChild(new Image($imageUrl, $matches[0]));

        return true;

    }
}
