<?php


namespace DesignPatterns\WebShop;


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
     * @var
     */
    private $productId;

    /**
     * @var Money
     */
    private $amount;


    /**
     * Order constructor.
     * @param $productId
     * @param $amount
     */
    public function __construct(UuidInterface $productId, Money $amount)
    {
        $this->id = Uuid::uuid4();
        $this->productId = $productId;
        $this->amount = $amount;
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
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

}