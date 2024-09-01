<?php

namespace App\Entity;

use App\Repository\BeatmapDifficultyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BeatmapDifficultyRepository::class)]
class BeatmapDifficulty
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $beatmap_id = null;

    #[ORM\Id]
    #[ORM\Column]
    private ?int $mode = null;

    #[ORM\Id]
    #[ORM\Column]
    private ?int $mods = null;

    #[ORM\Column]
    private ?float $diff_unified = null;

    public function getBeatmapId(): ?int
    {
        return $this->beatmap_id;
    }

    public function setBeatmapId(int $beatmap_id): static
    {
        $this->beatmap_id = $beatmap_id;

        return $this;
    }

    public function getMode(): ?int
    {
        return $this->mode;
    }

    public function setMode(int $mode): static
    {
        $this->mode = $mode;

        return $this;
    }

    public function getMods(): ?int
    {
        return $this->mods;
    }

    public function setMods(int $mods): static
    {
        $this->mods = $mods;

        return $this;
    }

    public function getDiffUnified(): ?float
    {
        return $this->diff_unified;
    }

    public function setDiffUnified(float $diff_unified): static
    {
        $this->diff_unified = $diff_unified;

        return $this;
    }
}
