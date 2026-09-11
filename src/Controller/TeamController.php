<?php

namespace App\Controller;
use App\Repository\ConsultantRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    #[Route('/team', name: 'team')]
    public function Consultant(ConsultantRepository $consultantRepository): Response
    {
        return $this->render('team/team.html.twig', [
            'consultants' => $consultantRepository->findAll(),
        ]);
    }
}
