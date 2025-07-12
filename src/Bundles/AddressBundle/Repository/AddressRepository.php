<?php

namespace App\Bundles\AddressBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Address>
 */
class AddressRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry   $registry,
    )
    {
        parent::__construct($registry, Address::class);
    }
}
