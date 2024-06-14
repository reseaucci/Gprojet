<?php

namespace App\Controller;

use App\Entity\Probleme;
use App\Form\ProblemeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ProblemeController extends AbstractController
{
    #[Route('/probleme', name: 'probleme_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        $problemes = $em->getRepository(Probleme::class)->findAll();

        return $this->render('probleme/index.html.twig', [
            'problemes' => $problemes,
        ]);
    }

    #[Route('/probleme/new', name: 'probleme_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $probleme = new Probleme();
        
        $form = $this->createForm(ProblemeFormType::class, $probleme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($probleme);
            $em->flush();

            return $this->redirectToRoute('probleme_index');
        }

        return $this->render('probleme/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/probleme/{id}', name: 'probleme_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $em): Response
    {
        $probleme = $em->getRepository(Probleme::class)->find($id);

        if (!$probleme) {
            $this->addFlash('danger', 'Le problème Demandé est introuvable.');
            return $this->redirectToRoute('probleme_index');
        }

        return $this->render('probleme/show.html.twig', [
            'probleme' => $probleme,
        ]);
    }

    #[Route('/probleme/{id}/edit', name: 'probleme_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $id, EntityManagerInterface $em): Response
    {
        $probleme = $em->getRepository(Probleme::class)->find($id);

        if (!$probleme) {
            $this->addFlash('danger', 'Le problème spécifié est introuvable.');
            return $this->redirectToRoute('probleme_index');
        }

        $form = $this->createForm(ProblemeFormType::class, $probleme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('probleme_show', ['id' => $probleme->getId()]);
        }

        return $this->render('probleme/edit.html.twig', [
            'probleme' => $probleme,
            'form' => $form->createView(),
        ]);
    }
}
