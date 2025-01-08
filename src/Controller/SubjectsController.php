<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SubjectsController extends AbstractController
{
    #[Route('/subjects', name: 'app_subjects')]
    public function index(): Response
    {
        return $this->render('subjects/index.html.twig', [
            'controller_name' => 'SubjectsController',
        ]);
    }
}
