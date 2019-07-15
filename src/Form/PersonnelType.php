<?php

namespace App\Form;

use App\Entity\Personnel;
use App\Form\PersonnelFonctionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PersonnelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            //->add('telephones')
            //->add('mails')
            ->add('fonctions', CollectionType::class,
            [
                'entry_type' => PersonnelFonctionType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => "Liste des fonctions :"
            ])
            ->add('photo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnel::class,
        ]);
    }
}
