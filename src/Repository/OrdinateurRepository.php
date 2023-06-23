<?php

namespace App\Repository;

use App\Entity\Ordinateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ordinateur>
 *
 * @method Ordinateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ordinateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ordinateur[]    findAll()
 * @method Ordinateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdinateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ordinateur::class);
    }

    public function save(Ordinateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Ordinateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function getLast15minutes()
    {
        $date = new \DateTime();
        $date->modify('-15 minutes');
        $date = $date->format('Y-m-d H:i:s');

        return $this->createQueryBuilder('o')
            ->andWhere('o.createdAt > :date')
            ->setParameter('date', $date)
            ->orderBy('o.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
