<?php
namespace DesignPatterns\WebShop\Coupon;

use DesignPatterns\WebShop\Coupon\Interfaces\Coupon;

use Money\Money;

class CouponBuilder
{
    /**
     * @var Coupon
     */
    private Coupon $coupon;

    /**
     * CouponBuilder constructor.
     * @param Coupon $coupon
     */
    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }


    /**
     * @param string $code
     * @param Money $amount
     *
     * @return self
     */
    public static function ofValue(string $code, Money $amount): self
    {
        return new static(new ValueCoupon($code, $amount));
    }

    /**
     * @param string $code
     * @param float $rate
     *
     * @return self
     * @throws \Assert\AssertionFailedException
     */
    public static function ofRate(string $code, float $rate): self
    {
        return new static(new RateCoupon($code, $rate));
    }

    /**
     * @param $validFrom
     * @param $validTwo
     * @return DateRange
     */
    public static function dateRange(\DateTimeImmutable $validFrom, \DateTimeImmutable $validTwo): DateRange
    {
        return new DateRange($validFrom, $validTwo);
    }

    /**
     * @param Coupon $couponType
     * @param DateRange $dateRange
     *
     * @return LimitedLifetimeCoupon
     */
    public static function limitedLifetimeCoupon(Coupon $couponType, DateRange $dateRange): LimitedLifetimeCoupon
    {
        return new LimitedLifetimeCoupon(
            $couponType,
            $dateRange
        );
    }

    /**
     * @return Coupon
     */
    public function getCoupon(): Coupon
    {
        return $this->coupon;
    }

}