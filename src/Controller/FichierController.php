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
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $fichier = new Fichier();
        $form = $this->createForm(FichierFormType::class, $fichier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form->get('fichier')->getData();
            if ($uploadedFile) {
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();

                try {
                    $uploadedFile->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // handle exception if something happens during file upload
                }

                // Determine mime type without symfony/mime
                $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($fileInfo, $this->getParameter('uploads_directory').'/'.$newFilename);
                finfo_close($fileInfo);

                $fichier->setChemin($newFilename);
                $fichier->setTaille($uploadedFile->getSize());
                $fichier->setType($mime);
            }

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
    public function edit(Request $request, Fichier $fichier, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(FichierFormType::class, $fichier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form->get('fichier')->getData();
            if ($uploadedFile) {
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();

                try {
                    $uploadedFile->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // handle exception if something happens during file upload
                }

                // Determine mime type without symfony/mime
                $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($fileInfo, $this->getParameter('uploads_directory').'/'.$newFilename);
                finfo_close($fileInfo);

                $fichier->setChemin($newFilename);
                $fichier->setTaille($uploadedFile->getSize());
                $fichier->setType($mime);
            }

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

        return $this->render('fichier/delete.html.twig', [
            'fichier' => $fichier, // $fichier représente l'entité Fichier que vous souhaitez supprimer
        ]);
        
    }
}
