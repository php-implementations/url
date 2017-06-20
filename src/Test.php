<?php declare(strict_types=1);

namespace PhpImplementations\Url;

use Auryn\Injector;
use League\CLImate\CLImate;
use League\CLImate\TerminalObject\Dynamic\Progress;
use PhpImplementations\Url\Implementation\Implementation;
use PhpImplementations\Url\Output\Writer;
use PhpImplementations\Url\Test\TestRunner;

class Test
{
    private $progressCounter = 0;

    private $progress;

    private $auryn;

    private $climate;

    private $inputDirectory;

    private $outputWriter;

    public function __construct(Injector $auryn, CLImate $climate, string $inputDirectory, Writer $outputWriter)
    {
        $this->auryn          = $auryn;
        $this->climate        = $climate;
        $this->inputDirectory = $inputDirectory;
        $this->outputWriter   = $outputWriter;
    }

    public function run(array $implementations, array $tests, array $inputs): void
    {
        $this->progress = $this->climate->progress()->total(count($implementations) * count($tests) * count($inputs));

        foreach ($tests as $test) {
            $this->runTest($this->auryn->make($test), $implementations, $inputs);
        }
    }

    private function runTest(TestRunner $test, array $implementations, array $inputs): void
    {
        foreach ($implementations as $implementation) {
            $this->runTestWithInput($test, $this->auryn->make($implementation), $inputs);
        }
    }

    private function runTestWithInput(TestRunner $test, Implementation $parser, array $inputs): void
    {
        foreach ($inputs as $input) {
            /** @var Progress $progress */
            $this->progress->current(
                ++$this->progressCounter, $this->buildProgressMessage($test, $parser, $input)

            );

            /** @noinspection PhpIncludeInspection */
            $result = $test->test(require $this->inputDirectory . '/' . $input, $parser);

            $this->outputWriter->store($this->getClassName($parser), $this->getClassName($test), $input, $result);
        }
    }

    private function buildProgressMessage(TestRunner $test, Implementation $parser, string $input): string
    {
        return sprintf(
            'Running %s on %s using set %s', $this->getClassName($test), $this->getClassName($parser), $input
        );
    }

    private function getClassName($object): string
    {
        return (new \ReflectionClass($object))->getShortName();
    }
}
