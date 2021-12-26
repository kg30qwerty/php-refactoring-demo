<?php

namespace Refactoring\Products;

use Brick\Math\BigDecimal;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Product
{
    /**
     * @var UuidInterface
     */
    private $serialNumber;

    /**
     * @var Price
     */
    private $price;

    /**
     * @var Description
     */
    private $description;

    /**
     * @var int
     */
    private $counter;

    /**
     * Product constructor.
     * @param Price $price
     * @param Description $description
     * @param int $counter
     */
    public function __construct(Price $price, Description $description, int $counter)
    {
        $this->serialNumber = Uuid::uuid4();
        $this->price = $price;
        $this->description = $description;
        $this->counter = $counter;
    }

    /**
     * @return BigDecimal
     */
    public function getPrice(): BigDecimal
    {
        return $this->price->getSum();
    }

    /**
     * @return UuidInterface
     */
    public function getSerialNumber(): UuidInterface
    {
        return $this->serialNumber;
    }

    /**
     * @return int
     */
    public function getCounter(): int
    {
        return $this->counter;
    }

    /**
     * @param BigDecimal $newPrice
     * @throws \Exception
     */
    public function changePriceTo(BigDecimal $newPrice): void
    {
        if ($this->counter > 0) {
            $this->price->change($newPrice);
        }
    }

    /**
     * @param string $charToReplace
     * @param string $replaceWith
     * @throws \Exception
     */
    public function replaceCharFromDesc(string $charToReplace, string $replaceWith): void
    {
       $this->description->replaceChar($charToReplace, $replaceWith);
    }

    /**
     * @return string
     */
    public function formatDesc(): string
    {
        return $this->description->format();
    }


    /**
     * @param int $counterToCheck
     * @throws \Exception
     */
    private function checkIfCounterIsNegative(int $counterToCheck): void
    {
        if ($counterToCheck < 0) {
            throw new \Exception("Negative counter");
        }
    }

    /**
     * @throws \Exception
     */
    public function decrementCounter(): void
    {
        $this->price->checkCorrect();
        $this->counter = $this->counter - 1;
        $this->checkIfCounterIsNegative($this->counter);
    }

    /**
     * @throws \Exception
     */
    public function incrementCounter(): void
    {
        $this->price->checkCorrect();
        $this->checkIfCounterIsNegative($this->counter + 1);
        $this->counter = $this->counter + 1;
    }
}