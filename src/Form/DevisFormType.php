<?php

namespace App\Form;

use App\Entity\Devis;
use App\Entity\Facture;
use App\Entity\client;
use App\Entity\projet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevisFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('date_creation', null, [
            'widget' => 'single_text'
        ])
        ->add('date_echeance', null, [
            'widget' => 'single_text'
        ])
        ->add('montant_ht')
        ->add('tva')
        ->add('montant_ttc')
        ->add('projet', EntityType::class, [
            'class' => projet::class,
            'choice_label' => 'nom', // Par exemple, si "nom" est le champ à afficher
        ])
        ->add('client', EntityType::class, [
            'class' => client::class,
            'choice_label' => 'nom', // Utilisez le champ approprié pour le nom du client
        ])
        ->add('facture', EntityType::class, [
            'class' => Facture::class,
            'choice_label' => 'numero', // Par exemple, si "numero" est le champ à afficher
        ])
    ;
}


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Devis::class,
        ]);
    }
}
