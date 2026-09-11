<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\MailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(  
        Request $request,
        EntityManagerInterface $manager,
        MailerInterface $mailer
        ): Response {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           $contact=$form->getData();
           $manager->persist($contact);
           ($contact);
           $manager->flush();
           //email
           $email = (new Email())
           ->from('hello@example.com')
           ->to('you@example.com')
           ->subject('Time for Symfony Mailer!')
           ->text('Sending emails is fun again!')
           ->html('<p>See Twig integration for better HTML integration!</p>');
         
           try {
            $mailer->send($email);
            
            $this->addFlash('success', 'Your message has been sent successfully!');
        } catch (TransportExceptionInterface $e) {
            //Handle the exception, e.g., log the error
        
        $this->addFlash('error', 'Failed to send the email. Please try again later.');
        }
           return $this->redirectToRoute('contact');
        }
        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
