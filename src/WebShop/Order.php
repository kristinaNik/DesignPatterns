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

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return [
            'sku' => $this->products->getSku(),
            'unitPrice' => $this->products->getUnitPrice(),
            'currency' => (string) $this->products->getUnitPrice()->getCurrency(),
            'quantity' => $this->quantity,
            'timestamp' => $this->products->getTimestamp()
        ];
    }
}