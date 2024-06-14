<?php
// src/Form/ProjetType.php

namespace App\Form;

use App\Entity\Projet;
use App\Entity\Responsable;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('nom')
        ->add('description')
        ->add('date_debut', DateType::class, [
            'widget' => 'single_text',
            'required' => false,
        ])
        ->add('date_fin', DateType::class, [
            'widget' => 'single_text',
            'required' => false,
        ])
        ->add('budget')
        ->add('responsable', EntityType::class, [
            'class' => Responsable::class,
            'choice_label' => 'nom', // Nom de l'attribut de l'entité Utilisateur à afficher
            'placeholder' => 'Sélectionnez un responsable',
        ])
        ->add('statut')
        ->add('budget_previsionnel')
        ->add('budget_reel')
        ->add('avancement')
        ->add('utilisateur', EntityType::class, [
            'class' => Utilisateur::class,
            'choice_label' => 'nom',
            'placeholder' => 'Sélectionnez un utilisateur',
        ]);
}

}
