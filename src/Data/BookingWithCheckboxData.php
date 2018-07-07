<?php

namespace App\Data;

use Symfony\Component\Validator\Constraints as Assert;

class BookingWithCheckboxData
{
    /**
     * @Assert\Valid()
     */
    public $booking;

    /**
     * @Assert\Type("bool")
     * @Assert\IsTrue()
     */
    public $agreedToTerms;
}