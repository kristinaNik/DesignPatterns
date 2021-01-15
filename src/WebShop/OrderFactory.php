<?php


namespace DesignPatterns\WebShop;


use Money\Money;
use Ramsey\Uuid\UuidInterface;

class OrderFactory
{
    /**
     * @param UuidInterface $productSku
     * @param Money $amount
     * @param string $name
     * @param int $quantity
     * @param \DateTimeImmutable $timestamp
     * @return Order
     */
    public static  function createOrders(UuidInterface $productSku, Money $amount, string $name, int $quantity, \DateTimeImmutable $timestamp): Order
    {
        return new Order($productSku, $amount,$name, $quantity, $timestamp);
    }

}