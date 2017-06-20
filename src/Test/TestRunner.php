<?php declare(strict_types=1);

namespace PhpImplementations\Url\Test;

use PhpImplementations\Url\Implementation\Implementation;

interface TestRunner
{
    public function test(array $urls, Implementation $parser): array;
}
