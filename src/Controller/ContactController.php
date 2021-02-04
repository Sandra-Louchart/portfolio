<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact", name="contact_")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param Request $request
     * @param MailerInterface $mailer
     * @param ContactRepository $contactRepository
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function index(Request $request, MailerInterface $mailer, ContactRepository $contactRepository): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if (($form->isSubmitted() && $form->isValid())) {
            $email = (new Email())
                ->from('sandra@test.com')
                ->to('sandra@test.com')
                ->subject('Sujet:' . $contact->getSubject())
                ->html($this->renderView('contact/email.html.twig', ['contact' => $contact]));
            $mailer->send($email);
            return $this->redirectToRoute('contact_index');
        }
        return $this->render('contact/contact.html.twig', [
            "form" => $form->createView(),
            "contacts" => $contactRepository->findAll(),
        ]);
    }
}