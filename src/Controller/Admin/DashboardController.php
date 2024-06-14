<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use App\Entity\Commentaire;
use App\Entity\Conge;
use App\Entity\Devis;
use App\Entity\Facture;
use App\Entity\Fichier;
use App\Entity\Jalon;
use App\Entity\LigneDevis;
use App\Entity\LigneFacture;
use App\Entity\Responsable;
use App\Entity\Risque;
use App\Entity\Role;
use App\Entity\Tache;
use App\Entity\Utilisateur;
use App\Entity\Probleme;

class DashboardController extends AbstractDashboardController
{
    private AdminUrlGenerator $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(ProblemeCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Your Project Title');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linktoDashboard('Dashboard', 'fa fa-home'),
            MenuItem::linkToCrud('Problemes', 'fas fa-list', Probleme::class),
            MenuItem::linkToCrud('Commentaire', 'fas fa-list', Commentaire::class),
            MenuItem::linkToCrud('Conge', 'fas fa-list', Conge::class),

            MenuItem::linkToCrud('Devis', 'fas fa-list', Devis::class),

            MenuItem::linkToCrud('Facture', 'fas fa-list', Facture::class),
            MenuItem::linkToCrud('Fichier', 'fas fa-list', Fichier::class),
            MenuItem::linkToCrud('Jalon', 'fas fa-list', Jalon::class),
            MenuItem::linkToCrud('LigneDevis', 'fas fa-list', LigneDevis::class),
            MenuItem::linkToCrud('LigneFacture', 'fas fa-list', LigneFacture::class),
            MenuItem::linkToCrud('Risque', 'fas fa-list', Risque::class),
            MenuItem::linkToCrud('Role', 'fas fa-list', Role::class),
            MenuItem::linkToCrud('Tache', 'fas fa-list', Tache::class),
            MenuItem::linkToCrud('Utilisateur', 'fas fa-list', Utilisateur::class),


            // Ajoutez d'autres éléments de menu ici
        ];
    }
}


