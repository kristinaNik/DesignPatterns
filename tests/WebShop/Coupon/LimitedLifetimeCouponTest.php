<?php

namespace DesignPatterns\Tests\WebShop\Coupon;

use DesignPatterns\WebShop\Coupon\CouponBuilder;
use DesignPatterns\WebShop\Coupon\MinimumPurchaseAmountCoupon;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use Symfony\Bridge\PhpUnit\ClockMock;

class LimitedLifetimeCouponTest extends TestCase
{
    public function testComplexCouponCombination(): void
    {
        ClockMock::withClockMock('2021-06-11 10:30:30');

        $couponOfRate = CouponBuilder::ofRate('COUPON1', 0.20);
        $dateRange = CouponBuilder::dateRange(new \DateTimeImmutable('2021-01-01 00:00:00'), new \DateTimeImmutable('2021-12-31 23:59:59'));

        $limitedCoupon = CouponBuilder::limitedLifetimeCoupon(new MinimumPurchaseAmountCoupon(
            $couponOfRate->getCoupon(),
            new Money(7000, new Currency('EUR'))
        ),$dateRange);


        $this->assertEquals(
            new Money(16000, new Currency('EUR')),
            $limitedCoupon->apply(new Money(20000, new Currency('EUR')))
        );
    }

    public function testCouponIsEligible(): void
    {
        ClockMock::withClockMock('2021-06-11 10:30:30');

        $couponOfValue = CouponBuilder::ofValue('COUPON1', new Money(3000, new Currency('EUR')));
        $dateRange = CouponBuilder::dateRange(new \DateTimeImmutable('2021-01-01 00:00:00'), new \DateTimeImmutable('2021-12-31 23:59:59'));

        $limitedCoupon = CouponBuilder::limitedLifetimeCoupon(
            $couponOfValue->getCoupon(),
            $dateRange
        );

        $this->assertEquals(
            new Money(9000, new Currency('EUR')),
            $limitedCoupon->apply(new Money(12000, new Currency('EUR')))
        );
    }

    public function testCouponIsNotEligible(): void
    {
        ClockMock::withClockMock('2021-06-11 10:30:30');

        $couponOfValue = CouponBuilder::ofValue('COUPON1', new Money(3000, new Currency('EUR')));
        $dateRange = CouponBuilder::dateRange(new \DateTimeImmutable('2019-01-01 00:00:00'),new \DateTimeImmutable('2019-06-31 23:59:59'));

        $limitedCoupon = CouponBuilder::limitedLifetimeCoupon(
            $couponOfValue->getCoupon(),
            $dateRange
        );

        //The amount should't be discounted because the coupon has expired
        $this->assertEquals(
            new Money(12000, new Currency('EUR')),
            $limitedCoupon->apply(new Money(12000, new Currency('EUR')))
        );
    }
}