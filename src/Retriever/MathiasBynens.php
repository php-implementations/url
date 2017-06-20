<?php declare(strict_types=1);

namespace PhpImplementations\Url\Retriever;

use Amp\Artax\HttpClient;
use function Amp\wait;

class MathiasBynens implements Retriever
{
    const URL = 'https://mathiasbynens.be/demo/url-regex';

    private $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function retrieve(): string
    {
        return wait($this->httpClient->request(self::URL))->getBody();
    }
}
