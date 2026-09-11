<?php

namespace App\Controller;

use App\Repository\EntrepriseRepository;
use App\Repository\DomaineExpertiseRepository;
use App\Repository\ConsultantRepository;
use App\Repository\BlogPostRepository;
use App\Repository\ContactRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\ContactType; 
use Doctrine\ORM\EntityManagerInterface; // Import the EntityManagerInterface

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(
        Request $request,
        EntrepriseRepository $entrepriseRepository,
        DomaineExpertiseRepository $domaineexpertiseRepository,
        ConsultantRepository $consultantRepository,
        BlogPostRepository $blogPostRepository,
        ContactRepository $contactRepository,
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager // Add EntityManagerInterface as a dependency
    ): Response {
        $contact = new \App\Entity\Contact();
        $form = $formFactory->create(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $entityManager->persist($contact); // Use the injected EntityManager
            $entityManager->flush();
            
            $this->addFlash('success', 'Your message has been sent successfully!');
        
            return $this->redirectToRoute('home');
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'entreprises' => $entrepriseRepository->findAll(),
            'domaineExpertises' => $domaineexpertiseRepository->findAll(),
            'consultants' => $consultantRepository->findAll(),
            'blogposts' => $blogPostRepository->lastsex(),
            'contacts' => $contactRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
}
