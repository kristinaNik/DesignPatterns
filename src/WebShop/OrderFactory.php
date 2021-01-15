<?php


namespace DesignPatterns\WebShop;


class OrderFactory
{
    /**
     * @param AbstractProduct $products
     * @param int $quantity
     *
     * @return Order
     *
     * @throws \Exception
     */
    public static  function createOrders(AbstractProduct $products, int $quantity): Order
    {
        return new Order($products, $quantity);
    }
}