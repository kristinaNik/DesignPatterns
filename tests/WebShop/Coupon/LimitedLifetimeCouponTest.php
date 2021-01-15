<?php

namespace DesignPatterns\Tests\WebShop\Coupon;

use DesignPatterns\WebShop\Coupon\DateRange;
use DesignPatterns\WebShop\Coupon\LimitedLifetimeCoupon;
use DesignPatterns\WebShop\Coupon\ValueCoupon;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use Symfony\Bridge\PhpUnit\ClockMock;

class LimitedLifetimeCouponTest extends TestCase
{

    public function testCouponIsEligible(): void
    {
        ClockMock::withClockMock('2021-06-11 10:30:30');

        $coupon = new LimitedLifetimeCoupon(
            new ValueCoupon('COUPON1', new Money(3000, new Currency('EUR'))),
            new DateRange(new \DateTimeImmutable('2021-01-01 00:00:00'), new \DateTimeImmutable('2021-12-31 23:59:59'))
        );

        $this->assertEquals(
            new Money(9000, new Currency('EUR')),
            $coupon->apply(new Money(12000, new Currency('EUR')))
        );
    }

    public function testCouponIsNotEligible(): void
    {
        ClockMock::withClockMock('2021-06-11 10:30:30');

        $coupon = new LimitedLifetimeCoupon(
            new ValueCoupon('COUPON1', new Money(3000, new Currency('EUR'))),
            new DateRange(new \DateTimeImmutable('2019-01-01 00:00:00'), new \DateTimeImmutable('2019-06-31 23:59:59'))
        );

        //The amount should't be discounted because the coupon has expired
        $this->assertEquals(
            new Money(12000, new Currency('EUR')),
            $coupon->apply(new Money(12000, new Currency('EUR')))
        );
    }
}