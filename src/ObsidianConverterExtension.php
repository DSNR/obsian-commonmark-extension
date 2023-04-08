<?php

namespace Dsnr\ObsidianCommonmarkExtension;

use Dsnr\ObsidianCommonmarkExtension\Node\Inline\Anchor;
use Dsnr\ObsidianCommonmarkExtension\Parsers\ObsidianAnchorParser;
use Dsnr\ObsidianCommonmarkExtension\Parsers\ObsidianImageParser;
use Dsnr\ObsidianCommonmarkExtension\Parsers\ObsidianLinkParser;
use Dsnr\ObsidianCommonmarkExtension\Renderers\ObsidianAnchorRenderer;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\ConfigurableExtensionInterface;
use League\Config\ConfigurationBuilderInterface;
use Nette\Schema\Expect;

class ObsidianConverterExtension implements ConfigurableExtensionInterface
{
    public function configureSchema(ConfigurationBuilderInterface $builder): void
    {
        $builder->addSchema('obsidian', Expect::structure([
            'base_image_path' => Expect::string()->default(''),
        ]));
    }

    public function register(EnvironmentBuilderInterface $environment): void
    {
        $imagePath = $environment->getConfiguration()->get('obsidian/base_image_path');

        $environment
            ->addInlineParser(new ObsidianImageParser($imagePath),  20)
            ->addInlineParser(new ObsidianLinkParser(),   100)
            ->addInlineParser(new ObsidianAnchorParser(), 0)

            ->addRenderer(Anchor::class, new ObsidianAnchorRenderer(), 0);
    }
}
