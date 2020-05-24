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

class LocataireController extends AbstractController
{
   

    /**
     * @Route("/locataire", name="locataire")
     */
    public function locataire()
    {
        return $this->render('locataire/locataire.html.twig');//vue locataire
    }


    /**
     * @Route("/validerModificationL", name="validerModificationL")
     */
    public function validerModificationL()
    {   
        //modification du locataire
        $nom = $_REQUEST['nom']; $prenom = $_REQUEST['prenom'];
        $adresse = $_REQUEST['adresse'];$login = $_REQUEST['login'];
        $cp = $_REQUEST['cp']; $ville = $_REQUEST['ville'];
        $tel = $_REQUEST['tel']; $email = $_REQUEST['email'];
        $telB = $_REQUEST['telB']; $rib = $_REQUEST['rib'];
        //si tous les champs sont remplis
        if ($nom&&$prenom&&$adresse&&$ville&&$cp&&$tel&&$rib&&$email&&$telB){
            //on modifie toutes les infos
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
            return $this->render('locataire/locataire.html.twig');
        }
        print("Champs vides");
        return $this->render('locataire/locataire.html.twig');
    }



/**
     * @Route("/monAppart", name="monAppart")
     */
    public function monAppart()
    {
        //retourne l'appartement du locataire
        return $this->render('locataire/monAppart.html.twig');
    }



/**
     * @Route("/infoALoc", name="infoALoc")
     */
    public function infoALoc()
    {
        //retourne les info de l'appartement qu'occupe le locataire
        $id=$_REQUEST['id'];
        return $this->render('locataire/infoALoc.html.twig',[
            "appart"=>$this->getDoctrine()->getRepository(Appartement::class)->find($id)]);
    }



/**
     * @Route("/maBanque", name="maBanque")
     */
    public function maBanque()
    {
        //retourne la banque du locataire
        return $this->render('locataire/maBanque.html.twig');
    }





    /**
     * @Route("/validation", name="validation")
     */
    public function validation()
    {
        //demande confirmation pour changer de statut de locataire a client
        return $this->render('locataire/validation.html.twig');
    }



/**
     * @Route("/devenirClient", name="devenirClient")
     */
    public function devenirClient()
    {
        //changer le statut de locataire a client
        $id = $_REQUEST['id'];
        $loc = $this->getDoctrine()->getRepository(Locataire::class)->find($id);
        $nom = $loc->getNomPe();
        $prenom = $loc->getPrenomPe();
        $anniv = $loc->getAnniv();
        $adresse = $loc->getAdressePe();
        $cp = $loc->getCodePostal();
        $ville = $loc->getNomVille();
        $tel = $loc->getTelephonePe();
        $email = $loc->getEmail();
        $telB = $loc->getTelBanque();
        $rib = $loc->getNumCpteBanque();
        $login = $loc->getUsername();
        $mdp = $loc->getPassword();//recupere tous les champs de locataire
        $user = new Client ($nom,$prenom,$adresse,$ville,$cp,$tel,$anniv,$login,$mdp,$rib,$email,$telB);
        $em = $this->getDoctrine()->getManager();//crée le client
        $em->remove($loc);//supprime le locataire
        $em->persist($user);
        $em->flush();
        return $this->render('default/index.html.twig');
    }



}
