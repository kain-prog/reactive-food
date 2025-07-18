<?php

namespace App\Bundles\CardBundle\Repository;

use App\Bundles\CardBundle\Entity\Card;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Card>
 */
class CardRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry   $registry,
    )
    {
        parent::__construct($registry, Card::class);
    }
}
