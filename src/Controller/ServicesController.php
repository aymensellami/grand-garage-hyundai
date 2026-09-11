<?php

namespace App\Controller;
use App\Repository\DomaineExpertiseRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServicesController extends AbstractController
{
    #[Route('/services', name: 'services')]
    public function DomaineExpertise(DomaineExpertiseRepository $domaineexpertiseRepository): Response
    {
        return $this->render('services/services.html.twig', [
            'domaineExpertises' => $domaineexpertiseRepository->findAll(),
        ]);
    }
}
