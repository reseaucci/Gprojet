<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\ProjetFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class ProjetController extends AbstractController
{
    #[Route('/projet', name: 'projet_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        // Simuler la récupération des projets depuis un service ou un système de stockage
        $projets = $em->getRepository(Projet::class)->findAll();
        return $this->render('projet/index.html.twig', [
            'projets' => $projets,
        ]);
    }

    #[Route('/projet/new', name: 'projet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $projet = new Projet();
        
        $form = $this->createForm(ProjetFormType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($projet);
            $em->flush();

            $this->addFlash('success', 'Projet créé avec succès.');

            return $this->redirectToRoute('projet_index');
        }

        return $this->render('projet/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/projet/{id}', name: 'projet_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $em): Response
    {
        // Simuler la récupération d'un projet par son ID depuis un service ou un système de stockage
        $projet =  $em->getRepository(Projet::class)->find($id);

        if (!$projet) {
            $this->addFlash('danger', 'Le projet demandé est introuvable.');
            return $this->redirectToRoute('projet_index');
        }

        return $this->render('projet/show.html.twig', [
            'projet' => $projet,
        ]);
    }

    #[Route('/projet/{id}/edit', name: 'projet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $id, EntityManagerInterface $em): Response
    {
        // Simuler la récupération d'un projet par son ID depuis un service ou un système de stockage
        $projet = $em->getRepository(Projet::class)->find($id);

        if (!$projet) {
            $this->addFlash('danger', 'Le projet spécifié est introuvable.');
            return $this->redirectToRoute('projet_index');
        }

        $form = $this->createForm(ProjetFormType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('projet_show', ['id' => $projet->getId()]);
            $this->addFlash('success', 'Projet mis à jour avec succès.');

            return $this->redirectToRoute('projet_show', ['id' => $projet->getId()]);
        }

        return $this->render('projet/edit.html.twig', [
            'projet' => $projet,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/projet/{id}', name: 'projet_delete', methods: ['POST'])]
    public function delete(Request $request, Projet $projet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$projet->getId(), $request->request->get('_token'))) {
            $entityManager->remove($projet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('projet_index');
    }
}
