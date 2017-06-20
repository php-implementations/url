<?php declare(strict_types=1);

namespace PhpImplementations\Url;

use Amp\Artax\Client;
use Amp\Artax\HttpClient;
use Auryn\Injector;

require_once __DIR__ . '/vendor/autoload.php';

$auryn = new Injector();

$auryn->alias(HttpClient::class, Client::class);
