<?php
declare(strict_types=1);

namespace Tests\Refactoring\Products;

use Brick\Math\BigDecimal;
use PHPUnit\Framework\TestCase;
use Refactoring\Products\Price;

class PriceTest extends TestCase
{
    /**
     * @test
     */
    public function testCreatePriceObjectWithNullArgumentWillThrowException()
    {
        $this->expectException(\TypeError::class);
        $price = new Price(null);
    }

    /**
     * @test
     */
    public function testCorrectPrice()
    {
        // given
        $price = $this->createPrice(BigDecimal::ten());

        // when
        $price->checkCorrect();

        // then
        $this->assertEquals(BigDecimal::ten(), $price->getSum());
    }

    /**
     * @test
     */
    public function canChangePrice()
    {
        // given
        $price = $this->createPrice(BigDecimal::zero());

        // when
        $price->change(BigDecimal::ten());

        // then
        $this->assertEquals(BigDecimal::ten(), $price->getSum());
    }

    /**
     * @param BigDecimal $price
     * @return Price
     */
    private function createPrice(BigDecimal $price): Price
    {
        return new Price($price);
    }
}