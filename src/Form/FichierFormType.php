<?php

namespace App\Form;

use App\Entity\Fichier;
use App\Entity\Projet;
use App\Entity\devis;
use App\Entity\facture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FichierFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('chemin')
            ->add('taille')
            ->add('type')
            ->add('projet_id', EntityType::class, [
                'class' => Projet::class,
'choice_label' => 'id',
            ])
            ->add('facture_id', EntityType::class, [
                'class' => facture::class,
'choice_label' => 'id',
            ])
            ->add('devis_id', EntityType::class, [
                'class' => devis::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fichier::class,
        ]);
    }
}
