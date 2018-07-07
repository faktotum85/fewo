<?php


namespace App\Controller;


use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{

    private $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * @Route("/admin")
     * @return Response
     */
    public function admin()
    {
        return $this->render('admin/index.html.twig', [
            'houseBookings' => $this->bookingRepository->findBy(['accommodation' => 'house']),
            'apartmentBookings' => $this->bookingRepository->findBy(['accommodation' => 'apartment']),
        ]);
    }
}