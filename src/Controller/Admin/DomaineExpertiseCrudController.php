<?php

namespace App\Controller\Admin;

use App\Entity\DomaineExpertise;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;  
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;  
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;


class DomaineExpertiseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DomaineExpertise::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle("index", "cloudmrege- Administration Domaine Expertise") // Sets the page title for the 'index' action.
            ->setPaginatorPageSize(20) ;// Sets the number of items per page in the list view.
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextareaField::new('description'),
                ImageField::new('file')->setBasePath('/images/team')->onlyOnIndex(),
                TextField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex(),
                
        ];
    }
    
}
