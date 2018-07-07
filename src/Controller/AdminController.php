<?php


namespace App\Controller;


use App\Data\BookingData;
use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use App\Service\BookingService;
use App\Service\MailService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{

    private $bookingRepository;
    private $bookingService;
    private $mailService;

    public function __construct(
        BookingRepository $bookingRepository,
        BookingService $bookingService,
        MailService $mailService
    )
    {
        $this->bookingRepository = $bookingRepository;
        $this->bookingService = $bookingService;
        $this->mailService = $mailService;
    }

    /**
     * @Route("/", name="admin_index")
     * @return Response
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'houseBookings' => $this->bookingRepository->findBy(['accommodation' => 'house']),
            'apartmentBookings' => $this->bookingRepository->findBy(['accommodation' => 'apartment']),
        ]);
    }

    /**
     * @Route("/neu", name="admin_new_booking")
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function newBooking(Request $request)
    {
        $form = $this->createForm(BookingType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->bookingService->create($form->getData());
            $this->addFlash('success', 'Die Buchung wurde erfolgreich angelegt.');
            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/booking.html.twig', [
            'form' => $form->createView(),
            'title' => 'admin.newBooking.title',
            'buttonText' => 'admin.newBooking.submit',
        ]);
    }

    /**
     * @Route("/{id}/bearbeiten", name="admin_edit_booking")
     * @param Request $request
     * @param Booking $booking
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function editBooking(Request $request, Booking $booking)
    {
        $bookingData = BookingData::fromBooking($booking);

        $form = $this->createForm(BookingType::class, $bookingData);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->bookingService->update($booking, $form->getData());
            $this->addFlash('success', 'Die Buchung wurde erfolgreich aktualisiert.');
            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/booking.html.twig', [
            'form' => $form->createView(),
            'title' => 'admin.editBooking.title',
            'buttonText' => 'admin.editBooking.submit',
        ]);
    }

    /**
     * @Route("/{id}/entfernen", name="admin_delete_booking")
     * @param Booking $booking
     * @return RedirectResponse
     */
    public function deleteBooking(Booking $booking)
    {
        $this->bookingService->delete($booking);
        $this->addFlash('success', 'Die Buchung wurde erfolgreich gelöscht.');
        return $this->redirectToRoute('admin_index');
    }

    /**
     * @Route("/{id}/bestaetigen", name="admin_confirm_booking")
     * @param Booking $booking
     * @return RedirectResponse
     * @throws Exception
     */
    public function confirmBooking(Booking $booking)
    {
        $this->bookingService->confirm($booking);
        $this->mailService->sendBookingConfirmation($booking);
        $this->addFlash('success', 'Die Buchung wurde bestätigt');
        return $this->redirectToRoute('admin_index');
    }
}