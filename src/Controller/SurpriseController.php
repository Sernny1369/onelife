<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SurpriseController extends AbstractController
{
    #[Route('/surprise', name: 'app_surprise')]
    public function index(): Response
    {
        return $this->render('surprise/index.html.twig', [
            'controller_name' => 'SurpriseController',
        ]);
    }
}
