<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Entity\ArticleContent;
use App\Form\ArticleContentType;
use App\Entity\ArticleContentImg;
use App\Entity\ArticleContentCard;
use App\Entity\ArticleContentJumbo;
use App\Form\ArticleContentImgType;
use App\Controller\OutilsController;
use App\Form\ArticleContentCardType;
use App\Form\ArticleContentJumboType;
use App\Repository\ArticleRepository;
use App\Repository\ArticleContentRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ArticleContentImgRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleContentCardRepository;
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
        $variables['pagederesultat'] = 'admin_article_article_edit';
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
        $variables['pagederesultat'] = 'admin_article_article_edit';
        $variables['pagederesultatConfig'] = array('id' => $articleContent->getArticle()->getId());
        $variables['titre'] = "Edition de l'article ".$articleContent->getArticle()->getTitre().".";
        $variables['texteConfirmation'] = "L'article a bien été modifié !";
        
        return $this->formElement($variables);
    }

    /**
     * Permet de supprimer un content
     *
     * @Route("/admin/admin_article/content/{id}/delete", name="admin_article_content_delete")
     * @return Response
     */
    public function deleteArticleContent(ArticleContent $articleContent, ObjectManager $manager, ArticleContentRepository $repo, ArticleContentCardRepository $repoCard, ArticleContentImgRepository $repoImg):Response {
        $variables['manager'] = $manager;
        $variables['element'] = $articleContent;        
        $variables['pagederesultat'] = 'admin_article_article_edit';
        $variables['pagederesultatConfig'] = array('id' => $articleContent->getArticle()->getId());   
        $variables['delete'] = [
                                ['findBy' => 'articleContent', 'classEnfant' => 'ArticleContentCards', 'repo' => $repoCard],
                                ['findBy' => 'articleContent', 'classEnfant' => 'ArticleContentImgs', 'repo' => $repoImg]
                            ];

        return $this->deleteElement($variables);
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
        $variables['pagedebase'] = 'admin/admin_article/card_edit.html.twig';
        $variables['pagederesultat'] = 'admin_article_content_edit';
        $variables['pagederesultatConfig'] = array('id' => $articleContentCard->getArticleContent()->getId());
        $variables['titre'] = "Edition de l'article ".$articleContentCard->getArticleContent()->getArticle()->getTitre().".";
        $variables['texteConfirmation'] = "L'article a bien été modifié !";
        
        return $this->formElement($variables);
    }

    /**
     * Permet de supprimer articleContentCard
     *
     * @Route("/admin/admin_article/card/{id}/delete", name="admin_article_card_delete")
     * @return Response
     */
    public function deleteArticleContentCard(ArticleContentCard $articleContentCard, ObjectManager $manager):Response {
        $variables['manager'] = $manager;
        $variables['element'] = $articleContentCard;        
        $variables['pagederesultat'] = 'admin_article_content_edit';  
        $variables['pagederesultatConfig'] = array('id' => $articleContentCard->getArticleContent()->getId());      
        return $this->deleteElement($variables);
    }

    /** GESTION DES ARTICLES IMG ***************************************************************************************************************************************/
    /**
     * Création d'un articleContentImg
     * 
     * @Route("/admin/img/new/{content_id}", name="admin_article_img_new")
     *
     * @return Response
     */
    public function creerArticleContentImg(Request $request, ObjectManager $manager, ArticleContentRepository $repo, $content_id):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $element = new ArticleContentImg();
        $content = $repo->find($content_id);
        $element->setArticleContent($content); 
        $variables['element'] = $element;
        $variables['classType'] = ArticleContentImgType::class;
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
     * @Route("/admin/admin_article/img/{id}/edit", name="admin_article_img_edit")
     * @return Response
     */
    public function editArticleContentImg(ArticleContentImg $articleContentImg, Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = $articleContentImg;
        $variables['classType'] = ArticleContentImgType::class;
        $variables['pagedebase'] = 'admin/admin_article/img_edit.html.twig';
        $variables['pagederesultat'] = 'admin_article_content_edit';
        $variables['pagederesultatConfig'] = array('id' => $articleContentImg->getArticleContent()->getId());
        $variables['titre'] = "Edition de l'article ".$articleContentImg->getArticleContent()->getArticle()->getTitre().".";
        $variables['texteConfirmation'] = "L'article a bien été modifié !";
        
        return $this->formElement($variables);
    }

    /**
     * Permet de supprimer articleContentImg
     *
     * @Route("/admin/admin_article/img/{id}/delete", name="admin_article_img_delete")
     * @return Response
     */
    public function deleteArticleContentImg(ArticleContentImg $articleContentImg, ObjectManager $manager):Response {
        $variables['manager'] = $manager;
        $variables['element'] = $articleContentImg;        
        $variables['pagederesultat'] = 'admin_article_content_edit';  
        $variables['pagederesultatConfig'] = array('id' => $articleContentImg->getArticleContent()->getId());      
        return $this->deleteElement($variables);
    }

    /** GESTION DES ARTICLES JUMBO *************************************************************************************************************************************/
    /**
     * Création d'un articleContentJumbo
     * 
     * @Route("/admin/jumbo/new/{content_id}", name="admin_article_jumbo_new")
     *
     * @return Response
     */
    public function creerArticleContentJumbo(Request $request, ObjectManager $manager, ArticleContentRepository $repo, $content_id):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $element = new ArticleContentJumbo();
        $content = $repo->find($content_id);
        $element->setArticleContent($content); 
        $variables['element'] = $element;
        $variables['classType'] = ArticleContentJumboType::class;
        $variables['pagedebase'] = 'admin/element_new.html.twig';
        $variables['pagederesultat'] = 'admin_article_content_edit';
        $variables['pagederesultatConfig'] = array('id' => $content_id);
        $variables['titre'] = "Création d'un contenu";
        $variables['texteConfirmation'] = "Le contenu a bien été créé !";
        
        return $this->formElement($variables);
    } 

    /**
     * Permet d'afficher le formulaire d'édition d'un articleContentJumbo
     *
     * @Route("/admin/admin_article/jumbo/{id}/edit", name="admin_article_jumbo_edit")
     * @return Response
     */
    public function editArticleContentJumbo(ArticleContentJumbo $articleContentJumbo, Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = $articleContentJumbo;
        $variables['classType'] = ArticleContentJumboType::class;
        $variables['pagedebase'] = 'admin/admin_article/jumbo_edit.html.twig';
        $variables['pagederesultat'] = 'admin_article_content_edit';
        $variables['pagederesultatConfig'] = array('id' => $articleContentJumbo->getArticleContent()->getId());
        $variables['titre'] = "Edition de l'article ".$articleContentJumbo->getArticleContent()->getArticle()->getTitre().".";
        $variables['texteConfirmation'] = "L'article a bien été modifié !";
        
        return $this->formElement($variables);
    }

    /**
     * Permet de supprimer articleContentJumbo
     *
     * @Route("/admin/admin_article/jumbo/{id}/delete", name="admin_article_jumbo_delete")
     * @return Response
     */
    public function deleteArticleContentJumbo(ArticleContentJumbo $articleContentJumbo, ObjectManager $manager):Response {
        $variables['manager'] = $manager;
        $variables['element'] = $articleContentJumbo;        
        $variables['pagederesultat'] = 'admin_article_content_edit';  
        $variables['pagederesultatConfig'] = array('id' => $articleContentJumbo->getArticleContent()->getId());      
        return $this->deleteElement($variables);
    }
}
