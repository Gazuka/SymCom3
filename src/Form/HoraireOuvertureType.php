<?php

namespace App\Form;

use App\Entity\HoraireOuverture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HoraireOuvertureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jour')
            ->add('heureDebut')
            ->add('heureFin')
            ->add('heureDebut2')
            ->add('heureFin2')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HoraireOuverture::class,
        ]);
    }
}
