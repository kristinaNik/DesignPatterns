<?php


namespace DesignPatterns\WebShop;


use Assert\Assertion;
use Money\Money;
use Ramsey\Uuid\UuidInterface;

class ComboProduct extends AbstractProduct
{
    /**
     * @var array
     */
    protected array $products;

    /**
     * ComboProduct constructor.
     *
     * @param UuidInterface $uuid
     * @param string $name
     * @param array $products
     * @param Money|null $unitPrice
     * @param \DateTimeImmutable|null $timestamp
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(UuidInterface $uuid, string $name, array $products, Money $unitPrice = null, \DateTimeImmutable $timestamp=null)
    {
        parent::__construct($uuid, $name, $unitPrice, $timestamp);

        Assertion::allIsInstanceOf($products, Product::class);
        Assertion::min(count($products),2);

        $this->products = array_values($products); //Get only values
    }

    /**
     * @return Money
     */
    public function getUnitPrice(): Money
    {
        if ($this->unitPrice) {
            return $this->unitPrice;
        }

        $totalPrice = $this->products[0]->getUnitPrice();
        $max = count($this->products);

        for ($i=1; $i< $max; $i++) {
            $totalPrice = $totalPrice->add($this->products[$i]->getUnitPrice());
        }

        return $totalPrice;
    }
}