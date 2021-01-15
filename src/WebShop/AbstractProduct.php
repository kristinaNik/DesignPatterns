<?php


namespace DesignPatterns\WebShop;

use Money\Currency;
use Money\Money;
use Ramsey\Uuid\UuidInterface;

class AbstractProduct implements Product
{
    //Value objects are immutable by design
    //Value objects also have types, so this bring type safety

    /* @var UuidInterface
     */
    protected UuidInterface $sku;

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var int
     */
    protected int  $productQuantity;

    /**
     * @var Money|null
     */
    protected $unitPrice;


    /**
     * AbstractProduct constructor.
     * @param UuidInterface $uuid
     * @param string $name
     * @param int $productQuantity
     * @param Money|null $unitPrice
     */
    public function __construct(UuidInterface $uuid, string $name, int $productQuantity, Money $unitPrice=null)
    {
        $this->sku = $uuid;
        $this->name = $name;
        $this->productQuantity = $productQuantity;
        $this->unitPrice = $unitPrice;
    }


    /**
     * @return UuidInterface
     */
    public function getSku(): UuidInterface
    {
        return $this->sku;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return Money
     */
    public function getUnitPrice(): Money
    {
        return  $this->unitPrice;

    }

    /**
     * @return int
     */
    public function getProductQuantity(): int
    {
        return $this->productQuantity;
    }
}