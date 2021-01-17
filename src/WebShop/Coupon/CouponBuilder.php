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
    private function __construct(Coupon $coupon)
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
     * @param string $validFrom
     * @param string $validTwo
     * @return $this
     * @throws \Exception
     */
    public function mustBeValidBetween(string $validFrom, string $validTwo): self
    {
        $this->coupon = new LimitedLifetimeCoupon(
            $this->coupon,
            new DateRange($validFrom,$validTwo)
        );

        return $this;
    }

    public function mustRequireMinimumPurchaseAmount(Money $amount): self
    {
        $this->coupon = new MinimumPurchaseAmountCoupon($this->coupon, $amount);

        return $this;
    }

    /**
     * @return Coupon
     */
    public function getCoupon(): Coupon
    {
        return $this->coupon;
    }

}