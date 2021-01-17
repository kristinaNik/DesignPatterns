<?php


namespace DesignPatterns\WebShop\Coupon;

use Assert\Assertion;
use DesignPatterns\WebShop\Coupon\Interfaces\Coupon;
use Money\Money;

class RateCoupon implements Coupon
{
    /**
     * @var string
     */
    private string $code;

    /**
     * @var float
     */
    private float $discountRate;


    /**
     * RateCoupon constructor.
     *
     * @param string $code
     * @param float $rate
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(string $code, float $rate)
    {
        Assertion::between($rate, 0, 1);
        $this->code = $code;
        $this->discountRate = $rate;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return  $this->code;
    }

    /**
     * @param Money $totalAmount
     * @return Money
     */
    public function apply(Money $totalAmount): Money
    {
        return $totalAmount->subtract($totalAmount->multiply($this->discountRate));
    }

}