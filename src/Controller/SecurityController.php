<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Routing\Annotation\Route; 
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


use App\Entity\Personne;
use App\Entity\Admin;
use App\Entity\Appartement;
use App\Entity\Client;
use App\Entity\Locataire;
use App\Entity\Proprietaire;
use App\Entity\Arrondissement;
use App\Entity\Banque;
use App\Entity\Demandes;
use App\Entity\Photo;
use App\Entity\Visite;


class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        //fonction predefini de symfony pour creer la session en se connectant
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig',[
            "last_username"=>$lastUsername, //retourne le dernier utilisateur
            "error"=>$error//retourne erreur si il y en a 
        ]);
    }
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        //se deconnecter de la session Symfony
    }


   

}