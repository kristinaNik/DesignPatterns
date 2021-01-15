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
     * @var \DateTimeImmutable
     */
    protected $timestamp;

    /**
     * AbstractProduct constructor.
     *
     * @param UuidInterface $uuid
     * @param string $name
     * @param Money|null $unitPrice
     * @param \DateTimeImmutable|null $timestamp
     * @throws \Exception
     */
    public function __construct(UuidInterface $uuid, string $name,  Money $unitPrice=null,  \DateTimeImmutable $timestamp = null)
    {
        $this->sku = $uuid;
        $this->name = $name;
        $this->unitPrice = $unitPrice;
        $timestamp = $timestamp ?: new \DateTimeImmutable('now', new \DateTimeZone('UTC'));
        $this->timestamp = (int) $timestamp->format('U');
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
     * @return \DateTimeImmutable
     */
    public function getTimestamp(): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat('U', $this->timestamp);
    }
}