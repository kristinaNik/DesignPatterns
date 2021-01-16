<?php

namespace DesignPatterns\WebShop\Coupon;

abstract class RestrictedCoupon implements Coupon
{
    /**
     * @var Coupon
     */
    protected Coupon $coupon;

    /**
     * RestrictedCoupon constructor.
     * @param Coupon $coupon
     */
    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->coupon->getCode();
    }
}