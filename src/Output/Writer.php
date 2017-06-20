<?php declare(strict_types=1);

namespace PhpImplementations\Url\Output;

class Writer
{
    private $path;

    public function __construct(string $path)
    {
        if (!is_dir($path)) {
            throw new \Exception('Invalid output path.');
        }

        $this->path = $path;
    }

    public function store(string $library, string $test, string $source, array $data): void
    {
        $storagePath = $this->path . '/' . $library . '/' . $test;

        @mkdir($storagePath, 766, true);

        if (!is_dir($storagePath)) {
            throw new \Exception('Could not create output directory.');
        }

        file_put_contents($storagePath . '/' . $source, '<?php return ' . var_export($data, true) . ';');
    }
}
