<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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




class DefaultController extends AbstractController
{
 
    /**
     * @Route("/", name="Accueil")
     */
    public function index()
    {//retourne la page d'accueil
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            
        ]);
    }

    /**
     * @Route("/presentation", name="presentation")
     */
    public function presentation(){//retourne la page de presentation
        return $this->render('default/presentation.html.twig');
    }


/**
     * @Route("/A", name="A")
     */
    public function A(){//retourne les plus beaux appartements
        return $this->render('default/Appart.html.twig');
       
    }


/**
     * @Route("/connexion", name="connexion")
     */
    // public function connexion(){
    //     return $this->render('default/connexion.html.twig', [
    //         "test"=>$this->getDoctrine()->getRepository(Personne::class)->findAll(),
    //         "test2"=>$this->getDoctrine()->getRepository(Appartement::class)->findAll()
    //     ]);
    // }


/**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(){//retourne la page d'inscription
        return $this->render('default/inscription.html.twig', [
            'controller_name' => 'inscription'
        ]);
    }


    /**
     * @Route("/valideInscription", name="valideInscription")
     */
    public function valideInscription(UserPasswordEncoderInterface $encoder){
        //inscrit client et proprietaire
        $nom = $_REQUEST['nom']; $prenom = $_REQUEST['prenom'];
        $anniv = $_REQUEST['anniv']; $adresse = $_REQUEST['adresse'];
        $cp = $_REQUEST['cp']; $ville = $_REQUEST['ville'];
        $tel = $_REQUEST['tel']; $email = $_REQUEST['email'];
        $telB = $_REQUEST['telB']; $rib = $_REQUEST['rib'];
        $login = $_REQUEST['login']; $mdp = $_REQUEST['mdp'];
        $repeat = $_REQUEST['repeat'];$type = $_REQUEST['type'];
        if ($nom&&$prenom&&$adresse&&$ville&&$cp&&$tel&&$anniv&&$login&&$mdp&&$repeat&&$rib&&$email&&$telB&&$type){
            //si tous les champs sont remplis
            if(strlen($mdp)>=6){//le mot de passe doit faire au moins 6 caracteres
                    if($mdp==$repeat){//les deux mdp doivent etre indentiques
                        $utilisateur = $this->getDoctrine()->getRepository(Personne::class)->findOneBy(array('login'=>"$login"));
                        if($utilisateur == null){//si le login n'existe pas
                            if($type=="Client"){
                                $anniv = new \DateTime("$anniv 00:00:00");//object de type date
                                //création du client
                                $user = new Client ($nom,$prenom,$adresse,$ville,$cp,$tel,$anniv,$login,$mdp,$rib,$email,$telB);
                                $em = $this->getDoctrine()->getManager();
                                $em->persist($user);//creation de l'objet dans la bdd
                                $em->flush();
                                $mdp=$encoder->encodePassword($user, $mdp);//hasher le mdp
                                $mdpEncode = $this->getDoctrine()->getRepository(Client::class)->findOneBy(array('login'=>"$login"))->setPassword($mdp);
                                //on créé alors le profil
                            }
                            elseif($type=='Propriétaire') {
                                $anniv = new \DateTime("$anniv 00:00:00");
                                //creer proprietaire
                                $user = new Proprietaire ($nom,$prenom,$adresse,$ville,$cp,$tel,$anniv,$login,$mdp,$rib,$email,$telB);
                                $em = $this->getDoctrine()->getManager();
                                $em->persist($user);//insere dans la bdd
                                $em->flush();
                                $mdp=$encoder->encodePassword($user, $mdp);//hashe le mdp
                                $mdpEncode = $this->getDoctrine()->getRepository(Proprietaire::class)->findOneBy(array('login'=>"$login"))->setPassword($mdp);
                                //on créé alors le profil
                            }
                        
                                $em = $this->getDoctrine()->getManager();
                                $em->persist($user);
                                $em->flush();
                                //retourne a la page inscription
                                return $this->render('default/inscription.html.twig', [ 
                                    "info"=>$this->getDoctrine()->getRepository(Proprietaire::class)->findAll(),
                                    "info2"=>$this->getDoctrine()->getRepository(Client::class)->findAll(),
                                    'controller_name' => 'inscription'
                                    ]);
                        }
                        else {
                            print("Ce login existe déjà");
                            return $this->render('default/inscription.html.twig', [
                            'controller_name' => 'inscription'
                            ]); 
                        }
    } 
    else{ print("Les mots de passe ne sont pas identiques");
        return $this->render('default/inscription.html.twig', [
            'controller_name' => 'inscription'
        ]); }
}
else { print("Le mot de passe est trop court. Veuillez saisir au moins 6 caractères");
    return $this->render('default/inscription.html.twig', [
        'controller_name' => 'inscription'
    ]);}
} 
else { print("Veuillez saisir tous les champs");
    return $this->render('default/inscription.html.twig', [
        'controller_name' => 'inscription'
    ]);}


    }


/**
     * @Route("/valideConnexion", name="valideConnexion")
     */
    // public function valideConnexion(){
    //     $login = $_REQUEST['login']; $mdp = $_REQUEST['password'];
    //     $utilisateur = $this->getDoctrine()->getRepository(Personne::class)->findBy(array('login'=>"$login",'mdp'=>"$mdp"));
    //     if($utilisateur==null){//affiche erreur si login ou mdp incorrect
    //         print("Login ou mot de passe incorrect");
    //         return $this->render('default/connexion.html.twig');
    //     }
    //     else { //si mdp et log correct on crée une sessin et on se connecte
    //         $login2=$this->getDoctrine()->getRepository(Personne::class)->findBy(array('login'=>"$login"));
    //         $type=$login2[0]->getType();
    //         if($type=='pro'){
    //             return $this->render('default/proprietaire.html.twig', [
    //             //$credentials =>$this->getCredentials($_REQUEST),
    //             //$user => getUser($credentials, $userProvider),
    //             //$information => checkCredentials($credentials, $user),
    //             "info"=>$this->getDoctrine()->getRepository(Personne::class)->findBy(array('login'=>"$login"))
    //             ]);
    //         }
    //         elseif($type=='cli'){
    //             return $this->render('default/client.html.twig',[
    //             "info"=>$this->getDoctrine()->getRepository(Personne::class)->findBy(array('login'=>"$login")),
    //             ]);
    //         }
    //         elseif($type=='loc'){
    //             return $this->render('default/locataire.html.twig',[
    //             "info"=>$this->getDoctrine()->getRepository(Personne::class)->findBy(array('login'=>"$login")),
    //             ]);
    //         }
    //         elseif($type=='adm'){
    //             return $this->render('default/admin.html.twig',[
    //             "info"=>$this->getDoctrine()->getRepository(Personne::class)->findBy(array('login'=>"$login")),
    //             ]);
    //         }
    //     }
    // }




}
