<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_advert")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\AdvertRepository")
 */
class Advert
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
   * @var \DateTime
   *
   * @ORM\Column(name="date", type="datetime")
   */
  private $date;

  /**
   * @var string
   *
   * @ORM\Column(name="title", type="string", length=255)
   */
  private $title;

  /**
   * @var string
   *
   * @ORM\Column(name="author", type="string", length=255)
   */
  private $author;

  /**
   * @var string
   *
   * @ORM\Column(name="content", type="string", length=255)
   */
  private $content;

  public function __construct()
  {
    // Par défaut, la date de l'annonce est la date d'aujourd'hui
    $this->date = new \Datetime();
  }

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param \DateTime $date
   */
  public function setDate($date)
  {
    $this->date = $date;
  }

  /**
   * @return \DateTime
   */
  public function getDate()
  {
    return $this->date;
  }

  /**
   * @param string $title
   */
  public function setTitle($title)
  {
    $this->title = $title;
  }

  /**
   * @return string
   */
  public function getTitle()
  {
    return $this->title;
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
}
