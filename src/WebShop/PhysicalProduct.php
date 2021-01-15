<?php


namespace DesignPatterns\WebShop;

use Money\Money;
use Ramsey\Uuid\UuidInterface;

class PhysicalProduct extends AbstractProduct
{
    public function __construct(UuidInterface $uuid, string $name, $quantity,Money $unitPrice)
    {
        parent::__construct($uuid, $name, $quantity, $unitPrice);
    }
}