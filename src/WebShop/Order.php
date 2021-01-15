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

    /**
     * @var int
     */
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
     * @var int
     */
    private int $quantity;

    /**
     * Order constructor.
     *
     * @param UuidInterface $productSku
     * @param Money $amount
     * @param string $productName
     * @param int $quantity
     * @param \DateTimeImmutable $timestamp
     */
    public function __construct(UuidInterface $productSku, Money $amount, string $productName, int $quantity, \DateTimeImmutable $timestamp)
    {
        $this->id = Uuid::uuid4();
        $this->productSku = $productSku;
        $this->amount = $amount;
        $this->productName = $productName;
        $this->quantity = $quantity;
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

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

}