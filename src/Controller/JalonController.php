<?php

namespace App\Controller;

use App\Entity\Jalon;
use App\Form\JalonFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class JalonController extends AbstractController
{
    #[Route('/jalon', name: 'jalon_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        $jalons = $em->getRepository(Jalon::class)->findAll();

        return $this->render('jalon/index.html.twig', [
            'jalons' => $jalons,
        ]);
    }

    #[Route('/jalon/{id}', name: 'jalon_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $em): Response
    {
        $jalon = $em->getRepository(Jalon::class)->find($id);

        if (!$jalon) {
            $this->addFlash('error', 'Le jalon spécifié est introuvable.');
            return $this->redirectToRoute('jalon_index');
        }

        return $this->render('jalon/show.html.twig', [
            'jalon' => $jalon,
        ]);
    }

    #[Route('/jalon/{id}/edit', name: 'jalon_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $id, EntityManagerInterface $em): Response
    {
        $jalon = $em->getRepository(Jalon::class)->find($id);

        if (!$jalon) {
            $this->addFlash('error', 'Le jalon spécifié est introuvable.');
            return $this->redirectToRoute('jalon_index');
        }

        $form = $this->createForm(JalonFormType::class, $jalon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('jalon_index');
        }

        return $this->render('jalon/edit.html.twig', [
            'form' => $form->createView(),
            'jalon' => $jalon,
        ]);
    }

    #[Route('/jalon/new', name: 'jalon_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $jalon = new Jalon();

        $form = $this->createForm(JalonFormType::class, $jalon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($jalon);
            $em->flush();

            return $this->redirectToRoute('jalon_index');
        }

        return $this->render('jalon/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
