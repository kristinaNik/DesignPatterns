<?php


namespace DesignPatterns\WebShop;

class OrderHandler
{
    /**
     * @param AbstractProduct $product
     * @param int $quantity
     *
     * @return Order
     *
     * @throws \Exception
     */
    public function add(AbstractProduct $product, int $quantity): Order
    {
       return OrderFactory::createOrders($product, $quantity);
    }

}