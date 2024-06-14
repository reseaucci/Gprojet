<?php

namespace App\Controller;

use App\Entity\Role;
use App\Form\RoleFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class RoleController extends AbstractController
{
    #[Route('/role/new', name: 'role_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $role = new Role();
        $form = $this->createForm(RoleFormType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($role);
            $em->flush();

            return $this->redirectToRoute('role_index');
        }

        return $this->render('role/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/role', name: 'role_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        $roles = $em->getRepository(Role::class)->findAll();

        return $this->render('role/index.html.twig', [
            'roles' => $roles,
        ]);
    }

    #[Route('/role/{id}', name: 'role_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $em): Response
    {
        $role = $em->getRepository(Role::class)->find($id);

        if (!$role) {
            $this->addFlash('error', 'Le rôle spécifié est introuvable.');
            return $this->redirectToRoute('role_index');
        }

        return $this->render('role/show.html.twig', [
            'role' => $role,
        ]);
    }

    

    #[Route('/role/{id}/edit', name: 'role_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Role $role, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(RoleFormType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('role_index');
        }

        return $this->render('role/edit.html.twig', [
            'role' => $role,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/role/{id}', name: 'role_delete', methods: ['DELETE'])]
    public function delete(Request $request, Role $role, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $role->getId(), $request->request->get('_token'))) {
            $em->remove($role);
            $em->flush();
        }

        return $this->redirectToRoute('role_index');
    }
}
