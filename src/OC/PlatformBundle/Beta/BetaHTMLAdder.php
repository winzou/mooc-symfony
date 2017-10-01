<?php
// src/OC/PlatformBundle/Beta/BetaHTMLAdder.php

namespace OC\PlatformBundle\Beta;

use Symfony\Component\HttpFoundation\Response;

class BetaHTMLAdder
{
  // M�thode pour ajouter le � b�ta � � une r�ponse
  public function addBeta(Response $response, $remainingDays)
  {
    $content = $response->getContent();

    // Code � rajouter
    // (Je mets ici du CSS en ligne, mais il faudrait utiliser un fichier CSS bien s�r !)
    $html = '<div style="position: absolute; top: 0; background: orange; width: 100%; text-align: center; padding: 0.5em;">Beta J-'.(int) $remainingDays.' !</div>';

    // Insertion du code dans la page, au d�but du <body>
    $content = str_replace(
      '<body>',
      '<body> '.$html,
      $content
    );

    // Modification du contenu dans la r�ponse
    $response->setContent($content);

    return $response;
  }
}
