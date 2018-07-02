<?php

namespace App\Service;

use Exception;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Form\FormInterface;
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
     * @param FormInterface $form
     * @throws Exception
     */
    public function sendContactMail(FormInterface $form)
    {
        $message = (new Swift_Message('Test Email'))
            ->setFrom('mail@sweller.de')
            ->setTo('mail@sweller.de')
            ->setReplyTo($form->getData()->email)
            ->setBody($this->twig->render('emails/contact.html.twig', [
                'formData' => $form->getData()
            ]), 'text/html');
        $this->mailer->send($message);
    }
}