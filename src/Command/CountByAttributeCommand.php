<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Reader\Offer;

/**
 * Class CountByAttributeCommand
 * @package App\Commands
 */
class CountByAttributeCommand extends BaseCommand
{
    protected string $name;
    protected string $value;

    /**
     * Configure current command.
     */
    protected function configure(): void
    {
        $this->setName('count_by_attribute')
            ->setDescription('Count by attribute command.')
            ->setHelp('Provide string attribute name and its value.')
            ->addArgument('name', InputArgument::REQUIRED)
            ->addArgument('value', InputArgument::REQUIRED);
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
        $this->name = (string) $this->loadArgument('name', $input);
        $this->value = (string) $this->loadArgument('value', $input);

        if (!property_exists(Offer::class, $this->name)) {
            throw new InvalidArgumentException("Offers objects dont have key {$this->name}.");
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
        $getProperty = 'get' . ucfirst($this->name);
        foreach ($this->offers as $offer) {
            if ($offer->{$getProperty}() == $this->value) {
                $count++;
            }
        }

        $output->writeln("Number of offers with {$this->name} equal to {$this->value} is {$count}");

        return $count;
    }
}