<?php
// src/OC/PlatformBundle/Entity/Application.php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_application")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\ApplicationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Application
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="author", type="string", length=255)
   */
  private $author;

  /**
   * @ORM\Column(name="content", type="text")
   */
  private $content;

  /**
   * @ORM\Column(name="date", type="datetime")
   */
  private $date;

  /**
   * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Advert", inversedBy="applications")
   * @ORM\JoinColumn(nullable=false)
   */
  private $advert;

  public function __construct()
  {
    $this->date = new \Datetime();
  }

  /**
   * @ORM\PrePersist
   */
  public function increase()
  {
    $this->getAdvert()->increaseApplication();
  }

  /**
   * @ORM\PreRemove
   */
  public function decrease()
  {
    $this->getAdvert()->decreaseApplication();
  }

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param string $author
   */
  public function setAuthor($author)
  {
    $this->author = $author;
  }

  /**
   * @return string
   */
  public function getAuthor()
  {
    return $this->author;
  }

  /**
   * @param string $content
   */
  public function setContent($content)
  {
    $this->content = $content;
  }

  /**
   * @return string
   */
  public function getContent()
  {
    return $this->content;
  }

  /**
   * @param \Datetime $date
   */
  public function setDate(\Datetime $date)
  {
    $this->date = $date;
  }

  /**
   * @return \Datetime
   */
  public function getDate()
  {
    return $this->date;
  }

  /**
   * @param Advert $advert
   */
  public function setAdvert(Advert $advert)
  {
    $this->advert = $advert;
  }

  /**
   * @return Advert
   */
  public function getAdvert()
  {
    return $this->advert;
  }
}
