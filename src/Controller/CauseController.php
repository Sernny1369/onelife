<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CauseController extends AbstractController
{
    #[Route('/cause', name: 'app_cause')]
    public function index(): Response
    {
        return $this->render('cause/index.html.twig', [
            'controller_name' => 'CauseController',
        ]);
    }
}
