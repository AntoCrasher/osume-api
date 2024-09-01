<?php

namespace App\Entity;

use App\Repository\BeatmapQueueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BeatmapQueueRepository::class)]
class BeatmapQueue
{
    const STATUS_DONE = 'DONE';
    const STATUS_PENDING = 'PENDING';
    const STATUS_PROCESSING = 'PROCESSING';
    const STATUS_ERROR = 'ERROR';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $file_md5 = null;
    
    #[ORM\Column(type: 'string', length: 20, options: ['default' => self::STATUS_PENDING])]
    private ?string $status = self::STATUS_PENDING;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $ts_created = null;

    #[ORM\Column(type: 'text', length: 1024, nullable: true)]
    private ?string $notice = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $time_taken = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTsCreated(): ?\DateTimeInterface
    {
        return $this->ts_created;
    }

    public function setTsCreated(\DateTimeInterface $ts_created): static
    {
        $this->ts_created = $ts_created;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        if (!in_array($status, [self::STATUS_DONE, self::STATUS_PENDING, self::STATUS_PROCESSING, self::STATUS_ERROR])) {
            throw new \InvalidArgumentException("Invalid status");
        }

        $this->status = $status;

        return $this;
    }

    public function getNotice(): ?string
    {
        return $this->notice;
    }

    public function setNotice(?string $notice): static
    {
        $this->notice = $notice;

        return $this;
    }

    public function getTimeTaken(): ?float
    {
        return $this->time_taken;
    }

    public function setTimeTaken(?float $time_taken): static
    {
        $this->time_taken = $time_taken;

        return $this;
    }
}
