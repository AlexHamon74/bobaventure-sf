<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class NewsController extends AbstractController
{
    #[Route('/news', name: 'app_news')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();

        return $this->render('news/index.html.twig', [
            'title' => 'Bob-Aventure - Blog',
            'articles' => $articles,
        ]);
    }

    #[Route('/news/{id}', name:'app_news_details')]
    public function details(Article $article): Response
    {
        return $this->render('news/details.html.twig', [
            'article' => $article,
        ]);
    }
}
