<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\Type\ArticleImageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title');
        yield TextEditorField::new('content');
        yield AssociationField::new('category');
        yield Field::new('main_image_file')
            ->setFormType(FileType::class)
            ->onlyOnForms();
        yield ImageField::new('main_image')
            ->setBasePath('/images/articleMainImage')
            ->onlyOnIndex();
        yield CollectionField::new('articleImages')
            ->setEntryType(ArticleImageType::class);
        yield DateTimeField::new('published_at')
            ->onlyOnIndex();
    }
}
