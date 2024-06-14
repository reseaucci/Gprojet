<?php

namespace App\Form;

use App\Entity\LigneDevis;
use App\Entity\devis;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneDevisFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('quantite')
            ->add('prix_unitaire_ht')
            ->add('montant_ht')
            ->add('devis_id', EntityType::class, [
                'class' => devis::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LigneDevis::class,
        ]);
    }
}
