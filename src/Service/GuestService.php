<?php


namespace App\Service;

use App\Entity\Guest;
use App\Data\Booking as BookingData;

class GuestService
{
    private $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * @param BookingData $bookingData
     * @return Guest
     */
    public function fromBookingData(BookingData $bookingData): Guest
    {
        $guest = new Guest();
        $guest->setFirstName($bookingData->firstName);
        $guest->setLastName($bookingData->lastName);
        $guest->setEmail($bookingData->email);
        $guest->setPhone($bookingData->phone);
        $guest->setAddress($this->addressService->fromBookingData($bookingData));

        return $guest;
    }
}