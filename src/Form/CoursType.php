<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Module;
use App\Entity\TypeCours;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('photo',FileType::class)
            ->add('data')
            ->add('module', EntityType::class, [
                'class' => Module::class,
                'choice_label'=>'libelle'
            ])
            ->add('typecour', EntityType::class, [
                'class' => TypeCours::class,
                'choice_label'=>'libelle'
            ])
            ->add('auteur', TextType::class)
            ->add('description', TextareaType::class)
            ->add('contenu', TextareaType::class)
            ->add('Enregistré', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
