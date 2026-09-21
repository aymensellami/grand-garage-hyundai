<?php

namespace App\Controller\Admin;

use App\Entity\Consultant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Vich\UploaderBundle\Form\Type\VichImageType;  
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;

class ConsultantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Consultant::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle("index", "Administration consultant") // Sets the page title for the 'index' action.
            ->setPaginatorPageSize(20) ;// Sets the number of items per page in the list view.
    }
    
     
    public function configureFields(string $pageName): iterable
    {
        return [
        
            TextField::new('nom'),
            TextField::new('pernon'),
            TextField::new('domaine'),
            TextField::new('exprience'),
            TextField::new('imageFile')->setFormType(VichImageType::class),
            ImageField::new('file')->setBasePath('/images/team')->onlyOnIndex(),
            
        ];
    }
    
}
