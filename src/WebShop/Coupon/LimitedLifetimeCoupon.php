<?php

namespace DesignPatterns\WebShop\Coupon;

use Money\Money;

class LimitedLifetimeCoupon extends RestrictedCoupon
{
    /**
     * @var DateRange
     */
    private DateRange $dateRange;

    /**
     * LimitedLifetimeCoupon constructor.
     * @param Coupon $coupon
     * @param DateRange $dateRange
     */
    public function __construct(
        Coupon $coupon,
        DateRange $dateRange
    )
    {
        parent::__construct($coupon);

        $this->dateRange = $dateRange;
    }

    /**
     * @param Money $totalAmount
     *
     * @return Money
     *
     * @throws \Exception
     */
    public function apply(Money $totalAmount): Money
    {
        $now = new \DateTimeImmutable('now');

        if ($now < $this->dateRange->getValidFrom() || $now > $this->dateRange->getValidTo()) {
            return $totalAmount;
        }

        return $this->coupon->apply($totalAmount);
    }
}