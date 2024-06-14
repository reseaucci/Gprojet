<?php

namespace App\Controller;

use App\Entity\Responsable;
use App\Form\ResponsableFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class ResponsableController extends AbstractController
{
    #[Route('/responsables', name: 'responsable_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $responsables = $entityManager->getRepository(Responsable::class)->findAll();
        return $this->render('responsable/index.html.twig', [
            'responsables' => $responsables,
        ]);
    }

    #[Route('/responsables/new', name: 'responsable_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
{
    $responsable = new Responsable();
    $form = $this->createForm(ResponsableFormType::class, $responsable);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($responsable);
        $entityManager->flush();
        return $this->redirectToRoute('responsable_index');
    }

    return $this->render('responsable/new.html.twig', [
        'form' => $form->createView(),
    ]);
}


    #[Route('/responsables/{id}', name: 'responsable_show', methods: ['GET'])]
    public function show(Responsable $responsable): Response
    {
        return $this->render('responsable/show.html.twig', [
            'responsable' => $responsable,
        ]);
    }

    #[Route('/responsables/{id}/edit', name: 'responsable_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Responsable $responsable, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ResponsableFormType::class, $responsable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('responsable_index');
        }

        return $this->render('responsable/edit.html.twig', [
            'responsable' => $responsable,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/responsables/{id}', name: 'responsable_delete', methods: ['POST'])]
    public function delete(Request $request, Responsable $responsable, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$responsable->getId(), $request->request->get('_token'))) {
            $entityManager->remove($responsable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('responsable_index');
    }
}
