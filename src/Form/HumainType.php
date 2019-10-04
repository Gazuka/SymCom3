<?php

namespace App\Form;

use App\Entity\Humain;
use App\Form\MailType;
use App\Entity\Fonction;
use App\Form\AdresseType;
use App\Form\TelephoneType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class HumainType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('sexe', ChoiceType::class, [
                'choices' => [
                    'Homme' => 'M',
                    'Femme' => 'F'
                    ]
                ])
            ->add('photo')
            ->add('adresse', AdresseType::class,
            [                
                'label' => "Adresse :"
            ])          
            ->add('telephones', CollectionType::class,
            [
                'entry_type' => TelephoneType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => "Téléphones :"
            ])
            ->add('emails', CollectionType::class,
            [
                'entry_type' => MailType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => "Emails :"
            ])
            ->add('missions', CollectionType::class,
            [
                'entry_type' => MissionType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => "Liste des missions :"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Humain::class,
        ]);
    }
}
