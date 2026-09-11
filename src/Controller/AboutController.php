<?php

namespace App\Controller;
use App\Repository\EntrepriseRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'about')]
    public function Entreprise(EntrepriseRepository $entrepriseRepository): Response
    {
        return $this->render('about/about.html.twig', [
            'entreprises' => $entrepriseRepository->findAll(),
        ]);
    }
}
