<?php


namespace DesignPatterns\WebShop;


use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Nonstandard\Uuid;
use Ramsey\Uuid\UuidInterface;

class Order
{

    /**
     * @var UuidInterface
     */
    private $id;

    private $timestamp;

    /**
     * @var
     */
    private $productSku;

    /**
     * @var Money
     */
    private $amount;

    /**
     * @var string
     */
    private $productName;


    /**
     * Order constructor.
     *
     * @param UuidInterface $productSku
     * @param Money $amount
     * @param string $productName
     * @param \DateTimeImmutable $timestamp
     */
    public function __construct(UuidInterface $productSku, Money $amount, string $productName, \DateTimeImmutable $timestamp)
    {
        $this->id = Uuid::uuid4();
        $this->productSku = $productSku;
        $this->amount = $amount;
        $this->productName = $productName;
        $this->timestamp = (int) $timestamp->format('U');
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getProductSku()
    {
        return Uuid::fromString($this->productSku);
    }

    /**
     * @return mixed
     */
    public function getAmount(): Money
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }


    /**
     * @return \DateTimeImmutable|false
     */
    public function getTimestamp()
    {
        return \DateTimeImmutable::createFromFormat('U', $this->timestamp);
    }

}