<?php


namespace App\Service;

use App\Data\Booking as BookingData;
use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class BookingService
{
    private $guestService;
    private $entityManager;

    public function __construct(
        GuestService $guestService,
        EntityManagerInterface $entityManager
    )
    {
        $this->guestService = $guestService;
        $this->entityManager = $entityManager;
    }

    /**
     * @param BookingData $bookingData
     * @throws Exception
     */
    public function storeBookingData(BookingData $bookingData)
    {
        $booking = $this->fromBookingData($bookingData);
        $this->entityManager->persist($booking);
        $this->entityManager->flush();
    }

    /**
     * @param BookingData $bookingData
     * @return Booking
     */
    public function fromBookingData(BookingData $bookingData): Booking
    {
        $booking = new Booking();
        $booking->setAccommodation($bookingData->accommodation);
        $booking->setComments($bookingData->comments);
        $booking->setGuest($this->guestService->fromBookingData($bookingData));
        $booking->setArrivalDate($bookingData->arrivalDate);
        $booking->setDepartureDate($bookingData->departureDate);

        return $booking;
    }
}