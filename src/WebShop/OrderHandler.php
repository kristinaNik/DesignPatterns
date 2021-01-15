<?php


namespace DesignPatterns\WebShop;

class OrderHandler
{
    /**
     * @param AbstractProduct $product
     * @return Order
     * @throws \Exception
     */
    public function handle(AbstractProduct $product): Order
    {
       return OrderFactory::createOrders($product->getSku(), $product->getUnitPrice(), $product->getName(), new \DateTimeImmutable('now'));
    }



}