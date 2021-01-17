<?php


namespace DesignPatterns\Tests\WebShop\Coupon;


use DesignPatterns\WebShop\Coupon\CouponBuilder;
use DesignPatterns\WebShop\Coupon\DateRange;
use DesignPatterns\WebShop\Coupon\LimitedLifetimeCoupon;
use DesignPatterns\WebShop\Coupon\MinimumPurchaseAmountCoupon;
use DesignPatterns\WebShop\Coupon\RateCoupon;
use DesignPatterns\WebShop\Coupon\ValueCoupon;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;

class CouponBuilderTest extends TestCase
{

    /**
     * @throws \Exception
     */
    public function testCreateComplexValueCouponCombination(): void
    {
        $expected = new LimitedLifetimeCoupon(
            new MinimumPurchaseAmountCoupon(
                new ValueCoupon('COUPON123', new Money(1500, new Currency('EUR'))),
                new Money(7500, new Currency('EUR'))
            ),
            new DateRange('2021-01-01 00:00:00','2021-12-31 23:59:59')
        );

        $coupon = CouponBuilder::ofValue('COUPON123', new Money(1500, new Currency('EUR')))
            ->mustRequireMinimumPurchaseAmount(new Money(7500, new Currency('EUR')))
            ->mustBeValidBetween('2021-01-01 00:00:00','2021-12-31 23:59:59')
            ->getCoupon()
        ;

        $this->assertEquals($expected, $coupon);
    }


    public function testCreateSimpleValueCoupon(): void
    {
        $this->assertEquals(
            new ValueCoupon('COUPON123', new Money(70000, new Currency('EUR'))),
            CouponBuilder::ofValue('COUPON123', new Money(70000, new Currency('EUR')))->getCoupon()
        );
    }

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function testCreateSimpleRateCoupon(): void
    {
        $this->assertEquals(
            new RateCoupon('COUPON123', .25),
            CouponBuilder::ofRate('COUPON123', .25)->getCoupon()
        );
    }
}