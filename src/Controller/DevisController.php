<?php

namespace App\Controller;

use App\Entity\Devis;
use App\Form\DevisFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class DevisController extends AbstractController
{
    #[Route('/devis', name: 'devis_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $devisRepository = $entityManager->getRepository(Devis::class);
        $devis = $devisRepository->findAll();

        return $this->render('devis/index.html.twig', [
            'devis' => $devis,
        ]);
    }

    #[Route('/devis/{id}', name: 'devis_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        $devisRepository = $entityManager->getRepository(Devis::class);
        $devis = $devisRepository->find($id);

        if (!$devis) {
            throw $this->createNotFoundException('Devis non trouvé');
        }

        return $this->render('devis/show.html.twig', [
            'devis' => $devis,
        ]);
    }

    #[Route('/devis/new', name: 'devis_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $devis = new Devis();

        $form = $this->createForm(DevisFormType::class, $devis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($devis);
            $em->flush();

            return $this->redirectToRoute('devis_index');
        }

        return $this->render('devis/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/devis/{id}/edit', name: 'devis_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        $devisRepository = $entityManager->getRepository(Devis::class);
        $devis = $devisRepository->find($id);

        if (!$devis) {
            throw $this->createNotFoundException('Devis non trouvé');
        }

        $form = $this->createForm(DevisFormType::class, $devis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('devis_index');
        }

        return $this->render('devis/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
