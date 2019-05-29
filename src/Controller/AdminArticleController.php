<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Entity\ArticleContent;
use App\Form\ArticleContentType;
use App\Entity\ArticleContentCard;
use App\Controller\OutilsController;
use App\Form\ArticleContentCardType;
use App\Repository\ArticleRepository;
use App\Repository\ArticleContentRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminArticleController extends OutilsController
{
    /** GESTION DES ARTICLES *******************************************************************************************************************************************/
    /**
     * Création d'un article
     * 
     * @Route("/admin/article/new", name="admin_article_article_new")
     *
     * @return Response
     */
    public function creerArticle(Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = new Article();
        $variables['classType'] = ArticleType::class;
        $variables['pagedebase'] = 'admin/element_new.html.twig';
        $variables['pagederesultat'] = 'admin_article_articles_liste';
        $variables['titre'] = "Création d'un article";
        $variables['texteConfirmation'] = "L'article ### a bien été créé !";
        $variables['texteConfirmationEval']["###"] = '$element->getTitre();';
        
        return $this->formElement($variables);
    }    
    /**
     * Affiche l'ensemble des articles
     * 
     * @Route("/admin/articles", name="admin_article_articles_liste")
     *
     * @return Response
     */
    public function recupererArticles(ArticleRepository $repo):Response {
        $elements = "articles";
        $titre = "Listing des articles";
        $pagederesultat = "admin/admin_article/articles_liste.html.twig";
        return $this->recupererElements($repo, $elements, $titre, $pagederesultat);
    }
    /**
     * Permet d'afficher le formulaire d'édition d'un article
     *
     * @Route("/admin/admin_article/article/{id}/edit", name="admin_article_article_edit")
     * @return Response
     */
    public function editArticle(Article $article, Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = $article;
        $variables['classType'] = ArticleType::class;
        $variables['pagedebase'] = 'admin/admin_article/article_edit.html.twig';
        $variables['pagederesultat'] = 'admin_article_articles_liste';
        $variables['titre'] = "Edition de l'article ".$article->getTitre().".";
        $variables['texteConfirmation'] = "L'agenda ### a bien été modifié !";
        $variables['texteConfirmationEval']["###"] = '$element->getTitre();';
        
        return $this->formElement($variables);
    }

    /** GESTION DES ARTICLES CONTENT ***********************************************************************************************************************************/
    /**
     * Création d'un articleContent
     * 
     * @Route("/admin/content/new/{article_id}", name="admin_article_content_new")
     *
     * @return Response
     */
    public function creerArticleContent(Request $request, ObjectManager $manager, ArticleRepository $repo, $article_id):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;        
        $element = new ArticleContent();
        $article = $repo->find($article_id);
        $element->setArticle($article);        
        $variables['element'] = $element;
        $variables['classType'] = ArticleContentType::class;
        $variables['pagedebase'] = 'admin/element_new.html.twig';
        $variables['pagederesultat'] = 'admin_article_articles_liste';
        $variables['pagederesultatConfig'] = array('id' => $article_id);
        $variables['titre'] = "Création d'un contenu";
        $variables['texteConfirmation'] = "Le contenu a bien été créé !";
        
        return $this->formElement($variables);
    }   
    /**
     * Permet d'afficher le formulaire d'édition d'un articleContent
     *
     * @Route("/admin/admin_article/content/{id}/edit", name="admin_article_content_edit")
     * @return Response
     */
    public function editArticleContent(ArticleContent $articleContent, Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = $articleContent;
        $variables['classType'] = ArticleContentType::class;
        $variables['pagedebase'] = 'admin/admin_article/content_edit.html.twig';
        $variables['pagederesultat'] = 'admin_article_articles_liste';
        $variables['pagederesultatConfig'] = array('id' => $articleContent->getArticle()->getId());
        $variables['titre'] = "Edition de l'article ".$articleContent->getArticle()->getTitre().".";
        $variables['texteConfirmation'] = "L'article a bien été modifié !";
        
        return $this->formElement($variables);
    }

    /** GESTION DES ARTICLES CARD **************************************************************************************************************************************/
    /**
     * Création d'un articleContentCard
     * 
     * @Route("/admin/card/new/{content_id}", name="admin_article_card_new")
     *
     * @return Response
     */
    public function creerArticleContentCard(Request $request, ObjectManager $manager, ArticleContentRepository $repo, $content_id):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $element = new ArticleContentCard();
        $content = $repo->find($content_id);
        $element->setArticleContent($content); 
        $variables['element'] = $element;
        $variables['classType'] = ArticleContentCardType::class;
        $variables['pagedebase'] = 'admin/element_new.html.twig';
        $variables['pagederesultat'] = 'admin_article_content_edit';
        $variables['pagederesultatConfig'] = array('id' => $content_id);
        $variables['titre'] = "Création d'un contenu";
        $variables['texteConfirmation'] = "Le contenu a bien été créé !";
        
        return $this->formElement($variables);
    }   
    /**
     * Permet d'afficher le formulaire d'édition d'un articleContentCard
     *
     * @Route("/admin/admin_article/card/{id}/edit", name="admin_article_card_edit")
     * @return Response
     */
    public function editArticleContentCard(ArticleContentCard $articleContentCard, Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = $articleContentCard;
        $variables['classType'] = ArticleContentCardType::class;
        $variables['pagedebase'] = 'admin/element_edit.html.twig';
        $variables['pagederesultat'] = 'admin_article_content_edit';
        $variables['pagederesultatConfig'] = array('id' => $articleContentCard->getContent()->getId());
        $variables['titre'] = "Edition de l'article ".$articleContentCard->getContent()->getArticle()->getTitre().".";
        $variables['texteConfirmation'] = "L'article a bien été modifié !";
        
        return $this->formElement($variables);
    }
}
