<?php

namespace App\Form;

use App\Entity\Apprenant;
use App\Entity\Cohorte;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApprenantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('email')
            ->add('description')
            ->add('dateNaiss')
            ->add('photo')
            ->add('cv')
            ->add('cohorte', EntityType::class, [
                'class' => Cohorte::class,
                'choice_label'=>'promotion'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Apprenant::class,
        ]);
    }
}
