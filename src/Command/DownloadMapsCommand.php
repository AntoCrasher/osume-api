<?php

namespace App\Command;

use App\Entity\Beatmap;
use App\Entity\BeatmapDifficulty;
use App\Repository\BeatmapDifficultyRepository;
use App\Repository\BeatmapRepository;
use App\Repository\BeatmapQueueRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DownloadMapsCommand extends Command
{
    private $entityManager;
    private $beatmapRepository;
    private $beatmapDifficultyRepository;
    private $beatmapQueueRepository;

    public function __construct(EntityManagerInterface $entityManager, BeatmapRepository $beatmapRepository, BeatmapDifficultyRepository $beatmapDifficultyRepository, BeatmapQueueRepository $beatmapQueueRepository)
    {
        $this->entityManager = $entityManager;
        $this->beatmapRepository = $beatmapRepository;
        $this->beatmapDifficultyRepository = $beatmapDifficultyRepository;
        $this->beatmapQueueRepository = $beatmapQueueRepository;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('app:download-maps-command')
             ->setDescription('Download all queued maps');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $timelimit = 55;
        $ts_start = microtime(true);
        while (true) {
            $queue_beatmap = $this->beatmapQueueRepository->findOnePending();
            if ($queue_beatmap) {
                $ts_processing = microtime(true);

                $queue_beatmap->setStatus('PROCESSING');
                $this->entityManager->persist($queue_beatmap);
                $this->entityManager->flush();

                $hash = $queue_beatmap->getFileMd5();
                    
                $data = file_get_contents('https://osu.ppy.sh/api/get_beatmaps?k=' . $_ENV['OSU_API_KEY'] . '&h=' . $hash . '&mods=0');
                $data_half_time = file_get_contents('https://osu.ppy.sh/api/get_beatmaps?k=' . $_ENV['OSU_API_KEY'] . '&h=' . $hash . '&mods=256');
                $data_double_time = file_get_contents('https://osu.ppy.sh/api/get_beatmaps?k=' . $_ENV['OSU_API_KEY'] . '&h=' . $hash . '&mods=64');
                
                $error = false;
                $empty = false;

                try {
                    $data = json_decode($data);
                    if (count($data) > 0) {
                        $data = $data[0];
                        $data_half_time = json_decode($data_half_time)[0];
                        $data_double_time = json_decode($data_double_time)[0];
                        
                        $beatmap = new Beatmap();
                        $beatmap->setBeatmapsetId($data->beatmapset_id);
                        $beatmap->setBeatmapId($data->beatmap_id);
                        $beatmap->setFileMd5($hash);
                        $beatmap->setRankedTimestamp(strtotime($data->approved_date) * 1000);
                        $beatmap->setTitle($data->title);
                        $beatmap->setTitleUnicode($data->title_unicode);
                        $beatmap->setArtist($data->artist);
                        $beatmap->setArtistUnicode($data->artist_unicode);
                        $beatmap->setDifficulty($data->version);
                        $beatmap->setKeyCount($data->diff_size);
                        $beatmap->setCountNormal($data->count_normal);
                        $beatmap->setCountSlider($data->count_slider);
                        $beatmap->setCreatorId($data->creator_id);
    
                        $beatmap_difficulty = new BeatmapDifficulty();
                        $beatmap_difficulty_half_time = new BeatmapDifficulty();
                        $beatmap_difficulty_double_time = new BeatmapDifficulty();
                        
                        $beatmap_difficulty->setBeatmapId($data->beatmap_id);
                        $beatmap_difficulty->setMode($data->mode);
                        $beatmap_difficulty->setMods(0);
                        $beatmap_difficulty->setDiffUnified($data->difficultyrating);
    
                        $beatmap_difficulty_half_time->setBeatmapId($data_half_time->beatmap_id);
                        $beatmap_difficulty_half_time->setMode($data_half_time->mode);
                        $beatmap_difficulty_half_time->setMods(256);
                        $beatmap_difficulty_half_time->setDiffUnified($data_half_time->difficultyrating);
    
                        $beatmap_difficulty_double_time->setBeatmapId($data_double_time->beatmap_id);
                        $beatmap_difficulty_double_time->setMode($data_double_time->mode);
                        $beatmap_difficulty_double_time->setMods(64);
                        $beatmap_difficulty_double_time->setDiffUnified($data_double_time->difficultyrating);
                    } else {
                        $empty = true;
                    }
                }
                catch (\Exception $e){
                    $error = true;
                    $queue_beatmap->setStatus('ERROR');
                    $queue_beatmap->setNotice($e->getMessage());
                    $output->writeln('ERROR: ' . $hash);
                }
                if ($empty) {
                    $id = floor(microtime(true) * 1000);
                    
                    $beatmap = new Beatmap();
                    $beatmap_difficulty = new BeatmapDifficulty();
                    $beatmap_difficulty_half_time = new BeatmapDifficulty();
                    $beatmap_difficulty_double_time = new BeatmapDifficulty();

                    $beatmap->setBeatmapId($id);
                    $beatmap->setBeatmapsetId($id);
                    $beatmap->setFileMd5($hash);
                    $beatmap->setRankedTimestamp(-1);
                    $beatmap->setTitle('');
                    $beatmap->setTitleUnicode('');
                    $beatmap->setArtist('');
                    $beatmap->setArtistUnicode('');
                    $beatmap->setDifficulty('');
                    $beatmap->setCountNormal(0);
                    $beatmap->setCountSlider(0);
                    $beatmap->setCreatorId(0);
                    $beatmap->setKeyCount(0);

                    $beatmap_difficulty->setBeatmapId($id);
                    $beatmap_difficulty->setMode(0);
                    $beatmap_difficulty->setMods(0);
                    $beatmap_difficulty->setDiffUnified(0);

                    $beatmap_difficulty_half_time->setBeatmapId($id);
                    $beatmap_difficulty_half_time->setMode(0);
                    $beatmap_difficulty_half_time->setMods(256);
                    $beatmap_difficulty_half_time->setDiffUnified(0);

                    $beatmap_difficulty_double_time->setBeatmapId($id);
                    $beatmap_difficulty_double_time->setMode(0);
                    $beatmap_difficulty_double_time->setMods(64);
                    $beatmap_difficulty_double_time->setDiffUnified(0);
                }
                $queue_beatmap->setTimeTaken(microtime(true) - $ts_processing);

                if ($this->beatmapRepository->findOneByFileMd5($hash) == null ) {
                    if (!$error) {
                        $queue_beatmap->setStatus('DONE');

                        $this->entityManager->persist($beatmap);
    
                        if ($this->beatmapDifficultyRepository->findOneByBeatmapId($beatmap_difficulty->getBeatmapId()) == null) {
                            $this->entityManager->persist($beatmap_difficulty);
                            $this->entityManager->persist($beatmap_difficulty_half_time);
                            $this->entityManager->persist($beatmap_difficulty_double_time);
                        }
                    }
                } else {
                    $queue_beatmap->setNotice('Beatmap already processed.');
                }
                if (!$error && !$empty) {
                    $queue_beatmap->setStatus('DONE');
                    $output->writeln('DONE: ' . $hash . ': '. $beatmap->getArtist() . ' - ' . $beatmap->getTitle() . ' [' . $beatmap->getDifficulty() . ']');
                }
                else if ($empty) {
                    $output->writeln('INVALID HASH: ' . $hash);
                    $queue_beatmap->setStatus('DONE');
                    $queue_beatmap->setNotice('MAP NOT EXIST');
                }

                $this->entityManager->persist($queue_beatmap);
                $this->entityManager->flush();
                
                if (microtime(true) - $ts_start > $timelimit) {
                    break;
                }
            } else {
                sleep(1);
            }

            if (microtime(true) - $ts_start > $timelimit) {
                break;
            }
        }
        // php bin/console app:download-maps-command
        return Command::SUCCESS;
    }
}
