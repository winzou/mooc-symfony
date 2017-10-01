<?php
// src/OC/PlatformBundle/ParamConverter/JsonParamConverter.php

namespace OC\PlatformBundle\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class JsonParamConverter implements ParamConverterInterface
{
  function supports(ParamConverter $configuration)
  {
    // Si le nom de l'argument du contr�leur n'est pas "json", on n'applique pas le convertisseur
    if ('json' !== $configuration->getName()) {
      return false;
    }

    return true;
  }

  function apply(Request $request, ParamConverter $configuration)
  {
    // On r�cup�re la valeur actuelle de l'attribut
    $json = $request->attributes->get('json');

    // On effectue notre action : le d�coder
    $json = json_decode($json, true);

    // On met � jour la nouvelle valeur de l'attribut
    $request->attributes->set('json', $json);
  }
}
