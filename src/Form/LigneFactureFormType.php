<?php

namespace App\Form;

use App\Entity\LigneFacture;
use App\Entity\facture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneFactureFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('quantite')
            ->add('prix_unitaire_ht')
            ->add('montant_ht')
            ->add('facture_id', EntityType::class, [
                'class' => facture::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LigneFacture::class,
        ]);
    }
}
