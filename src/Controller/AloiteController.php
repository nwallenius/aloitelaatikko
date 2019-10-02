<?php

namespace App\Controller;

use App\Entity\Aloite;
use App\Form\AloiteFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;   // twigiä varten
use Symfony\Component\Routing\Annotation\Route;                     // reititystä varten


class AloiteController extends AbstractController {

    /**
     * @Route("/aloite", name="aloite_lista")
     */
    public function index(){
        // Hakee kaikki aloitteet tietokannasta
        $aloitteet = $this->getDoctrine()->getRepository(Aloite::class)->findAll();


        // Pyydetään näkymää näyttämään kaikki aloitteet
        return $this->render('aloite/index.html.twig',[
            'aloitteet'    => $aloitteet,
        ]);
    }

    /**
     * @Route("/aloite/uusi", name="aloite_uusi")
     */
    public function uusi(Request $request){
        // Luodaan aloite-olio
        $aloite= new Aloite();
  
        // Luodaan lomake
        $form = $this->createForm(
          AloiteFormType::class,
          $aloite, [
            'action'    => $this->generateUrl('aloite_uusi'),
            'attr'      => ['class' => 'form-signin']
          ]
        );
  
        // Käsitellään lomakkeelta tulleet tiedot ja talletetaan tietokantaan
        $form->handleRequest($request);
        if($form->isSubmitted()){
          // Talletetaan lomaketiedot muuttujaan
          $aloite = $form->getData();
  
          // Talletetaan tietokantaan
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($aloite);
          $entityManager->flush();
  
          // Kutsutaan index-kontrolleria
          return $this->redirectToRoute('aloite_lista');
        }
  
        // Pyydetään näkymää näytämään lomake
          return $this->render('aloite/uusi.html.twig', [
            'form1' => $form->createView()
          ]);
      }
  
      /**
       * @Route("/aloite/nayta/{id}", name="aloite_nayta")
       */
      public function nayta($id){
        $aloite = $this->getDoctrine()->getRepository(Aloite::class)->find($id);
  
          return $this->render('aloite/nayta.html.twig', [
            'aloite'  => $aloite,
          ]);
      }
  
      /**
       * @Route("/aloite/muokkaa/{id}", name="aloite_muokkaa" )
       */
      public function muokkaa(Request $request, $id){
        // Luo aloite-olion ja palauttaa sen tiedoilla täytettynä.
        $aloite = $this->getDoctrine()->getRepository(Aloite::class)->find($id);
  
        // Luodaan lomake
        $form = $this->createForm(
          AloiteFormType::class,
          $aloite, [
            'attr'      => ['class' => 'form-signin']
          ]
        );
  
        // Käsitellään lomakkeelta tulleet tiedot ja talletetaan tietokantaan
        $form->handleRequest($request);
        if($form->isSubmitted()){
          // Talletetaan lomaketiedot muuttujaan
          $aloite = $form->getData();
  
          // Talletetaan tietokantaan
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->flush();
  
          // Kutsutaan index-kontrolleria
          return $this->redirectToRoute('aloite_lista');
        }      
  
         return $this->render('aloite/muokkaa.html.twig', [
           'form1'  => $form->createView()
         ]);
      }
  
      /**
       * @Route("/aloite/poista/{id}", name="aloite_poista")
       */
      public function poista(Request $request, $id){
  
        // Luo aloite-olion ja palauttaa sen tiedoilla täytettynä.
        $aloite = $this->getDoctrine()->getRepository(Aloite::class)->find($id);
        
          // Poistetaan aloite tietokannasta
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->remove($aloite);
          $entityManager->flush();
  
          return $this->redirectToRoute('aloite_lista');
  
         //return $this->render('aloite/poista.html.twig');
      }

}


?>