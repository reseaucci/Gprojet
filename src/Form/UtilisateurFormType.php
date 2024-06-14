<?php

namespace App\Form;

use App\Entity\Commentaire;
use App\Entity\Role;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('password')
            ->add('email')
            ->add('role', EntityType::class, [
                'class' => Role::class,
                'choice_label' => 'nom',
            ])
            ->add('avatar')
            ->add('disponibilite')
            ->add('commentaire', EntityType::class, [
                'class' => Commentaire::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
