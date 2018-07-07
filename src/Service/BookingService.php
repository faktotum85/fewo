<?php


namespace App\Service;

use App\Data\BookingData;
use App\Entity\Booking;
use App\Entity\Guest;
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
    public function create(BookingData $bookingData)
    {
        $booking = $this->applyBookingData(new Booking(), $bookingData);
        $this->entityManager->persist($booking);
        $this->entityManager->flush();
    }

    /**
     * @param Booking $booking
     * @param BookingData $bookingData
     */
    public function update(Booking $booking, BookingData $bookingData)
    {
        $this->applyBookingData($booking, $bookingData);
        $this->entityManager->flush();
    }

    /**
     * @param Booking $booking
     */
    public function delete(Booking $booking)
    {
        $this->entityManager->remove($booking);
        $this->entityManager->flush();
    }

    /**
     * @param Booking $booking
     * @param BookingData $bookingData
     * @return Booking
     */
    public function applyBookingData(Booking $booking, BookingData $bookingData): Booking
    {
        $booking->setAccommodation($bookingData->accommodation);
        $booking->setComments($bookingData->comments);
        $booking->setArrivalDate($bookingData->arrivalDate);
        $booking->setDepartureDate($bookingData->departureDate);

        $guest = $booking->getGuest() ? $booking->getGuest() : new Guest();
        $booking->setGuest($this->guestService->applyBookingData($guest, $bookingData));

        return $booking;
    }
}