<?php
namespace App\Controller\Admin;

use App\Entity\Probleme;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class ProblemeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Probleme::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Champ ID, caché dans le formulaire (auto-incrémenté)
            TextareaField::new('description'), // Champ description (longtext)
            IntegerField::new('priorite'), // Champ priorité (int)
            TextField::new('statut'), // Champ statut (varchar 255)
            DateTimeField::new('date_creation'), // Champ date de création (datetime)
            DateTimeField::new('date_resolution')->setRequired(false), // Champ date de résolution (datetime), non obligatoire
            // Ajoutez d'autres champs selon vos besoins
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Probleme')
            ->setEntityLabelInPlural('Problemes');
    }
}
?>