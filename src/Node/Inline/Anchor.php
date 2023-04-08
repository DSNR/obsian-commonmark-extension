<?php

namespace Dsnr\ObsidianCommonmarkExtension\Node\Inline;

use League\CommonMark\Node\Inline\AbstractInline;

class Anchor extends AbstractInline
{
    protected $id;

    public function __construct(string $id)
    {
        parent::__construct();

        $this->id = $id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }
}
