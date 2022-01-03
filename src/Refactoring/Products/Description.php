<?php
declare(strict_types=1);

namespace Refactoring\Products;

class Description
{
    /**
     * @var string
     */
    private $desc;

    /**
     * @var string
     */
    private $longDesc;

    /**
     * Description constructor.
     * @param string $desc
     * @param string $longDesc
     */
    public function __construct(string $desc, string $longDesc)
    {
        $this->desc = $desc;
        $this->longDesc = $longDesc;
    }

    /**
     * @return string
     */
    public function getDesc(): string
    {
        return $this->desc;
    }

    /**
     * @return string
     */
    public function getLongDesc(): string
    {
        return $this->longDesc;
    }

    /**
     * @param string $charToReplace
     * @param string $replaceWith
     * @throws \Exception
     */
    public function replaceChar(string $charToReplace, string $replaceWith): void
    {
        if (empty($this->longDesc) || empty($this->desc)) {
            throw new \Exception("empty desc");
        }

        $this->longDesc = str_replace($charToReplace, $replaceWith, $this->longDesc);
        $this->desc = str_replace($charToReplace, $replaceWith, $this->desc);
    }

    /**
     * @return string
     */
    public function format(): string
    {
        if (empty($this->longDesc) || empty($this->desc)) {
            return "";
        }

        return $this->desc . " *** " . $this->longDesc;
    }
}