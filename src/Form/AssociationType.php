<?php

namespace App\Form;

use App\Entity\Photo;
use App\Form\MissionType;
use App\Entity\Association;
use App\Form\Mission_AssociationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AssociationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('presentation')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Association sportive' => 'sportive',
                    'Association humanitaire, caritative ou sociale' => 'humanitaire-caritative-social',
                    'Association de loisirs' => 'loisirs',
                    'Association culturelle, artistique' => 'culturelle-artistique',
                    ]
                ])
            ->add('photo', EntityType::class, [
                'class' => Photo::class,
                'group_by' => 'type'                
                ])
            ->add('site')
            ->add('missions', CollectionType::class,
            [
                'entry_type' => Mission_AssociationType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => "Liste des missions :"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Association::class,
        ]);
    }
}
