<?php

namespace OC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class CoreController extends Controller
{
  // La page d'accueil
  public function indexAction()
  {
    // On retourne simplement la vue de la page d'accueil
    // L'affichage des 3 dernières annonces utilisera le contrôleur déjà existant dans PlatformBundle
    return $this->render('OCCoreBundle:Core:index.html.twig');

    // La méthode longue $this->get('templating')->renderResponse('...') est parfaitement valable
  }

  // La page de contact
  public function contactAction(Request $request)
  {
    // On récupère la session depuis la requête, en argument du contrôleur
    $session = $request->getSession();
    // Et on définit notre message
    $session->getFlashBag()->add('info', 'La page de contact n’est pas encore disponible, merci de revenir plus tard.');

    // Enfin, on redirige simplement vers la page d'accueil
    return $this->redirectToRoute('oc_core_home');

    // La méthode longue new RedirectResponse($this->get('router')->generate('oc_core_home')); est parfaitement valable
  }
}
