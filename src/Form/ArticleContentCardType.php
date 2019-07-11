<?php

namespace App\Form;

use App\Entity\ArticleContentCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleContentCardType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, $this->getConfiguration("Titre du module",
                            "Donnez un titre à votre Card"
                ))
            ->add('contenu', TextareaType::class, $this->getConfiguration("Titre du module",
                            "Ecrivez le contenu de votre Card"
                ))
            
            ->add('position', IntegerType::class, $this->getConfiguration("Position du contenu",
                            "Entrez la position de votre Card sur la page",
                            array("data" => 0)
                ))
            ->add('nbrColSm', IntegerType::class, $this->getConfiguration("Largeur en colonnes (sur 12) - écran SMALL",
                            "Entrez un nombre de colonnes que prendra votre Card (entre 1 et 12)",
                            array("data" => 12)
                ))
            ->add('nbrColMd', IntegerType::class, $this->getConfiguration("Largeur en colonnes (sur 12) - écran MEDIUM",
                            "Entrez un nombre de colonnes que prendra votre Card (entre 1 et 12)",
                            array("data" => 12)
                ))
            ->add('nbrColLg', IntegerType::class, $this->getConfiguration("Largeur en colonnes (sur 12) - écran LARGE",
                            "Entrez un nombre de colonnes que prendra votre Card (entre 1 et 12)",
                            array("data" => 12)
                ))
            ->add('nbrColXl', IntegerType::class, $this->getConfiguration("Largeur en colonnes (sur 12) - écran EXTRA LARGE",
                            "Entrez un nombre de colonnes que prendra votre Card (entre 1 et 12)",
                            array("data" => 12)
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleContentCard::class,
        ]);
    }
}
