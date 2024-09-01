<?php

namespace App\Controller;

use App\Entity\BeatmapQueue;
use App\Repository\BeatmapRepository;
use App\Repository\BeatmapQueueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfoController
{
    private $entityManager;
    private $beatmapRepository;
    private $beatmapQueueRepository;

    public function __construct(EntityManagerInterface $entityManager, BeatmapRepository $beatmapRepository, BeatmapQueueRepository $beatmapQueueRepository)
    {
        $this->entityManager = $entityManager;
        $this->beatmapRepository = $beatmapRepository;
        $this->beatmapQueueRepository = $beatmapQueueRepository;
    }

    #[Route('/v1/beatmap/info', name: 'app_info', methods: ['POST', 'GET'])]
    public function info(Request $request): Response
    {
        // Handle actual POST request
        $requestData = json_decode($request->getContent(), true);
        
        if (!isset($requestData['hashes'])) {
            $response = new Response('Hashes parameter is missing', Response::HTTP_BAD_REQUEST);
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        }

        $hashes = $requestData['hashes'];

        $beatmaps = [];
        $found_hashes = [];
        $found_diffs = $this->beatmapRepository->findDiffsByMd5s($hashes);

        foreach ($found_diffs as $beatmap) {
            $beatmapHash = $beatmap['file_md5'];

            if (!isset($beatmaps[$beatmapHash])) {
                $beatmaps[$beatmapHash] = ['sr' => []];
            }
            $beatmaps[$beatmapHash]['sr'][$beatmap['mods']] = $beatmap['diff_unified'];
            array_push($found_hashes, $beatmapHash);
        }
        $found_beatmaps = $this->beatmapRepository->findByFileMd5s($hashes);
        foreach ($found_beatmaps as $beatmap) {
            $beatmapHash = $beatmap->getFileMd5();
            $beatmaps[$beatmapHash]['ranked_timestamp'] = $beatmap->getRankedTimestamp();
        }

        $not_found_hashes = array_diff($hashes, $found_hashes);

        foreach ($not_found_hashes as $not_found_hash) {
            $queue_beatmap = new BeatmapQueue();
            $queue_beatmap->setFileMd5($not_found_hash);
            $this->entityManager->persist($queue_beatmap);
        }
        
        $this->entityManager->flush();
        $response = new Response(json_encode($beatmaps));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}