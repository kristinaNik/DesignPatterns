<?php


namespace DesignPatterns\WebShop\Coupon;

use Money\Money;

class ValueCoupon implements Coupon
{
    /**
     * @var string
     */
    private string $code;

    /**
     * @var Money
     */
    private Money $discount;


    /**
     * ValueCoupon constructor.
     * @param string $code
     * @param Money $discount
     */
    public function __construct(string $code, Money $discount)
    {
        $this->code = $code;
        $this->discount =$discount;
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
       if ($totalAmount->lessThan($this->discount)) {
           throw new \InvalidArgumentException("Total amount is lower than value coupon");
       }

       return $totalAmount->subtract($this->discount);
    }


}