<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{

    /**
     * @Route("/admin")
     * @return Response
     */
    public function admin()
    {
        return new Response('<html><body>Admin Page!</body></html>');
    }

}