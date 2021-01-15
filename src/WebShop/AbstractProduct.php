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
     * @var Money|null
     */
    protected $unitPrice;


    /**
     * AbstractProduct constructor.
     * @param UuidInterface $uuid
     * @param string $name
     * @param Money|null $unitPrice
     */
    public function __construct(UuidInterface $uuid, string $name,  Money $unitPrice=null)
    {
        $this->sku = $uuid;
        $this->name = $name;
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
}