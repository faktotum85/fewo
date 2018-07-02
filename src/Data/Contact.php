<?php

namespace App\Data;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public $email;
    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    public $message;
    /**
     * @Assert\Type("bool")
     * @Assert\IsTrue()
     */
    public $agreedToTerms;
}