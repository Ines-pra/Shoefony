<?php

namespace App\Repository\Store;

use App\Entity\Store\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    // public function myFindAll() : array
    // {
    //     return $this 
    //         ->createQueryBuilder('p')
    //         ->getQuery()
    //         ->getResult();
    // }

    /**
     * @return Product[]
     */
   
    public function findByNameAndCreatedAt() : Array
    {
        return $this
            ->createQueryBuilder('p')
            ->orderBy('p.created_at', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
    public function whereCurrentYear() 
    {
        return $this 
            ->createQueryBuilder('p')
            ->leftJoin('p.comments', 'c')
            ->groupBy('p')
            ->orderBy('COUNT(c.id)', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    public function getProductOfBrand(int $brand):array{
        return $this
            ->createQueryBuilder('p')
            ->where('p.brand = :brand')
            ->setParameter('brand', $brand)
            ->getQuery()
            ->getResult();    
        ;
    }
    

}