<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/preise", name="prices")
     */
    public function prices()
    {
        return $this->render('default/prices.html.twig');
    }

    /**
     * @Route("/anfahrt", name="directions")
     */
    public function directions()
    {
        return $this->render('default/directions.html.twig');
    }

    /**
     * @Route("/ferienwohnung", name="apartment")
     */
    public function apartment()
    {
        return $this->render('default/apartment.html.twig');
    }

    /**
     * @Route("/ferienhaus", name="house")
     */
    public function house()
    {
        return $this->render('default/house.html.twig');
    }

    /**
     * @Route("/impressum", name="imprint")
     */
    public function imprint()
    {
        return $this->render('default/imprint.html.twig');
    }

    /**
     * @Route("/datenschutz", name="privacy")
     */
    public function privacy()
    {
        return $this->render('default/privacy.html.twig');
    }
}
