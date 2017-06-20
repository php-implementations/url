<?php declare(strict_types=1);

namespace PhpImplementations\Url\Test;

use PhpImplementations\Url\Implementation\Implementation;

class Validity implements TestRunner
{
    public function test(array $urls, Implementation $parser): array
    {
        return [
            'valid'   => $this->testValidUrls($urls['valid'], $parser),
            'invalid' => $this->testInvalidUrls($urls['valid'], $parser),
        ];
    }

    private function testValidUrls(array $urls, Implementation $parser): array
    {
        $results = [];

        foreach ($urls as $url) {
            $results[] = [
                'url'  => $url,
                'pass' => $parser->isUrlValid($url),
            ];
        }

        return $results;
    }

    private function testInvalidUrls(array $urls, Implementation $parser): array
    {
        $results = [];

        foreach ($urls as $url) {
            $results[] = [
                'url'  => $url,
                'pass' => $parser->isUrlValid($url) === false,
            ];
        }

        return $results;
    }
}
