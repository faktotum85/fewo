<?php


namespace App\Controller;

use App\Data\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends Controller
{
    /**
     * @Route("/kontakt", name="contact")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
        }

        return $this->render('contact/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}