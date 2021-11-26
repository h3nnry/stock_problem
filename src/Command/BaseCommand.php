<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use App\Reader\Reader;
use App\Reader\Interfaces\OfferCollectionInterface;
use Symfony\Component\Console\Exception\InvalidArgumentException;

/**
 * Class BaseCommand
 * @package App\Commands
 */
class BaseCommand extends Command
{
    /** @var OfferCollectionInterface */
    protected $offers;

    /**
     *
     */
    protected function fetchOffers(): void
    {
        $this->offers = (new Reader(format: Reader::FORMAT_JSON))->read(__DIR__ . '/../../data/offers.json');
    }

    /**
     * @param string $name
     * @param InputInterface $input
     * @return string|null
     */
    protected function loadArgument(string $name, InputInterface $input): ?string
    {
        foreach ($input->getArguments() as $key => $value) {
            if ($name == $key) {
                if (isset($value)) {
                    return $value;
                } else {
                    throw new InvalidArgumentException("Value for {$key} is missing.");
                }
            }
        }
        return null;
    }
}