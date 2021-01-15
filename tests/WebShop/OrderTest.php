<?php


namespace DesignPatterns\Tests\WebShop;


use DesignPatterns\WebShop\OrderHandler;
use DesignPatterns\WebShop\PhysicalProduct;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class OrderTest extends TestCase
{

    public function testProductOrder()
    {
        $orderHandler = new OrderHandler();
        $product =  new PhysicalProduct(
            Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
            'WebSummerCamp',
            new Money(12000, new Currency('EUR')),

        );

        $order = $orderHandler->handle($product);


        $this->assertEquals(
            new Money(12000, new Currency('EUR')),
            $order->getAmount()
        );
        $this->assertEquals(
            Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
            $order->getProductId()
        );

    }

    public function testOrderObject()
    {
        $orderHandler = new OrderHandler();
        $product =  new PhysicalProduct(
            Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
            'WebSummerCamp',
            new Money(12000, new Currency('EUR')),

        );

        $order = $orderHandler->handle($product);

        $this->assertObjectHasAttribute("id", $order);
        $this->assertObjectHasAttribute("productId", $order);
        $this->assertObjectHasAttribute("amount", $order);
    }

}