<?php
namespace App\Controller;

use App\Entity\Conge;
use App\Form\CongeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class CongeController extends AbstractController
{
    #[Route('/conge', name: 'conge_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        $conges = $em->getRepository(Conge::class)->findAll();

        return $this->render('conge/index.html.twig', [
            'conges' => $conges,
        ]);
    }

    #[Route('/conge/{id<\d+>}', name: 'conge_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $em): Response
    {
        $conge = $em->getRepository(Conge::class)->find($id);

        if (!$conge) {
            $this->addFlash('error', 'Le conge spécifié est introuvable.');
            return $this->redirectToRoute('conge_index');
        }

        return $this->render('conge/show.html.twig', [
            'conge' => $conge,
        ]);
    }

    #[Route('/conge/{id<\d+>}/edit', name: 'conge_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $em, int $id): Response
    {
        $conge = $em->getRepository(Conge::class)->find($id);

        if (!$conge) {
            $this->addFlash('error', 'Le conge spécifié est introuvable.');
            return $this->redirectToRoute('conge_index');
        }

        $form = $this->createForm(CongeFormType::class, $conge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('conge_index');
        }

        return $this->render('conge/edit.html.twig', [
            'form' => $form->createView(),
            'conge' => $conge,
        ]);
    }

    #[Route('/conge/new', name: 'conge_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $conge = new Conge();
        
        $form = $this->createForm(CongeFormType::class, $conge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($conge);
            $em->flush();

            return $this->redirectToRoute('conge_index');
        }

        return $this->render('conge/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
