<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ClientController extends AbstractController
{
    #[Route('/client', name: 'client_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        $clients = $em->getRepository(Client::class)->findAll();

        return $this->render('client/index.html.twig', [
            'clients' => $clients,
        ]);
    }

    #[Route('/client/new', name: 'client_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $client = new Client();
        
        $form = $this->createForm(ClientFormType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('client_index');
        }

        return $this->render('client/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/client/{id}', name: 'client_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $em): Response
    {
        $client = $em->getRepository(Client::class)->find($id);

        if (!$client) {
            $this->addFlash('error', 'Le client spécifié est introuvable.');
            return $this->redirectToRoute('client_index');
        }

        return $this->render('client/show.html.twig', [
            'client' => $client,
        ]);
    }

    #[Route('/client/{id}/edit', name: 'client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $em, int $id): Response
    {
        $client = $em->getRepository(Client::class)->find($id);

        if (!$client) {
            $this->addFlash('error', 'Le client spécifié est introuvable.');
            return $this->redirectToRoute('client_index');
        }

        $form = $this->createForm(ClientFormType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('client_index');
        }

        return $this->render('client/edit.html.twig', [
            'form' => $form->createView(),
            'client' => $client,
        ]);
    }
}
