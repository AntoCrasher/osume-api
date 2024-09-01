<?php

namespace App\Command;

use App\Entity\Beatmap;
use App\Entity\BeatmapDifficulty;
use App\Repository\BeatmapDifficultyRepository;
use App\Repository\BeatmapRepository;
use App\Repository\OsuBeatmapsetsRepository;
use App\Repository\BeatmapQueueRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddRankedTimestamp extends Command
{
    private $entityManager;
    private $beatmapRepository;
    private $osuBeatmapsetsRepository;
    private $beatmapDifficultyRepository;
    private $beatmapQueueRepository;

    public function __construct(EntityManagerInterface $entityManager, BeatmapRepository $beatmapRepository, OsuBeatmapsetsRepository $osuBeatmapsetsRepository, BeatmapDifficultyRepository $beatmapDifficultyRepository, BeatmapQueueRepository $beatmapQueueRepository)
    {
        $this->entityManager = $entityManager;
        $this->beatmapRepository = $beatmapRepository;
        $this->osuBeatmapsetsRepository = $osuBeatmapsetsRepository;
        $this->beatmapDifficultyRepository = $beatmapDifficultyRepository;
        $this->beatmapQueueRepository = $beatmapQueueRepository;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('app:add-ranked-timestamp')
             ->setDescription('ranked timestamps');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        while (true) {
            $skip = false;
            $from_own = true;

            $no_timestamp = $this->beatmapRepository->findOneNoTimestamp();
        
            if (!$no_timestamp) {
                $output->writeln('No beatmap found with a ranked timestamp of 0.');
                break;
            }
            $output->write("\033[3A\033[0J\033[0J");
            $output->writeln('Found: ' . $no_timestamp->getTitle() . ' by ' . $no_timestamp->getArtist() . ' [' . $no_timestamp->getDifficulty() . ']');
            
            $hash = $no_timestamp->getFileMd5();

            if ($from_own) {
                $data = json_decode(file_get_contents('https://osu.ppy.sh/api/get_beatmaps?k=' . $_ENV['OSU_API_KEY'] . '&h=' . $hash . '&mods=0'));
                
                if (count($data) == 0) {
                    $output->writeln('EMPTY DATA');
                    if ($no_timestamp->getKeyCount() == 0) {
                        $no_timestamp->setRankedTimestamp(-1);
                        $skip = true;
                    } else {
                        break;
                    }
                }
                if (!$skip) {
                    $ranked_date = $data[0]->approved_date;
                }
            } else {
                $osu_beatmapset = $this->osuBeatmapsetsRepository->findOneByBeatmapsetId($no_timestamp->getBeatmapsetId());
                if (!$osu_beatmapset) {
                    $output->writeln('BEATMAPSET NOT FOUND');
                    break;
                }
                $ranked_date = $osu_beatmapset->getApprovedDate();
            }
            if (!$skip) {
                $ranked_timestamp = strtotime($ranked_date) * 1000;

                $output->writeln('Timestamp: ' . $ranked_timestamp);
                $output->writeln('');
    
                $no_timestamp->setRankedTimestamp($ranked_timestamp);
            } else {
                $output->writeln('Timestamp: -1');
            }

            $this->entityManager->persist($no_timestamp);
            $this->entityManager->flush();
        }

        // php bin/console app:add-ranked-timestamp
        return Command::SUCCESS;
    }
}
