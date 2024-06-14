<?php

namespace App\Form;

use App\Entity\Jalon;
use App\Entity\Projet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JalonFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom')
        ->add('date_echeance', null, [
            'widget' => 'single_text'
        ])
        ->add('statut')
        ->add('projet', EntityType::class, [
            'class' => Projet::class,
            'choice_label' => 'nom',
            'placeholder' => 'Choisir un projet',
            'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Jalon::class,
        ]);
    }
}
