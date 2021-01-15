<?php
namespace DesignPatterns\Tests\WebShop;

use DesignPatterns\WebShop\ComboProduct;
use DesignPatterns\WebShop\OrderFactory;
use DesignPatterns\WebShop\OrderHandler;
use DesignPatterns\WebShop\PhysicalProduct;
use DesignPatterns\WebShop\ProductFactory;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class OrderProductTest extends  TestCase
{


    /**
     * @var OrderHandler
     */
    private OrderHandler $orderHandler;


    /**
     * OrderTest constructor.
     * @param string|null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->orderHandler = new OrderHandler();
    }


    public function testPhysicalProductOrder(): void
    {
        $product =  new PhysicalProduct(
            Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
            'Product1',
            new Money(12000, new Currency('EUR')),

        );

        $order = $this->orderHandler->add($product, 2);

        $this->assertEquals(2, $order->getQuantity());

        $this->assertEquals(
            'Product1',
            $order->getProducts()->getName()
        );

        $this->assertEquals(
            new Money(12000, new Currency('EUR')),
            $order->getProducts()->getUnitPrice()
        );

        $this->assertEquals(
            Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
            $order->getProducts()->getSku()
        );
    }


    public function testComboProductOrder(): void
    {
        $products = [
            new PhysicalProduct(
                Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
                'Product1',
                new Money(12000, new Currency('EUR')),

            ),
            new PhysicalProduct(
                Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
                'Product2',
                new Money(9000, new Currency('EUR')),

            )
        ];

        $comboProduct = new ComboProduct(
            Uuid::fromString('edc262a3-0d57-4802-84ff-81409a7a6183'),
            'TestComboProduct',
            $products
        );

        $order = $this->orderHandler->add($comboProduct, 1);

        $this->assertEquals(1, $order->getQuantity());

        $this->assertEquals(
            'TestComboProduct',
            $order->getProducts()->getName()
        );

        $this->assertEquals(
            new Money(21000, new Currency('EUR')),
            $order->getProducts()->getUnitPrice()
        );

        $this->assertEquals(
            Uuid::fromString('edc262a3-0d57-4802-84ff-81409a7a6183'),
            $order->getProducts()->getSku()
        );
    }

    public function testProductNameFromTwoDifferentOrders(): void
    {
        $product1 =  new PhysicalProduct(
            Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
            'Product1',

            new Money(12000, new Currency('EUR')),

        );

        $product2 =  new ComboProduct(
            Uuid::fromString('edc262a3-0d57-4802-84ff-81409a7a6183'),
            'TestComboProduct',
            [
                $product1,
                new PhysicalProduct(
                    Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
                    'ProductTest',
                    new Money(12000, new Currency('EUR')),

                )
            ]
        );

        $order1 = $this->orderHandler->add($product1,2);
        $order2 = $this->orderHandler->add($product2,1);

        $this->assertEquals($product1->getName(), $order1->getProducts()->getName());
        $this->assertEquals($product2->getName(), $order2->getProducts()->getName());
        $this->assertNotEquals($order1, $order2);

    }
}