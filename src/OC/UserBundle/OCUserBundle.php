<?php

namespace OC\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class OCUserBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}
