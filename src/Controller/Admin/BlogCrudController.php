<?php

namespace App\Controller\Admin;

use App\Entity\Blog;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BlogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Blog::class;
    }


    public function configureFields(string $pageName): iterable
    {
      
            yield TextField::new('title');

            yield SlugField::new('slug')
                ->setTargetFieldName('title');
            yield TextField::new('textInfo');

            yield TextEditorField::new('content');

            yield DateTimeField::new('createdAt')
                ->hideOnForm();

            yield AssociationField::new('categories');
            yield AssociationField::new('image');
            yield DateTimeField::new('updatedAt')
                ->hideOnForm();

       
    }
}
