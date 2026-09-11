<?php

namespace App\Controller\Admin;

use App\Entity\BlogPost;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;


class BlogPostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogPost::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle("index", "cloudmrege- Administration blog") // Sets the page title for the 'index' action.
            ->setPaginatorPageSize(3) ;// Sets the number of items per page in the list view.
    }
    

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('titre'),
            TextareaField::new('contenu'),
            DateTimeField::new('date', 'date'),

        ];
    }
    
}
