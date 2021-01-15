<?php


namespace DesignPatterns\WebShop;

use Money\Money;
use Ramsey\Uuid\UuidInterface;

class PhysicalProduct extends AbstractProduct
{
    /**
     * PhysicalProduct constructor.
     *
     * @param UuidInterface $uuid
     * @param string $name
     * @param Money $unitPrice
     * @param \DateTimeImmutable|null $timestamp
     * @throws \Exception
     */
    public function __construct(UuidInterface $uuid, string $name, Money $unitPrice, \DateTimeImmutable $timestamp = null)
    {
        parent::__construct($uuid, $name,  $unitPrice, $timestamp);
    }
}