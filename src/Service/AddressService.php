<?php

namespace App\Service;

use App\Data\Booking as BookingData;
use App\Entity\Address;

class AddressService
{
    /**
     * @param BookingData $bookingData
     * @return Address
     */
    public function fromBookingData(BookingData $bookingData): Address
    {
        $address = new Address();
        $address->setStreet($bookingData->street);
        $address->setStreetNumber($bookingData->streetNumber);
        $address->setZipcode($bookingData->zipcode);
        $address->setCity($bookingData->city);

        return $address;
    }
}