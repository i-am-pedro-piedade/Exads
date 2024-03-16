<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TvShow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TvShow>
 *
 * @method TvShow|null find($id, $lockMode = null, $lockVersion = null)
 * @method TvShow|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<TvShow> findAll()
 * @method array<TvShow> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TvShowRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TvShow::class);
    }

    /**
     * @return array<TvShow>
     */
    public function findAllSortedByTitle(): array
    {
        return $this
            ->createQueryBuilder('t')
            ->orderBy('t.title')
            ->getQuery()
            ->getResult();
    }

    public function findAllQb(): QueryBuilder
    {
        return $this->createQueryBuilder('t')->orderBy('t.title');
    }
}
