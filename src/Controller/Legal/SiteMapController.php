<?php

namespace App\Controller\Legal;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SiteMapController extends AbstractController
{
    #[Route('/legal/sitemap', name: 'app_site_map')]
    public function index(): Response
    {
        return $this->render('legal/sitemap.html.twig', [
            'title' => 'Bob-Aventure - Plan du site',
        ]);
    }
}
