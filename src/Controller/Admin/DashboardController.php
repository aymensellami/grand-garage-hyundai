<?php

namespace App\Controller\Admin;

use App\Entity\Entreprise;
use App\Entity\BlogPost;
use App\Entity\User;
use App\Entity\DomaineExpertise;
use App\Entity\Consultant;
use App\Entity\Contact;
use App\Entity\Newsletters\Users;
use App\Entity\Newsletters\Newsletters;

use Doctrine\ORM\EntityManagerInterface; 
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Cloud Merge');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('About', 'fas fa-industry', Entreprise::class);
        yield MenuItem::linkToCrud('Blog', 'fas fa-newspaper', BlogPost::class);
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Services', 'fas fa-cogs', DomaineExpertise::class);
        yield MenuItem::linkToCrud('Team', 'fas fa-users', Consultant::class);
        yield MenuItem::linkToCrud('Contact', 'fas fa-envelope', Contact::class);
        yield MenuItem::linkToCrud('Newsletters\Users', 'fas fa-folder', Users::class);
        yield MenuItem::linkToCrud('Newsletters\Newsletters', 'fas fa-folder', Newsletters::class);

        yield MenuItem::linkToRoute('Envoyer la newsletter', 'fas fa-envelope', 'send_newsletter');

    }

    public function sendNewsletter(EntityManagerInterface $em, MailerInterface $mailer): Response
    {
        $users = $em->getRepository(Users::class)->findAll();

        // Vérifier s'il y a une newsletter non envoyée
        $newsletter = $em->getRepository(Newsletters::class)->findOneBy(['is_sent' => false]);

        if (!$newsletter) {
            $this->addFlash('info', 'Aucune newsletter à envoyer.');

            return $this->redirectToRoute('admin');
        }
        foreach ($users as $user) {
            $email = (new Email())
                ->from('your_email@example.com')
                ->to($user->getEmail())
                ->subject($newsletter->getName())
                ->html($newsletter->getContent());

            $mailer->send($email);
        }

        // Mettre à jour le statut de la newsletter comme envoyée
        $newsletter->setIsSent(true);
        $em->flush();

        $this->addFlash('success', 'La newsletter a été envoyée avec succès.');
        return $this->redirectToRoute('admin');
    }
}
