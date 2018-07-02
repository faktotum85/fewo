<?php


namespace App\Controller;

use App\Data\Contact;
use App\Form\ContactType;
use App\Service\MailService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends Controller
{

    private $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     * @Route("/kontakt", name="contact")
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function new(Request $request)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->mailService->sendContactMail($form);
            $this->addFlash('success', 'Ihre Nachricht wurde erfolgreich versandt.');
            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}