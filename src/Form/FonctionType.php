<?php

namespace App\Form;

use App\Entity\Humain;
use App\Entity\Fonction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FonctionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Pour un élu' => 'élu',
                    'Pour un employé' => 'employé',
                    'Pour un bénévole' => 'bénévole',
                    ]
                ])
            ->add('nom')            
            ->add('nom_feminin')            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fonction::class,
        ]);
    }
}
