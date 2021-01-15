<?php


namespace DesignPatterns\Tests\WebShop;

use Assert\AssertionFailedException;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use DesignPatterns\WebShop\ComboProduct;
use DesignPatterns\WebShop\PhysicalProduct;

class ComboProductTest extends TestCase
{

    public function testComplexComboProductWithoutCustomPrice(): void
    {
        $products = [
            new PhysicalProduct(
                Uuid::uuid4(),
                'WebShopProduct',
                2,
                new Money(12000, new Currency('EUR')),

            ),
            new ComboProduct(Uuid::uuid4(), 'Nested Combo', [
                new PhysicalProduct(
                    Uuid::uuid4(),
                    'WebShopProduct',
                    1,
                    new Money(9000, new Currency('EUR')),

                ),
                new PhysicalProduct(
                    Uuid::uuid4(),
                    'WebShopProduct',
                    1,
                    new Money(8000, new Currency('EUR')),

                )
            ],1)
        ];

        $combo = new ComboProduct(
            Uuid::uuid4(),
            'Test',
            $products,
            1
        );

        $this->assertEquals(
            new Money(29000, new Currency('EUR')),
            $combo->getUnitPrice()
        );
    }


    public function testComboProductWithCustomPrice(): void
    {
        $products = [
            new PhysicalProduct(
                Uuid::uuid4(),
                'WebShopProduct',
                1,
                new Money(12000, new Currency('EUR')),

            ),
            new PhysicalProduct(
                Uuid::uuid4(),
                'WebShopProduct',
                2,
                new Money(9000, new Currency('EUR')),

            )
        ];

        $combo = new ComboProduct(
            Uuid::uuid4(),
            'Test',
            $products,
            1,
            new Money(14500, new Currency('EUR'))
        );

        $this->assertEquals(
            new Money(14500, new Currency('EUR')),
            $combo->getUnitPrice()
        );
    }

    public function testInvalidComboProduct(): void
    {
        $this->expectException(AssertionFailedException::class);
        new ComboProduct(Uuid::uuid4(), 'Test', [
            new PhysicalProduct(
                Uuid::uuid4(),
                'WebShopProduct',
                1,
                new Money(12000, new Currency('EUR')),

            )
        ],1);
    }


    public function testSinglePhysicalProduct(): void
    {
        $product = new PhysicalProduct(
            Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
            "MyProductName",
            1,
            new Money(12000, new Currency('EUR'))
        );

        $this->assertEquals(
            Uuid::fromString('edc262a3-0d57-4801-84ff-81409a7a6183'),
            $product->getSku()
        );

        $this->assertSame(
            "MyProductName",
            $product->getName()
        );

        $this->assertEquals(
            new Money(12000, new Currency('EUR')),
            $product->getUnitPrice()
        );
    }

}