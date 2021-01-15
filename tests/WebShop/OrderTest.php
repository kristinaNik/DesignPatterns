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
            'WebSummerCamp',
            new Money(12000, new Currency('EUR')),

        );

        $order = $this->orderHandler->handle($product);

        $this->assertEquals(
            new Money(12000, new Currency('EUR')),
            $order->getAmount()
        );
        $this->assertEquals(
            Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
            $order->getProductId()
        );

    }

    public function testComboProductOrder()
    {
        $products = [
            new PhysicalProduct(
                Uuid::uuid4(),
                'WebSummerCamp',
                new Money(12000, new Currency('EUR')),

            ),
            new PhysicalProduct(
                Uuid::uuid4(),
                'WebSummerCamp',
                new Money(9000, new Currency('EUR')),

            )
        ];

        $comboProduct = new ComboProduct(
            Uuid::uuid4(),
            'Test',
            $products,
        );

        $order = $this->orderHandler->handle($comboProduct);

        $this->assertEquals(
            new Money(21000, new Currency('EUR')),
            $order->getAmount()
        );

    }

    public function testOrderObject()
    {
        $product =  new PhysicalProduct(
            Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
            'WebSummerCamp',
            new Money(12000, new Currency('EUR')),

        );

        $order = $this->orderHandler->handle($product);

        $this->assertObjectHasAttribute("id", $order);
        $this->assertObjectHasAttribute("productId", $order);
        $this->assertObjectHasAttribute("amount", $order);
    }

}