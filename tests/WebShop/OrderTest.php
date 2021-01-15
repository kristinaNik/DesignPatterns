<?php
namespace DesignPatterns\Tests\WebShop;

use DesignPatterns\WebShop\ComboProduct;
use DesignPatterns\WebShop\OrderHandler;
use DesignPatterns\WebShop\PhysicalProduct;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class OrderTest extends TestCase
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

    public function testPhysicalProductOrder()
    {
        $product =  new PhysicalProduct(
            Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
            'Product1',
            2,
            new Money(12000, new Currency('EUR')),

        );

        $order = $this->orderHandler->handle($product);

        $this->assertEquals(2, $order->getQuantity());

        $this->assertEquals(
            'Product1',
            $order->getProductName()
        );

        $this->assertEquals(
            new Money(12000, new Currency('EUR')),
            $order->getAmount()
        );
        $this->assertEquals(
            Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
            $order->getProductSku()
        );

    }

    public function testComboProductOrder()
    {
        $products = [
            new PhysicalProduct(
                Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
                'Product1',
                2,
                new Money(12000, new Currency('EUR')),

            ),
            new PhysicalProduct(
                Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
                'Product2',
                1,
                new Money(9000, new Currency('EUR')),

            )
        ];

        $comboProduct = new ComboProduct(
            Uuid::fromString('edc262a3-0d57-4802-84ff-81409a7a6183'),
            'TestComboProduct',
            $products,
            1,
        );

        $order = $this->orderHandler->handle($comboProduct);

        $this->assertEquals(1, $order->getQuantity());

        $this->assertEquals(
            'TestComboProduct',
            $order->getProductName()
        );

        $this->assertEquals(
            new Money(21000, new Currency('EUR')),
            $order->getAmount()
        );

        $this->assertEquals(
            Uuid::fromString('edc262a3-0d57-4802-84ff-81409a7a6183'),
            $order->getProductSku()
        );


    }

    public function testOrderObject()
    {
        $product =  new PhysicalProduct(
            Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
            'PhysicalProduct',
            1,
            new Money(12000, new Currency('EUR')),

        );

        $order = $this->orderHandler->handle($product);

        $this->assertObjectHasAttribute("id", $order);
        $this->assertObjectHasAttribute("productSku", $order);
        $this->assertObjectHasAttribute("productName", $order);
        $this->assertObjectHasAttribute("amount", $order);
        $this->assertObjectHasAttribute("timestamp", $order);
    }


    public function testProductNameFromTwoDifferentOrders()
    {
        $product1 =  new PhysicalProduct(
            Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
            'Product1',
            1,
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
                    1,
                    new Money(12000, new Currency('EUR')),

                )
            ],
            1,
        );

        $order1 = $this->orderHandler->handle($product1);
        $order2 = $this->orderHandler->handle($product2);

        $this->assertEquals($product1->getName(), $order1->getProductName());
        $this->assertEquals($product2->getName(), $order2->getProductName());
        $this->assertNotEquals($order1, $order2);

    }
}