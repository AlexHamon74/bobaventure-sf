<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->setLabel('Nom de la catégorie')
                ->setRequired(true),

            IntegerField::new('articles')
                ->setLabel('Nombre d\'articles')
                ->onlyOnIndex()
                ->setVirtual(true) 
                ->formatValue(function ($value, $entity) {
                    return $entity->getArticles()->count();
                }),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Gestion des catégories');
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance->getArticles()->isEmpty()) {
            $this->addFlash(
               'danger',
               'Impossible de supprimer cette catégorie car elle contient des articles.'
            );
            return;
        }
        parent::deleteEntity($entityManager, $entityInstance);
    }
}
