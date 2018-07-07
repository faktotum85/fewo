<?php

namespace App\Service;

use App\Data\BookingData;
use App\Entity\Address;

class AddressService
{
    /**
     * @param Address $address
     * @param BookingData $bookingData
     * @return Address
     */
    public function applyBookingData(Address $address, BookingData $bookingData): Address
    {
        $address->setStreet($bookingData->street);
        $address->setStreetNumber($bookingData->streetNumber);
        $address->setZipcode($bookingData->zipcode);
        $address->setCity($bookingData->city);

        return $address;
    }
}