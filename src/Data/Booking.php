<?php

namespace App\Data;

use Symfony\Component\Validator\Constraints as Assert;

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
}