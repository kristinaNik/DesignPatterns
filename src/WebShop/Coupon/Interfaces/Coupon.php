<?php


namespace DesignPatterns\WebShop\Coupon\Interfaces;

use Money\Money;

interface Coupon
{
    public function getCode(): string;

    public function apply(Money $totalAmount): Money;

}