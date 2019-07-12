<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ArticleType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, $this->getConfiguration("Titre de l'article",
                            "Donnez un titre à votre article"
                ))
            ->add('dateCreation', DateTimeType::class, $this->getConfiguration("Date de création de l'article",
                            "?",
                            [
                                'date_widget'=>'single_text',
                                'time_widget'=>'single_text'//,
                                //"data" => new \DateTime('now')
                                ]
                ))
            ->add('dateStart', DateTimeType::class, $this->getConfiguration("Date de début de publication",
                            "?",
                            [
                                'date_widget'=>'single_text',
                                'time_widget'=>'single_text'//,
                                //"data" => new \DateTime('now')
                                ]
                ))
            ->add('dateStop', DateTimeType::class, $this->getConfiguration("Date de fin de publication",
            "?",
                            [
                                'date_widget'=>'single_text',
                                'time_widget'=>'single_text'//,
                                //"data" => new \DateTime('now')
                            ]
                ))
            ->add('publie')
            ->add('archive')
            ->add('accueil')
            ->add('imageIntro')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
