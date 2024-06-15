<?php

namespace App\Form;

use App\Entity\Devis;
use App\Entity\Facture;
use App\Entity\Fichier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FichierFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('chemin', TextType::class)
            ->add('taille', IntegerType::class)
            ->add('type', TextType::class)
            ->add('facture', EntityType::class, [
                'class' => Facture::class,
                'choice_label' => 'numeroFacture',
            ])
            ->add('devis', EntityType::class, [
                'class' => Devis::class,
                'choice_label' => 'id',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fichier::class,
        ]);
    }
}
