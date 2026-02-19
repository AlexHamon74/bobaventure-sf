<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findByFilters(?string $search, ?int $categoryId): array
    {
        $qb = $this->createQueryBuilder('a')
            ->leftJoin('a.category', 'c')
            ->addSelect('c')
            ->orderBy('a.published_at', 'DESC');

        if ($search) {
            $qb->andWhere('a.title LIKE :search OR a.description LIKE :search')
                ->setParameter('search', '%' . $search . '%');
        }

        if ($categoryId) {
            $qb->andWhere('c.id = :categoryId')
                ->setParameter('categoryId', $categoryId);
        }

        return $qb->getQuery()->getResult();
    }
}
