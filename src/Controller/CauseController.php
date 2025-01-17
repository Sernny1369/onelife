<?php

namespace App\Controller;

use App\Entity\Cause;
use App\Form\CauseType;
use App\Repository\CauseRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\form;

#[Route('/cause')]
class CauseController extends AbstractController
{
    #[Route('/', name: 'app_cause')]
    public function index(CauseRepository $CauseRepository): Response
    {
        $cause = $CauseRepository->findAll();
        return $this->render('cause/index.html.twig', [
            'cause' => $cause
        ]);
    }

        #[Route('/admin', name: 'app_cause_admin')]
        public function admin(CauseRepository $CauseRepository): Response
        {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
            $cause = $CauseRepository->findAll();
            return $this->render('cause/admin_index.html.twig', [
                'cause' => $cause
            ]);
        }

        #[Route('/new', name: 'app_cause_new')]
        public function new(Request $request, EntityManagerInterface $em): Response
        {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
            $cause = new Cause();

            $form = $this->createForm(CauseType::class, $cause);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($cause);
                $em->flush();

                return $this->redirectToRoute('app_cause');
            }
            return $this->render('cause/new.html.twig', [
                'formCause' => $form->createview()
            ]);
        }

        #[Route('/{id}', name:'app_cause_show')]
        public function show(Cause $cause): Response
        {
           
             return $this->render('cause/show.html.twig', [
                'cause' => $cause
             ]);
        }

        
        #[Route('/edit/{id}', name: 'app_cause_edit')]
        public function edit(Cause $cause, Request $request, EntityManagerInterface $em): Response
        {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
            $form = $this->createForm(CauseType::class, $cause);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->flush();
                return $this->redirectToRoute('app_cause');
            }
            return $this->render('cause/edit.html.twig', [
                'formCause' => $form->createView()
            ]);
        }
        #[Route('/delete/{id}', name:'app_cause_delete')]
        public function delete(Cause $cause, EntityManagerInterface $em)
        {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
            $em->remove($cause);
            $em->flush();
            return $this->redirectToRoute('app_cause');
        }
}