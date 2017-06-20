<?php declare(strict_types=1);

namespace PhpImplementations\Url\Retriever;

interface Retriever
{
    public function retrieve(): string;
}
