<?php

namespace App\Controller;

use App\Entity\Subjects;
use App\Form\SubjectsType;
use App\Repository\SubjectsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/subjects')]
final class SubjectsController extends AbstractController
{
    #[Route(name: 'app_subjects', methods: ['GET'])]
    public function index(SubjectsRepository $subjectsRepository): Response
    {
        return $this->render('subjects/index.html.twig', [
            'subjects' => $subjectsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_subjects_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $subject = new Subjects();
        $form = $this->createForm(SubjectsType::class, $subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($subject);
            $entityManager->flush();

            return $this->redirectToRoute('app_subjects', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('subjects/new.html.twig', [
            'subject' => $subject,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_subjects_show', methods: ['GET'])]
    public function show(Subjects $subject): Response
    {
        return $this->render('subjects/show.html.twig', [
            'subject' => $subject,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_subjects_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Subjects $subject, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SubjectsType::class, $subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_subjects', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('subjects/edit.html.twig', [
            'subject' => $subject,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_subjects_delete', methods: ['POST'])]
    public function delete(Subjects $subject, EntityManagerInterface $entityManager)
    {
            $entityManager->remove($subject);
            $entityManager->flush();
        

        return $this->redirectToRoute('app_subjects', [], Response::HTTP_SEE_OTHER);
    }

    
}
