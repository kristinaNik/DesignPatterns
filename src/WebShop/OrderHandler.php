<?php


namespace DesignPatterns\WebShop;


class OrderHandler
{
    /**
     * @param AbstractProduct $product
     *
     * @return Order
     */
    public function handle(AbstractProduct $product): Order
    {
       return OrderFactory::createOrders($product->getSku(), $product->getUnitPrice());
    }

}