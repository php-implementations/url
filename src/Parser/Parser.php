<?php declare(strict_types=1);

namespace PhpImplementations\Url\Parser;

interface Parser
{
    public function parse(string $sourceData): array;
}
