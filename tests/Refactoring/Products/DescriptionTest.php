<?php
declare(strict_types=1);

namespace Tests\Refactoring\Products;

use PHPUnit\Framework\TestCase;
use Refactoring\Products\Description;

class DescriptionTest extends TestCase
{
    /**
     * @test
     */
    public function canReplaceChar()
    {
        //given
        $description = $this->createDescription("short", "long");

        //when
        $description->replaceChar('s', 'z');

        //expect
        $this->assertEquals("zhort *** long", $description->format());
    }

    /**
     * @test
     */
    public function canFormatDescription(): void
    {
        //expect
        $this->assertEquals("short *** long", $this->createDescription("short", "long")->format());
        $this->assertEquals("", $this->createDescription("short", "")->format());
        $this->assertEquals("", $this->createDescription("", "long2")->format());
    }

    /**
     * @param string $desc
     * @param string $longDesc
     * @return Description
     */
    private function createDescription(string $desc, string $longDesc): Description
    {
        return new Description($desc, $longDesc);
    }
}