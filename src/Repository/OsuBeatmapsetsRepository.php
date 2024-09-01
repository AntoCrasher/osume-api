<?php

namespace App\Repository;

use App\Entity\OsuBeatmapsets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OsuBeatmapsets>
 */
class OsuBeatmapsetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OsuBeatmapsets::class);
    }

    public function findOneByBeatmapsetId(int $beatmap_id): ?OsuBeatmapsets
    {
        return $this->findOneBy(['beatmapset_id' => $beatmap_id]);
    }
    

//    /**
//     * @return Beatmap[] Returns an array of Beatmap objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Beatmap
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
