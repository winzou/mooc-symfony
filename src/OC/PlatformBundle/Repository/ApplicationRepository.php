<?php

namespace OC\PlatformBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ApplicationRepository extends EntityRepository
{
  public function getApplicationsWithAdvert($limit)
  {
    $qb = $this->createQueryBuilder('a');

    // On fait une jointure avec l'entité Advert avec pour alias « adv »
    $qb
      ->innerJoin('a.advert', 'adv')
      ->addSelect('adv')
    ;

    // Puis on ne retourne que $limit résultats
    $qb->setMaxResults($limit);

    // Enfin, on retourne le résultat
    return $qb
      ->getQuery()
      ->getResult()
    ;
  }

  /**
   * @param string   $ip
   * @param integer  $seconds
   * @return bool    True si au moins une candidature créée il y a moins de $seconds secondes a été trouvée. False sinon.
   */
  public function isFlood($ip, $seconds)
  {
    return (bool) $this->createQueryBuilder('a')
      ->select('COUNT(a)')
      ->where('a.date >= :date')
      ->setParameter('date', new \Datetime($seconds.' seconds ago'))
      // Nous n'avons pas cet attribut, je laisse en commentaire, mais voici comment pourrait être la condition :
      //->andWhere('a.ip = :ip')->setParameter('ip', $ip)
      ->getQuery()
      ->getSingleScalarResult()
    ;
  }
}
