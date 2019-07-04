<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends OutilsController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /** GESTION DES UTILISATEURS ******************************************************************************************************************************************************/
    /**
     * Création d'un utilisateur
     * 
     * @Route("admin/utilisateur/new", name="admin_utilisateur_new")
     *
     * @return Response
     */
    public function creerUtilisateur(Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = new Utilisateur();
        $variables['classType'] = UtilisateurType::class;
        $variables['pagedebase'] = 'admin/element_new.html.twig';
        $variables['pagederesultat'] = 'admin';
        $variables['titre'] = "Création d'un utilisateur";
        $variables['texteConfirmation'] = "L'utilisateur' ### a bien été créé !";
        $variables['texteConfirmationEval']["###"] = '$element->getNom();';
        
        return $this->formElement($variables);
    }

    /** GESTION DES LOGS ******************************************************************************************************************************************************/
    /**
     * Permet d'afficher et de gérer le formulaire de connexion
     * 
     * @Route("/login", name="account_login")
     * 
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError(); 
        $username = $utils->getLastUsername();
        return $this->render('account/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }
    /**
     * Permet d'afficher le formulaure d'inscription
     * 
     * @Route("/register", name="account_register")
     *
     * @return Response
     */
   public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(RegistrationType::class, $utilisateur);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($utilisateur, $utilisateur->getHash());
            $utilisateur->setHash($hash);
            $manager->persist($utilisateur);
            $manager->flush();
            $this->addFlash(
                'success',
                "Votre compte a bien été créé ! Vous pouvez maintenant vous connecter !"
            );
            return $this->redirectToRoute('account_login');
        }
        return $this->render('account/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * Permet de se déconnecter
     * 
     * @Route("/logout", name="account_logout")
     *
     * @return void
     */
    public function logout() {
        //Rien ! configuration dans le security.yaml
    }
}
