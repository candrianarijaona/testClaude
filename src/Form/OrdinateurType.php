<?php

namespace App\Form;

use App\Entity\Ordinateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdinateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('statut')
            ->add('souris', EntityType::class, [
                'class' => 'App\Entity\Souris',
                'choice_label' => 'nom',
            ])
            ->add('tour', EntityType::class, [
                'class' => 'App\Entity\Tour',
                'choice_label' => 'nom',
            ])
            ->add('clavier', EntityType::class, [
                'class' => 'App\Entity\Clavier',
                'choice_label' => 'nom',
            ])
            ->add('ecrans', EntityType::class, [
                'class' => 'App\Entity\Ecran',
                'choice_label' => fn($ecran) => $ecran->getTaille() . ' ' . $ecran->getMarqueEcran()->getNom(),
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ordinateur::class,
        ]);
    }
}
