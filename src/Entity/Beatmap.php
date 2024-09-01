<?php

namespace App\Entity;

use App\Repository\BeatmapRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BeatmapRepository::class)]
class Beatmap
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $beatmap_id = null;

    #[ORM\Column]
    private ?int $beatmapset_id = null;

    #[ORM\Column(length: 1024)]
    private ?string $title = null;

    #[ORM\Column(length: 1024)]
    private ?string $title_unicode = null;

    #[ORM\Column(length: 1024)]
    private ?string $artist = null;
    
    #[ORM\Column(length: 1024)]
    private ?string $artist_unicode = null;

    #[ORM\Column(length: 1024)]
    private ?string $difficulty = null;

    #[ORM\Column(length: 32)]
    private ?string $file_md5 = null;

    #[ORM\Column]
    private ?int $ranked_timestamp = null;

    #[ORM\Column]
    private ?int $count_normal = null;

    #[ORM\Column]
    private ?int $count_slider = null;

    #[ORM\Column]
    private ?int $creator_id = null;

    #[ORM\Column]
    private ?int $key_count = null;

    public function getBeatmapId(): ?int
    {
        return $this->beatmap_id;
    }

    public function setBeatmapId(int $beatmap_id): static
    {
        $this->beatmap_id = $beatmap_id;

        return $this;
    }

    public function getBeatmapsetId(): ?int
    {
        return $this->beatmapset_id;
    }

    public function setBeatmapsetId(int $beatmapset_id): static
    {
        $this->beatmapset_id = $beatmapset_id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }
    public function getTitleUnicode(): ?string
    {
        return $this->title_unicode;
    }

    public function setTitleUnicode(string $title_unicode): static
    {
        $this->title_unicode = $title_unicode;

        return $this;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): static
    {
        $this->artist = $artist;

        return $this;
    }

    public function getArtistUnicode(): ?string
    {
        return $this->artist_unicode;
    }

    public function setArtistUnicode(string $artist_unicode): static
    {
        $this->artist_unicode = $artist_unicode;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): static
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getFileMd5(): ?string
    {
        return $this->file_md5;
    }

    public function setFileMd5(string $file_md5): static
    {
        $this->file_md5 = $file_md5;

        return $this;
    }
    
    public function getRankedTimestamp(): ?int
    {
        return $this->ranked_timestamp;
    }

    public function setRankedTimestamp(int $ranked_timestamp): static
    {
        $this->ranked_timestamp = $ranked_timestamp;

        return $this;
    }

    public function getCountNormal(): ?int
    {
        return $this->count_normal;
    }

    public function setCountNormal(int $count_normal): static
    {
        $this->count_normal = $count_normal;

        return $this;
    }

    public function getCountSlider(): ?int
    {
        return $this->count_slider;
    }

    public function setCountSlider(int $count_slider): static
    {
        $this->count_slider = $count_slider;

        return $this;
    }

    public function getCreatorId(): ?int
    {
        return $this->creator_id;
    }

    public function setCreatorId(int $creator_id): static
    {
        $this->creator_id = $creator_id;

        return $this;
    }

    public function getKeyCount(): ?float
    {
        return $this->key_count;
    }

    public function setKeyCount(float $key_count): static
    {
        $this->key_count = $key_count;

        return $this;
    }
}
