<?php
// src/OC/PlatformBundle/Twig/AntispamExtension.php

namespace OC\PlatformBundle\Twig;

use OC\PlatformBundle\Antispam\OCAntispam;

class AntispamExtension extends \Twig_Extension
{
  /**
   * @var OCAntispam
   */
  private $ocAntispam;

  public function __construct(OCAntispam $ocAntispam)
  {
    $this->ocAntispam = $ocAntispam;
  }

  public function checkIfArgumentIsSpam($text)
  {
    return $this->ocAntispam->isSpam($text);
  }

  // Twig va exécuter cette méthode pour savoir quelle(s) fonction(s) ajoute notre service
  public function getFunctions()
  {
    return array(
      new \Twig_SimpleFunction('checkIfSpam', array($this, 'checkIfArgumentIsSpam')),
      // Dans notre cas, on pourrait également utiliser directement le service OCAntispam :
      // new \Twig_SimpleFunction('checkIfSpam', array($this->ocAntispam, 'isSpam')),
    );
}

  // La méthode getName() identifie votre extension Twig, elle est obligatoire
  public function getName()
  {
    return 'OCAntispam';
  }
}
