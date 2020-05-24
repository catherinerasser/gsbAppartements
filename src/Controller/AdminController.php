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

class AdminController extends AbstractController
{
    

    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        return $this->render('admin/admin.html.twig');//vue admin
    }


/**
     * @Route("/lesUtilisateurs", name="lesUtilisateurs")
     */
    public function lesUtilisateurs()
    {
        //retourne tous les utilisateurs par collection de type pro, cli, loc, adm
        return $this->render('admin/lesUtilisateurs.html.twig',[
            "pros"=>$this->getDoctrine()->getRepository(Proprietaire::class)->findAll(),
            "clis"=>$this->getDoctrine()->getRepository(Client::class)->findAll(),
            "locs"=>$this->getDoctrine()->getRepository(Locataire::class)->findAll(),
            "adms"=>$this->getDoctrine()->getRepository(Admin::class)->findAll()
        ]);
    }




/**
     * @Route("/validerModificationA", name="validerModificationA")
     */
    public function validerModificationA()
    {   //modification de l'admin
        $login = $_REQUEST['login'];
        $email = $_REQUEST['email'];
        if ($email){//si le champs est rempli
           $emailP = $this->getDoctrine()->getRepository(Personne::class)->findOneBy(array('login'=>"$login"))->setEmail($email);
            //faire les modifications dans la bdd
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->render('admin/admin.html.twig');
        }
        print("Champs vides");
        return $this->render('admin/admin.html.twig');
    }


    /**
     * @Route("/supprimer", name="supprimer")
     */
    public function supprimer()
    {   //l'administrateur supprime un client locataire ou proprietaire
        $login = $_REQUEST['login'];
        $user = $this->getDoctrine()->getRepository(Personne::class)->findOneBy(array('login'=>"$login"));
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);//suppression
        //faire les modifications dans la bdd
        $em->flush();
        //retourne tous les utilisateurs en fonction de leur type
        return $this->render('admin/lesUtilisateurs.html.twig',[
            "pros"=>$this->getDoctrine()->getRepository(Proprietaire::class)->findAll(),
            "clis"=>$this->getDoctrine()->getRepository(Client::class)->findAll(),
            "locs"=>$this->getDoctrine()->getRepository(Locataire::class)->findAll(),
            "adms"=>$this->getDoctrine()->getRepository(Admin::class)->findAll()
        ]);
    }


    
/**
     * @Route("/lesAppartements", name="lesAppartements")
     */
    public function lesAppartements()
    {
        //retourne tous les appartements pour l'admin
        return $this->render('admin/lesAppartements.html.twig',[
            "apparts"=>$this->getDoctrine()->getRepository(Appartement::class)->findAll()]);
    }



    /**
     * @Route("/infoA", name="infoA")
     */
    public function infoA()
    {
        //info de chaque appartement en fonction de son id pour l'admin
        $id=$_REQUEST['id'];
        return $this->render('admin/infoA.html.twig',[
            "appart"=>$this->getDoctrine()->getRepository(Appartement::class)->find($id)]);
    }



/**
     * @Route("/lesCotisations", name="lesCotisations")
     */
    public function lesCotisations()
    {
        //retourne toutes les cotisations de proprietaire pour l'admin
        return $this->render('admin/lesCotisations.html.twig',[
            "pros"=>$this->getDoctrine()->getRepository(Proprietaire::class)->findAll()]);
    }



    /**
     * @Route("/informations", name="informations")
     */
    public function informations()
    {
        //retourne les informations d'un utilisateur pour l'admin
        $login = $_REQUEST['login'];
        $user = $this->getDoctrine()->getRepository(Personne::class)->findOneBy(array('login'=>"$login"));
        return $this->render('admin/informations.html.twig',[
            "user"=>$user
        ]);
    }

/**
     * @Route("/lesDemandes", name="lesDemandes")
     */
    public function lesDemandes()
    {
        //retourne toutes les demandes pour l'admin
        return $this->render('admin/lesDemandes.html.twig',[
            "dems"=>$this->getDoctrine()->getRepository(Demandes::class)->findAll()]);
    }


/**
     * @Route("/lesVisites", name="lesVisites")
     */
    public function lesVisites()
    {
        //retourne toutes les visites pour l'admin
        return $this->render('admin/lesVisites.html.twig',[
            "visis"=>$this->getDoctrine()->getRepository(Visite::class)->findAll()]);
    }


}
