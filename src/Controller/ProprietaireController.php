<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


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

class ProprietaireController extends AbstractController
{
    
    /**
     * @Route("/proprietaire", name="proprietaire")
     */
    public function proprietaire()
    {
        return $this->render('proprietaire/proprietaire.html.twig',[ //vue proprietaire
            
        ]);
    }



/**
     * @Route("/appartementsPro", name="appartementsPro")
     */
    public function appartementsPro()
    {   
        //retourne les appartements du proprietaire
        return $this->render('proprietaire/appartementsPro.html.twig',[
    
        ]);
    }


/**
     * @Route("/validerModificationP", name="validerModificationP")
     */
    public function validerModificationP()
    {   
        //modification du proprietaire
        $nom = $_REQUEST['nom']; $prenom = $_REQUEST['prenom'];
        $adresse = $_REQUEST['adresse'];$login = $_REQUEST['login'];
        $cp = $_REQUEST['cp']; $ville = $_REQUEST['ville'];
        $tel = $_REQUEST['tel']; $email = $_REQUEST['email'];
        $telB = $_REQUEST['telB']; $rib = $_REQUEST['rib'];
        //si tous les champs sont saisis
        if ($nom&&$prenom&&$adresse&&$ville&&$cp&&$tel&&$rib&&$email&&$telB){
            //on modifie toutes les données
            $nomP = $this->getDoctrine()->getRepository(Personne::class)->findOneBy(array('login'=>"$login"))->setNomPe($nom);
            $prenomP = $this->getDoctrine()->getRepository(Personne::class)->findOneBy(array('login'=>"$login"))->setPrenomPe($prenom);
            $adresseP = $this->getDoctrine()->getRepository(Personne::class)->findOneBy(array('login'=>"$login"))->setAdressePe($adresse);
            $cpP = $this->getDoctrine()->getRepository(Personne::class)->findOneBy(array('login'=>"$login"))->setCodePostal($cp);
            $villeP = $this->getDoctrine()->getRepository(Personne::class)->findOneBy(array('login'=>"$login"))->setNomVille($ville);
            $telP = $this->getDoctrine()->getRepository(Personne::class)->findOneBy(array('login'=>"$login"))->setTelephonePe($tel);
            $emailP = $this->getDoctrine()->getRepository(Personne::class)->findOneBy(array('login'=>"$login"))->setEmail($email);
            $telBP = $this->getDoctrine()->getRepository(Personne::class)->findOneBy(array('login'=>"$login"))->setTelBanque($telB);
            $ribP = $this->getDoctrine()->getRepository(Personne::class)->findOneBy(array('login'=>"$login"))->setNumCpteBanque($rib);
            //faire les modifications dans la bdd
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->render('proprietaire/proprietaire.html.twig');
        }
        print("Champs vides");//si un/des champs est/sont vide/S
        return $this->render('proprietaire/proprietaire.html.twig');
    }

/**
     * @Route("/cotisationsPro", name="cotisationsPro")
     */
    public function cotisationsPro()
    {   
        //retourne toutes les cotisations des proprietaires 
        return $this->render('proprietaire/cotisationsPro.html.twig');
    }


    /**
     * @Route("/infoAPro", name="infoAPro")
     */
    public function infoAPro()
    {   //retourne les informations d'un appartement pour un proprietaire
        $id=$_REQUEST['id'];
        return $this->render('proprietaire/infoAPro.html.twig',[
            "appart"=>$this->getDoctrine()->getRepository(Appartement::class)->find($id)]);
    }



    /**
     * @Route("/modifA", name="modifA")
     */
    public function modifA()
    {
        //retourne une vue pour modifier l'appartement pour le proprietaire
        $id=$_REQUEST['id'];
        return $this->render('proprietaire/modifA.html.twig',[
            "appart"=>$this->getDoctrine()->getRepository(Appartement::class)->find($id)]);
    }

    /**
    * @Route("/validerModifApp", name="validerModifApp")
    */
   public function validerModifApp()
   {   //valider modifications de l'appartement du proprietaire
       $id = $_REQUEST['id'];
       $nom = $_REQUEST['nom'];
       $loc = $_REQUEST['loc'];
       $char = $_REQUEST['char'];
       if ($nom&&$loc&&$char){//si tous les champs sont saisis
           $nomA = $this->getDoctrine()->getRepository(Appartement::class)->find($id)->setNomAppart($nom);
           $locA = $this->getDoctrine()->getRepository(Appartement::class)->find($id)->setPrixLoc($loc);
           $charA = $this->getDoctrine()->getRepository(Appartement::class)->find($id)->setPrixCharges($char);
           //faire les modifications dans la bdd
           $em = $this->getDoctrine()->getManager();
           $em->flush();
           return $this->render('proprietaire/infoAPro.html.twig',[
               "appart"=>$this->getDoctrine()->getRepository(Appartement::class)->find($id)]);
       }
       print("Champs vides");
       return $this->render('proprietaire/modifA.html.twig');
   }


   /**
     * @Route("/ajoutAPro", name="ajoutAPro")
     */
    public function ajoutAPro(){//ajouter un appartement pour le proprietaire
        return $this->render('proprietaire/ajoutAPro.html.twig');
    }


 /**
     * @Route("/valideCreation", name="valideCreation")
     */
    public function valideCreation(){//creer un appartement pour le proprietaire
        $nom = $_REQUEST['nom']; $voy = $_REQUEST['voy'];
        $cham = $_REQUEST['cham']; $lit = $_REQUEST['lit'];
        $sb = $_REQUEST['sb']; $id = $_REQUEST['id'];
        $wifi = $_REQUEST['wifi']; $chau = $_REQUEST['chau'];
        $cui = $_REQUEST['cui']; $lave = $_REQUEST['lave'];
        $type = $_REQUEST['type']; $prixloc = $_REQUEST['prixloc'];
        $prixchar = $_REQUEST['prixchar'];$adresse = $_REQUEST['adresse'];
        $arron = $_REQUEST['arron']; 
        $eta = $_REQUEST['eta'];$asc = $_REQUEST['asc'];
        $prea = $_REQUEST['prea'];
        $date= date('m/d/yy');
        $date = new \DateTime("$date 00:00:00");//objet de type date
        if($wifi == 'Oui'){$wifi=true;}
        else{$wifi=false;}
        if($chau == 'Oui'){$chau=true;}
        else{$chau=false;}
        if($cui == 'Oui'){$cui=true;}
        else{$cui=false;}
        if($lave == 'Oui'){$lave=true;}
        else{$lave=false;}
        if($asc == 'Oui'){$asc=true;}
        else{$asc=false;}
        if($prea == 'Oui'){$prea=true;}
        else{$prea=false;}
        //if ($nom&&$voy&&$cham&&$lit&&$sb&&$wifi&&$chau&&$cui&&$lave&&$type&&$prixloc&&$prixchar&&$adresse&&$arron&&$eta&&$asc&&$prea){
            //si tous les champs sont remplis
            $appart = new Appartement ($nom,$voy,$cham,$lit,$sb,$wifi,$chau,$cui,$lave,$type,$prixloc,$prixchar,$adresse,$arron,$eta,$asc,$prea,$id,$date);
            //on créé alors le profil
            $appart2 = $this->getDoctrine()->getRepository(Proprietaire::class)->find($id)->addAppartement($appart);
            $em = $this->getDoctrine()->getManager();
            $em->persist($appart);//migration bdd
            $em->flush();
            return $this->render('proprietaire/appartementsPro.html.twig');
            //}
        // else { 
        //         print("Veuillez saisir tous les champs");
        //         return $this->render('security/ajoutAPro.html.twig');
        //     }
}




/**
     * @Route("/suppAPro", name="suppAPro")
     */
    public function suppAPro()
    {   
        //supprimer un appartement pour les proprietaires
        $id = $_REQUEST['id'];
        $appart = $this->getDoctrine()->getRepository(Appartement::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($appart);//supprimer objet
        //faire les modifications dans la bdd
        $em->flush();
        return $this->render('proprietaire/appartementsPro.html.twig');
    }


}
