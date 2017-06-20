<?php declare(strict_types=1);

namespace PhpImplementations\Url\Implementation;

use Madkom\Uri\UriFactory;

class Madkom implements Implementation
{
    private $factory;

    public function __construct(UriFactory $factory)
    {
        $this->factory = $factory;
    }

    public function isUrlValid(string $url): bool
    {
        try {
            $uri = $this->factory->createUri($url);
        } catch(\Throwable $e) {
            return false;
        }

        return $url === $uri->toString();
    }
}
