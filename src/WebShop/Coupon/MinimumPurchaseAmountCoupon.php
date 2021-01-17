<?php
namespace DesignPatterns\WebShop\Coupon;

use DesignPatterns\WebShop\Coupon\Interfaces\Coupon;
use Money\Money;

class MinimumPurchaseAmountCoupon extends RestrictedCoupon
{
    /**
     * @var Money
     */
    private Money $minimumPurchaseAmount;

    /**
     * MinimumPurchaseAmountCoupon constructor.
     *
     * @param Coupon $coupon
     * @param Money $minimumPurchaseAmount
     */
    public function __construct(Coupon $coupon, Money $minimumPurchaseAmount)
    {
        parent::__construct($coupon);
        $this->minimumPurchaseAmount = $minimumPurchaseAmount;
    }

    /**
     * @param Money $totalAmount
     * @return Money
     */
    public function apply(Money $totalAmount): Money
    {
        if ($totalAmount->lessThan($this->minimumPurchaseAmount)) {
            return $totalAmount;
        }

        return $this->coupon->apply($totalAmount);
    }
}