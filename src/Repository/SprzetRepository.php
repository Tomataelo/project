<?php

namespace App\Repository;

use App\Entity\Sprzet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sprzet>
 */
class SprzetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sprzet::class);
    }

    //    /**
    //     * @return Sprzet[] Returns an array of Sprzet objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Sprzet
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function countSprzetByModelIdWithUserIdGreaterThanZero(int $modelId)
    {
        $qb = $this->createQueryBuilder('s');
        $qb->select('COUNT(s.id)')  // Użyjemy funkcji COUNT() aby zliczyć wyniki
           ->where('s.id_modelu = :modelId')
           ->andWhere('s.id_uzytkownika > 0')  // Zmieniamy warunek na większe od 0
           ->setParameter('modelId', $modelId);
    
        // Zwraca pojedynczy wynik jako liczba
        return (int) $qb->getQuery()->getSingleScalarResult();
    }

}
