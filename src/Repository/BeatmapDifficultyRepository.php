<?php

namespace App\Repository;

use App\Entity\BeatmapDifficulty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BeatmapDifficulty>
 */
class BeatmapDifficultyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BeatmapDifficulty::class);
    }

    public function findOneByBeatmapId(int $beatmap_id): ?BeatmapDifficulty
    {
        return $this->findOneBy(['beatmap_id' => $beatmap_id]);
    }

//    /**
//     * @return BeatmapDifficulty[] Returns an array of BeatmapDifficulty objects
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

//    public function findOneBySomeField($value): ?BeatmapDifficulty
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
