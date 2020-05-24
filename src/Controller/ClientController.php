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

class ClientController extends AbstractController
{
   /**
     * @Route("/client", name="client")
     */
    public function client()
    {
        return $this->render('client/client.html.twig');//vue client
    }


/**
     * @Route("/validerModificationC", name="validerModificationC")
     */
    public function validerModificationC()
    {   
        //modification client
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
            return $this->render('client/client.html.twig');
        }
        print("Champs vides");
        return $this->render('client/client.html.twig');
    }



    /**
     * @Route("/mesDemandes", name="mesDemandes")
     */
    public function mesDemandes()
    {//retourne les demandes du client
        return $this->render('client/mesDemandes.html.twig');
    }


/**
     * @Route("/ajoutDCli", name="ajoutDCli")
     */
    public function ajoutDCli()
    {
        //ajoute une demande pour le client
        $nb=$_REQUEST['nb'];
        return $this->render('client/ajoutDCli.html.twig',[
            "nb"=>$nb
        ]);
    }

/**
     * @Route("/propA", name="propA")
     */
    public function propA()
    {//propose les arrondissements
        return $this->render('client/propA.html.twig');
    }


 /**
     * @Route("/propDCli", name="propDCli")
     */
    public function propDCli()
    {
        //recupere les données pour créer la demande et la proposition des appartements
        $id = $_REQUEST['id'];
        if($_REQUEST['nb']==1){
            $a1=$_REQUEST['a1'];$a2=0;$a3=0;$a4=0;
        }
        if($_REQUEST['nb']==2){
            $a1=$_REQUEST['a1'];$a2=$_REQUEST['a2'];$a3=0;$a4=0;
        }
        if($_REQUEST['nb']==3){
            $a1=$_REQUEST['a1'];$a2=$_REQUEST['a2'];$a3=$_REQUEST['a3'];$a4=0;
        }
        if($_REQUEST['nb']==4){
            $a1=$_REQUEST['a1'];$a2=$_REQUEST['a2'];$a3=$_REQUEST['a3'];$a4=$_REQUEST['a4'];
        }
        $voy=$_REQUEST['voy']; $type=$_REQUEST['type'];
        $prix=$_REQUEST['prix']; $datearr=$_REQUEST['datearr']; $datedep=$_REQUEST['datedep']; 
        $datearr = new \DateTime("$datearr 00:00:00"); 
        $datedep = new \DateTime("$datedep 00:00:00");//objet de type date
        $appart=$this->getDoctrine()->getRepository(Appartement::class)->findByField($voy,$type,$prix,$a1,$a2,$a3,$a4,$datearr);
        //proposition d'apparts
        //puis création de la demande
        $id=$this->getDoctrine()->getRepository(Client::class)->find($id);
        $dem = new Demandes ($type,$datearr,$datedep,$id);
        $em = $this->getDoctrine()->getManager();
        $em->persist($dem);
        $em->flush();
        $idD=$this-> getDoctrine()->getRepository(Demandes::class)->findMax()->getId(); 
        //ajoutes les arrondissements à la collection de la demande selon leur nombre
        if($_REQUEST['nb']==1){//si il n'y a qu'un arrondissement
            $a1=$this->getDoctrine()->getRepository(Arrondissement::class)->find($a1);
            $arron1 = $this->getDoctrine()->getRepository(Demandes::class)->find($idD)->addArrondissement($a1);
        }
        if($_REQUEST['nb']==2){//2 arrondissements
            $a1=$this->getDoctrine()->getRepository(Arrondissement::class)->find($a1);
            $a2=$this->getDoctrine()->getRepository(Arrondissement::class)->find($a2);
            $arron1 = $this->getDoctrine()->getRepository(Demandes::class)->find($idD)->addArrondissement($a1);
            $arron2 = $this->getDoctrine()->getRepository(Demandes::class)->find($idD)->addArrondissement($a2);
        }
        if($_REQUEST['nb']==3){//3 arrondissements
            $a1=$this->getDoctrine()->getRepository(Arrondissement::class)->find($a1);
            $a2=$this->getDoctrine()->getRepository(Arrondissement::class)->find($a2);
            $a3=$this->getDoctrine()->getRepository(Arrondissement::class)->find($a3);
            $arron1 = $this->getDoctrine()->getRepository(Demandes::class)->find($idD)->addArrondissement($a1);
            $arron2 = $this->getDoctrine()->getRepository(Demandes::class)->find($idD)->addArrondissement($a2);
            $arron3 = $this->getDoctrine()->getRepository(Demandes::class)->find($idD)->addArrondissement($a3);
        }
        if($_REQUEST['nb']==4){//4 arrondissements
            $a1=$this->getDoctrine()->getRepository(Arrondissement::class)->find($a1);
            $a2=$this->getDoctrine()->getRepository(Arrondissement::class)->find($a2);
            $a3=$this->getDoctrine()->getRepository(Arrondissement::class)->find($a3);
            $a4=$this->getDoctrine()->getRepository(Arrondissement::class)->find($a4);
            $arron1 = $this->getDoctrine()->getRepository(Demandes::class)->find($idD)->addArrondissement($a1);
            $arron2 = $this->getDoctrine()->getRepository(Demandes::class)->find($idD)->addArrondissement($a2);
            $arron3 = $this->getDoctrine()->getRepository(Demandes::class)->find($idD)->addArrondissement($a3);
            $arron4 = $this->getDoctrine()->getRepository(Demandes::class)->find($idD)->addArrondissement($a4);
        }
        //mettre a jour la bdd
        $em = $this->getDoctrine()->getManager();
        $em->persist($dem);
        $em->flush();
        //retour de la collection d'appartements compatibles avec la demande
        return $this->render('client/propDCli.html.twig',[
            "apparts"=>$appart
        ]);
    }



    /**
     * @Route("/infoACli", name="infoACli")
     */
    public function infoACli()
    {
        //retourne les informations de l'appartement pour le client
        $id=$_REQUEST['id'];
        return $this->render('client/infoACli.html.twig',[
            "appart"=>$this->getDoctrine()->getRepository(Appartement::class)->find($id)]);
    }



    /**
     * @Route("/modifDCli", name="modifDCli")
     */
    public function modifDCli()
    {
        //modification de la demande d'un client
        $id = $_REQUEST['id'];
        return $this->render('client/modifDCli.html.twig',[
            "dem"=>$this->getDoctrine()->getRepository(Demandes::class)->find($id)
        ]);
    }



    /**
     * @Route("/validModifD", name="validModifD")
     */
    public function validModifD()
    {
        //valider la modification de la demande du client
        $id = $_REQUEST['id'];
        $datearr = $_REQUEST['datearr'];
        $datedep = $_REQUEST['datedep'];
        if ($datearr&&$datedep){
            $datearr = new \DateTime("$datearr 00:00:00");//objet type date
            $datedep = new \DateTime("$datedep 00:00:00");
            $dateArr = $this->getDoctrine()->getRepository(Demandes::class)->find($id)->setDateArrive($datearr);
            $dateDep = $this->getDoctrine()->getRepository(Demandes::class)->find($id)->setDateDepart($datedep);
            //faire les modifications dans la bdd
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->render('client/mesVisites.html.twig',[
                "dem"=>$this->getDoctrine()->getRepository(Demandes::class)->find($id)
            ]);
        }
        print("Champs vides");
        return $this->render('client/modifDCli.html.twig',[
            "dem"=>$this->getDoctrine()->getRepository(Demandes::class)->find($id)]);
    }





     /**
     * @Route("/suppDCli", name="suppDCli")
     */
    public function suppDCli()
    {
        //supprimer demande par le client
        $id = $_REQUEST['id'];
        $dem = $this->getDoctrine()->getRepository(Demandes::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($dem);
        //faire les modifications dans la bdd
        $em->flush();
        return $this->render('client/mesDemandes.html.twig');
    }



    /**
     * @Route("/mesVisites", name="mesVisites")
     */
    public function mesVisites()
    {
        //retourne les visites du client
        return $this->render('client/mesVisites.html.twig');
    }



/**
     * @Route("/ajoutVCli", name="ajoutVCli")
     */
    public function ajoutVCli()
    {//ajouter une visite par le client
        return $this->render('client/ajoutVCli.html.twig',[
            "apparts"=>$this->getDoctrine()->getRepository(Appartement::class)->findAll()
        ]);
    }




 /**
     * @Route("/validAjoutV", name="validAjoutV")
     */
    public function validAjoutV()
    {   //valider la création de la visite du client
        $id = $_REQUEST['id']; $nom = $_REQUEST['nom'];
        $date = $_REQUEST['date']; 
        $appart=$this->getDoctrine()->getRepository(Appartement::class)->findOneBy(array('nom_appart'=>"$nom"));
        $id=$this->getDoctrine()->getRepository(Client::class)->find($id);
        $date = new \DateTime("$date 00:00:00");
        if ($date&&$appart){
            //si tous les champs sont remplis
            $visit = new Visite ($id,$date,$appart);
            //on créé alors le profil
            $em = $this->getDoctrine()->getManager();
            $em->persist($visit);
            $em->flush();
            return $this->render('client/mesVisites.html.twig');
            }
        else { 
                print("Veuillez saisir tous les champs");
                return $this->render('client/ajoutVCli.html.twig');
            }
    }




 /**
     * @Route("/modifVCli", name="modifVCli")
     */
    public function modifVCli()
    {//modification de la visite du client
        $id = $_REQUEST['id'];
        return $this->render('client/modifVCli.html.twig',[
            "visit"=>$this->getDoctrine()->getRepository(Visite::class)->find($id)]);
    }




     /**
     * @Route("/validModifV", name="validModifV")
     */
    public function validModifV()
    { //valide la modification de la visite par le client
        $id = $_REQUEST['id'];
        $date = $_REQUEST['date'];
        if ($date){
            $date = new \DateTime("$date 00:00:00");//objet de type date
            $dateV = $this->getDoctrine()->getRepository(Visite::class)->find($id)->setDateVisite($date);
            //faire les modifications dans la bdd
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->render('client/modifVCli.html.twig',[
                "visit"=>$this->getDoctrine()->getRepository(Visite::class)->find($id)
            ]);
        }
        print("Champs vides");
        return $this->render('client/modifVCli.html.twig',[
            "visit"=>$this->getDoctrine()->getRepository(Visite::class)->find($id)]);
    }




     /**
     * @Route("/suppVCli", name="suppVCli")
     */
    public function suppVCli()
    {//supprimer les visites par le client
        $id = $_REQUEST['id'];
        $visit = $this->getDoctrine()->getRepository(Visite::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($visit);
        //faire les modifications dans la bdd
        $em->flush();
        return $this->render('client/mesVisites.html.twig');
    }



    /**
     * @Route("/devenirLocataire", name="devenirLocataire")
     */
    public function devenirLocataire()
    {
        //changer de statut pour le client
        return $this->render('client/devenirLocataire.html.twig',[
            "apparts"=>$this->getDoctrine()->getRepository(Appartement::class)->findAll()
        ]);
    }


    /**
     * @Route("/validerLocataire", name="validerLocataire")
     */
    public function validerLocataire()
    {
        //valider le changement de statut de client à locataire
        $id = $_REQUEST['id'];
        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
        $nomA = $_REQUEST['nomA'];
        $nom = $client->getNomPe();
        $prenom = $client->getPrenomPe();
        $anniv = $client->getAnniv();
        $adresse = $client->getAdressePe();
        $cp = $client->getCodePostal();
        $ville = $client->getNomVille();
        $tel = $client->getTelephonePe();
        $email = $client->getEmail();
        $telB = $client->getTelBanque();
        $rib = $client->getNumCpteBanque();
        $login = $client->getUsername();
        $mdp = $client->getPassword();
        //recupe tous les champs du client pour les donner au locataire
        $idB=$this->getDoctrine()->getRepository(Banque::class)->find(1);
        $idA=$this->getDoctrine()->getRepository(Appartement::class)->findOneBy(array('nom_appart'=>"$nomA"));
        $locs=$this->getDoctrine()->getRepository(Locataire::class)->findAll();
        foreach ($locs as $loc){//si l'appartement est déjà occupé
            if($nomA==$loc->getNumAppart()->getNomAppart()){
                print("Appartement déjà occupé");//changement pas accepté
                return $this->render('client/devenirLocataire.html.twig',[
                    "apparts"=>$this->getDoctrine()->getRepository(Appartement::class)->findAll()
                    ]);
            }
        }//le client devient locataire
        $user = new Locataire ($nom,$prenom,$adresse,$ville,$cp,$tel,$anniv,$login,$mdp,$rib,$email,$telB,$idB,$idA);
        $em = $this->getDoctrine()->getManager();
        $em->remove($client);//on supprime le client
        $em->persist($user);//on créé le locataire
        $em->flush();
        return $this->render('locataire/locataire.html.twig');
    }
       


}
