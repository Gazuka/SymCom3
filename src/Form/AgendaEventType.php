<?php

namespace App\Form;

use App\Entity\Agenda;
use App\Form\AgendaType;
use App\Entity\AgendaEvent;
use App\Repository\AgendaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AgendaEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateEvent')
            ->add('nom')
            ->add('lieu')
            ->add('heureDebut')
            ->add('heureFin')
            ->add('commentaire')
            ->add('datePublication')
            ->add('publie')
            ->add('lien')
            ->add('agendas', EntityType::class, [
                'class' => Agenda::class,
                'multiple' => true,
                'expanded' => true,
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AgendaEvent::class,
        ]);
    }
}
