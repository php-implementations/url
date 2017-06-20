<?php declare(strict_types=1);

namespace PhpImplementations\Cli;

use Auryn\Injector;
use League\CLImate\CLImate;
use PhpImplementations\Url\Implementation\Madkom;
use PhpImplementations\Url\Output\Writer;
use PhpImplementations\Url\Test;
use PhpImplementations\Url\Test\Validity;

require_once __DIR__ . '/../bootstrap.php';

$implementations = [
    Madkom::class,
];

$tests = [
    Validity::class,
];

$inputs = [
    'MathiasBynens.php',
];

/** @var Injector $auryn */
(new Test($auryn, new CLImate(), __DIR__ . '/../data/input', new Writer(__DIR__ . '/../data/output')))
    ->run($implementations, $tests, $inputs)
;
