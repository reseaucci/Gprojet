<?php

namespace App\Form;

use App\Entity\Risque;
use App\Entity\Projet; // Import the Projet entity
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RisqueFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['rows' => 5]
            ])
            ->add('impact_potentiel', IntegerType::class, [
                'label' => 'Impact Potentiel'
            ])
            
            ->add('plan_action', TextareaType::class, [
                'label' => 'Plan d\'action',
                'attr' => ['rows' => 5]
            ])
            ->add('projet', EntityType::class, [
                'class' => Projet::class,
                'choice_label' => 'nom',
                'label' => 'Projet',
                'placeholder' => 'Sélectionnez un projet'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => ['class' => 'btn btn-primary']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Risque::class,
        ]);
    }
}
