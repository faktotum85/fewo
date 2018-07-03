<?php

namespace App\Controller;

use App\Data\Booking;
use App\Form\BookingType;
use App\Service\BookingService;
use App\Service\MailService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends Controller
{
    private $mailService;
    private $bookingService;

    public function __construct(
        MailService $mailService,
        BookingService $bookingService
    )
    {
        $this->mailService = $mailService;
        $this->bookingService = $bookingService;
    }

    /**
     * @Route("/buchen", name="booking")
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function new(Request $request)
    {
        $booking = new Booking();

        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->mailService->sendBookingMail($form);
            $this->bookingService->storeBookingData($form->getData());
            $this->addFlash('success', 'Ihre Buchungsanfrage wurde erfolgreich versandt.');
            return $this->redirectToRoute('booking');
        }

        return $this->render('booking/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}