<?php declare(strict_types=1);

namespace PhpImplementations\Url\Implementation;

use function Sabre\Uri\parse;

class Sabre implements Implementation
{
    public function isUrlValid(string $url): bool
    {
        try {
            $uri = parse($url);
        } catch(\Throwable $e) {
            return false;
        }

        return (bool) array_filter($uri);
    }
}
