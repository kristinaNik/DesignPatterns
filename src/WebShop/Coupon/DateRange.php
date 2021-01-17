<?php

namespace DesignPatterns\WebShop\Coupon;

class DateRange
{
    /**
     * @var \DateTimeImmutable
     */
    private $validFrom;

    /**
     * @var \DateTimeImmutable
     */
    private $validTo;


    /**
     * DateRange constructor.
     * @param \DateTimeImmutable $validFrom
     * @param \DateTimeImmutable $validTo
     */
    public function __construct(\DateTimeImmutable $validFrom, \DateTimeImmutable $validTo)
    {
        $this->validFrom = $validFrom;
        $this->validTo = $validTo;
    }

    /**
     * @return mixed
     */
    public function getValidFrom()
    {
        return $this->validFrom;
    }

    /**
     * @return mixed
     */
    public function getValidTo()
    {
        return $this->validTo;
    }


}