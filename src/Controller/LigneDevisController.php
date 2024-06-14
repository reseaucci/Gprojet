<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LigneDevisController extends AbstractController
{
    #[Route('/ligne/devis', name: 'app_ligne_devis')]
    public function index(): Response
    {
        return $this->render('ligne_devis/index.html.twig', [
            'controller_name' => 'LigneDevisController',
        ]);
    }
}
