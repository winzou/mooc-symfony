<?php
// src/OC/PlatformBundle/Beta/BetaListener.php

namespace OC\PlatformBundle\Beta;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class BetaListener
{
  // Notre processeur
  protected $betaHTML;

  // La date de fin de la version b�ta :
  // - Avant cette date, on affichera un compte � rebours (J-3 par exemple)
  // - Apr�s cette date, on n'affichera plus le � b�ta �
  protected $endDate;

  public function __construct(BetaHTMLAdder $betaHTML, $endDate)
  {
    $this->betaHTML = $betaHTML;
    $this->endDate  = new \Datetime($endDate);
  }

  public function processBeta(FilterResponseEvent $event)
  {
    if (!$event->isMasterRequest()) {
      return;
    }

    $remainingDays = $this->endDate->diff(new \Datetime())->days;

    // Si la date est d�pass�e, on ne fait rien
    if ($remainingDays <= 0) {
      return;
    }

    // On utilise notre BetaHRML
    $response = $this->betaHTML->addBeta($event->getResponse(), $remainingDays);

    // On met � jour la r�ponse avec la nouvelle valeur
    $event->setResponse($response);
  }
}
