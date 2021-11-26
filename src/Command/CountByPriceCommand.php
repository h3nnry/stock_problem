<?php

declare(strict_types=1);

namespace App\Command;


use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Class CountByPriceCommand
 * @package App\Commands
 */
class CountByPriceCommand extends BaseCommand
{
    protected float $from;
    protected float $to;

    /**
     * Configure current command.
     */
    protected function configure(): void
    {
        $this->setName('count_by_price_range')
            ->setDescription('Count by price range command.')
            ->setHelp('Provide float values from and to in order to get results count.')
            ->addArgument('from', InputArgument::REQUIRED)
            ->addArgument('to', InputArgument::REQUIRED);
    }

    /**
     * Initializes the command after the input has been bound and before the input
     * is validated.
     *
     * This is mainly useful when a lot of commands extends one main command
     * where some things need to be initialized based on the input arguments and options.
     *
     * @see InputInterface::bind()
     * @see InputInterface::validate()
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->from = (float) $this->loadArgument('from', $input);
        $this->to = (float) $this->loadArgument('to', $input);

        if ($this->to <= $this->from) {
            throw new InvalidArgumentException('To need to be greater whan from.');
        }

        $this->fetchOffers();
    }

    /**
     * Executes the current command.
     *
     * This method is not abstract because you can use this class
     * as a concrete class. In this case, instead of defining the
     * execute() method, you set the code to execute by passing
     * a Closure to the setCode() method.
     *
     * @return int 0 if everything went fine, or an exit code
     *
     * @throws LogicException When this abstract method is not implemented
     *
     * @see setCode()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $count = 0;
        foreach ($this->offers as $offer) {
            if ($offer->getPrice() >= $this->from && $offer->getPrice() <= $this->to) {
                $count++;
            }
        }

        $output->writeln("Number of offers with price between {$this->from} and {$this->to} is {$count}");

        return $count;
    }
}