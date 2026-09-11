<?php

namespace App\Controller\Admin;

use App\Entity\Entreprise;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;




class EntrepriseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Entreprise::class;
    }
    public function configureCrud(Crud $crud): Crud
{
    return $crud
        ->setPageTitle("index", "cloudmrege- Administration de Entreprise") // Sets the page title for the 'index' action.
        ->setPaginatorPageSize(20) // Sets the number of items per page in the list view.
        ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig'); // Adds a form theme for CKEditor to be used in form rendering.
}








    
public function configureFields(string $pageName): iterable
{
    return [
        TextField::new('nom'),
        TextField::new('nbrConsultant'),
        
        TextField::new('chiffredaffaires'),

        TextareaField::new('Introduction')
    ];
}

}
