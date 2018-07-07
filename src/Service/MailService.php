<?php

namespace App\Service;

use App\Data\BookingData;
use App\Data\ContactData;
use App\Entity\Booking;
use Exception;
use Swift_Mailer;
use Swift_Message;
use Twig\Environment;

class MailService
{
    private $mailer;
    private $twig;

    public function __construct(Swift_Mailer $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * @param ContactData $contactData
     * @throws Exception
     */
    public function sendContactMail(ContactData $contactData)
    {
        $message = (new Swift_Message('Kontaktanfrage'))
            ->setFrom('mail@sweller.de')
            ->setTo('mail@sweller.de')
            ->setReplyTo($contactData->email)
            ->setBody($this->twig->render('emails/contact.html.twig', [
                'formData' => $contactData
            ]), 'text/html');
        $this->mailer->send($message);
    }

    /**
     * @param BookingData $bookingData
     * @throws Exception
     */
    public function sendBookingMails(BookingData $bookingData)
    {
        $this->sendBookingRequestToAdmin($bookingData);
        $this->sendConfirmationToGuest($bookingData);
    }

    /**
     * @param Booking $booking
     * @throws Exception
     */
    public function sendBookingConfirmation(Booking $booking)
    {
        $message = (new Swift_Message('Bestätigung Ihrer Buchung'))
            ->setFrom('mail@sweller.de')
            ->setTo($booking->getGuest()->getEmail())
            ->setBody($this->twig->render('emails/booking-confirmation.html.twig', [
                'booking' => $booking
            ]), 'text/html');
        $this->mailer->send($message);
    }

    /**
     * @param BookingData $bookingData
     * @throws Exception
     */
    private function sendConfirmationToGuest(BookingData $bookingData): void
    {
        $message = (new Swift_Message('Ihre Buchungsanfrage'))
            ->setFrom('mail@sweller.de')
            ->setTo($bookingData->email)
            ->setBody($this->twig->render('emails/booking-request-confirmation.html.twig', [
                'booking' => $bookingData
            ]), 'text/html');
        $this->mailer->send($message);
    }

    /**
     * @param BookingData $bookingData
     * @throws Exception
     */
    private function sendBookingRequestToAdmin(BookingData $bookingData): void
    {
        $message = (new Swift_Message('Buchungsanfrage'))
            ->setFrom('mail@sweller.de')
            ->setTo('mail@sweller.de')
            ->setReplyTo($bookingData->email)
            ->setBody($this->twig->render('emails/booking.html.twig', [
                'formData' => $bookingData
            ]), 'text/html');
        $this->mailer->send($message);
    }
}