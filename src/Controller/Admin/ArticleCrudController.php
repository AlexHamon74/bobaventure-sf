<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\Type\ArticleImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Formield;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title')
                ->setLabel('Titre de l\'article')
                ->setRequired(true),

            AssociationField::new('category')
                ->setLabel('Catégorie')
                ->setRequired(true),

            TextEditorField::new('content')
                ->setLabel('Contenu de l\'article')
                ->onlyOnForms()
                ->setRequired(true),

            TextField::new('content')
                ->setLabel('Contenu de l\'article')
                ->onlyOnDetail()
                ->renderAsHtml(),
                
            ImageField::new('main_image')
                ->setLabel('Image principale')
                ->hideOnForm()
                ->setBasePath('/images/articleMainImage'),

            Field::new('main_image_file')
                ->setLabel('Image principale')
                ->onlyOnForms()
                ->setFormType(FileType::class)
                ->setHelp('L\'image doit être au format paysage'),

            CollectionField::new('articleImages')
                ->setLabel('Images supplémentaires')
                ->onlyOnForms()
                ->setEntryType(ArticleImageType::class),

            AssociationField::new('articleImages')
                ->setLabel('Images supplémentaires')
                ->onlyOnDetail()
                ->setTemplatePath('admin/article_images.html.twig'),

            DateTimeField::new('published_at')
                ->setLabel('Date de publication')
                ->hideOnForm(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Gestion des articles');
    }
}
