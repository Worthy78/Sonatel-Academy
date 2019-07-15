<?php

namespace App\Form;

use App\Entity\Candidature;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CandidatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Prenom', TextType::class)
            ->add('nom', TextType::class)
            ->add('dateNaissance')
            ->add('lieuNaissance', TextType::class)
            ->add('NiveauEtude', ChoiceType::class, array(
                'choices'  => array(
                    'Niveau d\'étude' => null,
                    'Bac' => 'Bac',
                    'Licence' => 'licence',
                    'Master' => 'Master',
                    'Autre' => 'Autre'
                ))
            )
            ->add('formationSouhaite', ChoiceType::class, array(
                'choices'  => array(
                    'Formation souhaitée' => null,
                    'Présentielle' => 'Présentielle',
                    'Online' => 'Online',
                    
                ))
            )
            ->add('referentielChoisit', ChoiceType::class, array(
                'choices'  => array(
                    'referentiel Choisit' => null,
                    'Developpement d\'application' => 'Developpement d\'application',
                    'Data artisan' => 'Data artisan',
                    'Référent digital' => 'Référent digital',
                    
                ))
            )
            ->add('travaillezVous', ChoiceType::class, array(
                'choices'  => array(
                    'travaillez-Vous' => null,
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                ))
            )
            ->add('domaineTravail', TextType::class)
            ->add('cv')
            ->add('telephone', TextType::class)
            ->add('email', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidature::class,
        ]);
    }
}
