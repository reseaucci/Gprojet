<?php

namespace App\Controller;

use App\Entity\Fichier;
use App\Form\FichierFormType;
use App\Repository\FichierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fichier')]
class FichierController extends AbstractController
{
    #[Route('/', name: 'fichier_index', methods: ['GET'])]
    public function index(FichierRepository $fichierRepository): Response
    {
        return $this->render('fichier/index.html.twig', [
            'fichiers' => $fichierRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'fichier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fichier = new Fichier();
        $form = $this->createForm(FichierFormType::class, $fichier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($fichier);
            $entityManager->flush();

            return $this->redirectToRoute('fichier_index');
        }

        return $this->render('fichier/new.html.twig', [
            'fichier' => $fichier,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'fichier_show', methods: ['GET'])]
    public function show(Fichier $fichier): Response
    {
        return $this->render('fichier/show.html.twig', [
            'fichier' => $fichier,
        ]);
    }

    #[Route('/{id}/edit', name: 'fichier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fichier $fichier, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FichierFormType::class, $fichier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('fichier_index');
        }

        return $this->render('fichier/edit.html.twig', [
            'fichier' => $fichier,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'fichier_delete', methods: ['POST'])]
    public function delete(Request $request, Fichier $fichier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fichier->getId(), $request->request->get('_token'))) {
            $entityManager->remove($fichier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fichier_index');
    }
}
