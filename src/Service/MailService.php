<?php

namespace App\Service;

use App\Data\BookingData;
use App\Data\ContactData;
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
    public function sendBookingMail(BookingData $bookingData)
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