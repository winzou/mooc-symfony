<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Application;
use OC\PlatformBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
  public function indexAction($page)
  {
    if ($page < 1) {
      throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    }

    // Notre liste d'annonce en dur
    $listAdverts = array(
      array(
        'title'   => 'Recherche développpeur Symfony',
        'id'      => 1,
        'author'  => 'Alexandre',
        'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Mission de webmaster',
        'id'      => 2,
        'author'  => 'Hugo',
        'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Offre de stage webdesigner',
        'id'      => 3,
        'author'  => 'Mathieu',
        'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
        'date'    => new \Datetime())
    );

    return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
      'listAdverts' => $listAdverts,
    ));
  }

  public function viewAction($id)
  {
    $em = $this->getDoctrine()->getManager();

    // On récupère l'annonce $id
    $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);

    // $advert est donc une instance de OC\PlatformBundle\Entity\Advert
    // ou null si l'id $id n'existe pas, d'où ce if :
    if (null === $advert) {
      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    }

    // On récupère la liste des candidatures de cette annonce
    $listApplications = $em
      ->getRepository('OCPlatformBundle:Application')
      ->findBy(array('advert' => $advert))
    ;

    return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
      'advert'           => $advert,
      'listApplications' => $listApplications
    ));
  }

  public function addAction(Request $request)
  {
    // Création de l'entité
    $advert = new Advert();
    $advert->setTitle('Recherche développeur Symfony2.');
    $advert->setAuthor('Alexandre');
    $advert->setContent("Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…");

    // Création de l'entité Image
    $image = new Image();
    $image->setUrl('http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg');
    $image->setAlt('Job de rêve');

    // On lie l'image à l'annonce
    $advert->setImage($image);

    // Création d'une première candidature
    $application1 = new Application();
    $application1->setAuthor('Marine');
    $application1->setContent("J'ai toutes les qualités requises.");

    // Création d'une deuxième candidature par exemple
    $application2 = new Application();
    $application2->setAuthor('Pierre');
    $application2->setContent("Je suis très motivé.");

    // On lie les candidatures à l'annonce
    $application1->setAdvert($advert);
    $application2->setAdvert($advert);

    // On récupère l'EntityManager
    $em = $this->getDoctrine()->getManager();

    // Étape 1 : On « persiste » l'entité
    $em->persist($advert);

    // Étape 1 bis : si on n'avait pas défini le cascade={"persist"},
    // on devrait persister à la main l'entité $image
    // $em->persist($image);

    // Étape 1 ter : pour cette relation pas de cascade lorsqu'on persiste Advert, car la relation est
    // définie dans l'entité Application et non Advert. On doit donc tout persister à la main ici.
    $em->persist($application1);
    $em->persist($application2);

    // Étape 2 : On « flush » tout ce qui a été persisté avant
    $em->flush();

    // Reste de la méthode qu'on avait déjà écrit
    if ($request->isMethod('POST')) {
      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

      // Puis on redirige vers la page de visualisation de cettte annonce
      return $this->redirectToRoute('oc_platform_view', array('id' => $advert->getId()));
    }

    // Si on n'est pas en POST, alors on affiche le formulaire
    return $this->render('OCPlatformBundle:Advert:add.html.twig');
  }

  public function editAction($id, Request $request)
  {
    if ($request->isMethod('POST')) {
      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

      return $this->redirectToRoute('oc_platform_view', array('id' => 5));
    }

    $advert = array(
      'title'   => 'Recherche développpeur Symfony',
      'id'      => $id,
      'author'  => 'Alexandre',
      'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
      'date'    => new \Datetime()
    );

    return $this->render('OCPlatformBundle:Advert:edit.html.twig', array(
      'advert' => $advert
    ));
  }

  public function deleteAction($id)
  {
    return $this->render('OCPlatformBundle:Advert:delete.html.twig');
  }

  public function menuAction($limit)
  {
    // On fixe en dur une liste ici, bien entendu par la suite on la récupérera depuis la BDD !
    $listAdverts = array(
      array('id' => 2, 'title' => 'Recherche développeur Symfony'),
      array('id' => 5, 'title' => 'Mission de webmaster'),
      array('id' => 9, 'title' => 'Offre de stage webdesigner')
    );

    return $this->render('OCPlatformBundle:Advert:menu.html.twig', array(
      // Tout l'intérêt est ici : le contrôleur passe les variables nécessaires au template !
      'listAdverts' => $listAdverts
    ));
  }
}
