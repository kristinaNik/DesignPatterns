<?php


namespace DesignPatterns\WebShop;


class Order
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var AbstractProduct
     */
    private AbstractProduct $products;

    /**
     * @var int
     */
    private int $quantity;

    /**
     * @var \DateTimeImmutable|false
     */
    private $timestamp;

    /**
     * Order constructor.
     * @param AbstractProduct $products
     * @param $quantity
     * @throws \Exception
     */
    public function __construct(AbstractProduct $products, int $quantity)
    {
        $this->id = random_int(1, 5000);
        $this->products = $products;
        $this->quantity  = $quantity;
        $this->timestamp = \DateTimeImmutable::createFromFormat('U', $this->timestamp);
    }

    /**
     * @return AbstractProduct
     */
    public function getProducts(): AbstractProduct
    {
        return $this->products;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

}