<?php

namespace App\Repository;

use App\Entity\Beatmap;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Beatmap>
 */
class BeatmapRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Beatmap::class);
    }

    public function findOneByBeatmapId(int $beatmap_id): ?Beatmap
    {
        return $this->findOneBy(['beatmap_id' => $beatmap_id]);
    }
    public function findOneByFileMd5(string $fileMd5): ?Beatmap
    {
        return $this->findOneBy(['file_md5' => $fileMd5]);
    }
    public function findByFileMd5s(array $fileMd5s): array
    {
        return $this->findBy(['file_md5' => $fileMd5s]);
    }

    public function findDiffsByMd5s(array $fileMd5s, int $batchSize = 500): array
    {
        $results = [];
        $total = count($fileMd5s);

        for ($i = 0; $i < $total; $i += $batchSize) {
            $batch = array_slice($fileMd5s, $i, $batchSize);

            $qb = $this->createQueryBuilder('m')
                ->select('m.file_md5, d.mods, d.diff_unified')
                ->innerJoin('App\Entity\BeatmapDifficulty', 'd', 'WITH', 'm.beatmap_id = d.beatmap_id')
                ->where('m.file_md5 IN (:fileMd5s)')
                ->setParameter('fileMd5s', $batch);

            $batchResults = $qb->getQuery()->getResult();
            $results = array_merge($results, $batchResults);
        }

        return $results;
    }

    public function findOneNoTimestamp(): ?Beatmap
    {
        return $this->createQueryBuilder('b')
        ->where('b.ranked_timestamp = 0')
        ->orderBy('b.beatmap_id', 'ASC')
        ->setMaxResults(1)
        ->getQuery()
        ->getOneOrNullResult();
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
