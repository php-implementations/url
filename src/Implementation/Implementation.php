<?php declare(strict_types=1);

namespace PhpImplementations\Url\Implementation;

interface Implementation
{
    public function isUrlValid(string $url): bool;
}
