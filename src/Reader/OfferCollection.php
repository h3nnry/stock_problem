<?php

declare(strict_types=1);

namespace App\Reader;

use App\Reader\Interfaces\OfferCollectionInterface;
use App\Reader\Interfaces\OfferInterface;
use Iterator;

/**
 * Class OfferCollection
 * @package App\Reader
 */
class OfferCollection implements OfferCollectionInterface, Iterator
{
    private int $position = 0;
    private array $data = [];



    public function get(int $index): OfferInterface
    {
        if (!isset($this->data[$index])) {
            trigger_error("Undefined array key {$index}", E_USER_WARNING);
        }
        return $this->data[$index];
    }

    public function getIterator(): Iterator
    {
        return $this;
    }

    /**
     * Return the current element
     * @link https://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        return $this->data[$this->position];
    }

    /**
     * Move forward to next element
     * @link https://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * Return the key of the current element
     * @link https://php.net/manual/en/iterator.key.php
     * @return string|float|int|bool|null scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Checks if current position is valid
     * @link https://php.net/manual/en/iterator.valid.php
     * @return bool The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid(): bool
    {
        return isset($this->data[$this->position]);
    }

    /**
     * Rewind the Iterator to the first element
     * @link https://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * @param OfferInterface $offer
     */
    public function addOne(OfferInterface $offer): void
    {
        $this->data[] = $offer;
    }

    /**
     * @param array $offers
     */
    public function addMultiple(array $offers): void
    {
        foreach ($offers as $offer) {
            $this->addOne(new Offer(...$offer));
        }
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}