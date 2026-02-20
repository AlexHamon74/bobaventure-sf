<?php

namespace App\Controller\Legal;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PrivacyController extends AbstractController
{
    #[Route('/legal/privacy', name: 'app_privacy')]
    public function index(): Response
    {
        return $this->render('legal/privacy.html.twig', [
            'title' => 'Bob-Aventure - Politique de confidentialité',
        ]);
    }
}
