<?php


namespace App\Data;


use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use App\Entity\Booking;

class BookingData
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

    /**
     * @param Booking $booking
     * @return BookingData
     */
    public static function fromBooking(Booking $booking)
    {
        $bookingData = new BookingData();
        $bookingData->accommodation = $booking->getAccommodation();
        $bookingData->firstName = $booking->getGuest()->getFirstName();
        $bookingData->lastName = $booking->getGuest()->getLastName();
        $bookingData->street = $booking->getGuest()->getAddress()->getStreet();
        $bookingData->streetNumber = $booking->getGuest()->getAddress()->getStreetNumber();
        $bookingData->zipcode = $booking->getGuest()->getAddress()->getZipcode();
        $bookingData->city = $booking->getGuest()->getAddress()->getCity();
        $bookingData->arrivalDate = $booking->getArrivalDate();
        $bookingData->departureDate = $booking->getDepartureDate();
        $bookingData->email = $booking->getGuest()->getEmail();
        $bookingData->phone = $booking->getGuest()->getPhone();
        $bookingData->comments = $booking->getComments();
        return $bookingData;
    }
}