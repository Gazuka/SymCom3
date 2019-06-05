<?php

namespace App\Form;

use App\Entity\ArticleContentJumbo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleContentJumboType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('titreVisibility')
            ->add('contenu')
            ->add('intro')
            ->add('position')
            ->add('nbrColSm')
            ->add('nbrColMd')
            ->add('nbrColLg')
            ->add('nbrColXl')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleContentJumbo::class,
        ]);
    }
}
