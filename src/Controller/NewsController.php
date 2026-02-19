<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class NewsController extends AbstractController
{
    #[Route('/news', name: 'app_news')]
    public function index(Request $request, ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {
        $search = $request->query->get('q');
        $categoryId = $request->query->get('category');

        $articles = $articleRepository->findByFilters($search, $categoryId);
        $categories = $categoryRepository->findAll();

        return $this->render('news/index.html.twig', [
            'title' => 'Bob-Aventure - Blog',
            'articles' => $articles,
            'categories' => $categories,
            'currentSearch' => $search,
            'currentCategory' => $categoryId,
        ]);
    }

    #[Route('/news/{id}', name: 'app_news_details')]
    public function details(Article $article): Response
    {
        return $this->render('news/details.html.twig', [
            'article' => $article,
        ]);
    }
}
