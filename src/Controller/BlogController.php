<?php

namespace App\Controller;

use App\Repository\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;


class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog')]
    public function Blogpost(
        BlogPostRepository $blogpostRepository,
        PaginatorInterface $paginator, 
        Request $request
    ): Response {
        $data = $blogpostRepository->findAll(); 
        $blogposts = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('blog/blog.html.twig', [
            'blogposts' => $blogposts,
        ]);
    }

    #[Route('/blog/{id}', name: 'blog_detail')]
    public function detailblog(Request $request, BlogPostRepository $BlogPostRepository): Response
    {
        $id = $request->get('id');
        $blogpost = $BlogPostRepository->find($id);

        if (!$blogpost) {
            throw $this->createNotFoundException('Blog post not found');
        }

        return $this->render('blog/detail.html.twig', [
            'blogpost' => $blogpost,
        ]);
    }
}
