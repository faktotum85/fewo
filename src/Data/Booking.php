<?php

namespace App\Data;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Booking
{
    /**
     * @Assert\Choice(callback={"App\Enum\AccommodationTypeEnum", "getAvailableTypes"})
     * @Assert\NotBlank()
     */
    public $accommodation;
    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    public $firstName;
    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    public $lastName;
    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    public $street;
    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    public $streetNumber;
    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    public $zipcode;
    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    public $city;
    /**
     * @Assert\Date()
     * @Assert\NotBlank()
     */
    public $arrivalDate;
    /**
     * @Assert\Date()
     * @Assert\NotBlank()
     */
    public $departureDate;
    /**
     * @Assert\Email()
     * @Assert\NotBlank()
     */
    public $email;
    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    public $phone;
    /**
     * @Assert\Type("string")
     */
    public $comments;
    /**
     * @Assert\Type("bool")
     * @Assert\IsTrue()
     */
    public $agreedToTerms;

    /**
     * @Assert\Callback
     * @param ExecutionContextInterface $context
     */
    public function validateDateOrder(ExecutionContextInterface $context)
    {
        if($this->departureDate < $this->arrivalDate) {
            $context->buildViolation('booking.wrongDateOrder')
                ->atPath('departureDate')
                ->addViolation();
        }
    }

    /**
     * @Assert\Callback
     * @param ExecutionContextInterface $context
     */
    public function validateDatesInFuture(ExecutionContextInterface $context)
    {
        if($this->arrivalDate < new DateTime()) {
            $context->buildViolation('booking.inPast')
                ->atPath('arrivalDate')
                ->addViolation();
        }
    }
}