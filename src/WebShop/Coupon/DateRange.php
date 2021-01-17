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
     * @param string $validFrom
     * @param string $validTo
     * @throws \Exception
     */
    public function __construct(string $validFrom, string $validTo)
    {
        $this->validFrom = new \DateTimeImmutable($validFrom);
        $this->validTo = new \DateTimeImmutable($validTo);
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