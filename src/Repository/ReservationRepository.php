<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function occupiedFinder($checkinDate, $checkoutDate)
    {
        return $this->createQueryBuilder('d')
            ->where('d.checkinDate BETWEEN :from AND :to')
            ->orWhere('d.checkoutDate BETWEEN :from AND :to')
            ->orWhere(':from BETWEEN d.checkinDate and d.checkoutDate ')
            ->orderBy('d.checkinDate', 'ASC')
            ->setParameter('from', $checkinDate)
            ->setParameter('to', $checkoutDate)
            ->getSQL();    

       return $this->     
    }
}
