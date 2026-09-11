<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\DomaineExpertiseRepository;
use App\Repository\ConsultantRepository;
use App\Repository\BlogPostRepository;

class SitemapController extends AbstractController
{
    #[Route('/sitemap.xml', name: 'app_sitemap', defaults: ['_format' => 'xml'])]
    public function index(
        Request $request,
        DomaineExpertiseRepository $domaineexpertiseRepository,
        ConsultantRepository $consultantRepository,
        BlogPostRepository $blogPostRepository
    ): Response {
        $hostname = $request->getSchemeAndHttpHost();

        $urls = [
            ['loc' => $this->generateUrl('home')],
            ['loc' => $this->generateUrl('about')],
            ['loc' => $this->generateUrl('services')],
            ['loc' => $this->generateUrl('team')],
            ['loc' => $this->generateUrl('blog')],
            ['loc' => $this->generateUrl('contact')],
            ['loc' => $this->generateUrl('newsletters')],
        ];

        foreach ($blogPostRepository->findAll() as $blogpost) {
            $urls[] = ['loc' => $this->generateUrl('blog_detail', ['id' => $blogpost->getId()])];
        }
        $reponse=new Response(
            $this->renderView('sitemap/index.html.twig', [
                'urls'=>$urls,
                'hostname'=>$hostname,

            ]),
            200
        );
   $reponse->headers->set('content-type','text/xml');

        return $reponse;
    }
}
