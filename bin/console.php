<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use App\Command\CountByPriceCommand;
use App\Command\CountByAttributeCommand;

$app = new Application();
$app->add(new CountByPriceCommand());
$app->add(new CountByAttributeCommand());

try {
    $app->run(
        new ArgvInput(),
        new ConsoleOutput()
    );
} catch (\Exception $e) {
    // Handle application's exceptions
}