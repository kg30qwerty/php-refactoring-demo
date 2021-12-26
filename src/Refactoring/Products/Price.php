<?php
namespace Refactoring\Products;

use Brick\Math\BigDecimal;

class Price
{
    /**
     * @var BigDecimal
     */
    private $sum;


    /**
     * Price constructor.
     * @param BigDecimal $price
     */
    public function __construct(BigDecimal $sum)
    {
        $this->sum = $sum;
    }

    /**
     * @return BigDecimal
     */
    public function getSum(): BigDecimal
    {
        return $this->sum;
    }

    /**
     * @throws \Exception
     */
    public function checkCorrect()
    {
        if ($this->sum->getSign() <= 0) {
            throw new \Exception("Invalid price");
        }
    }

    /**
     * @param BigDecimal $newPrice
     * @throws \Exception
     */
    public function change(BigDecimal $newPrice): void
    {
        $this->sum = $newPrice;
    }
}