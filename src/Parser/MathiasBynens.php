<?php declare(strict_types=1);

namespace PhpImplementations\Url\Parser;

class MathiasBynens implements Parser
{
    public function parse(string $sourceData): array
    {
        $source= new \DOMDocument();
        $source->loadHTML($sourceData);

        $xpath = new \DOMXPath($source);

        return [
            'valid'   => $this->parseValid($xpath),
            'invalid' => $this->parseInvalid($xpath),
        ];
    }

    private function parseValid(\DOMXPath $source): array
    {
        $items = [];

        $started = false;

        foreach ($source->query('//table/tr') as $row) {
            if (!$started && trim($row->textContent) === 'These URLs should match (1 → correct)') {
                $started = true;

                continue;
            }

            if (!$started) {
                continue;
            }

            if (trim($row->textContent) === 'These URLs should fail (0 → correct)') {
                break;
            }

            $items[] = trim($row->getElementsByTagName('th')->item(0)->textContent);
        }

        return $items;
    }

    private function parseInvalid(\DOMXPath $source): array
    {
        $items = [];

        $started = false;

        foreach ($source->query('//table/tr') as $row) {
            if (!$started && trim($row->textContent) === 'These URLs should fail (0 → correct)') {
                $started = true;

                continue;
            }

            if (!$started) {
                continue;
            }

            $items[] = trim($row->getElementsByTagName('th')->item(0)->textContent);
        }

        return $items;
    }
}
