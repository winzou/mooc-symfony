<?php

namespace OC\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="oc_user")
 * @ORM\Entity(repositoryClass="OC\UserBundle\Repository\UserRepository")
 */
class User implements UserInterface
{
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var string
   *
   * @ORM\Column(name="username", type="string", length=255, unique=true)
   */
  private $username;

  /**
   * @var string
   *
   * @ORM\Column(name="password", type="string", length=255)
   */
  private $password;

  /**
   * @var string
   *
   * @ORM\Column(name="salt", type="string", length=255)
   */
  private $salt;

  /**
   * @var array
   *
   * @ORM\Column(name="roles", type="array")
   */
  private $roles = array();

  public function eraseCredentials()
  {
  }

  /**
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param string $username
   */
  public function setUsername($username)
  {
    $this->username = $username;
  }

  /**
   * @return string
   */
  public function getUsername()
  {
    return $this->username;
  }

  /**
   * @param string $password
   */
  public function setPassword($password)
  {
    $this->password = $password;
  }

  /**
   * @return string
   */
  public function getPassword()
  {
    return $this->password;
  }

  /**
   * @param string $salt
   */
  public function setSalt($salt)
  {
    $this->salt = $salt;
  }

  /**
   * @return string
   */
  public function getSalt()
  {
    return $this->salt;
  }

  /**
   * @param array $roles
   */
  public function setRoles(array $roles)
  {
    $this->roles = $roles;
  }

  /**
   * @return array
   */
  public function getRoles()
  {
    return $this->roles;
  }
}
