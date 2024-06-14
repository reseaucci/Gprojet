<?php

namespace App\Controller;

use App\Entity\Risque;
use App\Form\RisqueFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RisqueController extends AbstractController
{
    #[Route('/risque', name: 'risque_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $risques = $entityManager->getRepository(Risque::class)->findAll();

        return $this->render('risque/index.html.twig', [
            'risques' => $risques,
        ]);
    }

    #[Route('/risque/new', name: 'risque_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $risque = new Risque();
        $form = $this->createForm(RisqueFormType::class, $risque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($risque);
            $entityManager->flush();

            return $this->redirectToRoute('risque_index');
        }

        return $this->render('risque/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/risque/{id}', name: 'risque_show', methods: ['GET'])]
    public function show(Risque $risque): Response
    {
        return $this->render('risque/show.html.twig', [
            'risque' => $risque,
        ]);
    }

    #[Route('/risque/{id}/edit', name: 'risque_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Risque $risque, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RisqueFormType::class, $risque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('risque_index');
        }

        return $this->render('risque/edit.html.twig', [
            'risque' => $risque,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/risque/{id}', name: 'risque_delete', methods: ['POST'])]
    public function delete(Request $request, Risque $risque, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$risque->getId(), $request->request->get('_token'))) {
            $entityManager->remove($risque);
            $entityManager->flush();
        }

        return $this->redirectToRoute('risque_index');
    }
}
