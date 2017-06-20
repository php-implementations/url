<?php declare(strict_types=1);

namespace PhpImplementations\Cli;

use Auryn\Injector;
use League\CLImate\CLImate;
use League\CLImate\TerminalObject\Dynamic\Progress;
use PhpImplementations\Url\Parser\MathiasBynens as MathiasBynensParser;
use PhpImplementations\Url\Retriever\MathiasBynens as MathiasBynensRetriever;

require_once __DIR__ . '/../bootstrap.php';

$climate = new CLImate();

$dataSources = [
    'MathiasBynens' => [
        'retriever' => MathiasBynensRetriever::class,
        'parser'    => MathiasBynensParser::class,
    ],
];

$progress = $climate->progress()->total(count($dataSources) * 2);

$progressCounter = 0;

foreach ($dataSources as $key => $dataSource) {
    /** @var Injector $auryn */
    $retriever = $auryn->make($dataSource['retriever']);
    $parser    = $auryn->make($dataSource['parser']);

    /** @var Progress $progress */
    $progress->current(++$progressCounter, sprintf('Retrieving %s test data', $key));

    $sourceData = $retriever->retrieve();

    $progress->current(++$progressCounter, sprintf('Parsing %s test data', $key));

    file_put_contents(
        __DIR__ . '/../data/input/' . $key . '.php',
        '<?php $matches = ' . var_export($parser->parse($sourceData), true) . ';'
    );
}
