<?php


namespace DesignPatterns\WebShop;


use Money\Money;
use Ramsey\Uuid\UuidInterface;

class OrderFactory
{

    /**
     * @param UuidInterface $productSku
     * @param Money $amount
     * @param $name
     * @param \DateTimeImmutable $timestamp
     * @return Order
     */
    public static  function createOrders(UuidInterface $productSku, Money $amount, string $name, \DateTimeImmutable $timestamp): Order
    {
        return new Order($productSku, $amount,$name, $timestamp);
    }

}