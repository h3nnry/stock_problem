<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Command\CountByPriceCommand;
use App\Reader\Offer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Formatter\OutputFormatterInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class OfferTest extends TestCase
{
    public function testCheckOffer(): void
    {
//        $offer = new Offer(offerId: 1, );
        $command = new CountByPriceCommand();
//        $command->addArgument('from', 0);
//        $command->addArgument('to', 0);
        $mockInput = $this->createMock(InputInterface::class);
        $mockOutput = $this->createMock(OutputInterface::class);
        $method = $mockInput->method('getArguments');
        $method->willReturn(['from' => '1', 'to' => '0']);

        $this->expectException(InvalidArgumentException::class);
        $res = $command->run($mockInput, $mockOutput);
//        $this->assertEquals($res, 3);
    }
}