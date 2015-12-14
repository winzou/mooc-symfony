<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request; // N'oubliez pas ce use !
use Symfony\Component\HttpFoundation\Response;

class AdvertController extends Controller
{
  public function indexAction()
  {
    // On veut avoir l'URL de l'annonce d'id 5.
    $url = $this->get('router')->generate(
      'oc_platform_view', // 1er argument : le nom de la route
      array('id' => 5)    // 2e argument : les valeurs des paramètres
    );
    // $url vaut « /platform/advert/5 »

    return new Response("L'URL de l'annonce d'id 5 est : ".$url);
  }

  // On injecte la requête dans les arguments de la méthode
  public function viewAction($id, Request $request)
  {
    // On récupère notre paramètre tag
    $tag = $request->query->get('tag');

    return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
      'id'  => $id,
      'tag' => $tag,
    ));
  }

  // Ajoutez cette méthode :
  public function addAction(Request $request)
  {
    $session = $request->getSession();

    // Bien sûr, cette méthode devra réellement ajouter l'annonce

    // Mais faisons comme si c'était le cas
    $session->getFlashBag()->add('info', 'Annonce bien enregistrée');

    // Le « flashBag » est ce qui contient les messages flash dans la session
    // Il peut bien sûr contenir plusieurs messages :
    $session->getFlashBag()->add('info', 'Oui oui, elle est bien enregistrée !');

    // Puis on redirige vers la page de visualisation de cette annonce
    return $this->redirectToRoute('oc_platform_view', array('id' => 5));
  }

  // On récupère tous les paramètres en arguments de la méthode
  public function viewSlugAction($slug, $year, $_format)
  {
    return new Response("On pourrait afficher l'annonce correspondant au slug '".$slug."', créée en ".$year." et au format ".$_format.".");
  }
}
