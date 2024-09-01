<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BeatmapsetRepository;

#[ORM\Entity(repositoryClass: BeatmapsetRepository::class)]
#[ORM\Table(name: "osu_beatmapsets")]
class OsuBeatmapsets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $beatmapset_id = null;

    #[ORM\Column(type: "integer", options: ["default" => 0])]
    private int $user_id;

    #[ORM\Column(type: "integer", options: ["default" => 0])]
    private int $thread_id;

    #[ORM\Column(type: "string", length: 80, options: ["default" => ""])]
    private string $artist;

    #[ORM\Column(type: "string", length: 80, nullable: true)]
    private ?string $artist_unicode = null;

    #[ORM\Column(type: "string", length: 80, options: ["default" => ""])]
    private string $title;

    #[ORM\Column(type: "string", length: 80, nullable: true)]
    private ?string $title_unicode = null;

    #[ORM\Column(type: "string", length: 80, options: ["default" => ""])]
    private string $creator;

    #[ORM\Column(type: "string", length: 200, options: ["default" => ""])]
    private string $source;

    #[ORM\Column(type: "string", length: 1000, options: ["default" => ""])]
    private string $tags;

    #[ORM\Column(type: "boolean", options: ["default" => 0])]
    private bool $video;

    #[ORM\Column(type: "boolean", options: ["default" => 0])]
    private bool $storyboard;

    #[ORM\Column(type: "boolean", options: ["default" => 0])]
    private bool $epilepsy;

    #[ORM\Column(type: "float", options: ["default" => 0])]
    private float $bpm;

    #[ORM\Column(type: "smallint", options: ["default" => 1])]
    private int $versions_available;

    #[ORM\Column(type: "smallint", options: ["default" => 0])]
    private int $approved;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $approvedby_id = null;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $approved_date = null;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $submit_date = null;

    #[ORM\Column(type: "string", options: ["default" => "CURRENT_TIMESTAMP"])]
    private string $last_update;

    #[ORM\Column(type: "string", length: 120, nullable: true, options: ["collation" => "utf8mb3_bin"])]
    private ?string $filename = null;

    #[ORM\Column(type: "boolean", options: ["default" => 1])]
    private bool $active;

    #[ORM\Column(type: "float", options: ["default" => 0])]
    private float $rating;

    #[ORM\Column(type: "smallint", options: ["default" => 0])]
    private int $offset;

    #[ORM\Column(type: "string", length: 200, options: ["default" => ""])]
    private string $displaytitle;

    #[ORM\Column(type: "smallint", options: ["default" => 1])]
    private int $genre_id;

    #[ORM\Column(type: "smallint", options: ["default" => 1])]
    private int $language_id;

    #[ORM\Column(type: "smallint", options: ["default" => 0])]
    private int $star_priority;

    #[ORM\Column(type: "bigint", options: ["default" => 0])]
    private int $filesize;

    #[ORM\Column(type: "bigint", nullable: true)]
    private ?int $filesize_novideo = null;

    #[ORM\Column(type: "string", length: 16, nullable: true)]
    private ?string $body_hash = null;

    #[ORM\Column(type: "string", length: 16, nullable: true)]
    private ?string $header_hash = null;

    #[ORM\Column(type: "string", length: 16, nullable: true)]
    private ?string $osz2_hash = null;

    #[ORM\Column(type: "boolean", options: ["default" => 0])]
    private bool $download_disabled;

    #[ORM\Column(type: "string", length: 100, nullable: true, options: ["collation" => "utf8mb3_bin"])]
    private ?string $download_disabled_url = null;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $thread_icon_date = null;

    #[ORM\Column(type: "integer", options: ["default" => 0])]
    private int $favourite_count;

    #[ORM\Column(type: "integer", options: ["default" => 0])]
    private int $play_count;

    #[ORM\Column(type: "string", length: 2048, nullable: true)]
    private ?string $difficulty_names = null;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $cover_updated_at = null;

    #[ORM\Column(type: "boolean", options: ["default" => 0])]
    private bool $discussion_enabled;

    #[ORM\Column(type: "boolean", options: ["default" => 0])]
    private bool $discussion_locked;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?string $deleted_at = null;

    #[ORM\Column(type: "integer", options: ["default" => 0])]
    private int $hype;

    #[ORM\Column(type: "integer", options: ["default" => 0])]
    private int $nominations;

    #[ORM\Column(type: "integer", options: ["default" => 0])]
    private int $previous_queue_duration;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $queued_at = null;

    #[ORM\Column(type: "string", length: 32, nullable: true)]
    private ?string $storyboard_hash = null;

    #[ORM\Column(type: "boolean", options: ["default" => 0])]
    private bool $nsfw;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $track_id = null;

    #[ORM\Column(type: "boolean", options: ["default" => 0])]
    private bool $spotlight;

    #[ORM\Column(type: "boolean", nullable: true)]
    private ?bool $comment_locked = null;

    #[ORM\Column(type: "text", nullable: true, options: ["collation" => "utf8mb4_bin"])]
    private ?string $eligible_main_rulesets = null;
    
    // Beatmapset ID
    public function getBeatmapsetId(): ?int
    {
        return $this->beatmapset_id;
    }

    public function setBeatmapsetId(int $beatmapset_id): static
    {
        $this->beatmapset_id = $beatmapset_id;
        return $this;
    }

    // User ID
    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;
        return $this;
    }

    // Thread ID
    public function getThreadId(): int
    {
        return $this->thread_id;
    }

    public function setThreadId(int $thread_id): static
    {
        $this->thread_id = $thread_id;
        return $this;
    }

    // Artist
    public function getArtist(): string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): static
    {
        $this->artist = $artist;
        return $this;
    }

    // Artist Unicode
    public function getArtistUnicode(): ?string
    {
        return $this->artist_unicode;
    }

    public function setArtistUnicode(?string $artist_unicode): static
    {
        $this->artist_unicode = $artist_unicode;
        return $this;
    }

    // Title
    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    // Title Unicode
    public function getTitleUnicode(): ?string
    {
        return $this->title_unicode;
    }

    public function setTitleUnicode(?string $title_unicode): static
    {
        $this->title_unicode = $title_unicode;
        return $this;
    }

    // Creator
    public function getCreator(): string
    {
        return $this->creator;
    }

    public function setCreator(string $creator): static
    {
        $this->creator = $creator;
        return $this;
    }

    // Source
    public function getSource(): string
    {
        return $this->source;
    }

    public function setSource(string $source): static
    {
        $this->source = $source;
        return $this;
    }

    // Tags
    public function getTags(): string
    {
        return $this->tags;
    }

    public function setTags(string $tags): static
    {
        $this->tags = $tags;
        return $this;
    }

    // Video
    public function hasVideo(): bool
    {
        return $this->video;
    }

    public function setVideo(bool $video): static
    {
        $this->video = $video;
        return $this;
    }

    // Storyboard
    public function hasStoryboard(): bool
    {
        return $this->storyboard;
    }

    public function setStoryboard(bool $storyboard): static
    {
        $this->storyboard = $storyboard;
        return $this;
    }

    // Epilepsy
    public function hasEpilepsy(): bool
    {
        return $this->epilepsy;
    }

    public function setEpilepsy(bool $epilepsy): static
    {
        $this->epilepsy = $epilepsy;
        return $this;
    }

    // BPM
    public function getBpm(): float
    {
        return $this->bpm;
    }

    public function setBpm(float $bpm): static
    {
        $this->bpm = $bpm;
        return $this;
    }

    // Versions Available
    public function getVersionsAvailable(): int
    {
        return $this->versions_available;
    }

    public function setVersionsAvailable(int $versions_available): static
    {
        $this->versions_available = $versions_available;
        return $this;
    }

    // Approved
    public function getApproved(): int
    {
        return $this->approved;
    }

    public function setApproved(int $approved): static
    {
        $this->approved = $approved;
        return $this;
    }

    // Approved By ID
    public function getApprovedbyId(): ?int
    {
        return $this->approvedby_id;
    }

    public function setApprovedbyId(?int $approvedby_id): static
    {
        $this->approvedby_id = $approvedby_id;
        return $this;
    }

    // Approved Date
    public function getApprovedDate(): ?string
    {
        return $this->approved_date;
    }

    public function setApprovedDate(?string $approved_date): static
    {
        $this->approved_date = $approved_date;
        return $this;
    }

    // Submit Date
    public function getSubmitDate(): ?string
    {
        return $this->submit_date;
    }

    public function setSubmitDate(?string $submit_date): static
    {
        $this->submit_date = $submit_date;
        return $this;
    }

    // Last Update
    public function getLastUpdate(): string
    {
        return $this->last_update;
    }

    public function setLastUpdate(string $last_update): static
    {
        $this->last_update = $last_update;
        return $this;
    }

    // Filename
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): static
    {
        $this->filename = $filename;
        return $this;
    }

    // Active
    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;
        return $this;
    }

    // Rating
    public function getRating(): float
    {
        return $this->rating;
    }

    public function setRating(float $rating): static
    {
        $this->rating = $rating;
        return $this;
    }

    // Offset
    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setOffset(int $offset): static
    {
        $this->offset = $offset;
        return $this;
    }

    // Display Title
    public function getDisplayTitle(): string
    {
        return $this->displaytitle;
    }

    public function setDisplayTitle(string $displaytitle): static
    {
        $this->displaytitle = $displaytitle;
        return $this;
    }

    // Genre ID
    public function getGenreId(): int
    {
        return $this->genre_id;
    }

    public function setGenreId(int $genre_id): static
    {
        $this->genre_id = $genre_id;
        return $this;
    }

    // Language ID
    public function getLanguageId(): int
    {
        return $this->language_id;
    }

    public function setLanguageId(int $language_id): static
    {
        $this->language_id = $language_id;
        return $this;
    }

    // Star Priority
    public function getStarPriority(): int
    {
        return $this->star_priority;
    }

    public function setStarPriority(int $star_priority): static
    {
        $this->star_priority = $star_priority;
        return $this;
    }

    // Filesize
    public function getFilesize(): int
    {
        return $this->filesize;
    }

    public function setFilesize(int $filesize): static
    {
        $this->filesize = $filesize;
        return $this;
    }

    // Filesize No Video
    public function getFilesizeNovideo(): ?int
    {
        return $this->filesize_novideo;
    }

    public function setFilesizeNovideo(?int $filesize_novideo): static
    {
        $this->filesize_novideo = $filesize_novideo;
        return $this;
    }

    // Body Hash
    public function getBodyHash(): ?string
    {
        return $this->body_hash;
    }

    public function setBodyHash(?string $body_hash): static
    {
        $this->body_hash = $body_hash;
        return $this;
    }

    // Header Hash
    public function getHeaderHash(): ?string
    {
        return $this->header_hash;
    }

    public function setHeaderHash(?string $header_hash): static
    {
        $this->header_hash = $header_hash;
        return $this;
    }

    // Osz2 Hash
    public function getOsz2Hash(): ?string
    {
        return $this->osz2_hash;
    }

    public function setOsz2Hash(?string $osz2_hash): static
    {
        $this->osz2_hash = $osz2_hash;
        return $this;
    }

    // Download Disabled
    public function isDownloadDisabled(): bool
    {
        return $this->download_disabled;
    }

    public function setDownloadDisabled(bool $download_disabled): static
    {
        $this->download_disabled = $download_disabled;
        return $this;
    }

    // Download Disabled URL
    public function getDownloadDisabledUrl(): ?string
    {
        return $this->download_disabled_url;
    }

    public function setDownloadDisabledUrl(?string $download_disabled_url): static
    {
        $this->download_disabled_url = $download_disabled_url;
        return $this;
    }

    // Thread Icon Date
    public function getThreadIconDate(): ?string
    {
        return $this->thread_icon_date;
    }

    public function setThreadIconDate(?string $thread_icon_date): static
    {
        $this->thread_icon_date = $thread_icon_date;
        return $this;
    }

    // Favourite Count
    public function getFavouriteCount(): int
    {
        return $this->favourite_count;
    }

    public function setFavouriteCount(int $favourite_count): static
    {
        $this->favourite_count = $favourite_count;
        return $this;
    }

    // Play Count
    public function getPlayCount(): int
    {
        return $this->play_count;
    }

    public function setPlayCount(int $play_count): static
    {
        $this->play_count = $play_count;
        return $this;
    }

    // Difficulty Names
    public function getDifficultyNames(): ?string
    {
        return $this->difficulty_names;
    }

    public function setDifficultyNames(?string $difficulty_names): static
    {
        $this->difficulty_names = $difficulty_names;
        return $this;
    }

    // Cover Updated At
    public function getCoverUpdatedAt(): ?string
    {
        return $this->cover_updated_at;
    }

    public function setCoverUpdatedAt(?string $cover_updated_at): static
    {
        $this->cover_updated_at = $cover_updated_at;
        return $this;
    }

    // Discussion Enabled
    public function isDiscussionEnabled(): bool
    {
        return $this->discussion_enabled;
    }

    public function setDiscussionEnabled(bool $discussion_enabled): static
    {
        $this->discussion_enabled = $discussion_enabled;
        return $this;
    }

    // Discussion Locked
    public function isDiscussionLocked(): bool
    {
        return $this->discussion_locked;
    }

    public function setDiscussionLocked(bool $discussion_locked): static
    {
        $this->discussion_locked = $discussion_locked;
        return $this;
    }

    // Deleted At
    public function getDeletedAt(): ?string
    {
        return $this->deleted_at;
    }

    public function setDeletedAt(?string $deleted_at): static
    {
        $this->deleted_at = $deleted_at;
        return $this;
    }

    // Hype
    public function getHype(): int
    {
        return $this->hype;
    }

    public function setHype(int $hype): static
    {
        $this->hype = $hype;
        return $this;
    }

    // Nominations
    public function getNominations(): int
    {
        return $this->nominations;
    }

    public function setNominations(int $nominations): static
    {
        $this->nominations = $nominations;
        return $this;
    }

    // Previous Queue Duration
    public function getPreviousQueueDuration(): int
    {
        return $this->previous_queue_duration;
    }

    public function setPreviousQueueDuration(int $previous_queue_duration): static
    {
        $this->previous_queue_duration = $previous_queue_duration;
        return $this;
    }

    // Queued At
    public function getQueuedAt(): ?string
    {
        return $this->queued_at;
    }

    public function setQueuedAt(?string $queued_at): static
    {
        $this->queued_at = $queued_at;
        return $this;
    }

    // Storyboard Hash
    public function getStoryboardHash(): ?string
    {
        return $this->storyboard_hash;
    }

    public function setStoryboardHash(?string $storyboard_hash): static
    {
        $this->storyboard_hash = $storyboard_hash;
        return $this;
    }

    // NSFW
    public function isNsfw(): bool
    {
        return $this->nsfw;
    }

    public function setNsfw(bool $nsfw): static
    {
        $this->nsfw = $nsfw;
        return $this;
    }

    // Track ID
    public function getTrackId(): ?int
    {
        return $this->track_id;
    }

    public function setTrackId(?int $track_id): static
    {
        $this->track_id = $track_id;
        return $this;
    }

    // Spotlight
    public function isSpotlight(): bool
    {
        return $this->spotlight;
    }

    public function setSpotlight(bool $spotlight): static
    {
        $this->spotlight = $spotlight;
        return $this;
    }

    // Comment Locked
    public function isCommentLocked(): ?bool
    {
        return $this->comment_locked;
    }

    public function setCommentLocked(?bool $comment_locked): static
    {
        $this->comment_locked = $comment_locked;
        return $this;
    }

    // Eligible Main Rulesets
    public function getEligibleMainRulesets(): ?string
    {
        return $this->eligible_main_rulesets;
    }

    public function setEligibleMainRulesets(?string $eligible_main_rulesets): static
    {
        $this->eligible_main_rulesets = $eligible_main_rulesets;
        return $this;
    }

}
