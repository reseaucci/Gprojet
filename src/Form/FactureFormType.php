<?php

namespace App\Form;

use App\Entity\Facture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroFacture', TextType::class, [
                'label' => 'Numéro de Facture'
            ])
            ->add('dateCreation', DateType::class, [
                'label' => 'Date de Création',
                'widget' => 'single_text',
            ])
            ->add('dateEcheance', DateType::class, [
                'label' => 'Date d\'Échéance',
                'widget' => 'single_text',
            ])
            ->add('montantHt', MoneyType::class, [
                'label' => 'Montant HT',
                'currency' => 'EUR',
            ])
            ->add('tva', MoneyType::class, [
                'label' => 'TVA',
                'currency' => 'EUR',
            ])
            ->add('montantTtc', MoneyType::class, [
                'label' => 'Montant TTC',
                'currency' => 'EUR',
            ])
            ->add('methodePaiement', TextType::class, [
                'label' => 'Méthode de Paiement'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
