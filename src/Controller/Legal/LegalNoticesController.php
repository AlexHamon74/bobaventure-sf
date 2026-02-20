<?php

namespace App\Controller\Legal;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LegalNoticesController extends AbstractController
{
    #[Route('/legal/notices', name: 'app_legal_notices')]
    public function index(): Response
    {
        return $this->render('legal/legal_notices.html.twig', [
            'title' => 'Bob-Aventure - Mentions légales',
        ]);
    }
}
