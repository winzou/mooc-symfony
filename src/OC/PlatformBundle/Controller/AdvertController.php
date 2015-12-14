<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

// N'oubliez pas ce use :
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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

  // La route fait appel à OCPlatformBundle:Advert:view, on doit donc définir la méthode viewAction.
  // On donne à cette méthode l'argument $id, pour correspondre au paramètre {id} de la route
  public function viewAction($id)
  {
    // $id vaut 5 si l'on a appelé l'URL /platform/advert/5

    // Ici, on récupèrera depuis la base de données l'annonce correspondant à l'id $id.
    // Puis on passera l'annonce à la vue pour qu'elle puisse l'afficher

    return new Response("Affichage de l'annonce d'id : ".$id);
  }

  // On récupère tous les paramètres en arguments de la méthode
  public function viewSlugAction($slug, $year, $_format)
  {
    return new Response("On pourrait afficher l'annonce correspondant au slug '".$slug."', créée en ".$year." et au format ".$_format.".");
  }
}
