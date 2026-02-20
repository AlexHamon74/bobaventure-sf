<?php

namespace App\Controller\Legal;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CGUController extends AbstractController
{
    #[Route('/legal/cgu', name: 'app_cgu')]
    public function index(): Response
    {
        return $this->render('legal/cgu.html.twig', [
            'title' => 'Bob-Aventure - Conditions générales d\'utilisation',
        ]);
    }
}
