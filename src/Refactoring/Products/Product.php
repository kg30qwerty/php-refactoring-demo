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
     * @var int
     */
    private $counter;

    /**
     * @var Price
     */
    private $price;

    /**
     * @var Description
     */
    private $description;

    /**
     * Product constructor.
     * @param BigDecimal $price
     * @param string $desc
     * @param string $longDesc
     * @param int $counter
     */
    public function __construct(BigDecimal $price, string $desc, string $longDesc, int $counter)
    {
        $this->serialNumber = Uuid::uuid4();
        $this->counter = $counter;
        $this->description = new Description($desc, $longDesc);
        $this->price = new Price($price);
    }

    /**
     * @return UuidInterface
     */
    public function getSerialNumber(): UuidInterface
    {
        return $this->serialNumber;
    }

    /**
     * @return BigDecimal
     */
    public function getPrice(): BigDecimal
    {
        return $this->price->getSum();
    }

    /**
     * @return string
     */
    public function getDesc(): string
    {
        return $this->description->getDesc();
    }

    /**
     * @return string
     */
    public function getLongDesc(): string
    {
        return $this->description->getLongDesc();
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