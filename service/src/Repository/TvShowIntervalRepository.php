<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TvShowInterval;
use App\Entity\TvShow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use DateTime;

/**
 * @extends ServiceEntityRepository<TvShowInterval>
 *
 * @method TvShowInterval|null find($id, $lockMode = null, $lockVersion = null)
 * @method TvShowInterval|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<TvShowInterval> findAll()
 * @method array<TvShowInterval> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TvShowIntervalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TvShowInterval::class);
    }

    /**
     * @param array<string, DateTime|Collection<int, TvShow>>|null $filters
     * @return TvShowInterval|null
     */
    public function findNext(?array $filters): ?TvShowInterval
    {
        /** @var DateTime|null $datetime */
        $datetime = $filters['afterDate'] ?? new DateTime();
        $weekDay = intval($datetime->format('N'));
        $showTime = intval($datetime->format('G')) * 60 + intval($datetime->format('i'));
        /** @var Collection<int, TvShow>|null $tvShows */
        $tvShows = $filters['tvShows'] ?? null;

        $qb = $this
            ->createQueryBuilder('i')
            ->setMaxResults(1);
        $qb = $this->addFilterByDayOfWeek($qb, $weekDay, $showTime);
        $qb = $this->addFilterByShowToQb($qb, $tvShows);
        return $qb->getQuery()->getOneOrNullResult() ?? $this->findNextInTheFollowingWeek($filters);
    }

    /**
     * @param array<string, DateTime|Collection<int, TvShow>>|null $filters
     * @return TvShowInterval|null
     */
    protected function findNextInTheFollowingWeek(?array $filters): ?TvShowInterval
    {
        /** @var Collection<int, TvShow>|null $tvShows */
        $tvShows = $filters['tvShows'] ?? null;
        $qb = $this
            ->createQueryBuilder('i')
            ->setMaxResults(1);
        $qb = $this->addFilterByDayOfWeek($qb);
        $qb = $this->addFilterByShowToQb($qb, $tvShows);
        return $qb->getQuery()->getOneOrNullResult();
    }

    protected function addFilterByDayOfWeek(QueryBuilder $qb, int $weekDay = 0, int $showTime = 0): QueryBuilder
    {
        return $qb->where('i.weekDay >= :weekDay')
            ->andWhere('i.showTime >= :showTime')
            ->orderBy('i.weekDay')
            ->addOrderBy('i.showTime')
            ->setParameter('weekDay', $weekDay)
            ->setParameter('showTime', $showTime);
    }

    /**
     * @param QueryBuilder $qb
     * @param Collection<int, TvShow>|null $tvShows
     * @return QueryBuilder
     */
    protected function addFilterByShowToQb(QueryBuilder $qb, ?Collection $tvShows): QueryBuilder
    {
        if ($tvShows && count($tvShows) > 0) {
            $qb->andWhere('i.tvShow IN (:tvShows)')
                ->setParameter('tvShows', $tvShows);
        }
        return $qb;
    }
}
