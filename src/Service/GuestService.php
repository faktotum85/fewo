<?php


namespace App\Service;

use App\Entity\Address;
use App\Entity\Guest;
use App\Data\BookingData;

class GuestService
{
    private $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * @param Guest $guest
     * @param BookingData $bookingData
     * @return Guest
     */
    public function applyBookingData(Guest $guest, BookingData $bookingData): Guest
    {
        $guest->setFirstName($bookingData->firstName);
        $guest->setLastName($bookingData->lastName);
        $guest->setEmail($bookingData->email);
        $guest->setPhone($bookingData->phone);

        $address = $guest->getAddress() ? $guest->getAddress() : new Address();
        $guest->setAddress($this->addressService->applyBookingData($address, $bookingData));

        return $guest;
    }
}