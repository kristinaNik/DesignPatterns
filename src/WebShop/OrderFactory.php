<?php


namespace DesignPatterns\WebShop;


use Money\Money;
use Ramsey\Uuid\UuidInterface;

class OrderFactory
{

    /**
     * @param $productId
     * @param $amount
     * @return Order
     */
    public static  function createOrders(UuidInterface $productId, Money $amount): Order
    {
        return new Order($productId, $amount);
    }

}