<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function findByFilters($formData)
    {
        $queryBuilder = $this->createQueryBuilder('c');

        if (isset($formData['yearMin']) && isset($formData['yearMax'])) {
            $queryBuilder->andWhere('c.year >= :yearMin')
                ->andWhere('c.year <= :yearMax')
                ->setParameter('yearMin', $formData['yearMin'])
                ->setParameter('yearMax', $formData['yearMax']);
        }

        if (isset($formData['mileageMin']) && isset($formData['mileageMax'])) {
            $queryBuilder->andWhere('c.mileage >= :mileageMin')
                ->andWhere('c.mileage <= :mileageMax')
                ->setParameter('mileageMin', $formData['mileageMin'])
                ->setParameter('mileageMax', $formData['mileageMax']);
        }

        if (isset($formData['priceMin']) && isset($formData['priceMax'])) {
            $queryBuilder->andWhere('c.price >= :priceMin')
                ->andWhere('c.price <= :priceMax')
                ->setParameter('priceMin', $formData['priceMin'])
                ->setParameter('priceMax', $formData['priceMax']);
        }

        return $queryBuilder->getQuery()->getResult();
    }

//    /**
//     * @return Car[] Returns an array of Car objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Car
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
